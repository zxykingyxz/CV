<?php
class ReWorkedTemplate
{
    public $storeCss;
    function __construct() {}

    // Render view
    public function getTemplate($templateName, $data = [])
    {
        echo $this->getTemplateContent($templateName, $data);
    }
    public function getTemplateContent($templateName, $data = [])
    {
        global $func;
        global $db;
        global $config;
        global $_COM;
        global $_SRC;
        global $_TYPE;
        global $_ACT;
        global $_LANG;
        global $array_param_value;

        if ($data !== null) extract($data);
        ob_start();
        include $templateName . ".php";
        $htmlContent = ob_get_clean();

        return $htmlContent;
    }
    public function getTemplateLayoutsFor($data = array())
    {
        global $config;
        $defaults = [
            'name_layouts' => '',
            'data' => '',
            'global' => [],
        ];
        /* Data */
        $info = array_merge($defaults, $data);

        if (!empty($info['global'])) {
            $global_data = $this->importGlobals($info['global']);
            $info = array_merge($info, $global_data);
        }
        $info['name_layouts'] = trim($info['name_layouts'], ' ');
        $layouts_tmp = $this->getCheckInfile($info['name_layouts'], _VIEWS);

        $html = $this->getTemplateContent($layouts_tmp['url'], $info);
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
}
