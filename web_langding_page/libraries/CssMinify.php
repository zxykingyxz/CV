<?php
class CssMinify
{
    private $pathCss = array();
    private $debugCss;
    private $cacheName = '';
    private $cacheFile = 'assets/css/';
    private $cacheSize = false;
    private $cacheTimeFile = false;
    private $storeCss = null;
    function __construct($debugCss)
    {
        $this->debugCss = $debugCss;
    }

    public function setCss($path)
    {
        $this->pathCss[] = $path;
    }

    public function getCss()
    {
        if (empty($this->pathCss)) die("No files to optimize");
        return ($this->debugCss) ? $this->defaultCss() : $this->miniCss();
    }

    public function setCache($name)
    {
        $this->cacheName = $name;
        $this->cacheFile = $this->cacheFile . $this->cacheName . '.css';
        $this->cacheSize = (file_exists($this->cacheFile)) ? filesize($this->cacheFile) : 0;
        $this->cacheTimeFile = filemtime($this->cacheFile);
    }

    public function isFileChanged()
    {
        foreach ($this->pathCss as $file_path) {
            // Tách bỏ query string nếu có
            $file_path = explode('?', $file_path)[0];
            // Kiểm tra nếu tệp tồn tại và có thể truy cập được
            if (file_exists($file_path)) {
                // Kiểm tra nếu thời gian sửa đổi của tệp lớn hơn thời gian cache
                if (filemtime($file_path) > $this->cacheTimeFile) {
                    return true; // Tệp đã thay đổi
                }
            } else {
                // Nếu tệp không tồn tại, có thể xử lý hoặc log lỗi nếu cần
                error_log("File does not exist: " . $file_path);
            }
        }
        return false; // Không có tệp nào thay đổi
    }

    private function miniCss()
    {
        global $https_config;
        if (!$this->isFileChanged() && $this->cacheSize) {
            $version = filemtime($this->cacheFile);
            $cachedCss = file_get_contents($this->cacheFile);
            return "<style type='text/css'>{$cachedCss}</style>";
        }

        $strCss = '';
        foreach ($this->pathCss as $path) {
            $path = explode('?', $path)[0];
            $path_parts = pathinfo($path);
            $extension = strtolower($path_parts['extension']);
            if ($extension != 'css') die("Invalid file");
            $filecontent = file_get_contents($path);
            $fullURLPath = $https_config . $path_parts['dirname'] . '/';
            $filecontent = $this->fixUrlPath($filecontent, $fullURLPath);
            $strCss .= $this->compressCss($filecontent);
        }
        if ($strCss) {
            file_put_contents($this->cacheFile, $strCss);
        }

        $version = filemtime($this->cacheFile);
        return "<style type='text/css'>{$strCss}</style>";
    }

    private function defaultCss()
    {
        $linkCss = '';
        foreach ($this->pathCss as $path) {
            $path_file = explode('?', $path)[0];
            $path_parts = pathinfo($path_file);
            $extension = strtolower($path_parts['extension']);
            if ($extension != 'css') die("Invalid file");
            $linkCss .= '<link href="' . $path . '" rel="stylesheet">' . PHP_EOL;
        }
        return $linkCss;
    }

    public function fixUrlPath($buffer, $fullURL)
    {
        $regex = '/url\((?![\'"]?(?:data:|https?:|\/\/))([\'"]?)([^\'")]*)\1\)/';
        return preg_replace($regex, 'url(' . $fullURL . '${2})', $buffer);
    }

    private function compressCss($buffer)
    {
        $buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
        $buffer = str_replace(': ', ':', $buffer);
        $buffer = str_replace(["\r\n", "\r", "\n", "\t", '  ', '    ', '    '], '', $buffer);
        return $buffer;
    }
}
