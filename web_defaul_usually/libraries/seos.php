<?php
	class seos
	{
		private $_d;
		private $data;

		function __construct($db)
		{
			$this->_d = $db;
		}

		public function setSeo($key='', $value='')
		{
			if($key != '' && $value != '') $this->data[$key] = $value;
		}

		public function getSeo($key)
		{
			return (isset($this->data[$key]) && $this->data[$key] != '') ? $this->data[$key] : '';
		}

		public function getSeoDB($id=0, $com='', $act='', $type='')
		{

			if($id || $act=='capnhat')
			{
				if($id) $row = $this->_d->rawQueryOne("select * from #_seo where idmuc = ? and com = ? and act = ? and type = ? limit 0,1",array($id,$com,$act,$type));
				else $row = $this->_d->rawQueryOne("select * from #_seo where com = ? and act = ? and type = ? limit 0,1",array($com,$act,$type));

				return $row;
			}
		}

		public function updateSeoDB($json = '', $table = '', $id = 0)
		{
			if($table && $id) $this->_d->rawQuery("update #_$table set options = ? where id = ?",array($json,$id));
		}
	}
?>