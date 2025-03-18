<?php
class functions
{
    private $_db;
    public function __construct($db)
    {
        $this->_db = $db;
    }
    public function redirect($url = '')
    {
        echo '<script language="javascript">window.location = "' . $url . '" </script>';
        exit();
    }
    public function getClientIpServer()
    {

        $ipaddress = '';

        if ($_SERVER['HTTP_CLIENT_IP'])
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if ($_SERVER['HTTP_X_FORWARDED_FOR'])
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if ($_SERVER['HTTP_X_FORWARDED'])
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if ($_SERVER['HTTP_FORWARDED_FOR'])
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if ($_SERVER['HTTP_FORWARDED'])
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if ($_SERVER['REMOTE_ADDR'])
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
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
    public function isAjax()
    {
        return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && (strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'));
    }
    public function encryptPassword($secret, $str, $salt)
    {
        return md5(sha1($secret . $str . $salt));
    }
    public function checkLeftMenu($dataCheck = array())
    {
        global $com, $src, $type, $act;

        $data_default = [
            "com" => "",
            "src" => "",
            "act" => "",
            "type" => "",
        ];

        $infoCheck = array_merge($data_default, $dataCheck);

        foreach ($infoCheck as $key => $value) {
            if (!empty($value)) {
                if ($value != $$key) {
                    return false;
                }
            }
        }

        return true;
    }
    public function getUrlParam($dataParam = array())
    {
        $data_default = [
            "com" => "",
            "src" => "",
            "act" => "",
            "type" => "",
            "id" => "",
        ];

        $infoParam = array_merge($data_default, $dataParam);
        $url = "index.php?";
        $array_param_url = [];

        if (!empty($infoParam['com'])) {
            $array_param_url['com'] = $infoParam['com'];
        }
        if (!empty($infoParam['src'])) {
            $array_param_url['src'] = $infoParam['src'];
        }
        if (!empty($infoParam['act'])) {
            $array_param_url['act'] = $infoParam['act'];
        }
        if (!empty($infoParam['type'])) {
            $array_param_url['type'] = $infoParam['type'];
        }
        if (!empty($infoParam['id'])) {
            $array_param_url['id'] = $infoParam['id'];
        }
        $int_check = 0;
        foreach ($array_param_url as $key => $value) {
            if ($int_check != 0) {
                $url .= "&";
            }
            $url .= $key . "=" . $value;
            $int_check++;
        }
        return $url;
    }
    public function getActParam($text_act = null)
    {
        global $act;
        if (str_contains($act, "list")) {
            $data_return = $text_act . "_list";
        } elseif (str_contains($act, "cat")) {
            $data_return = $text_act . "_cat";
        } elseif (str_contains($act, "item")) {
            $data_return = $text_act . "_item";
        } elseif (str_contains($act, "sub")) {
            $data_return = $text_act . "_sub";
        } else {
            $data_return = $text_act;
        }
        return $data_return;
    }
    public function addHrefImg($data = array())
    {
        global $config, $https_config;

        /* Defaults */
        $defaults = [
            'class' => '',
            'classfix' => '',
            'id' => '',
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
            'actual_width' => 0,
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
        if ((int)$info['actual_width'] > 0) {
            $height = (((int)$height * (int)$info['actual_width']) / (int)$width);
            $width = (int)$info['actual_width'];
            $info['sizes'] = (int)$width . "x" . (int)$height . "x" . (int)$zoom;
        }
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
        $urlImagesTmp = $info['upload'] . $info['image'];

        /* Path src */
        if (!empty($info['url'])) {
            $urlImages = $info['url'];
        } else {
            if (!empty($info['size-src'])) {
                $info['pathSize'] = $info['size-src'] . "/" . $urlImagesTmp;
                $urlImages = $https_config . $info['pathSize'];
            } else {
                $urlImages = $https_config . $urlImagesTmp;
            }
        }

        /* Path error */
        $urlImagesError =  $info['upload-error'] . $info['image-error'];

        /* target */
        $info['target'] = (!empty($info['target'])) ? "target='" . $info['target'] . "'" : "";

        /* Class */
        $info['class'] = ($info['isLazy']) ? $info['class'] . ' lazy ' : $info['class'];
        $info['class'] = (!empty($info['class'])) ? "class='" . $info['class'] . "'" : "";
        $info['classfix'] =  "class='load_website " . $info['classfix'] . "'";

        /* Id */
        $info['id'] = (!empty($info['id'])) ? "id='" . $info['id'] . "'" : "";

        /* Check to convert Webp */
        $info['hasURL'] = false;

        if (filter_var(str_replace($https_config, "", $urlImages), FILTER_VALIDATE_URL)) {
            $info['hasURL'] = true;
        }

        if ($config['website']['image']['hasWebp']) {
            if (!$info['sizes']) {
                if (!$info['hasURL']) {
                    $this->converWebp($urlImages);
                }
            }
            if (!$info['hasURL']) {
                $urlImages .= '.webp';
            }
        }

        /* Src */
        if (file_exists($urlImages)) {
            $info['src'] =  "src='" . $urlImages . "'";
        } else {
            $info['src'] =  "src='" . $urlImagesError . "'";
        }

        /* add ahref */
        if ($info['addhref']) {
            $startHref = "<a href='" . $info['href'] . "' " . $info['classfix'] . " " . $info['target'] . " role='" . $info['role'] . "' rel='" . $info['rel'] . "' title='" . $info['alt'] . "' " . $info['data'] . " style='width: 100%;aspect-ratio:$width/$height;max-width:" . $width . "px;display: inline-flex;justify-items: center;align-items: center;line-height: 0;position: relative;' > ";
            $endHref = "</a>";
        } else {
            $startHref = "<div  " . $info['classfix'] . " style='width: 100%;aspect-ratio:$width/$height;max-width:" . $width . "px;display: inline-flex;justify-items: center;align-items: center;line-height: 0;position: relative;' > " . $info['data'] . "";
            $endHref = "</div>";
        }

        /* Image */
        $result = "{$startHref}<img width='{$width}' height='{$height}' " . $info['class'] . " " . $info['id'] . "  " . $info['src'] . " alt='" . $info['alt'] . "' style='position: absolute;  top: 50%;left: 50%;transform: translate(-50%, -50%);width: 100%;height: 100%;$style'/>{$endHref}";

        return $result;
    }
    public function getInfoAccount()
    {
        $data_info = new stdClass();
        $dataAccount = $this->_db->rawQueryOne("select * from #_user where id=? limit 0,1", array($_SESSION['login']));

        $data_info->id = $_SESSION['login'];
        $data_info->username = $dataAccount['username'];
        $data_info->password = $dataAccount['password'];
        $data_info->ten = $dataAccount['ten'];
        $data_info->dienthoai = $dataAccount['dienthoai'];
        $data_info->email = $dataAccount['email'];
        $data_info->diachi = $dataAccount['diachi'];
        $data_info->quyen = $dataAccount['quyen'];
        $data_info->role = $dataAccount['role'];
        $data_info->avatar = $dataAccount['avatar'];
        $data_info->ngaytao = $dataAccount['ngaytao'];
        $data_info->user_token = $dataAccount['user_token'];
        $data_info->permission = $dataAccount['permission'];

        return $data_info;
    }
}
