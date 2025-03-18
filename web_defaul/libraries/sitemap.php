<?php
class sitemap
{
	private $_db;
	private $_func;
	private $_data;
	private $_lang = 'vi';
	public function __construct($db, $func, $lang, $data)
	{
		$this->_db = $db;
		$this->_func = $func;
		$this->_data = is_array($data) ? $data : null;
		$this->_lang = $lang;
		$this->getSitemap();
	}
	public function getSitemap()
	{
		header("Content-Type: application/xml; charset=utf-8");
		echo '<?xml version="1.0" encoding="UTF-8"?>';
		echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';
		self::urlElement('', '1.0', time());
		foreach ($this->_data as $k => $v) {
			if ($v['sitemap']) {
				$priority = $v['field'] == 'id' ? "1.0" : "0.8";
				if ($v['field'] == 'id') {
					self::urlElement($v['com'], $priority, time());
				}
				if ($v['tbl'] != 'info' && $v['tbl'] != 'contact') {
					$this->CreateXML($v['tbl'], $v['type'], $priority);
				}
			}
		}
		echo '</urlset>';
	}
	public function CreateXML($tbl = '', $type = '', $priority = 1)
	{
		global $lang, $config;
		if (empty($tbl)) return false;
		$items = $this->_db->rawQuery("select tenkhongdau_$lang as alias,ngaytao,type from #_$tbl where hienthi=1 and type=? order by id desc", array($type));
		foreach ($items as $item) {
			self::urlElement($item['alias'], $priority, $item['ngaytao']);
		}
	}
	public static function urlElement($url, $pri, $time)
	{
		global $lang, $https_config, $config;
		$url = ($config['lang_check']) ? $https_config . $lang . '/' . $url : $https_config . $url;
		$str = '<url><loc>' . $url . '</loc><lastmod>' . date("c", $time) . '</lastmod><changefreq>daily</changefreq><priority>' . $pri . '</priority></url>';
		echo $str;
	}
}
