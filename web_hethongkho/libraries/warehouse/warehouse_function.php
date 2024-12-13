<?php
require _lib . 'WebpConvert/vendor/autoload.php';

use WebPConvert\WebPConvert;

class warehouse_function
{
    private $cacheDir;
    private $cacheTime = 60 * 60;
    private $_key;
    private $_ipad;
    private $_opad;
    function __construct()
    {
        $this->cacheDir = _basename . 'iweb@cache';

        $key = "warehouse";
        $this->_key = sha1($key);
        if (isset($key[64])) {
            $key = pack('H32', $this->_key);
        }

        if (!isset($key[64])) {
            $key = str_pad($key, 64, chr(0));
        }

        $this->_ipad = substr($key, 0, 64) ^ str_repeat(chr(0x36), 64);
        $this->_opad = substr($key, 0, 64) ^ str_repeat(chr(0x5C), 64);
    }
    public function isPhone($number)
    {
        $number = trim($number);
        if (preg_match_all('/^(0|84)(2(0[3-9]|1[0-6|8|9]|2[0-2|5-9]|3[2-9]|4[0-9]|5[1|2|4-9]|6[0-3|9]|7[0-7]|8[0-9]|9[0-4|6|7|9])|3[2-9]|5[5|6|8|9]|7[0|6-9]|8[0-6|8|9]|9[0-4|6-9])([0-9]{7})$/m', $number, $matches, PREG_SET_ORDER, 0)) {
            return true;
        } else {
            return false;
        }
    }
    public function money($dola, $currency = '')
    {
        return number_format($dola, 0, ',', '.') . $currency;
    }
    public function isEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }
    public function transfer($msg, $page = "index.html", $check = true)
    {

        $showtext = $msg;

        $page_transfer = $page;

        $check_svg = $check;

        include(_template . "warehouse/transfer.php");

        exit();
    }
    /* Kiểm tra dữ liệu nhập vào */
    public function cleanInput($input = '', $type = '')
    {
        $output = '';

        if ($input != '') {
            $search = array(
                'script' => '@<script[^>]*?>.*?</script>@si',
                'style' => '@<style[^>]*?>.*?</style>@siU',
                'blank' => '@
                <![\s\S]*?--[ \t\n\r]*>@',
                'iframe' => '/<iframe(.*?)<\/iframe>/is',
                'title' => '/<title(.*?)<\/title>/is',
                'pre' => '/<pre(.*?)<\/pre>/is',
                'frame' => '/<frame(.*?)<\/frame>/is',
                'frameset' => '/<frameset(.*?)<\/frameset>/is',
                'object' => '/<object(.*?)<\/object>/is',
                'embed' => '/<embed(.*?)<\/embed>/is',
                'applet' => '/<applet(.*?)<\/applet>/is',
                'meta' => '/<meta(.*?)<\/meta>/is',
                'doctype' => '/<!doctype(.*?)>/is',
                'link' => '/<link(.*?)>/is',
                'body' => '/<body(.*?)<\/body>/is',
                'html' => '/<html(.*?)<\/html>/is',
                'head' => '/<head(.*?)<\/head>/is',
                'onclick' => '/onclick="(.*?)"/is',
                'ondbclick' => '/ondbclick="(.*?)"/is',
                'onchange' => '/onchange="(.*?)"/is',
                'onmouseover' => '/onmouseover="(.*?)"/is',
                'onmouseout' => '/onmouseout="(.*?)"/is',
                'onmouseenter' => '/onmouseenter="(.*?)"/is',
                'onmouseleave' => '/onmouseleave="(.*?)"/is',
                'onmousemove' => '/onmousemove="(.*?)"/is',
                'onkeydown' => '/onkeydown="(.*?)"/is',
                'onload' => '/onload="(.*?)"/is',
                'onunload' => '/onunload="(.*?)"/is',
                'onkeyup' => '/onkeyup="(.*?)"/is',
                'onkeypress' => '/onkeypress="(.*?)"/is',
                'onblur' => '/onblur="(.*?)"/is',
                'oncopy' => '/oncopy="(.*?)"/is',
                'oncut' => '/oncut="(.*?)"/is',
                'onpaste' => '/onpaste="(.*?)"/is',
                'php-tag' => '/<(\?|\%)\=?(php)?/',
                'php-short-tag' => '/(\%|\?)>/'
            );

            if (!empty($type)) {
                unset($search[$type]);
            }

            $output = preg_replace($search, '', $input);
        }

        return $output;
    }
    /* Kiểm tra dữ liệu nhập vào */
    public function sanitize($input = '', $type = '')
    {
        if (is_array($input)) {
            foreach ($input as $var => $val) {
                $output[$var] = $this->sanitize($val, $type);
            }
        } else {
            $output  = $this->cleanInput($input, $type);
        }

        return $output;
    }
    public function getType($type)
    {
        global $config, $lang, $translate;
        $result = ($config['lang_check']) ? $lang . '/' . $translate[$lang][$type] : $type;
        return $result;
    }
    public function isAjax()
    {

        return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && (strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'));
    }

    function generalPassword($length = 12)
    {
        $array_chars = array();
        $array_chars[0] = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $array_chars[1] = 'abcdefghijklmnopqrstuvwxyz';
        $array_chars[2] = '0123456789';
        $array_chars[3] = '-=~!@#$%^&*()_+,./<>?;:[]{}\|';
        $array_chars[4] = $array_chars[0] . $array_chars[1] . $array_chars[2] . $array_chars[3];

        $_arr_m = array();
        $_arr_m[] = mt_rand(0, 1);
        $_arr_m[] = mt_rand(0, 1);
        $_arr_m[] = 2;
        $_arr_m[] = 3;

        $length = $length - 4;
        for ($k = 0; $k < $length; ++$k) {
            $_arr_m[] = 4;
        }

        $pass = '';
        foreach ($_arr_m as $m) {
            $chars = $array_chars[$m];
            $max = strlen($chars) - 1;
            $pass .= $chars[mt_rand(0, $max)];
        }
        return $pass;
    }
    public function encrypt($data, $iv = '')
    {
        $iv = empty($iv) ? substr($this->_key, 0, 16) : substr($iv, 0, 16);

        $data = openssl_encrypt($data, 'aes-256-cbc', $this->_key, 0, $iv);
        return strtr($data, '+/=', '-_,');
    }
    public function decrypt($data, $iv = '')
    {
        $iv = empty($iv) ? substr($this->_key, 0, 16) : substr($iv, 0, 16);

        $data = strtr($data, '-_,', '+/=');
        return openssl_decrypt($data, 'aes-256-cbc', $this->_key, 0, $iv);
    }
    public function converWebp($in)
    {
        global $config, $https_config;
        $in = $https_config . str_replace(_asset, "", $in);

        if (!extension_loaded('imagick')) {
            ob_start();
            WebPConvert::serveConverted($in, $in . ".webp", [
                'fail' => 'original',
                //'show-report' => true,
                'serve-image' => [
                    'headers' => [
                        'cache-control' => true,
                        'vary-accept' => true,
                    ],
                    'cache-control-header' => 'max-age=2',
                ],
                'convert' => [
                    "quality" => 100
                ]
            ]);
            file_put_contents($in . ".webp", ob_get_contents());
            ob_end_clean();
        } else {

            WebPConvert::convert($in, $in . ".webp", [
                'fail' => 'original',
                'convert' => [
                    'quality' => 100,
                    'max-quality' => 100,
                ]
            ]);
        }
    }
    public function addHrefImg($data = array())
    {
        global $config, $https_config;

        /* Defaults */
        $defaults = [
            'class' => '',
            'classfix' => '',
            'id' => '',
            'isLazy' => true,
            'create_thumbs' => true,
            'thumbs' => _thumbs,
            'isWatermark' => false,
            'watermark' => (defined('_watermark')) ? _watermark : '',
            'addhref' => false,
            'href' => '',
            'data' => '',
            'rel' => 'dofollow',
            'role' => 'link',
            'target' => '',
            'prefix' => '',
            'size-error' => '',
            'size-src' => '',
            'sizes' => '',
            'url' => '',
            'upload' => '',
            'image' => '',
            'upload-error' => 'assets/images/',
            'image-error' => 'noimage.png',
            'alt' => ''
        ];

        /* Data */
        $info = array_merge($defaults, $data);

        list($width, $height, $zoom) = explode('x', $info['sizes']);
        $style = '';
        switch ($zoom) {
            case 1:
                $style = 'object-fit:cover ;';
                break;
            case 2:
                $style = 'object-fit:contain ;';
                break;
            case 3:
                $style = 'object-fit:fill ;';
                break;
            default:
                break;
        }

        /* Upload - Image */
        if (empty($info['upload']) || empty($info['image'])) {
            $info['upload'] = $info['upload-error'];
            $info['image'] = $info['image-error'];
        }

        /* Size */
        if (!empty($info['sizes'])) {
            $info['size-error'] = $info['size-src'] = $info['sizes'];
        }

        /* Path origin */
        $info['pathOrigin'] = $info['upload'] . $info['image'];

        /* Path src */
        if (!empty($info['url'])) {
            $info['pathSrc'] = $info['url'];
        } else {
            if (!empty($info['size-src']) && $info['create_thumbs']) {
                $info['pathSize'] = $info['size-src'] . "/" . $info['upload'] . $info['image'];
                $info['pathSrc'] = (!empty($info['isWatermark']) && !empty($info['prefix'])) ? $https_config . $info['watermark'] . "/" . $info['prefix'] . "/" . $info['pathSize'] : $https_config . $info['thumbs'] . "/" . $info['pathSize'];
            } else {
                $info['pathSrc'] = $https_config . $info['pathOrigin'];
            }
        }

        /* Path error */
        $info['pathError'] = $https_config . $info['thumbs'] . "/" . $info['size-error'] . "/" . $info['upload-error'] . $info['image-error'];

        /* target */
        $info['target'] = (!empty($info['target'])) ? "target='" . $info['target'] . "'" : "";

        /* Class */
        $info['class'] = ($info['isLazy']) ? $info['class'] . ' lazy ' : $info['class'];
        $info['class'] = (!empty($info['class'])) ? "class='" . $info['class'] . "'" : "";
        $info['classfix'] = (!empty($info['classfix'])) ? "class='" . $info['classfix'] . "'" : "";

        /* Id */
        $info['id'] = (!empty($info['id'])) ? "id='" . $info['id'] . "'" : "";

        /* Check to convert Webp */
        $info['hasURL'] = false;

        if (filter_var(str_replace($https_config, "", $info['pathSrc']), FILTER_VALIDATE_URL)) {
            $info['hasURL'] = true;
        }

        if ($config['website']['image']['hasWebp']) {

            if (!$info['sizes']) {
                if (!$info['hasURL']) {
                    $this->converWebp($info['pathSrc']);
                }
            }

            if (!$info['hasURL']) {
                $info['pathSrc'] .= '.webp';
            }
        }

        /* Src */
        $info['src'] = (!empty($info['isLazy']) && strpos($info['class'], 'lazy') !== false) ? "data-src='" . $info['pathSrc'] . "'" : "src='" . $info['pathSrc'] . "'";

        /* add ahref */
        if ($info['addhref']) {

            $startHref = "<a href='" . $info['href'] . "' " . $info['classfix'] . " " . $info['target'] . " role='" . $info['role'] . "' rel='" . $info['rel'] . "' title='" . $info['alt'] . "' " . $info['data'] . " style='aspect-ratio:$width/$height; max-width:" . $width . "px ;  $style' > ";

            $endHref = "</a>";
        } else {
            $startHref = "<div  " . $info['classfix'] . " style='aspect-ratio:$width/$height; max-width:" . $width . "px ;  $style > " . $info['data'] . "";

            $endHref = "</div>";
        }

        /* Image */
        $result = "{$startHref}<img width='{$width}' height='{$height}' " . $info['class'] . " " . $info['id'] . " onerror=\"this.src=" . $info['pathError'] . "\" " . $info['src'] . " alt='" . $info['alt'] . "'/>{$endHref}";

        return $result;
    }

    public function getCacheFilePath($key)
    {
        return $this->cacheDir . '/cache_' . md5($key);
    }
    public function setArrayJson($nameJson, $namedata, $urlJson)
    {
        $tmpfile = array();
        $tmpfile[$namedata] = $this->getArrayJson($namedata, $urlJson);
        if (!isset($tmpfile[$namedata]) || !is_array($tmpfile[$namedata])) {
            $tmpfile[$namedata] = array();
        }
        if (!in_array($nameJson, $tmpfile[$namedata]) && !empty($tmpfile)) {
            array_push($tmpfile[$namedata], $nameJson);
            file_put_contents($urlJson . '.json', json_encode($tmpfile));
            return true;
        }
        return false;
    }

    public function getArrayJson($namedata, $urlJson)
    {
        if (file_exists($urlJson . '.json')) {
            $tmpfile = json_decode(file_get_contents($urlJson . '.json'), true)[$namedata];
            return $tmpfile;
        }
        return false;
    }
    public function getNameFolder($nameFolder, $additional_characters = '')
    {
        if (is_dir($nameFolder) && is_readable($nameFolder)) {
            $data = array();
            $folders = scandir($nameFolder);
            foreach ($folders as $folder_name) {
                if (is_dir($nameFolder . $additional_characters . $folder_name) && !in_array($folder_name, ['.', '..'])) {
                    array_push($data, $folder_name . $additional_characters);
                }
            }
        }
        return $data;
    }
    public function getTemplate($templateName, $data = [], $isCache = false)
    {
        echo $this->getTemplateContent($templateName, $data, $isCache);
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
    public function getTemplateContent($templateName, $data = [], $isCache = true)
    {
        global $config, $com, $_SRC, $_ACT, $_TYPE, $jv0;

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
        $cacheData = array(
            'dataHash' => $dataHash,
            'timestamp' => time(),
            'content' => $htmlContent
        );

        file_put_contents($cacheFile, serialize($cacheData));
        return $htmlContent;
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
    public function getTemplateLayoutsFor($data = array())
    {
        global $config;

        $defaults = [
            'name_layouts' => '',
            'data' => '',
            'save_cache' => true,
            'global' => '',
        ];

        /* Data */
        $info = array_merge($defaults, $data);
        if (!empty($info['global'])) {
            $global_data = $this->importGlobals($info['global']);
            $info = array_merge($info, $global_data);
        }
        $info['name_layouts'] = trim($info['name_layouts'], ' ');
        $layouts_tmp = $this->getCheckInfile($info['name_layouts'], _views);
        if (($layouts_tmp['return'] == true)) {
            $html = $this->getTemplateContent($layouts_tmp['url'], $info, (($config['cache']['save_cache_temple']) == true) ? $info['save_cache'] : false);
        } else {
            $html = "<span>file không nằm trong folder views</span>";
        }
        // html
        return $html;
    }
    function checkTottalDateChart($data = array())
    {
        $defaults = [
            "total_order" => [],
            "data_check" => null,
            "start_check" => null,
            "end_check" => null,
        ];

        $option = array_merge($defaults, $data);
        $array_total_data_chart = [];

        if (is_null($option['data_check'])) {
            return $array_total_data_chart;
        }
        foreach ($option['total_order'] as $k_order => $v_order) {
            if (isset($v_order[$option['data_check']])) {
                if ($v_order[$option['data_check']] >= $option['start_check'] && $v_order[$option['data_check']] <= $option['end_check']) {
                    array_push($array_total_data_chart, $v_order);
                }
            }
        }
        return $array_total_data_chart;
    }
    function checkDetailReturnDashboard($data = array())
    {
        $defaults = [
            "total_data" => [],
            "data_check" => null,
            "status_check" => null,
            "total_money_check" => null,
            "start_check" => null,
            "end_check" => null,
        ];

        $option = array_merge($defaults, $data);

        $total_money_success_chart = 0;
        $total_money_cancel_chart = 0;

        foreach ($option['total_data'] as $k_data_order => $v_data_order) {
            if ($v_data_order[$option['data_check']] >= $option['start_check'] && $v_data_order[$option['data_check']] <= $option['end_check']) {
                switch ($v_data_order[$option['status_check']]) {
                    case 2:
                        $total_money_success_chart += $v_data_order[$option['total_money_check']];
                        break;
                    case 3:
                        $total_money_cancel_chart += $v_data_order[$option['total_money_check']];
                        break;
                    default:
                        break;
                };
                unset($option['total_data'][$k_data_order]);
            }
        }
        $option['total_data'] = array_values($option['total_data']);

        $array_return = [
            'money_success' => $total_money_success_chart,
            'money_cancel' => $total_money_cancel_chart,
        ];

        return $array_return;
    }
    public function stripUnicode($str)
    {

        if (!$str) return false;

        $unicode = array(

            'a' => 'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ',

            'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',

            'd' => 'đ',

            'D' => 'Đ',

            'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',

            'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',

            'i' => 'í|ì|ỉ|ĩ|ị',

            'I' => 'Í|Ì|Ỉ|Ĩ|Ị',

            'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',

            'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',

            'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',

            'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',

            'y' => 'ý|ỳ|ỷ|ỹ|ỵ',

            'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ'

        );

        foreach ($unicode as $khongdau => $codau) {

            $arr = explode("|", $codau);

            $str = str_replace($arr, $khongdau, $str);
        }

        return $str;
    }
    public function changeTitle($str)
    {
        $str = $this->stripUnicode($str);
        $str = mb_convert_case($str, MB_CASE_LOWER, 'utf-8');
        $str = trim($str);
        $str = preg_replace('/[^a-zA-Z0-9\ ]/', '', $str);
        $str = str_replace("  ", " ", $str);
        $str = str_replace(" ", "-", $str);
        return $str;
    }
    public function imagesName($nameImg)
    {

        $rand = rand(10, 9999);

        $img = explode(".", $nameImg);

        $result = $this->changeTitle($img[0]) . "-" . $rand;

        return $result;
    }
    public function deleteLink($file)
    {
        return @unlink($file);
    }
    public function getNameData($data_name = null)
    {
        return $data_name;
    }
    public function uploadImg($id = 0, $photo = 'photo', $thumb = 'thumb', $file = null, $path = null, $table = null, $w = null, $h = null, $r = 1, $b = false)
    {
        global $db;
        if ($file) {
            $handle = new Upload($file);
            if ($file['error'] != 4) {
                if ($handle->uploaded) {
                    $handle->file_new_name_body = $this->imagesName($handle->file_src_name_body);
                    $data[$photo] = $handle->file_new_name_body . '.' . $handle->file_src_name_ext;
                    $handle->process($path);
                    if ($handle->processed) {
                        if ($id != 0) {

                            $db->where("id", $id);

                            $item = $db->getOne($table);

                            if (!file_exists($path . $item[$photo])) {
                                $this->deleteLink($path . $item[$photo]);
                            }
                        }

                        $msg_upload = true;
                    }
                }
                if ($handle->uploaded) {
                    $handle->image_resize = true;
                    $handle->image_x = $w;
                    $handle->image_y = $h;
                    $handle->file_new_name_body = $this->imagesName($handle->file_src_name_body) . '_' . $handle->image_x . 'x' . $handle->image_y;
                    $data[$thumb] = $handle->file_new_name_body . '.' . $handle->file_src_name_ext;
                    if ($r == 2) {
                        $handle->image_ratio_fill  = true;
                        if ($b == true) {
                            $handle->image_background_color = '#FFF';
                        }
                    } else {
                        $handle->image_ratio_crop = true;
                    }
                    if ($handle->file_src_name_ext == 'jqg' || $handle->file_src_name_ext == 'jpeg' || $handle->file_src_name_ext == 'JPG' || $handle->file_src_name_ext == 'JPEG') {
                        $handle->image_convert         = 'jpg';
                        $handle->jpeg_quality = 90;
                    } elseif ($handle->file_src_name_ext == 'png' || $handle->file_src_name_ext == 'PNG') {
                        $handle->image_convert         = 'png';
                        $handle->png_compression = 3;
                    }
                    $handle->process($path);
                    if ($handle->processed) {
                        if ($id != 0) {
                            $db->where("id", $id);
                            $item = $db->getOne($table);
                            $this->deleteLink($path . $item[$thumb]);
                        }
                        $msg_upload = true;
                    }
                }
            }
            return $data;
        }
    }
    public function getTimeAgo($dateTime)
    {
        if (is_string($dateTime)) {
            $timestamp = strtotime(str_replace("/", "-", $dateTime));
        } elseif (is_int($dateTime)) {
            $timestamp = $dateTime;
        } else {
            return "không hợp lệ";
        }

        $currentTimestamp = time();
        $elapsedSeconds = $currentTimestamp - $timestamp;
        if ($elapsedSeconds < 0) {
            return "Thời gian chưa xảy ra.";
        }

        // Tính toán thời gian
        $secondsInMinute = 60;
        $secondsInHour = 3600;
        $secondsInDay = 86400;
        $secondsInMonth = 2592000; // 30 ngày
        $secondsInYear = 31536000; // 365 ngày

        if ($elapsedSeconds < $secondsInMinute) {
            return "$elapsedSeconds giây trước";
        } elseif ($elapsedSeconds < $secondsInHour) {
            $minutes = floor($elapsedSeconds / $secondsInMinute);
            return "$minutes phút trước";
        } elseif ($elapsedSeconds < $secondsInDay) {
            $hours = floor($elapsedSeconds / $secondsInHour);
            return "$hours giờ trước";
        } elseif ($elapsedSeconds < $secondsInMonth) {
            $days = floor($elapsedSeconds / $secondsInDay);
            return "$days ngày trước";
        } elseif ($elapsedSeconds < $secondsInYear) {
            $months = floor($elapsedSeconds / $secondsInMonth);
            return "$months tháng trước";
        } else {
            $years = floor($elapsedSeconds / $secondsInYear);
            return "$years năm trước";
        }
    }
    public function addBillDetail($data = [], $id = null, $status = null)
    {
        global $db, $sup_main_table, $_TYPE, $name_table_warehouse_product;
        if (!empty($data)) {
            foreach ($data as $key_product => $value_product) {
                $sent_sp = [];
                $info_product = $db->rawQueryOne("select id,id_warehouse,id_supplier,name,sale_price,capital_price,quantity,code from #_$name_table_warehouse_product where  " . $this->getAccountParam()->sql . " and id=?  and trash<>true", array($value_product['id']));
                $sent_sp['id_owner'] = $this->getAccountParam()->id;
                $sent_sp['id_warehouse'] = $info_product['id_warehouse'];
                $sent_sp['id_product'] = $value_product['id'];
                $sent_sp['id_supplier'] = $info_product['id_supplier'];
                $sent_sp['quantity'] = $value_product["quantity"];
                $sent_sp['price'] = (int)$value_product["quantity"] * (int)$info_product['capital_price'];
                $sent_sp['status'] = $status;
                $data_trashed = $this->save_data_trash($info_product);
                if (!empty($data_trashed)) {
                    $sent_sp['data_trashed'] = json_encode($data_trashed, JSON_UNESCAPED_UNICODE);
                }
                $sent_sp['date_created'] = time();
                switch ($_TYPE) {
                    case 'import':
                        $sent_sp['id_bill_goods'] = $id;
                        if ($status == 2) {
                            $db->rawQueryOne("update table_$name_table_warehouse_product set quantity=quantity+? where " . $this->getAccountParam()->sql . " and id=?  and trash<>true", array($value_product["quantity"], $value_product['id']));
                        }
                        break;
                    case 'export':
                        $sent_sp['id_bill'] = $id;
                        if ($status == 2) {
                            $db->rawQueryOne("update table_$name_table_warehouse_product set quantity=quantity-? where " . $this->getAccountParam()->sql . " and id=?  and trash<>true", array($value_product["quantity"], $value_product['id']));
                        }
                        break;
                    default:
                        break;
                }
                $check = $db->insert($sup_main_table, $sent_sp);
            }
        }
        return true;
    }
    public function save_data_trash($data = [])
    {
        global $db;
        global $name_table_warehouse_warehouse;
        global $name_table_warehouse_supplier;
        global $name_table_warehouse_customer;
        global $name_table_warehouse_ship;
        global $name_table_warehouse_product;

        $array_trash_data = array();
        if (!empty($data)) {
            if (!empty($data['id_warehouse'])) {
                $info_data = [];
                $info_data = $db->rawQueryOne("select name from table_$name_table_warehouse_warehouse where " . $this->getAccountParam()->sql . " and id=? and trash<>true", array($data['id_warehouse']));
                if (!empty($info_data)) {
                    $array_trash_data['id_warehouse'] = $info_data['name'];
                } else {
                    return array();
                }
            }
            if (!empty($data['id_supplier'])) {
                $info_data = [];
                $info_data = $db->rawQueryOne("select name from table_$name_table_warehouse_supplier where " . $this->getAccountParam()->sql . " and id=? and trash<>true", array($data['id_supplier']));
                if (!empty($info_data)) {
                    $array_trash_data['id_supplier'] = $info_data['name'];
                } else {
                    return array();
                }
            }
            if (!empty($data['id_customer'])) {
                $info_data = [];
                $info_data = $db->rawQueryOne("select name from table_$name_table_warehouse_customer where " . $this->getAccountParam()->sql . " and id=? and trash<>true", array($data['id_customer']));
                if (!empty($info_data)) {
                    $array_trash_data['id_customer'] = $info_data['name'];
                } else {
                    return array();
                }
            }
            if (!empty($data['id_ship'])) {
                $info_data = [];
                $info_data = $db->rawQueryOne("select name from table_$name_table_warehouse_ship where " . $this->getAccountParam()->sql . " and id=? and trash<>true", array($data['id_ship']));
                if (!empty($info_data)) {
                    $array_trash_data['id_ship'] = $info_data['name'];
                } else {
                    return array();
                }
            }
            if (!empty($data['id_product'])) {
                $info_data = [];
                $info_data = $db->rawQueryOne("select name from table_$name_table_warehouse_product where " . $this->getAccountParam()->sql . " and id=? and trash<>true", array($data['id_product']));
                if (!empty($info_data)) {
                    $array_trash_data['id_product'] = $info_data['name'];
                } else {
                    return array();
                }
            }
        }
        return $array_trash_data;
    }
    public function getQuantityProductOrdered($id = null)
    {
        global $db, $name_table_warehouse_bill_detail, $name_table_warehouse_product;
        $quantity_product_ordered =  $db->rawQueryOne("select SUM(quantity) as totalquantity from table_$name_table_warehouse_bill_detail where " . $this->getAccountParam()->sql . " and id_product=? and status=?", array($id, 1));
        $quantity_product =  $db->rawQueryOne("select quantity from table_$name_table_warehouse_product where " . $this->getAccountParam()->sql . " and id=? and status=? and trash<>true", array($id, 1));
        if (!empty($quantity_product_ordered)) {
            $quantity_available = ($quantity_product['quantity'] - $quantity_product_ordered['totalquantity']  >= 0) ? $quantity_product['quantity'] - $quantity_product_ordered['totalquantity']  : 0;
        } else {
            $quantity_available =  $quantity_product['quantity'];
        }

        return $quantity_available;
    }
    public function save_data($array = [])
    {
        global  $db;
        global $account_info;
        global $name_table_warehouse_product;
        global $name_table_warehouse_warehouse;
        global $name_table_warehouse_customer;
        global $_SRC;
        global $_TYPE;

        $default = [
            "id" => '',
            "data" => [],
            "photo" => [],
            "folder" => '',
            "table" => '',
        ];

        $info = array_merge($default, $array);
        extract($info);
        $send = array();
        if (!empty($account_info)) {
            $send['id_owner'] = $this->getAccountParam()->id;
            if (!empty($data)) {
                foreach ($data as $k => $v) {
                    if (!in_array($k, ['list_id_product'])) {
                        // kiểm tra số
                        if (in_array($k, [
                            'max_quantity',
                            'sale_price',
                            'capital_price',
                            'quantity',
                            'status',
                            'district',
                            'min_quantity',
                            'city',
                            'gender',
                            'salary_type',
                            'salary',
                            'status',
                            'kind',
                            'goods_money',
                            'id_save',
                            'id_staff',
                            'time_save',
                            'price',
                            'formality',
                            'corner_money',
                            'salary_paid',
                            'id_warehouse',
                            'id_supplier',
                            'total_price',
                            'capital_price',
                            'id_customer',
                            'id_ship',
                            'total_amount',
                            'discount',
                            'ship',
                            'pay',
                            'id_bill',
                            'id_bill_goods',
                            'id_product',
                            'id_check',
                            'id_tester',
                            'id_balancer',
                            'inventory',
                            'reality',
                            'deviation',
                            'price_deviation',
                            'id_importer',
                        ])) {
                            $send[$k] = preg_replace("/[^0-9]/", "",  htmlspecialchars($v));
                            // kiểm tra ngày
                        } elseif (in_array($k, [
                            'birthdate',
                            'balance_day',
                            'check_date',
                            'expiration_date',
                            'import_date',
                        ])) {
                            $send[$k] = strtotime(str_replace('/', '-', $v));
                        } else {
                            $send[$k] = htmlspecialchars($v);
                        }
                    }
                }
            }
            // kiểm tra mã và tên có trùng không
            $where_check_edit = "";
            if (!empty($id)) {
                $where_check_edit = " and id<>$id ";
            }
            if (!empty($data['name'])) {
                $check_namecode = $db->rawQueryOne("select id from #_" . $table . " where " . $this->getAccountParam()->sql . " and (name = ? or code = ?) $where_check_edit ", array($data['name'], $data['code']));
            } else {
                $check_namecode = $db->rawQueryOne("select id from #_" . $table . " where " . $this->getAccountParam()->sql . " and (code = ?) $where_check_edit ", array($data['code']));
            }
            if (!empty($check_namecode) || empty($data['code']) || (strlen($data['code']) < 7)) {
                if (!empty($id)) {
                    $this->save_notification($data, $table, 2, 'edit', 2);
                } else {
                    $this->save_notification($data, $table, 2, 'add', 2);
                }
                $status = [
                    "status" => 201,
                    "messenger" => "Tên/Mã bị trùng hoặc không đúng định dạng!",
                ];
                return  $status;
            }
            // trả về danh sách sản phẩm 
            if (!empty($data['list_id_product'])) {
                $list_bill_detail = array();
                foreach ($data['list_id_product'] as $item) {
                    $list_bill_detail[] = json_decode($item, true);
                }
            }
            // kiểm tra mục đặt biệt
            switch ($_SRC) {
                case 'warehouse':
                    switch ($_TYPE) {
                        case 'warehouse':
                            if (!empty($id)) {
                                $db->rawQueryOne("update table_$name_table_warehouse_product set status=? where id_warehouse=? and " . $this->getAccountParam()->sql . " and trash<>true", array($data['status'], $id));
                            }
                            break;
                        case 'product':
                            if (empty($id)) {
                                $info_warehouse =  $db->rawQueryOne("select status from table_$name_table_warehouse_warehouse where id=? and " . $this->getAccountParam()->sql . " and trash<>true", array($data['id_warehouse']));
                                $send['status'] = $info_warehouse['status'];
                            }
                            break;
                        default:
                            break;
                    }
                    break;
                case 'transaction':
                    switch ($_TYPE) {
                        case 'import':
                            // kiểm tra số lượng khi thay đổi trạng thái
                            if (!empty($id)) {
                                $check_status_bill = $db->rawQueryOne("select status from table_$table where " . $this->getAccountParam()->sql . " and id=? and status<>?", array($id, $data['status']));
                                if (!empty($check_status_bill)) {
                                    $list_product = $db->rawQuery("select id,id_product,quantity from table_$sub_table where " . $this->getAccountParam()->sql . " and id_bill_goods=? and status<>?", array($id, $data['status']));
                                    if (!empty($list_product)) {
                                        try {
                                            switch ($data['status']) {
                                                case 1:
                                                    foreach ($list_product as $value) {
                                                        $quantity_available = $this->getQuantityProductOrdered($value['id']);
                                                        if ($value['quantity'] > $quantity_available) {
                                                            $info_product = $db->rawQueryOne("select code from table_$name_table_warehouse_product where " . $this->getAccountParam()->sql . " and id = ? and trash<>true", array($value['id_product']));
                                                            $this->save_notification($info_product ?? '', $table, 4, 'edit', 2);
                                                            throw new Exception("Sản phẩm " . ($info_product['code'] ?? 'Không rõ') . " không đủ số lượng!");
                                                        }
                                                    }
                                                    foreach ($list_product as $value) {
                                                        $db->rawQueryOne("update table_$name_table_warehouse_product set quantity = quantity - ? where " . $this->getAccountParam()->sql . " and id = ? and trash<>true", array($value['quantity'], $value['id_product']));
                                                        $db->rawQueryOne("update table_$sub_table set status = ? where " . $this->getAccountParam()->sql . " and id = ? and trash<>true", array($data['status'], $value['id']));
                                                    }
                                                    break;
                                                case 2:
                                                    foreach ($list_product as $value) {
                                                        $db->rawQueryOne("update table_$name_table_warehouse_product set quantity = quantity + ? where " . $this->getAccountParam()->sql . " and id = ? and trash<>true", array($value['quantity'], $value['id_product']));
                                                        $db->rawQueryOne("update table_$sub_table set status = ? where " . $this->getAccountParam()->sql . " and id = ? and trash<>true", array($data['status'], $value['id']));
                                                    }
                                                    break;
                                                default:
                                                    break;
                                            }
                                        } catch (Exception $e) {
                                            return [
                                                "status" => 201,
                                                "messenger" => $e->getMessage(),
                                            ];
                                        }
                                    }
                                }
                            }
                            break;
                        case 'export':
                            // kiểm tra khách hàng
                            if (!empty($customer)) {
                                $check_name_customer = $db->rawQueryOne("select id FROM table_$name_table_warehouse_customer WHERE " . $this->getAccountParam()->sql . " and name=?", array($customer['name']));
                                if (empty($check_name_customer)) {
                                    $code = "KH";
                                    do {
                                        if ($check == false) {
                                            for ($i = 0; $i < 8; $i++) {
                                                $code .= mt_rand(0, 9);
                                            }
                                        }
                                        $check_code_customer = $db->rawQueryOne("select id FROM table_$name_table_warehouse_customer WHERE " . $this->getAccountParam()->sql . " and code=?", array($code));
                                    } while (!empty($check_code_customer));

                                    foreach ($customer as $k => $v) {
                                        $send_kh[$k] = htmlspecialchars($v);
                                    }
                                    $send_kh['id_owner'] = $this->getAccountParam()->id;
                                    $send_kh['code'] = $code;
                                    $send_kh['status'] = 1;
                                    $send_kh['date_created'] = time();
                                    $send['id_customer'] = $db->insert($name_table_warehouse_customer, $send_kh);
                                } else {
                                    $this->save_notification($customer, $table, 5, 'add', 2);
                                    $status = [
                                        "status" => 201,
                                        "messenger" => "Tên khách hàng bị trùng!",
                                    ];
                                    return $status;
                                }
                            }
                            // kiểm tra danh sách sản phẩm
                            if (empty($id)) {
                                if (!empty($list_bill_detail)) {
                                    foreach ($list_bill_detail as $key => $value) {
                                        $quantity_available = $this->getQuantityProductOrdered($value['id']);
                                        $info_product =  $db->rawQueryOne("select quantity,code from table_$name_table_warehouse_product where " . $this->getAccountParam()->sql . " and id=? and status=?", array($value['id'], 1));
                                        if (!empty($info_product) && $info_product['quantity'] > 0) {
                                            if ($value['quantity'] > $quantity_available) {
                                                $this->save_notification($info_product, $table, 7, 'add', 2);
                                                $status = [
                                                    "status" => 201,
                                                    "messenger" => "Sản phẩm " . $info_product['code'] . " không đủ số lượng!",
                                                ];
                                                return $status;
                                            }
                                        } else {
                                            $this->save_notification($info_product, $table, 6, 'add', 2);
                                            $status = [
                                                "status" => 201,
                                                "messenger" => "Có sản phẩm không đủ số lượng hoặc sản phẩm không tồn tại!",
                                            ];
                                            return $status;
                                        }
                                    }
                                } else {
                                    $this->save_notification($data, $table, 8, 'add', 2);
                                    $status = [
                                        "status" => 201,
                                        "messenger" => "Bạn chưa chọn sản phẩm trong hóa đơn!",
                                    ];
                                    return $status;
                                }
                                // kiểm tra  đối tác vận chuyển
                                if (empty($data['id_ship'])) {
                                    if (!empty($id)) {
                                        $this->save_notification($data, $table, 9, 'edit', 2);
                                    } else {
                                        $this->save_notification($data, $table, 9, 'add', 2);
                                    }
                                    $status = [
                                        "status" => 201,
                                        "messenger" => "Bạn chưa chọn đối tác giao hàng!",
                                    ];
                                    return $status;
                                }
                                // kiểm tra phương thức thanh toán
                                if (empty($data['pay'])) {
                                    if (!empty($id)) {
                                        $this->save_notification($data, $table, 10, 'edit', 2);
                                    } else {
                                        $this->save_notification($data, $table, 10, 'add', 2);
                                    }
                                    $status = [
                                        "status" => 201,
                                        "messenger" => "Bạn chưa chọn phương thức thanh toán!",
                                    ];
                                    return $status;
                                }
                            }

                            // kiểm tra trạng thái
                            if (!empty($id)) {
                                $check_status_bill = $db->rawQueryOne("select status from table_$table where " . $this->getAccountParam()->sql . " and id=? and status<>?", array($id, $data['status']));
                                if (!empty($check_status_bill)) {
                                    $list_product = $db->rawQuery("select id,id_product,quantity from table_$sub_table where " . $this->getAccountParam()->sql . " and id_bill=? and status<>? and trash<>true", array($id, $data['status']));
                                    if (!empty($list_product)) {
                                        try {
                                            switch ($data['status']) {
                                                case 1:
                                                case 3:
                                                    foreach ($list_product as $value) {
                                                        if ($check_status_bill['status'] == 2) {
                                                            $db->rawQueryOne("update table_$name_table_warehouse_product set quantity = quantity + ? where " . $this->getAccountParam()->sql . " and id = ?", array($value['quantity'], $value['id_product']));
                                                        }
                                                        $db->rawQueryOne("update table_$sub_table set status = ? where " . $this->getAccountParam()->sql . " and id = ?", array($data['status'], $value['id']));
                                                    }
                                                    break;
                                                case 2:
                                                    foreach ($list_product as $value) {
                                                        $quantity_available = $this->getQuantityProductOrdered($value['id']);
                                                        if ($value['quantity'] > $quantity_available) {
                                                            $info_product = $db->rawQueryOne("select code from table_$name_table_warehouse_product where " . $this->getAccountParam()->sql . " and id = ?", array($value['id_product']));
                                                            $this->save_notification($info_product ?? '', $table, 4, 'edit', 2);
                                                            throw new Exception("Sản phẩm " . ($info_product['code'] ?? 'Không rõ') . " không đủ số lượng!");
                                                        }
                                                    }
                                                    foreach ($list_product as $value) {
                                                        $db->rawQueryOne("update table_$name_table_warehouse_product set quantity = quantity - ? where " . $this->getAccountParam()->sql . " and id = ?", array($value['quantity'], $value['id_product']));
                                                        $db->rawQueryOne("update table_$sub_table set status = ? where " . $this->getAccountParam()->sql . " and id = ?", array($data['status'], $value['id']));
                                                    }
                                                    break;
                                                default:
                                                    break;
                                            }
                                        } catch (Exception $e) {
                                            return [
                                                "status" => 201,
                                                "messenger" => $e->getMessage(),
                                            ];
                                        }
                                    }
                                }
                            }
                            break;

                        default:
                            break;
                    }
                default:
                    break;
            }

            // kiểm tra quận huyện có đúng không
            if (!empty($data['district']) && !empty($data['city'])) {
                $chech_district = $db->rawQueryOne("select id from #_place_dists where id_city = ? and id = ? ", array($data['city'], $data['district']));
                if (empty($chech_district)) {
                    if (!empty($id)) {
                        $this->save_notification($data, $table, 3, 'edit', 2);
                    } else {
                        $this->save_notification($data, $table, 3, 'add', 2);
                    }
                    $status = [
                        "status" => 201,
                        "messenger" => "Quận huyện không đúng!",
                    ];
                    return $status;
                }
            }

            // xử lý hình ảnh
            $file = $photo[0];
            if (!empty($file)) {
                if ($file['error'] == 0) {
                    $photo = $this->uploadImg((!empty($id)) ? $id : 0, "photo", "thumb", $file, $folder, $table, 600, 600, 1, false);
                    $send['photo'] = $photo['photo'];
                    $send['thumb'] = $photo['thumb'];
                }
            }
            $data_trashed = $this->save_data_trash($data);
            if (!empty($data_trashed)) {
                $send['data_trashed'] = json_encode($data_trashed, JSON_UNESCAPED_UNICODE);
            }
            if (!empty($id)) {
                $db->where('id', $id);
                $updateData = $db->update($table, $send);
                $id_bill_detail = $id;
                if ($updateData) {
                    $check_status_load = $updateData;
                    $this->save_notification(array_merge($send, ["id" => $id]), $table, 1, 'edit', 1);
                }
            } else {
                $send['date_created'] = time();
                $send['trash'] = false;
                $insertID = $db->insert($table, $send);
                $id_bill_detail = $insertID;
                if ($insertID) {
                    $check_status_load = $insertID;
                    $this->save_notification(array_merge($send, ["id" => $insertID]), $table, 1, 'add', 1);
                }
            }
            if (!empty($list_bill_detail)) {
                $this->addBillDetail($list_bill_detail, $id_bill_detail, $send['status']);
            }
        }
        if ($check_status_load) {
            $status = [
                "status" => 200,
                "messenger" => "Cập nhật dữ liệu thành công!",
            ];
        } else {
            $status = [
                "status" => 201,
                "messenger" => "Cập nhật dữ liệu thất bại!",
            ];
        }
        return $status;
    }
    public function delete_data($list_id = array(), $status = null, $table = null)
    {
        global $db;
        global $name_table_warehouse_warehouse;
        global $name_table_warehouse_product;
        global $name_table_warehouse_bill;
        global $name_table_warehouse_bill_detail;
        global $name_table_warehouse_bill_goods;
        global $name_table_warehouse_bill_goods_detail;

        if (!is_array($list_id)) {
            $list_id = [$list_id];
        }
        foreach ($list_id as $value) {
            $info_data = $db->rawQueryOne("select id,code from table_$table where " . $this->getAccountParam()->sql . " and id=? ", array($value));
            if (!empty($info_data)) {
                switch ($status) {
                    case 'trash':
                        $db->rawQueryOne("update table_$table set trash=?,date_trash=? where " . $this->getAccountParam()->sql . " and id=? and trash<>true ", array(true, time(), $value));
                        switch ($table) {
                            case $name_table_warehouse_warehouse:
                                $db->rawQueryOne("update table_$name_table_warehouse_product set trash=?,date_trash=? where " . $this->getAccountParam()->sql . " and id_warehouse=? and trash<>true ", array(true, time(), $value));
                                break;
                            default:
                                break;
                        }
                        $status_notification = [
                            "status" => 200,
                            "messenger" => "Chuyển dữ liệu " . $info_data['code'] . " vào thùng rác thành công!",
                        ];
                        break;
                    case 'undo':
                        $db->rawQueryOne("update table_$table set trash=?,date_trash=? where " . $this->getAccountParam()->sql . " and id=? and trash<>false ", array(false, NULL, $value));
                        switch ($table) {
                            case $name_table_warehouse_warehouse:
                                $db->rawQueryOne("update table_$name_table_warehouse_product set trash=?,date_trash=? where " . $this->getAccountParam()->sql . " and id_warehouse=? and trash<>false ", array(false, NULL, $value));
                                break;
                            case $name_table_warehouse_product:
                                $info_product = $db->rawQueryOne("select id_warehouse from table_$table where " . $this->getAccountParam()->sql . " and id=?  ", array($value));
                                $info_warehouse_product = $db->rawQueryOne("select id from table_$name_table_warehouse_warehouse where " . $this->getAccountParam()->sql . " and id=? and trash<>false ", array($info_product['id_warehouse']));
                                if (!empty($info_warehouse_product)) {
                                    $db->rawQueryOne("update table_$name_table_warehouse_warehouse set trash=?,date_trash=? where " . $this->getAccountParam()->sql . " and id=? and trash<>false ", array(false, NULL, $info_warehouse_product['id']));
                                }
                                break;
                            default:
                                break;
                        }
                        $status_notification = [
                            "status" => 200,
                            "messenger" => "Hoàn tác dữ liệu " . $info_data['code'] . " thành công!",
                        ];
                        break;
                    case 'delete':
                        $db->rawQueryOne("delete from table_$table where " . $this->getAccountParam()->sql . " and id=? and trash<>false ", array($value));
                        switch ($table) {
                            case $name_table_warehouse_warehouse:
                                $db->rawQueryOne("delete from table_$name_table_warehouse_product where " . $this->getAccountParam()->sql . " and id_warehouse=? and trash<>false ", array($value));
                                break;
                            case $name_table_warehouse_bill:
                                $db->rawQueryOne("delete from table_$name_table_warehouse_bill_detail where " . $this->getAccountParam()->sql . " and id_bill=?", array($value));
                                break;
                            case $name_table_warehouse_bill_goods:
                                $db->rawQueryOne("delete from table_$name_table_warehouse_bill_goods_detail where " . $this->getAccountParam()->sql . " and id_bill_goods=?", array($value));
                                break;
                            default:
                                break;
                        }
                        $status_notification = [
                            "status" => 200,
                            "messenger" => "Xóa dữ liệu " . $info_data['code'] . " thành công!",
                        ];
                        break;
                    default:
                        break;
                }
                $this->save_notification($info_data, $table, 1, $status, 1);
            } else {
                $status_notification = [
                    "status" => 201,
                    "messenger" => "Dữ liệu không tồn tại!",
                ];
            }
        }
        return $status_notification;
    }
    public function save_notification($data = [], $table = null, $kind = null, $check_content = null, $status = null)
    {
        global $db, $account_info, $name_table_warehouse_notification;

        $send_tb = array();
        if (!empty($account_info)) {
            $send_tb['id_owner'] = $this->getAccountParam()->id;
            $send_tb['kind'] = $kind;
            $send_tb['status'] = $status;
            $send_tb['check_content'] = $check_content;
            $send_tb['viewed'] = 1;
            $send_tb['date_created'] = time();
            $content = [];
            switch ($table) {
                case 'warehouse_warehouse':
                    $name = "Kho";
                    break;
                case 'warehouse_product':
                    $name = "Sản phẩm";
                    break;
                case 'warehouse_supplier':
                    $name = "Nhà cung cấp";
                    break;
                case 'warehouse_customer':
                    $name = "Khách hàng";
                    break;
                case 'warehouse_ship':
                    $name = "Đối tác vận chuyển";
                    break;
                case 'warehouse_bill':
                    $name = "Hóa đơn";
                    break;
                case 'warehouse_bill_goods':
                    $name = "Hóa đơn hàng hóa";
                    break;
                default:
                    break;
            }
            switch ($check_content) {
                case 'add':
                    $title = "Thêm dữ liệu vào ";
                    $content[1] = "Mã dữ liệu được thêm vào: ";
                    $content[2] = "Tên/Mã dữ liệu thêm vào bị trùng hoặc dữ liệu không đúng định dạng!";
                    $content[3] = "Quận/Huyện dữ liệu thêm vào không đúng định dạng!";
                    $content[4] = "Đơn nhập hàng có sản phẩm " . $data['code'] . " không đủ số lượng trong!";
                    $content[5] = "Tên khách hàng " . $data['name'] . " bị trùng!";
                    $content[6] = "Có sản phẩm không đủ số lượng hoặc sản phẩm không tồn tại!";
                    $content[7] = "Sản phẩm " . $data['code'] . " không đủ số lượng!";
                    $content[8] = "Bạn chưa chọn sản phẩm trong hóa đơn!";
                    $content[9] = "Bạn chưa chọn đối tác giao hàng!";
                    $content[10] = "Bạn chưa chọn phương thức thanh toán!";
                    break;
                case 'edit':
                    $title = "Cập nhật dữ liệu ";
                    $content[1] = "Mã dữ liệu được cập nhật: ";
                    $content[2] = "Tên/Mã dữ liệu cập nhật bị trùng hoặc dữ liệu không đúng định dạng!";
                    $content[3] = "Quận/Huyện dữ liệu cập nhật không đúng định dạng!";
                    $content[4] = "Đơn nhập hàng có sản phẩm " . $data['code'] . " không đủ số lượng trong!";
                    $content[5] = "Tên khách hàng " . $data['name'] . " bị trùng!";
                    $content[6] = "Có sản phẩm không đủ số lượng hoặc sản phẩm không tồn tại!";
                    $content[7] = "Sản phẩm " . $data['code'] . " không đủ số lượng!";
                    $content[8] = "Bạn chưa chọn sản phẩm trong hóa đơn!";
                    $content[9] = "Bạn chưa chọn đối tác giao hàng!";
                    $content[10] = "Bạn chưa chọn phương thức thanh toán!";
                    break;
                case 'trash':
                    $title = "Chuyển vào thùng rác dữ liệu ";
                    $content[1] = "Mã dữ liệu được Chuyển vào thùng rác: ";
                    break;
                case 'undo':
                    $title = "Hoàn tác dữ liệu ";
                    $content[1] = "Mã dữ liệu được Hoàn tác: ";
                    break;
                case 'delete':
                    $title = "Xóa dữ liệu ";
                    $content[1] = "Mã dữ liệu được Xóa: ";
                    break;
                default:
                    break;
            }
            switch ($kind) {
                    // Thành công khi thêm xóa sửa
                case 1:
                    $send_tb['name'] = $title . $name;
                    $send_tb['content'] = $content[$kind] . $data['code'];
                    break;
                    // Thất Bại khi kiểm tra tên và mã
                case 2;
                    // Thất Bại khi kiểm tra quận/huyện
                case 3;
                    // Thất Bại khi kiểm tra Số lượng khi nhập kho
                case 4;
                    // Thất Bại khi kiểm tra tên khách hàng mới
                case 5;
                    // Thất Bại khi kiểm tra số lượng sản phẩm trong đơn hàng
                case 6;
                case 7;
                case 8;
                case 9;
                case 10;
                    $send_tb['name'] = $title . $name;
                    $send_tb['content'] = $content[$kind];
                    break;
                default:
                    break;
            }
            $check = $db->insert($name_table_warehouse_notification, $send_tb);
        }
    }
    public function getTitleColumn($column = null)
    {
        $titles = [
            'name' => "Tên",
            'code' => "Mã Kiểm Tra",
            'code_product' => "Mã Kiểm Tra",
            'id_importer' => "Người Nhập",
            'total_quantity' => "Tổng Số Lượng",
            'barcode' => "Mã Vạch",
            'phone' => "Số Điện Thoại",
            'email' => "Email",
            'password' => "Mật Khẩu",
            'city' => "Khu Vực",
            'district' => "Quận Huyện",
            'address' => "Địa Chỉ",
            'calculation_unit' => "Đơn Vị Tính",
            'profession' => "Ngành Nghề",
            'company' => "Công Ty",
            'tax_code' => "Mã Số Thuế",
            'CCCD' => "CCCD",
            'decentralization' => "Phân Quyền",
            'history' => "Lịch Sử",
            'salary_type' => "Loại Lương",
            'salary' => "Lương",
            'status' => "Trạng Thái",
            'content' => "Nội Dung",
            'kind' => "Loại",
            'id_save' => "Đối Tượng",
            'id_staff' => "Nhân Viên Đảm Nhận",
            'receiver' => "Người Nhận",
            'payer' => "Người Thu",
            'time_save' => "Thời Gian Lưu",
            'price' => "Giá",
            'formality' => "Hình Thức Thanh Toán",
            'corner_money' => "Tiến Góc",
            'salary_paid' => "Lương Đã Trả",
            'id_warehouse' => "Kho",
            'id_supplier' => "Nhà Cung Cấp",
            'importer' => "Người Nhập",
            'total_price' => "Tổng Giá",
            'id_customer' => "Khách Hàng",
            'id_ship' => "Đơn Vị Vận Chuyển",
            'total_amount' => "Tổng Số Lượng",
            'discount' => "Giảm Giá",
            'ship' => "Tên Đơn Vị Vận Chuyển",
            'pay' => "Phương Thức Thanh Toán",
            'id_bill' => "Hóa Đơn",
            'id_bill_goods' => "Nhập Hàng",
            'supplier' => "Tên Nhà Cung Cấp",
            'warehouse' => "Tên Kho",
            'id_product' => "Sản Phẩm",
            'expiration_date' => "Hạn Sử Dụng",
            'id_check' => "Phiếu Kiểm",
            'id_tester' => "Người Kiểm",
            'id_balancer' => "Người Cân Bằng",
            'id_exporter' => "Người Xuất Hàng",
            'checker' => "Tên Người Kiểm",
            'balanced_person' => "Tên Người Cân Bằng",
            'check_date' => "Ngày Kiểm",
            'date_trash' => "Ngày Xóa",
            'balance_day' => "Ngày Cân Bằng",
            'inventory' => "Tồn Kho",
            'reality' => "Thực Tế",
            'deviation' => "Độ Lệch",
            'price_deviation' => "Giá Lệch",
            'import_date' => "Ngày Nhập",
            'gender' => "Giới Tính",
            'heft' => "Trọng Lượng",
            'size' => "Kích Thước",
            'location' => "Vị Trí",
            'painted' => "Mô Tả",
            'brand' => "Thương Hiệu",
            'origin' => "Nguồn Gốc",
            'note' => "Ghi Chú",
            'photo' => "Hình Ảnh",
            'sale_price' => "Giá Bán",
            'capital_price' => "Giá Vốn",
            'quantity' => "Tồn Kho",
            'max_quantity' => "Tồn Tối Đa",
            'min_quantity' => "Tồn Tối Thiểu",
            'goods_money' => "Tiền Hàng",
            'birthdate' => "Ngày Sinh",
            'date_created' => "Ngày Tạo",
        ];
        return !empty($titles[$column]) ? $titles[$column] : '';
    }
    public function getAccountParam()
    {
        global  $sessison_account_warehouse;
        $data_return = new stdClass();
        $data_return->id = htmlspecialchars($_SESSION[$sessison_account_warehouse]['id_owner']);
        $data_return->sql = " id_owner=" .  htmlspecialchars($_SESSION[$sessison_account_warehouse]['id_owner']) . " ";
        return $data_return;
    }
    public function value_handing_column($column = null, $value = [])
    {
        global $db;
        global $lang;
        global $https_config;
        global $_SRC;
        global $_TYPE;
        global $name_table_account;
        global $name_table_subaccount;
        global $name_table_warehouse_product;
        global $name_table_warehouse_supplier;
        global $name_table_warehouse_warehouse;
        global $name_table_warehouse_ship;
        global $name_table_warehouse_customer;

        $name = "";
        $Title = $this->getTitleColumn($column);

        switch ($column) {
            case 'quantity':
            case 'max_quantity':
            case 'min_quantity':
            case 'sale_price':
            case 'capital_price':
            case 'goods_money':
            case 'corner_money':
            case 'price':
            case 'total_price':
            case 'salary':
            case 'salary_paid':
                $name =  (!empty($value[$column])) ? $value[$column] : 0;
                break;
            case 'birthdate':
            case 'time_save':
            case 'expiration_date':
            case 'check_date':
            case 'balance_day':
            case 'date_created':
            case 'date_trash':
                $name =  date("H:i:s d/m/Y", $value[$column]);
                break;
            case 'name':
                $name =   $this->getNameData($value[$column]);
                break;
            case 'password':
                $name =  $this->decrypt($value[$column]);
                break;
            case 'booked':
                // $name =  ($value[$column]['quantity'] - $qty_product_ordered['quantity']) > 0 ? $value[$column]['quantity'] - $qty_product_ordered['quantity'] : 0;
                break;
            case 'gender':
                $name = ($value[$column] == 1) ? "Nam" : "Nữ";
                break;
            case 'city':
                $value_city = $db->rawQueryOne("select name_$lang as name from #_place_citys where id = ? ", array($value[$column]));
                $name =  $value_city['name'];
                break;
            case 'district':
                $value_dist = $db->rawQueryOne("select name_$lang as name from #_place_dists where id = ?", array($value[$column]));
                $name =  $value_dist['name'];
                break;
            case 'id_product':
                $value_tmp = $db->rawQueryOne("select name from #_$name_table_warehouse_product where " . $this->getAccountParam()->sql . " and id = ?  and trash<>true", array($value[$column]));
                if (!empty($value_tmp)) {
                    $name =  $value_tmp['name'];
                } else {
                    foreach (json_decode($value["data_trashed"], true) as $key => $value) {
                        if ($key == $column) {
                            $name =  $value;
                            break;
                        }
                    }
                }
                break;
            case 'code_product':
                $value_tmp = $db->rawQueryOne("select code from #_$name_table_warehouse_product where " . $this->getAccountParam()->sql . " and id = ?  and trash<>true", array($value['id_product']));
                $name =  $value_tmp['code'];
                break;
            case 'id_importer':
                switch ($value['status_importer']) {
                    case 'main':
                        $info_importer = $db->rawQueryOne("select name from #_$name_table_account where id=? and trash<>true ", array($value[$column]));
                        $name = $info_importer['name'];
                        break;
                    case 'sub':
                        $info_importer = $db->rawQueryOne("select name from #_$name_table_subaccount where " . $this->getAccountParam()->sql . " and id=?  and trash<>true", array($value[$column]));
                        $name = $info_importer['name'];
                        break;
                    default:
                        break;
                }
                break;
            case 'id_exporter':
                switch ($value['status_exporter']) {
                    case 'main':
                        $info_exporter = $db->rawQueryOne("select name from #_$name_table_account where id=?  and trash<>true", array($value[$column]));
                        $name = $info_exporter['name'];
                        break;
                    case 'sub':
                        $info_exporter = $db->rawQueryOne("select name from #_$name_table_subaccount where " . $this->getAccountParam()->sql . " and id=?  and trash<>true", array($value[$column]));
                        $name = $info_exporter['name'];
                        break;
                    default:
                        break;
                }
                break;
            case 'id_warehouse':
                $value_tmp = $db->rawQueryOne("select name from #_$name_table_warehouse_warehouse where " . $this->getAccountParam()->sql . " and id = ?  and trash<>true", array($value[$column]));
                if (!empty($value_tmp)) {
                    $name =  $value_tmp['name'];
                } else {
                    foreach (json_decode($value["data_trashed"], true) as $key => $value) {
                        if ($key == $column) {
                            $name =  $value;
                            break;
                        }
                    }
                }
                break;
            case 'id_supplier':
                $value_tmp = $db->rawQueryOne("select name from #_$name_table_warehouse_supplier where " . $this->getAccountParam()->sql . " and id = ? and trash<>true ", array($value[$column]));
                if (!empty($value_tmp)) {
                    $name =  $value_tmp['name'];
                } else {
                    foreach (json_decode($value["data_trashed"], true) as $key => $value) {
                        if ($key == $column) {
                            $name =  $value;
                            break;
                        }
                    }
                }
                break;
            case 'id_ship':
                $value_tmp = $db->rawQueryOne("select name from #_$name_table_warehouse_ship where " . $this->getAccountParam()->sql . " and id = ? and trash<>true ", array($value[$column]));
                if (!empty($value_tmp)) {
                    $name =  $value_tmp['name'];
                } else {
                    foreach (json_decode($value["data_trashed"], true) as $key => $value) {
                        if ($key == $column) {
                            $name =  $value;
                            break;
                        }
                    }
                }
                break;
            case 'id_customer':
                $value_tmp = $db->rawQueryOne("select name from #_$name_table_warehouse_customer where " . $this->getAccountParam()->sql . " and id = ? and trash<>true ", array($value[$column]));
                if (!empty($value_tmp)) {
                    $name =  $value_tmp['name'];
                } else {
                    foreach (json_decode($value["data_trashed"], true) as $key => $value) {
                        if ($key == $column) {
                            $name =  $value;
                            break;
                        }
                    }
                }
                break;
            case 'photo':
                $name = $https_config . _upload_baiviet_l . $value[$column];
                break;
            case 'status':
                $name =  $this->status_handing_column(false, $value[$column]);
                switch ($_SRC) {
                    case 'warehouse':
                        if ($_TYPE == "product") {
                            if (($value['max_quantity']) <= $value['quantity'] && ($value['quantity'] > 0)) {
                                $name =  $this->status_handing_column(false, 1);
                            } else if (($value['max_quantity'] *  95 / 100) <= $value['quantity'] && ($value['max_quantity']) > $value['quantity']) {
                                $name =  $this->status_handing_column(false, 2);
                            } else if ((($value['max_quantity'] *  95 / 100) > $value['quantity']) && $value['quantity'] >= $value['min_quantity']) {
                                $name =  $this->status_handing_column(false, 3);
                            } else if ($value['min_quantity'] > $value['quantity'] && ($value['quantity'] > 0)) {
                                $name = $this->status_handing_column(false, 4);
                            } else if (($value['quantity'] == 0)) {
                                $name =  $this->status_handing_column(false, 5);
                            }
                        }
                        break;
                    default:
                        break;
                }
                break;
            default:
                $name =  $value[$column];
                break;
        }

        if (empty($value)) {
            return $Title;
        } else {
            return $name;
        }
    }
    public function status_handing_column($data_check = true, $value_input = null)
    {
        global $_SRC, $_TYPE, $_ACT;
        $data = [];
        $name = "";
        switch ($_SRC) {
            case 'warehouse':
                switch ($_TYPE) {
                    case 'warehouse':
                    case '':
                        $data = [
                            'online' => [
                                "name" => "Còn hoạt động",
                                "value" => 1,
                            ],
                            'offline' => [
                                "name" => "Ngưng hoạt động",
                                "value" => 2,
                            ],
                        ];
                        break;
                    case 'product':
                        $data = [
                            [
                                "name" => "Đã Đầy",
                                "value" => 1,
                            ],
                            [
                                "name" => "Sắp Đầy",
                                "value" => 2,
                            ],
                            [
                                "name" => "Còn Hàng",
                                "value" => 3,
                            ],
                            [
                                "name" => "Sắp Hết Hàng",
                                "value" => 4,
                            ],
                            [
                                "name" => "Hết Hàng",
                                "value" => 5,
                            ],
                        ];
                        break;
                    default:
                        break;
                }
                break;
            case 'partner':
                switch ($_TYPE) {
                    case 'supplier':
                    case '':
                    case 'customer':
                    case 'ship':
                        $data = [
                            'online' => [
                                "name" => "Còn hoạt động",
                                "value" => 1,
                            ],
                            'offline' => [
                                "name" => "Ngưng hoạt động",
                                "value" => 2,
                            ],
                        ];
                        break;
                    default:
                        break;
                }
                break;
            case 'transaction':
                switch ($_TYPE) {
                    case 'import':
                        $data = [
                            [
                                "name" => "Phiếu Tạm",
                                "value" => 1,
                            ],
                            [
                                "name" => "Đã Hoàn Thành",
                                "value" => 2,
                            ],
                        ];
                        break;
                    case 'export':
                        $data = [
                            [
                                "name" => "Phiếu Tạm",
                                "value" => 1,
                            ],
                            [
                                "name" => "Đã Hoàn Thành",
                                "value" => 2,
                            ],
                            [
                                "name" => "Trả Hàng",
                                "value" => 3,
                            ],
                        ];
                        break;
                    default:
                        break;
                }
                break;
            default:
                # code...
                break;
        }
        foreach ($data as $status) {
            if ($status['value'] == $value_input) {
                $name = $status['name'];
                break;
            }
        }
        if ($data_check === true) {
            return $data;
        } else {
            return $name;
        }
    }
    public function getSqlWhereKeywords($keywords = null)
    {
        $sql = "";
        if (!empty($keywords)) {
            $specialChars = ['=', '+', '@', '#', '$', '^', '&', '*', '(', ')', ';', '\'', '"', '\\', ',', '.', '<', '>', '?', '/'];
            $keywords = str_replace($specialChars, ' ', $keywords);
            $array_kw = explode(' ', $keywords);
            $keywords_sql = '';
            $i_keywords = 0;
            foreach ($array_kw as $k_keywords => $v_keywords) {
                if (!empty($v_keywords)) {
                    if ($i_keywords != 0) {
                        $keywords_sql .= '|';
                    }
                    $keywords_sql .= $v_keywords;
                    $i_keywords++;
                }
            }
            $sql = "((name REGEXP '$keywords_sql') or (code REGEXP '$keywords_sql'))";
        }
        return $sql;
    }
    public function getSqlOrderBy($sort = null)
    {
        $order_by = "";
        switch ($sort) {
            case 0:
                $order_by = " order by id desc ";
                break;
            case 1:
                $order_by = " order by date_created desc ";
                break;
            case 2:
                $order_by = " order by date_created asc ";
                break;
            case 3:
                $order_by = " order by name desc ";
                break;
            case 4:
                $order_by = " order by code desc ";
                break;
            default:
                $order_by = " order by id desc ";
                break;
        }
        return $order_by;
    }
    public function getSqlWhereParam($array_param_value = [])
    {
        global $_SRC, $_ACT, $_TYPE;
        $i_param = 0;
        $param_sql = '';
        if (!empty($array_param_value)) {
            foreach ($array_param_value as $key_param => $value_param) {
                if (!empty($value_param)) {
                    $param_sql .= ($i_param != 0) ? ' and ' : '';
                    if (in_array($key_param, ['status'])) {
                        if (($_TYPE == "product") && ($_SRC == "warehouse")) {
                            foreach ($value_param as $key_status => $status) {
                                $param_sql .= ($key_status != 0) ? ' or ' : '(';
                                switch ($status) {
                                    case '1':
                                        $param_sql .= " (max_quantity <= quantity) ";
                                        break;
                                    case '2':
                                        $param_sql .= "((max_quantity > quantity) and (max_quantity * 0.95 <= quantity)) ";
                                        break;
                                    case '3':
                                        $param_sql .= " ((min_quantity < quantity) and (max_quantity * 0.95 > quantity))";
                                        break;
                                    case '4':
                                        $param_sql .= " ((min_quantity > quantity) and (quantity > 0))";
                                        break;
                                    case '5':
                                        $param_sql .= " (quantity = 0) ";
                                        break;
                                    default:
                                        break;
                                }
                                $param_sql .= ($key_status == (count($value_param) - 1)) ? ')' : '';
                            }
                        } else {
                            $param_sql .= "($key_param REGEXP '" . implode('|', $value_param) . "')";
                        }
                    } else {
                        $param_sql .= "($key_param REGEXP '" . implode('|', $value_param) . "')";
                    }
                    $i_param++;
                }
            }
        }
        $sql = ($i_param > 0) ? "($param_sql)" : "";
        return $sql;
    }
    public function handleFormTable($sql_table = null, $items_page = 7)
    {
        global $db, $keywords, $page, $array_param_value, $sort, $array_param_value_id, $account_info, $sessison_account_warehouse;
        if (!empty($sql_table) && !empty($account_info)) {
            $where = '';
            $order_by = '';
            $array_option_param = [];
            // kiểm tra tài khoản
            $where = " and " . $this->getAccountParam()->sql;

            // kiểm tra id
            $param_id_sql = '';
            if (!empty($array_param_value_id)) {
                foreach ($array_param_value_id as $key_param_id => $value_param_id) {
                    if (!empty($value_param_id)) {
                        $param_id_sql .= ' and ';
                        $param_id_sql .= "$key_param_id=$value_param_id";
                    }
                }
                $where .= $param_id_sql;
            }
            // end

            // từ khóa
            $where_tmp_keywords = $this->getSqlWhereKeywords($keywords);
            if (!empty($where_tmp_keywords)) {
                $array_option_param[] = $where_tmp_keywords;
            }
            // end

            // checkbox phân loại
            $where_tmp_param = $this->getSqlWhereParam($array_param_value);
            if (!empty($where_tmp_param)) {
                $array_option_param[] =  $where_tmp_param;
            }
            // end
            if (!empty($array_option_param)) {
                $where .= ' and (';
                // total option sql
                foreach ($array_option_param as $key_option_sql => $item_option_sql) {
                    $where .= ($key_option_sql != 0) ? ' and ' : '';
                    $where .=  $item_option_sql;
                }
                $where .= ')';
            }

            // sắp xếp
            $order_by = $this->getSqlOrderBy($sort);

            // phân trang
            $count_data_table = $db->rawQueryOne("select COUNT(*) as count from #_" . $sql_table . " where 1 $where  and trash<>true", array());
            $total_page = intdiv($count_data_table['count'], $items_page);
            if ($count_data_table['count'] % $items_page) {
                $total_page += 1;
            }
            if (empty($page)) {
                $page = 1;
            }
            $limit_data = "limit " . ($items_page) * ($page - 1) . "," . $items_page;
            // end
            $data_table = $db->rawQuery("select * from #_" . $sql_table . " where 1 $where and trash<>true $order_by $limit_data  ", array());
            // html
            $html_table = $this->getTemplateLayoutsFor([
                'name_layouts' => 'form_warehouse_table',
                'data' => $data_table,
                'global' => ['jv0', 'url_warehouse_product'],
            ]);
            $paging = $this->getTemplateLayoutsFor([
                'name_layouts' => 'paging_warehouse',
                'total_page' => $total_page,
                'page' => $page,
            ]);
            // end
            $data_return = new stdClass();
            $data_return->table = $html_table;
            $data_return->paging = $paging;
            return $data_return;
        }
    }
    public function changeMoney($money = null, $lang = null)
    {
        switch ($lang) {
            case '':
            case 'vi':
                return $this->money($money, 'đ');
                break;

            default:
                return $this->money($money, ' đ');
                break;
        }
    }
    public function autoCreateTable($array_table = [["name_table" => "", "column" => []]])
    {
        global $db;
        $value_column_collate = "COLLATE utf8mb4_unicode_ci";
        $value_column_default = "DEFAULT NULL";
        $column_type_table = [
            "subkey" => [
                "type" => "INT(11)",
                "typedb" => "",
                "collate" => "",
                "default" => $value_column_default,
            ],
            "int" => [
                "type" => "INT(11)",
                "typedb" => "UNSIGNED",
                "collate" => "",
                "default" => $value_column_default,
            ],
            "bigint" => [
                "type" => "BIGINT",
                "typedb" => "UNSIGNED",
                "collate" => "",
                "default" => $value_column_default,
            ],
            "varchart(255)" => [
                "type" => "VARCHAR(255)",
                "typedb" => "",
                "collate" => $value_column_collate,
                "default" => $value_column_default,
            ],
            "varchart(50)" => [
                "type" => "VARCHAR(50)",
                "typedb" => "",
                "collate" => $value_column_collate,
                "default" => $value_column_default,
            ],
            "text" => [
                "type" => "TEXT",
                "typedb" => "",
                "collate" => $value_column_collate,
                "default" => $value_column_default,
            ],
            "mediumtext" => [
                "type" => "MEDIUMTEXT",
                "typedb" => "",
                "collate" => $value_column_collate,
                "default" => $value_column_default,
            ],
            "longtext" => [
                "type" => "LONGTEXT",
                "typedb" => "",
                "collate" => $value_column_collate,
                "default" => $value_column_default,
            ],
            "boolean" => [
                "type" => "BOOLEAN",
                "typedb" => "",
                "collate" => "",
                "default" => "",
            ],
        ];
        $column_table = [
            "id" => "INT(11) AUTO_INCREMENT PRIMARY KEY",
            "name" => $column_type_table["text"],
            "thumb" => $column_type_table["text"],
            "phone" => $column_type_table["varchart(255)"],
            "email" => $column_type_table["varchart(255)"],
            "password" => $column_type_table["varchart(255)"],
            "subdomain" => $column_type_table["text"],
            "token" => $column_type_table["text"],
            "city" => $column_type_table["int"],
            "district" => $column_type_table["int"],
            "address" => $column_type_table["varchart(255)"],
            "birthdate" => $column_type_table["int"],
            "profession" => $column_type_table["int"],
            "date_created" => $column_type_table["int"],
            "id_owner" => $column_type_table["int"],
            "code" => $column_type_table["varchart(255)"],
            "tax_code" => $column_type_table["varchart(255)"],
            "gender" => $column_type_table["int"],
            "photo" => $column_type_table["text"],
            "CCCD" => $column_type_table["varchart(255)"],
            "position" => $column_type_table["int"],
            "decentralization" => $column_type_table["mediumtext"],
            "history" => $column_type_table["longtext"],
            "salary_type" => $column_type_table["int"],
            "salary" => $column_type_table["int"],
            "status" => $column_type_table["int"],
            "content" => $column_type_table["mediumtext"],
            "kind" => $column_type_table["int"],
            "max_quantity" => $column_type_table["int"],
            "company" => $column_type_table["varchart(255)"],
            "goods_money" => $column_type_table["int"],
            "note" => $column_type_table["text"],
            "data_trashed" => $column_type_table["text"],
            "id_save" => $column_type_table["int"],
            "id_staff" => $column_type_table["int"],
            "receiver" => $column_type_table["varchart(255)"],
            "payer" => $column_type_table["varchart(255)"],
            "time_save" => $column_type_table["int"],
            "price" => $column_type_table["int"],
            "formality" => $column_type_table["int"],
            "corner_money" => $column_type_table["int"],
            "salary_paid" => $column_type_table["int"],
            "id_warehouse" => $column_type_table["int"],
            "id_supplier" => $column_type_table["int"],
            "barcode" => $column_type_table["varchart(50)"],
            "importer" => $column_type_table["varchart(255)"],
            "sale_price" => $column_type_table["int"],
            "total_price" => $column_type_table["int"],
            "total_quantity" => $column_type_table["int"],
            "status_importer" => $column_type_table["varchart(255)"],
            "id_exporter" => $column_type_table["int"],
            "status_exporter" => $column_type_table["varchart(255)"],
            "capital_price" => $column_type_table["int"],
            "calculation_unit" => $column_type_table["varchart(255)"],
            "heft" => $column_type_table["varchart(255)"],
            "size" => $column_type_table["varchart(255)"],
            "location" => $column_type_table["text"],
            "quantity" => $column_type_table["int"],
            "min_quantity" => $column_type_table["int"],
            "painted" => $column_type_table["varchart(255)"],
            "brand" => $column_type_table["varchart(255)"],
            "origin" => $column_type_table["varchart(255)"],
            "check_content" => $column_type_table["varchart(255)"],
            "id_customer" => $column_type_table["int"],
            "id_ship" => $column_type_table["int"],
            "total_amount" => $column_type_table["bigint"],
            "discount" => $column_type_table["int"],
            "ship" => $column_type_table["int"],
            "pay" => $column_type_table["int"],
            "id_bill" => $column_type_table["int"],
            "id_bill_goods" => $column_type_table["int"],
            "viewed" => $column_type_table["int"],
            "supplier" => $column_type_table["text"],
            "trash" => $column_type_table["boolean"],
            "date_trash" => $column_type_table["int"],
            "warehouse" => $column_type_table["text"],
            "id_product" => $column_type_table["int"],
            "expiration_date" => $column_type_table["int"],
            "id_check" => $column_type_table["int"],
            "id_tester" => $column_type_table["int"],
            "id_balancer" => $column_type_table["int"],
            "checker" => $column_type_table["varchart(255)"],
            "balanced_person" => $column_type_table["varchart(255)"],
            "check_date" => $column_type_table["int"],
            "balance_day" => $column_type_table["int"],
            "inventory" => $column_type_table["int"],
            "reality" => $column_type_table["int"],
            "deviation" => $column_type_table["int"],
            "price_deviation" => $column_type_table["int"],
            "import_date" => $column_type_table["int"],
            "id_importer" => $column_type_table["int"],
            "date_logged" => $column_type_table["int"],
        ];
        foreach ($array_table as $key_table => $value_table) {
            $sql_table = "";
            $check_table = $db->rawQueryOne("SHOW TABLES LIKE '" . $value_table['name_table'] . "';", array());
            array_unshift($value_table['column'], 'id');
            if (empty($check_table)) {
                // Thêm bảng nếu bảng chưa tồn tại
                $sql_table .= "CREATE TABLE " . $value_table['name_table'] . " (";
                foreach ($value_table['column'] as $column) {
                    if ($column == 'id') {
                        $sql_table .= $column . " " . $column_table[$column];
                    } else {
                        $sql_table .= $column . " " . $column_table[$column]['type'] . " " . $column_table[$column]['typedb'] . " " . $column_table[$column]['collate'] . " " . $column_table[$column]['default'];
                    }
                    if (end($value_table['column']) !== $column) {
                        $sql_table .= ", ";
                    };
                }
                $sql_table .= ");";
                $db->rawQueryOne($sql_table, array());
            } else {
                $table_show_column = $db->rawQuery("SHOW COLUMNS FROM " . $value_table['name_table'] . "", array());
                $table_show_key = $db->rawQueryOne("SHOW KEYS FROM " . $value_table['name_table'] . " WHERE Key_name = 'PRIMARY'", array());
                $resultArrayColumn = [];
                // kiểm tra khóa chính trong bảng
                if (!empty($table_show_key) && ($table_show_key["Column_name"] != 'id')) {
                    $db->rawQueryOne("ALTER TABLE " . $value_table['name_table'] . " DROP PRIMARY KEY;", array());
                    $db->rawQueryOne("ALTER TABLE " . $value_table['name_table'] . " MODIFY " . $table_show_key["Column_name"] . " " . $column_table[$table_show_key["Column_name"]]['type'] . " " . $column_table[$table_show_key["Column_name"]]['typedb'] . " " . $column_table[$table_show_key["Column_name"]]['collate'] . " " . $column_table[$table_show_key["Column_name"]]['default'] . ";", array());
                }
                // xóa các cột không có trong data mà có trong bảng
                // Đồng thời thêm tên các cột đó vào 1 bảng mới
                foreach ($table_show_column as $item) {
                    if (!in_array($item['Field'], $value_table['column'])) {
                        $db->rawQueryOne("ALTER TABLE " . $value_table['name_table'] . " DROP COLUMN " . $item['Field'] . ";", array());
                    } else {
                        if ($item['Field'] == 'id') {
                            $isInt = stripos($item['Type'], 'INT') !== false;
                            $isAutoIncrement = stripos($item['Extra'], 'AUTO_INCREMENT') !== false;
                            $isPrimaryKey = stripos($item['Key'], 'PRI') !== false;
                            if (!$isInt || !$isAutoIncrement) {
                                if (!$isPrimaryKey) {
                                    $db->rawQueryOne("ALTER TABLE " . $value_table['name_table'] . " DROP PRIMARY KEY;", array());
                                }
                                $db->rawQueryOne("ALTER TABLE " . $value_table['name_table'] . " MODIFY " . $item['Field'] . $column_table['id'] . ";", array());
                            }
                        } else {
                            if (stripos($item['Type'], $column_table[$item['Field']]['type']) === false) {

                                $db->rawQueryOne("ALTER TABLE " . $value_table['name_table'] . " MODIFY " . $item['Field'] . " " . $column_table[$item['Field']]['type'] . " " . $column_table[$item['Field']]['typedb'] . " " . $column_table[$item['Field']]['collate'] . " " . $column_table[$item['Field']]['default'] . ";", array());
                            }
                        }
                        $resultArrayColumn[] = $item['Field'];
                    }
                }
                // kiểm tra số lượng cột và sắp xếp theo thứ tự
                $total_column_check = count($value_table['column']);
                $total_column_search = count($resultArrayColumn);
                if ($total_column_check >= $total_column_search) {
                    if ($value_table['column'] !== $resultArrayColumn) {
                        $before_column = "";
                        for ($i = 0; $i < $total_column_check; $i++) {
                            $sql_table_detail = "";
                            $location_array_search = array_search($value_table['column'][$i], $resultArrayColumn);
                            if (in_array($value_table['column'][$i], $resultArrayColumn)) {
                                // cột có trong bảng
                                if ($i == 0 && ($resultArrayColumn[$i] != 'id')) {
                                    // đổi vị trí đầu trong bảng
                                    $sql_table_detail .= "ALTER TABLE " . $value_table['name_table'] . " CHANGE id id  INT AUTO_INCREMENT FIRST;";
                                    $db->rawQueryOne($sql_table_detail, array());
                                    // đổi vị trí đầu trong bảng
                                    $location_id_table = array_search('id', $resultArrayColumn);
                                    unset($resultArrayColumn[$location_id_table]);
                                    array_unshift($resultArrayColumn, 'id');
                                } else {
                                    if ($i != $location_array_search) {
                                        // đổi vị trí trong bảng
                                        $value_array_check = $resultArrayColumn[$i];
                                        $sql_table_detail .= "ALTER TABLE " . $value_table['name_table'] . " ";
                                        $sql_table_detail .= "CHANGE " . $value_table['column'][$i] . " " . $value_table['column'][$i] . " " . $column_table[$value_table['column'][$i]]['type'] . " ";
                                        $sql_table_detail .= "AFTER  "  . $before_column . ";";
                                        $db->rawQueryOne($sql_table_detail, array());
                                        // đổi vị trí trong mảng
                                        unset($resultArrayColumn[$location_array_search]);
                                        $resultArrayColumn_tmp = [];
                                        foreach ($resultArrayColumn as $nameColumn) {
                                            if ($before_column == $nameColumn) {
                                                $resultArrayColumn_tmp[] = $value_table['column'][$i];
                                            }
                                            $resultArrayColumn_tmp[] = $nameColumn;
                                        }
                                        $resultArrayColumn = $resultArrayColumn_tmp;
                                    }
                                }
                            } else {
                                // cột không có trong bảng
                                if ($i == 0 && ($resultArrayColumn[$i] != 'id')) {
                                    // thêm vị trí đầu trong bảng
                                    $sql_table_detail .= "ALTER TABLE " . $value_table['name_table'] . " ADD COLUMN id " . $column_table['id'] . " FIRST;";
                                    $db->rawQueryOne($sql_table_detail, array());
                                    // thêm vị trí đầu trong mảng
                                    $resultArrayColumn_tmp = [];
                                    foreach ($resultArrayColumn as $key_nameColumn => $nameColumn) {
                                        if ($key_nameColumn == 0) {
                                            $resultArrayColumn_tmp[] = 'id';
                                        }
                                        $resultArrayColumn_tmp[] = $nameColumn;
                                    }
                                    $resultArrayColumn = $resultArrayColumn_tmp;
                                } else {

                                    // thêm vị trí trong bảng
                                    $sql_table_detail .= "ALTER TABLE " . $value_table['name_table'] . " ";
                                    $sql_table_detail .= "ADD COLUMN " . $value_table['column'][$i] . " " . $column_table[$value_table['column'][$i]]['type'] . " " . $column_table[$value_table['column'][$i]]['typedb'] . " " . $column_table[$value_table['column'][$i]]['collate'] . " " . $column_table[$value_table['column'][$i]]['default'] . " ";
                                    $sql_table_detail .= "AFTER  "  . $before_column . ";";
                                    $db->rawQueryOne($sql_table_detail, array());
                                    // thêm vị trí trong mảng
                                    $resultArrayColumn_tmp = [];
                                    foreach ($resultArrayColumn as $nameColumn) {
                                        if ($before_column == $nameColumn) {
                                            $resultArrayColumn_tmp[] = $value_table['column'][$i];
                                        }
                                        $resultArrayColumn_tmp[] = $nameColumn;
                                    }
                                    $resultArrayColumn = $resultArrayColumn_tmp;
                                }
                            }
                            $before_column = $value_table['column'][$i];
                        }
                    }
                }
            }
        }
    }
}
