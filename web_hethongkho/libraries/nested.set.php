<?php
/**
 * @category   	PHP classes
 * @package    	Database
 * @copyright  	Copyright (c) 2019		
 * @version     v1.0
 */

class Nested_Set extends database{
	
	/**
	 * Resource of connection from Database
	 * 
	 * @var resource
	 * 
	 */
	
	public $_kn;

	public $_connect;
	
	/**
	 * Name of table in database
	 * 
	 * @var string
	 * 
	 */
	private $_table;
	
	/**
	* Name of database
	*
	* @var string
	*/
	private $_db;
	
	public  $_parent = 0; 
	
	public 	$_data; 
	
	public 	$_id; 
	
	public 	$_orderArr; 
	
	public $_maxlevel=9;
	/**
	* Construct
	* 
	*
	* @param  array Create connection to database.
	* @param  string Database adapter
	*
	* @return MySQL connection.
	*/
	public function __construct($params = array()) {
		$this->_kn = parent::database($params);
		$this->connect();
		$this->_table = $params['refix'].$params['table'];
	}
	
	/**
	* Update info of node
	* 
	*
	* @param  array Data array store node info.
	* @param  int ID of node which you modify.
	* @param  int ID of parent node if you change parent node when you update current node
	*
	* @return A node modified and node info save to database.
	*/
	
	public function updateNode($type,$data,$id = null,$newParentId = 0){
		if($id != null && $id != 0){
			$nodeInfo = $this->getNodeInfo($id);
			$strUpdate = $this->createUpdateQuery($data);
			$sql	= 'UPDATE ' . $this->_table . '  
					   SET ' . $strUpdate . '  
					   WHERE type="'.$type.'" and id = ' . $id;		
			$this->query($sql);
		}
		
		if($newParentId != null && $newParentId > 0){
			if($nodeInfo['parents'] != $newParentId){
				$this->moveNode($type,$id,$newParentId);
			}
		}
		
	}
	
	/**
	* Move node to new parent (move: left - right - before - after)
	* 
	*
	* @param  int ID of node which you want move to new parent.
	* @param  int ID of parent node which you want apply new node
	* @param  array Case when you apply new node (apply: left position - right position - before position - after position)
	*
	* @return Change tree structure.
	*/
	
	public function moveNode($type, $id, $parent = 0, $options = null){
		$this->_id 	= $id;
		$this->_parent 	= $parent;
		
		if($options['position'] == 'right' || $options == null)	$this->moveRight($type);
		
		if($options['position'] == 'left')	$this->moveLeft($type);
		
		if($options['position'] == 'after')	$this->movetAfter($type,$options['brother_id']);
		
		if($options['position'] == 'before') $this->moveBefore($type,$options['brother_id']);
	}
	
	/**
	* Move node to left postion a unit on a level
	* 
	*
	* @param  int ID of node which you want move to new position.
	* 
	* @return Change tree structure.
	* 
	*/
	public function moveUp($type,$id){
		$nodeInfo = $this->getNodeInfo($id);		
		$parentInfo = $this->getNodeInfo($nodeInfo['parents']);
		
		$sql 	= 'SELECT * 
				   FROM ' . $this->_table . ' 
				   WHERE type="'.$type.'" and lft < ' . $nodeInfo['lft'] . '
				   AND parents = ' . $nodeInfo['parents'] . ' 
				   ORDER BY lft DESC 
				   LIMIT 1
				   ';
		$this->query($sql);
	 	$nodeBrother = $this->fetch_array();

		if(!empty($nodeBrother)){
			
			$options = array('position'=>'before','brother_id'=>$nodeBrother['id']);
			$this->moveNode($type,$id,$parentInfo['id'],$options);
		}
		
	}
	
	/**
	* Move node to right postion a unit on a level
	* 
	*
	* @param  int ID of node which you want move to new position.
	* 
	* @return Change tree structure.
	* 
	*/
	public function moveDown($type,$id){
		$nodeInfo = $this->getNodeInfo($id);		
		$parentInfo = $this->getNodeInfo($nodeInfo['parents']);
		
		$sql 	= 'SELECT * 
				   FROM ' . $this->_table . ' 
				   WHERE type="'.$type.'" and lft > ' . $nodeInfo['lft'] . '
				   AND parents = ' . $nodeInfo['parents'] . ' 
				   ORDER BY lft ASC  
				   LIMIT 1
				   ';
		$this->query($sql);
	 	$nodeBrother = $this->fetch_array();
		
		if(!empty($nodeBrother)){
			
			$options = array('position'=>'after','brother_id'=>$nodeBrother['id']);
			$this->moveNode($type,$id,$parentInfo['id'],$options);
		}
	}
	
	/**
	* Get info of parent node
	* 
	*
	* @param  int ID of node which you want get info
	* 
	* @return Node info.
	* 
	*/
	public function getParentNode($id){
		$infoNode = $this->getNodeInfo($id);
		$parentId = $infoNode['parents'];		
		$infoParentNode = $this->getNodeInfo($parentId);
		return $infoParentNode;
	}
	
	
	/**
	* Update ordering of all node in tree
	* 
	*
	* @param  array An array store info tree
	* @param  array An array store info of ordering
	* 
	* @return Change tree structure.
	* 
	*/
	public function orderTree($type,$data,$orderArr){
				
		$orderGroup = $this->orderGroup($data);				
		$newOrderGroup = array();
		foreach ($orderGroup as $key => $val){
			$tmpVal = array();
			foreach ($val as $key2 => $val2){
				$tmpVal[$key2] = $orderArr[$key2];
			}
			natsort($tmpVal);		
			$orderGroup[$key] = $tmpVal;
		}
		
		foreach ($orderGroup as $key => $val){
			$tmpVal = array();
			foreach ($val as $key2 => $val2){
				$info = $this->getNodeByLeft($type,$key2);
				$tmpVal[$info['id']] = $val2;
			}
			$orderGroup[$key] = $tmpVal;
		}
	
		foreach ($orderGroup as $key => $val){
			foreach ($val as $key2 => $val2){
				$nodeID = $key2;
				$parent = $key;				
				$this->moveNode($type,$nodeID, $parent);
			}
		}
	}
	
	/**
	* Get info of node
	* 
	*
	* @param  int Left value of node
	* 
	* @return array Node info.
	* 
	*/
	protected function getNodeByLeft($type,$left){
		$sql = 'SELECT * FROM ' . $this->_table . ' WHERE type="'.$type.'" and lft = ' . $left;
		$this->query($sql);
	 	$row = $this->fetch_array();
		return $row;
	}
	
	/**
	* Create node groups
	* 
	*
	* @param  array An array store info tree
	* 
	* @return array of node groups
	* 
	*/
		
	public function orderGroup($data = null){
		if($data != null){
			$orderArr = array();
		 	if(count($data)>0){
		 		foreach ($data as $key => $val){
		 			$orderArr[$val['id']] = array();
		 			if(isset($orderArr[$val['parents']])){
		 				$orderArr[$val['parents']][] = $val['lft'];
		 			}
		 		}
		 		$orderArr2 = array();
		 		foreach ($orderArr as $key => $val){
		 			$tmp = array();
		 			$tmp = $orderArr[$key];
		 			if(count($tmp)>0){
		 				$orderArr2[$key] = array_flip($val);
		 			}
		 		}
		 		
		 	}
		}
		$this->_orderArr = $orderArr2;
		return $this->_orderArr;
	}

	/**
	* Create ordering of node by left value
	* 
	*
	* @param int ID of parent of current node
	* @param int Letf value of current node
	* 
	* @return int An value of ordering 
	* 
	*/
	public function getNodeOrdering($parent,$left){
		$ordering = $this->_orderArr[$parent][$left] + 1;
		return $ordering;
	}
	
	/**
	* Create breadcrumbs for nodes of tree 
	* 
	*
	* @param int ID of current node
	* @param int level of parent where you want get info
	* 
	* @return array An array store info of breadcrumbs
	* 
	*/
	public function breadcrumbs($type, $id, $level_stop = null){
		$sql = 'SELECT parent.* 
				FROM ' . $this->_table . ' AS node,
			         ' . $this->_table . ' AS parent
				WHERE node.lft BETWEEN parent.lft AND parent.rgt
			      AND parent.type="'.$type.'" and node.id = ' . $id;
		
		if(isset($level_stop)){
			$sql .= ' AND parent.level > ' . $level_stop;
		}
		
		$sql .= ' ORDER BY node.lft';

		$this->query($sql);
	 	$arrData = $this->result_array();

		return $arrData;
	}

	/**
	* Processing move node to before position of other node
	* 
	*
	* @param int ID of node which you want move current node to before postion
	* 
	* @return Change tree structure
	* 
	*/
	protected function moveBefore($type,$brother_id){
		
		$infoMoveNode = $this->getNodeInfo($this->_id);
		
		$lftMoveNode = $infoMoveNode['lft'];
		$rgtMoveNode = $infoMoveNode['rgt'];
		$widthMoveNode = $this->widthNode($lftMoveNode, $rgtMoveNode);		
		
		$sqlReset = 'UPDATE ' . $this->_table . ' 
					 SET rgt = (rgt -  ' . $rgtMoveNode . '),  
					 	 lft = (lft -  ' . $lftMoveNode . ')   
					  WHERE type="'.$type.'" and lft BETWEEN ' . $lftMoveNode . ' AND ' . $rgtMoveNode;
		
		$this->query($sqlReset);
		
		
		$slqUpdateRight = 'UPDATE ' . $this->_table . '  
						   SET rgt = (rgt -  ' . $widthMoveNode . ')  
							WHERE type="'.$type.'" and rgt > ' . $rgtMoveNode;		
		$this->query($slqUpdateRight);

		
		$slqUpdateLeft = 'UPDATE ' . $this->_table . ' 
						  SET lft = (lft -  ' . $widthMoveNode . ') 
						  WHERE type="'.$type.'" and lft > ' . $rgtMoveNode;
		$this->query($slqUpdateLeft);
		
				
		$infoBrotherNode = $this->getNodeInfo($brother_id);
		$lftBrotherNode = $infoBrotherNode['lft'];
		
		
		$slqUpdateLeft = 'UPDATE ' . $this->_table . ' 
						  SET lft = (lft +  ' . $widthMoveNode . ') 
						  WHERE lft >= ' . $lftBrotherNode . ' 
						  AND type="'.$type.'" and rgt>0';
		$this->query($slqUpdateLeft);
		
		$slqUpdateRight = 'UPDATE ' . $this->_table . '  
						   SET rgt = (rgt +  ' . $widthMoveNode . ')  
							WHERE type="'.$type.'" and rgt >= ' . $lftBrotherNode;
		$this->query($slqUpdateRight);
		
		
		$infoParentNode 	= $this->getNodeInfo($this->_parent);
		$levelMoveNode 		= $infoMoveNode['level'];
		$levelParentNode	= $infoParentNode['level'];
		$newLevelMoveNode  = $levelParentNode + 1;
		
		$slqUpdateLevel = 'UPDATE ' . $this->_table . ' 
						  SET level = (level  -  ' . $levelMoveNode . ' + ' . $newLevelMoveNode . ')
						  WHERE type="'.$type.'" and rgt <= 0';
		$this->query($slqUpdateLevel);
		
		$newParent 	= $infoParentNode['id'];
		$newLeft 	= $infoBrotherNode['lft'];
		$newRight 	= $infoBrotherNode['lft'] + $widthMoveNode - 1;
		$slqUpdateParent = 'UPDATE ' . $this->_table . '  
						  SET parents = ' . $newParent . ',  
						      lft = ' . $newLeft . ',  
						  	  rgt = ' . $newRight . '  
						  WHERE type="'.$type.'" and id = ' . $this->_id;
		$this->query($slqUpdateParent);	
		
		$slqUpdateNode = 'UPDATE ' . $this->_table . '  
						  SET rgt = (rgt +  ' . $newRight . '), 
						   	  lft = (lft +  ' . $newLeft . ') 
						  WHERE type="'.$type.'" and rgt <0';
		$this->query($slqUpdateNode);
	}
	
	/**
	* Processing move node to after position of other node
	* 
	*
	* @param int ID of node which you want move current node to after postion
	* 
	* @return Change tree structure
	* 
	*/
	protected function movetAfter($type, $brother_id){

		$infoMoveNode = $this->getNodeInfo($this->_id);
		
		$lftMoveNode = $infoMoveNode['lft'];
		$rgtMoveNode = $infoMoveNode['rgt'];
		$widthMoveNode = $this->widthNode($lftMoveNode, $rgtMoveNode);
		
		
		$sqlReset = 'UPDATE ' . $this->_table . ' 
					 SET rgt = (rgt -  ' . $rgtMoveNode . '),  
					 	 lft = (lft -  ' . $lftMoveNode . ')   
					  WHERE type="'.$type.'" and lft BETWEEN ' . $lftMoveNode . ' AND ' . $rgtMoveNode;
		
		$this->query($sqlReset);
		
		$slqUpdateRight = 'UPDATE ' . $this->_table . '  
						   SET rgt = (rgt -  ' . $widthMoveNode . ')  
							WHERE type="'.$type.'" and rgt > ' . $rgtMoveNode;		
		$this->query($slqUpdateRight);
		
		$slqUpdateLeft = 'UPDATE ' . $this->_table . ' 
						  SET lft = (lft -  ' . $widthMoveNode . ') 
						  WHERE type="'.$type.'" and lft > ' . $rgtMoveNode;		
		$this->query($slqUpdateLeft);
		
		
		$infoBrotherNode = $this->getNodeInfo($brother_id);
		$rgtBrotherNode = $infoBrotherNode['rgt'];		
		
		$slqUpdateLeft = 'UPDATE ' . $this->_table . ' 
						  SET lft = (lft +  ' . $widthMoveNode . ') 
						  WHERE type="'.$type.'" and lft > ' . $rgtBrotherNode . ' 
						  AND rgt>0';		
		$this->query($slqUpdateLeft);
		
		$slqUpdateRight = 'UPDATE ' . $this->_table . '  
						   SET rgt = (rgt +  ' . $widthMoveNode . ')  
							WHERE type="'.$type.'" and rgt > ' . $rgtBrotherNode;		
		$this->query($slqUpdateRight);
		
		
		$infoParentNode = $this->getNodeInfo($this->_parent);
		$levelMoveNode 		= $infoMoveNode['level'];
		$levelParentNode	= $infoParentNode['level'];
		$newLevelMoveNode  = $levelParentNode + 1;
		
		$slqUpdateLevel = 'UPDATE ' . $this->_table . ' 
						  SET level = (level  -  ' . $levelMoveNode . ' + ' . $newLevelMoveNode . ')
						  WHERE type="'.$type.'" and rgt <= 0';
		$this->query($slqUpdateLevel);		
		
		$newParent 	= $infoParentNode['id'];
		$newLeft 	= $infoBrotherNode['rgt'] + 1;
		$newRight 	= $infoBrotherNode['rgt'] + $widthMoveNode;
		$slqUpdateParent = 'UPDATE ' . $this->_table . '  
						  SET parents = ' . $newParent . ',  
						      lft = ' . $newLeft . ',  
						  	  rgt = ' . $newRight . '  
						  WHERE type="'.$type.'" and id = ' . $this->_id;	
		$this->query($slqUpdateParent);		
		
		$slqUpdateNode = 'UPDATE ' . $this->_table . '  
						  SET rgt = (rgt +  ' . $newRight . '), 
						   	  lft = (lft +  ' . $newLeft . ') 
						  WHERE type="'.$type.'" and rgt <0';		
		$this->query($slqUpdateNode);
	}
	
	/**
	* Processing move node to left position of other node
	* 
	*
	* @return Change tree structure
	* 
	*/
	protected function moveLeft($type){
		
		$infoMoveNode = $this->getNodeInfo($this->_id);
		
		$lftMoveNode = $infoMoveNode['lft'];
		$rgtMoveNode = $infoMoveNode['rgt'];
		$widthMoveNode = $this->widthNode($lftMoveNode, $rgtMoveNode);
		
		$sqlReset = 'UPDATE ' . $this->_table . ' 
					 SET rgt = (rgt -  ' . $rgtMoveNode . '),  
					 	 lft = (lft -  ' . $lftMoveNode . ')   
					  WHERE type="'.$type.'" and lft BETWEEN ' . $lftMoveNode . ' AND ' . $rgtMoveNode;
		$this->query($sqlReset);
		
		$slqUpdateRight = 'UPDATE ' . $this->_table . '  
						   SET rgt = (rgt -  ' . $widthMoveNode . ')  
							WHERE type="'.$type.'" and rgt > ' . $rgtMoveNode;		
		$this->query($slqUpdateRight);
		
		$slqUpdateLeft = 'UPDATE ' . $this->_table . ' 
						  SET lft = (lft -  ' . $widthMoveNode . ') 
						  WHERE type="'.$type.'" and lft > ' . $rgtMoveNode;
		$this->query($slqUpdateLeft);
		
		$infoParentNode = $this->getNodeInfo($this->_parent);
		$lftParentNode = $infoParentNode['lft'];
		
		$slqUpdateLeft = 'UPDATE ' . $this->_table . ' 
						  SET lft = (lft +  ' . $widthMoveNode . ') 
						  WHERE lft > ' . $lftParentNode . '
						  AND type="'.$type.'" and rgt > 0 
						  ';
		$this->query($slqUpdateLeft);
		
		$slqUpdateRight = 'UPDATE ' . $this->_table . '  
						   SET rgt = (rgt +  ' . $widthMoveNode . ')  
							WHERE type="'.$type.'" and rgt > ' . $lftParentNode;		
		$this->query($slqUpdateRight);
		
		$levelMoveNode 		= $infoMoveNode['level'];
		$levelParentNode	= $infoParentNode['level'];
		$newLevelMoveNode  = $levelParentNode + 1;
		
		$slqUpdateLevel = 'UPDATE ' . $this->_table . ' 
						  SET level = (level  -  ' . $levelMoveNode . ' + ' . $newLevelMoveNode . ')
						  WHERE type="'.$type.'" and rgt <= 0';
		$this->query($slqUpdateLevel);
		
		
		$newParent 	= $infoParentNode['id'];
		$newLeft 	= $infoParentNode['lft'] + 1;
		$newRight 	= $infoParentNode['lft'] + $widthMoveNode;
		$slqUpdateParent = 'UPDATE ' . $this->_table . '  
						  SET parents = ' . $newParent . ',  
						      lft = ' . $newLeft . ',  
						  	  rgt = ' . $newRight . '  
						  WHERE type="'.$type.'" and id = ' . $this->_id;
		$this->query($slqUpdateParent);
		
		
		$slqUpdateNode = 'UPDATE ' . $this->_table . '  
						  SET rgt = (rgt +  ' . $newRight . '), 
						   	  lft = (lft +  ' . $newLeft . ') 
						  WHERE type="'.$type.'" and rgt <0';
		$this->query($slqUpdateNode);
		
	}
	
	/**
	* Processing move node to right position of other node
	* 
	*
	* @return Change tree structure
	* 
	*/
	protected function moveRight($type){
		
		$infoMoveNode = $this->getNodeInfo($this->_id);
		
		$lftMoveNode = $infoMoveNode['lft'];
		$rgtMoveNode = $infoMoveNode['rgt'];
		$widthMoveNode = $this->widthNode($lftMoveNode, $rgtMoveNode);
		
		$sqlReset = 'UPDATE ' . $this->_table . ' 
					 SET rgt = (rgt -  ' . $rgtMoveNode . '),  
					 	 lft = (lft -  ' . $lftMoveNode . ')   
					  WHERE type="'.$type.'" and lft BETWEEN ' . $lftMoveNode . ' AND ' . $rgtMoveNode;
		$this->query($sqlReset);
		
		$slqUpdateRight = 'UPDATE ' . $this->_table . '  
						   SET rgt = (rgt -  ' . $widthMoveNode . ')  
							WHERE type="'.$type.'" and rgt > ' . $rgtMoveNode;	
		$this->query($slqUpdateRight);
		
		$slqUpdateLeft = 'UPDATE ' . $this->_table . ' 
						  SET lft = (lft -  ' . $widthMoveNode . ') 
						  WHERE type="'.$type.'" and lft > ' . $rgtMoveNode;
		$this->query($slqUpdateLeft);
		
		$infoParentNode = $this->getNodeInfo($this->_parent);
		$rgtParentNode = $infoParentNode['rgt'];
		
		$slqUpdateLeft = 'UPDATE ' . $this->_table . ' 
						  SET lft = (lft +  ' . $widthMoveNode . ') 
						  WHERE type="'.$type.'" and lft >= ' . $rgtParentNode . '
						  AND rgt > 0 
						  ';		
		$this->query($slqUpdateLeft);
		
		$slqUpdateRight = 'UPDATE ' . $this->_table . '  
						   SET rgt = (rgt +  ' . $widthMoveNode . ')  
							WHERE type="'.$type.'" and rgt >= ' . $rgtParentNode;		
		$this->query($slqUpdateRight);
		
		$levelMoveNode 		= $infoMoveNode['level'];
		$levelParentNode	= $infoParentNode['level'];
		$newLevelMoveNode  = $levelParentNode + 1;
		
		$slqUpdateLevel = 'UPDATE ' . $this->_table . ' 
						  SET level = (level  -  ' . $levelMoveNode . ' + ' . $newLevelMoveNode . ')
						  WHERE type="'.$type.'" and rgt <= 0';
		$this->query($slqUpdateLevel);
		
		$newParent 	= $infoParentNode['id'];
		$newLeft 	= $infoParentNode['rgt'];
		$newRight 	= $infoParentNode['rgt'] + $widthMoveNode - 1;
		$slqUpdateParent = 'UPDATE ' . $this->_table . '  
						  SET parents = ' . $newParent . ',  
						      lft = ' . $newLeft . ',  
						  	  rgt = ' . $newRight . '  
						  WHERE type="'.$type.'" and id = ' . $this->_id;
		$this->query($slqUpdateParent);
		
		$slqUpdateNode = 'UPDATE ' . $this->_table . '  
						  SET rgt = (rgt +  ' . $newRight . '), 
						   	  lft = (lft +  ' . $newLeft . ') 
						  WHERE type="'.$type.'" and rgt <0';
			
		$this->query($slqUpdateNode);
		
	}
	
	/**
	* Insert a new node to tree (move: left - right - before - after)
	* 
	*
	* @param  array An array store info of new node
	* @param  int ID of parent node which you want insert new node
	* @param  array Case when you apply new node (apply: left position - right position - before position - after position)
	*
	* @return Change tree structure.
	*/
	public function insertNode($type, $data, $parent = 0, $options = null) {

		$this->_data 	= $data;
		
		$this->_parent 	= $parent;

		if($options['position'] == 'right' || $options == null)	return $this->insertRight($type);
		
		if($options['position'] == 'left') return $this->insertLeft($type);
		
		if($options['position'] == 'after') return $this->insertAfter($type,$options['brother_id']);
		
		if($options['position'] == 'before') return $this->insertBefore($type,$options['brother_id']);
		
	}
	
	/**
	* Insert a new node to right position of other node
	* 
	*
	* @return Change tree structure
	* 
	*/
	protected function insertRight($type=''){
		
		$parentInfo =  $this->getNodeInfo($this->_parent);

		if($parentInfo){
			$parentRight = $parentInfo['rgt'];
			$slqUpdateLeft = 'UPDATE ' . $this->_table . ' 
						  SET lft = lft + 2 
						  WHERE type="'.$type.'" and lft > ' . $parentRight;
			$this->query($slqUpdateLeft);
		
		
			$slqUpdateRight = 'UPDATE ' . $this->_table . ' 
						  SET rgt = rgt + 2 
						  WHERE type="'.$type.'" and rgt >= ' . $parentRight;
			$this->query($slqUpdateRight);

			$slqUpdateHs = 'UPDATE ' . $this->_table . ' 
							  SET heso_parent = 6 
							  WHERE id='.$this->_parent;		
			$this->query($slqUpdateHs);
			$data = $this->_data;		
			$data['parents']	= $this->_parent;
			$data['lft'] 		= $parentRight;
			$data['rgt'] 		= $parentRight + 1;
			$data['level'] 		= $parentInfo['level'] + 1;
			$data['heso_child']=2;
		}else{
			$data = $this->_data;		
			$data['parents']	= $this->_parent;
			$data['lft'] 		= 0;
			$data['rgt'] 		= 1;
			$data['level'] 		= 0;
			$data['heso_parent']=6;
		}
		
		$newData = $this->createInsertQuery($data);
		
		$slqInsert = 'INSERT INTO ' . $this->_table . 
					 '(' . $newData['cols'] . ') ' . 'VALUES(' . $newData['values'] . ')';
		
		$this->query($slqInsert);

		return $this->get_insert_id();
	}
	
	/**
	* Insert a new node to left position of other node
	* 
	*
	* @return Change tree structure
	* 
	*/
	protected function insertLeft($type){

		$parentInfo =  $this->getNodeInfo($this->_parent);
		
		if($parentInfo){
			$parentLeft = $parentInfo['lft'];
		
			$slqUpdateLeft = 'UPDATE ' . $this->_table . ' 
							  SET lft = lft + 2 
							  WHERE  type="'.$type.'" and lft > ' . $parentLeft;
			$this->query($slqUpdateLeft);
			
			$slqUpdateRight = 'UPDATE ' . $this->_table . ' 
							  SET rgt = rgt + 2 
							  WHERE type="'.$type.'" and rgt > ' . ($parentLeft + 1);		
			$this->query($slqUpdateRight);
			
			$slqUpdateHs = 'UPDATE ' . $this->_table . ' 
							  SET heso_parent = 6 
							  WHERE id='.$this->_parent;		
			$this->query($slqUpdateHs);

			$data = $this->_data;		
			$data['parents']	= $this->_parent;
			$data['lft'] 		= $parentLeft + 1;
			$data['rgt'] 		= $parentLeft + 2;
			$data['level'] 		= $parentInfo['level'] + 1;
			$data['heso_child']=2;
		}else{
			$data = $this->_data;		
			$data['parents']	= $this->_parent;
			$data['lft'] 		= 0;
			$data['rgt'] 		= 1;
			$data['level'] 		= 0;
			$data['heso_parent']=6;
		}
		
		$newData = $this->createInsertQuery($data);
		
		$slqInsert = 'INSERT INTO ' . $this->_table . 
					 '(' . $newData['cols'] . ') ' . 'VALUES(' . $newData['values'] . ')';
		$this->query($slqInsert);
		return $this->get_insert_id();
		//return mysql_insert_id();
	}
	
	
	/**
	* Insert a new node to after position of other node
	* 
	* 
	* @param int ID of node which you want insert new node to after postion
	*
	* @return Change tree structure
	* 
	*/
	protected function insertAfter($type,$brother_id){
		
		$parentInfo =  $this->getNodeInfo($this->_parent);		
		$brotherInfo =  $this->getNodeInfo($brother_id);		
		
		$slqUpdateLeft = 'UPDATE ' . $this->_table . ' 
						  SET lft = lft + 2 
						  WHERE type="'.$type.'" and lft > ' . $brotherInfo['rgt'];
		
		$this->query($slqUpdateLeft);
		
		$slqUpdateRight = 'UPDATE ' . $this->_table . ' 
						  SET rgt = rgt + 2 
						  WHERE type="'.$type.'" and rgt > ' . $brotherInfo['rgt'];
		
		$this->query($slqUpdateRight);
		
		$data = $this->_data;		
		$data['parents']	= $this->_parent;
		$data['lft'] 		= $brotherInfo['rgt'] + 1;
		$data['rgt'] 		= $brotherInfo['rgt'] + 2;
		$data['level'] 		= $parentInfo['level'] + 1;
		
		$newData = $this->createInsertQuery($data);
		
		$slqInsert = 'INSERT INTO ' . $this->_table . 
					 '(' . $newData['cols'] . ') ' . 'VALUES(' . $newData['values'] . ')';
		
		$this->query($slqInsert);

		return $this->get_insert_id();
	}
	
	/**
	* Insert a new node to before position of other node
	* 
	* 
	* @param int ID of node which you want insert new node to before postion
	*
	* @return Change tree structure
	* 
	*/
	protected function insertBefore($type,$brother_id){
		
		$parentInfo =  $this->getNodeInfo($this->_parent);		
		$brotherInfo =  $this->getNodeInfo($brother_id);		
		
		$slqUpdateLeft = 'UPDATE ' . $this->_table . ' 
						  SET lft = lft + 2 
						  WHERE type="'.$type.'" and lft >= ' . $brotherInfo['lft'];
		
		$this->query($slqUpdateLeft);
		
		$slqUpdateRight = 'UPDATE ' . $this->_table . ' 
						  SET rgt = rgt + 2 
						  WHERE type="'.$type.'" and rgt >= ' . ($brotherInfo['lft'] + 1);
		
		$this->query($slqUpdateRight);
		
		$data = $this->_data;		
		$data['parents']	= $this->_parent;
		$data['lft'] 		= $brotherInfo['lft'];
		$data['rgt'] 		= $brotherInfo['lft'] + 1;
		$data['level'] 		= $parentInfo['level'] + 1;
		
		$newData = $this->createInsertQuery($data);
		
		$slqInsert = 'INSERT INTO ' . $this->_table . 
					 '(' . $newData['cols'] . ') ' . 'VALUES(' . $newData['values'] . ')';
		
		$this->query($slqInsert);

		return $this->get_insert_id();
	}
	/**
	* Create a string from a data array 
	* 
	* 
	* @param array a data array 
	*
	* @return string
	* 
	*/
	protected function createUpdateQuery($data){
		if (count ( $data ) > 0) {
			$result = '';			
			$i = 1;
			foreach ( $data as $key => $val ) {
				if ($i == 1) {
					$result .= " " . $key . " = '" . $val . "' ";
				} else {
					$result .= " ," . $key . " = '" . $val . "' ";
				}
				$i ++;
			}
		}
		return $result;
	}
	
	/**
	* Create a string from a data array 
	* 
	* 
	* @param array a data array 
	*
	* @return string
	* 
	*/
	public function createInsertQuery($data){
		if (count ( $data ) > 0) {
			$cols = '';
			$values = '';
			$i = 1;
			foreach ( $data as $key => $val ) {
				if ($i == 1) {
					$cols .= "`" . $key . "`";
					$values .= "'" . $val . "'";
				} else {
					$cols .= ",`" . $key . "`";
					$values .= ",'" . $val . "'";
				}
				$i ++;
			}
		}
		$result['cols'] 	= $cols;
		$result['values'] 	= $values;
		return $result;
	}
	
	/**
	* Calculate total nodes
	* 
	* 
	* @param int ID of parent node
	* 
	* @return int Total nodes
	*
	*/
	public function totalNode($parents = 0, $type = ''){
		$sql = 'SELECT lft,rgt FROM ' . $this->_table . ' WHERE type="'.$type.'" and parents = ' . $parents;
		$result = $this->query($sql);

		$lft = mysqli_result($result, 0,'lft');
		$rgt = mysqli_result($result, 0,'rgt');
		$total = ($rgt - $lft + 1)/2;
		return $total;
	}

	/**
	* Width of a branch of tree
	* 
	* 
	* @param int Left value of node
	* @param int Right value of node
	* 
	* @return int width of node
	*
	*/
	public function widthNode($lft,$rgt){
		$width = $rgt - $lft + 1;
		return $width;
	}
	
	/**
	* Remove a node of tree
	* 
	* 
	* @param int ID of node which you want remove
	* @param string. If it is 'branch', delete a branch of tree
	* 				 If it is 'node', delete a node of tree and update all nodes of branch
	* 
	* @return Change tree structure
	*
	*/

	public function removeNode($type, $id, $options = 'branch'){
		$this->_id = $id;
		
		if($options == 'branch') $this->removeBranch($type);
		if($options == 'node') $this->removeOne($type);
	}
	
	/**
	* Remove a branch of tree
	* 
	* 
	* @return Change tree structure
	*
	*/
	protected  function removeBranch($type){
		
		$infoNodeRemove =  $this->getNodeInfo($this->_id);
	
		$rgtNodeRemove 		= $infoNodeRemove['rgt'];
		$lftNodeRemove 		= $infoNodeRemove['lft'];
		$widthNodeRemove 	= $this->widthNode($lftNodeRemove,$rgtNodeRemove);
		
		$slqDelete = 'DELETE FROM ' . $this->_table . ' 
					  WHERE type="'.$type.'" and lft BETWEEN ' . $lftNodeRemove . ' AND ' . $rgtNodeRemove;
		$this->query($slqDelete);
		
		$slqUpdateLeft = 'UPDATE ' . $this->_table . ' 
						  SET lft = (lft - ' . $widthNodeRemove . ')  
						  WHERE type="'.$type.'" and lft > ' . $rgtNodeRemove;
		
		$this->query($slqUpdateLeft);
		
		$slqUpdateRight = 'UPDATE ' . $this->_table . ' 
						  SET rgt = (rgt - ' . $widthNodeRemove . ')  
						  WHERE type="'.$type.'" and rgt > ' . $rgtNodeRemove;
		
		$this->query($slqUpdateRight);
		
		
		
	}
	
	/**
	* Remove an one of tree
	* 
	* 
	* @return Change tree structure
	*
	*/
	protected function removeOne($type){
		
		$nodeInfo = $this->getNodeInfo($this->_id);
		$sql = 'SELECT id 
				FROM ' . $this->_table . ' 
				WHERE type="'.$type.'" and parents = ' . $nodeInfo['id'] . ' 
				ORDER BY lft ASC ';
		$this->query($sql);
		$childIds = $this->result_array();
		
		rsort($childIds);
		
		if(count($childIds)>0){
			foreach ($childIds as $key => $val){
				$id = $val;
				$parent = $nodeInfo['parents'];
				$options = array('position'=>'after','brother_id'=>$nodeInfo['id']);
				$this->moveNode($type,$id, $parent, $options);
			}
			$this->removeNode($type,$nodeInfo['id']);
		}
	}
	
	/**
	* Get info node of tree
	* 
	* 
	* @param int ID of node which you want get info
	*  
	* @return Change tree structure
	*
	*/
	public function getNodeInfo($id){
		$sql = 'SELECT * FROM ' . $this->_table . ' WHERE id = '.$id;
		$this->query($sql);
		$row = $this->fetch_array();
		return $row;
	}
	
	/**
	* Get tree
	* 
	* 
	* @param int ID of parent node
	* @param string A case of get node list
	* @param int ID of node which you don't want get info
	* @param int level of tree
	*  
	* @return array Node list
	*
	*/
	public function listItem($type = '', $parents = 0,$items = 'all',$exclude_id = null,$level = 0){
		
		$sqlParents = 'SELECT @parentLeft := lft,@parentRight := rgt     
					   FROM ' . $this->_table . '  
					   WHERE type="'.$type.'" and parents = ' . $parents . ';';
		$result = $this->query($sqlParents);
		
		$sqlItems = 'SELECT node.*    
					 FROM ' . $this->_table . ' AS node ';
		
		if($items == 'all'){
			$sqlItemsLR = ' WHERE node.lft >= @parentLeft
					       AND node.rgt <= @parentRight and type="'.$type.'" ';
		}else{
			$sqlItemsLR = ' WHERE node.lft > @parentLeft
					       AND node.rgt < @parentRight and type="'.$type.'" ';
		}
							
		if($exclude_id != null && (int)$exclude_id >0){
			$sqlExclude = '	SELECT lft, rgt     
					   		FROM ' . $this->_table . '  
					   		WHERE id = ' . $exclude_id;
			$this->query($sqlExclude);
			$rowExclude = $this->fetch_array(); 

			$lftExclude = $rowExclude['lft'];
			$rgtExclude = $rowExclude['rgt'];
		}
		
		$sqlItems .= $sqlItemsLR;
		
		if($level !=0 ){
			$sqlItems .= ' AND node.level <=  ' . $level . ' '; 
		}
		
		$sqlItems .= ' ORDER BY node.lft ';
		$result = $this->query($sqlItems);

		if($result){
			$dataArr = $this->result_array();
		}
		return $dataArr;
	}
	
	/**
	* destruct function
	* 
	* 
	*/
	public function __destruct() {
		//mysql_close ( $this->_connect );
	}

}