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
        ob_start('ob_gzhandler');
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
    public function getTemplateLayoutsFor($data = array())
    {
        global $config;
        $defaults = [
            'name_layouts' => '',
            'data' => '',
            'save_cache' => true,
            'global' => [],
        ];
        /* Data */
        $info = array_merge($defaults, $data);

        if (!empty($info['global'])) {
            $global_data = $this->importGlobals($info['global']);
            $info = array_merge($info, $global_data);
        }
        $info['name_layouts'] = trim($info['name_layouts'], ' ');
        $layouts_tmp = $this->getCheckInfile($info['name_layouts'], _views);

        $html = $this->getTemplateContent($layouts_tmp['url'], $info, (($config['cache']['save_cache_temple']) == true) ? $info['save_cache'] : false);
        return $html;
    }
    public function getNameFolder($nameFolder, $additional_characters = '')
    {
        $data = array();
        if (is_dir($nameFolder) && is_readable($nameFolder)) {
            $folders = scandir($nameFolder);
            foreach ($folders as $folder_name) {
                if (is_dir($nameFolder . $additional_characters . $folder_name) && !in_array($folder_name, ['.', '..'])) {
                    array_push($data, $folder_name . $additional_characters);
                }
            }
        }
        return $data;
    }
    public function getNameFileinFolder($url_file)
    {
        if (is_dir($url_file) && is_readable($url_file)) {
            $data = array();
            $files = scandir($url_file);
            $i = 0;
            foreach ($files as  $file) {
                if (file_exists($url_file . '/' . $file) && !in_array($file, ['.', '..'])) {
                    $data[$i] = [
                        'url' => $url_file . '/' . $file,
                        'name' => $file
                    ];
                    $i++;
                }
            }
        }
        return $data;
    }
    public function getCheckInfile($nameLayouts, $urlFile)
    {
        $data = array('');
        $file = "";
        $data = array_merge($this->getNameFolder($urlFile, '/'), $data);
        foreach ($data as $v) {
            $filePath = $urlFile . $v . $nameLayouts;
            if (file_exists($filePath . ".php")) {
                $file = $filePath;
                break;
            }
        }
        if (empty($file)) {
            $file = $nameLayouts;
            return [
                "url" => $file,
                "return" => false,
            ];
        }
        return [
            "url" => $file,
            "return" => true,
        ];
    }

    public function importGlobals($globalVars = [])
    {
        $global_data = [];
        if (!empty($globalVars)) {
            foreach ($globalVars as $var) {
                global $$var;

                if (!empty($$var)) {
                    $global_data[$var] = $$var;
                }
            }
        }

        return $global_data;
    }
    public function getCacheFilePath($key)
    {
        return $this->cacheDir . '/cache_' . md5($key);
    }
}
