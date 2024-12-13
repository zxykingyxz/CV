<?php
	/*

		url link:

		https://domain.com/danh-muc-cap-1

		https://domain.com/danh-muc-cap-1/danh-muc-cap-2

	*/

	private $_db;

	private $_lang;

	class getUrl{
		
		public function __construct($db,$lang){

			$this->_db = $db;

			$this->_lang = $lang;

		}

		public function getLink($pid,$type){

			$link='';

			$detail=$this->_db->rawQueryOne("select id,id_list,id_cat tenkhongdau_{$this->_lang} as alias from #_baiviet where hienthi=1 and id=? and type=? limit 1",array($pid,$type));

			if(!empty($detail['id_list'])){

				$link.=$this->getList($detail['id_list']).'/';

			}
			if(!empty($detail['id_cat'])){

				$link.=$this->getCat($detail['id_cat']).'/';

			}
			if(!empty($detail['id_item'])){

				$link.=$this->getItem($detail['id_item']);

			}

			return substr($link,0,-1);

		}

		public function getList($pid,$type){

			$list=$this->_db->rawQueryOne("select tenkhongdau_{$this->_lang} as alias from #_baiviet_list where hienthi=1 and id=? and type=? limit 1",array($pid,$type));

			return $list['alias'];

		}
		public function getCat($pid,$type){

			$cat=$this->_db->rawQueryOne("select tenkhongdau_{$this->_lang} as alias from #_baiviet_cat where hienthi=1 and id=? and type=? limit 1",array($pid,$type));

			return $cat['alias'];

		}
		public function getItem($pid,$type){

			$item=$this->_db->rawQueryOne("select tenkhongdau_{$this->_lang} as alias from #_baiviet_item where hienthi=1 and id=? and type=? limit 1",array($pid,$type));

			return $item['alias'];

		}

	}

?>