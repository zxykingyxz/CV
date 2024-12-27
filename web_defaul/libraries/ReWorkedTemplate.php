<?php
class ReWorkedTemplate
{
    public $_utils;
    public $storeCss;
    private $cacheDir;
    private $cacheTime = 60 * 60; //thời gian 1h
    function __construct()
    {
        $this->cacheDir = _basename . 'iweb@cache';
        $this->_utils = new ReWorkedUtils();
    }

    // Render view
    public function getTemplate($templateName, $data = [], $isCache = false)
    {
        echo $this->getTemplateContent($templateName, $data, $isCache);
    }
    public function getTemplateContent($templateName, $data = [], $isCache = true)
    {
        global $func;
        global $db;
        global $cache;
        global $config;
        global $https_config;
        global $row_setting;
        global $optionsSetting;
        global $lang;
        global $jv0;
        global $deviceType;
        global $com;
        global $seo;

        $cacheFile = $this->getCacheFilePath($templateName);
        $cacheData = file_exists($cacheFile) ? unserialize(file_get_contents($cacheFile)) : null;
        $dataHash = md5(json_encode($data));

        if (
            $isCache && $config['website']['isCache'] && $cacheData !== null && isset($cacheData['dataHash']) && $cacheData['dataHash'] === $dataHash &&
            time() - $cacheData['timestamp'] < $this->cacheTime
        ) {
            return $cacheData['content'];
        }

        if ($data !== null) extract($data);
        ob_start();
        include $templateName . ".php";

        $htmlContent = ob_get_clean();
        // $htmlContent = $this->_utils->removeHtmlComments($htmlContent);
        $cacheData = array(
            'dataHash' => $dataHash,
            'timestamp' => time(),
            'content' => $htmlContent
        );

        file_put_contents($cacheFile, serialize($cacheData));
        return $htmlContent;
    }
    public function getCacheFilePath($key)
    {
        return $this->cacheDir . '/cache_' . md5($key);
    }
}
