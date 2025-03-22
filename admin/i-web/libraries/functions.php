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
    public function formatMoney($value, $unit = '')
    {
        return number_format($value, 0, ',', '.') . " " . $unit;
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
    public function cleanInput($input = '', $_TYPE = '')
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

            if (!empty($_TYPE)) {
                unset($search[$_TYPE]);
            }

            $output = preg_replace($search, '', $input);
        }

        return $output;
    }
    /* Kiểm tra dữ liệu nhập vào */
    public function sanitize($input = '', $_TYPE = '')
    {
        if (is_array($input)) {
            foreach ($input as $var => $val) {
                $output[$var] = $this->sanitize($val, $_TYPE);
            }
        } else {
            $output  = $this->cleanInput($input, $_TYPE);
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
        global $_COM, $_SRC, $_TYPE, $_ACT;

        $data_default = [
            "com" => "",
            "src" => "",
            "type" => "",
        ];

        $infoCheck = array_merge($data_default, $dataCheck);

        foreach ($infoCheck as $key => $value) {
            if (!empty($value)) {
                switch ($key) {
                    case 'com':
                        if ($value != $_COM) {
                            return false;
                        }
                        break;
                    case 'src':
                        if ($value != $_SRC) {
                            return false;
                        }
                        break;
                    case 'type':
                        if ($value != $_TYPE) {
                            return false;
                        }
                        break;
                    default:
                        break;
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
        ];

        $infoParam = array_merge($data_default, $dataParam);
        $array_param_url = [];
        $url = "index.php?";
        foreach ($infoParam as $key => $value) {
            if (!empty($value)) {
                $array_param_url[$key] = htmlspecialchars($value);
            }
        }
        foreach ($array_param_url as $key => $value) {
            if ($key != 0) {
                $url .= "&";
            }
            $url .= $key . "=" . $value;
        }
        return $url;
    }
    public function getDataNumber($value)
    {
        return (int)preg_replace("/[^0-9]/", "",  htmlspecialchars($value));
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
    public function getSqlWhereKeywords($keywords = null, $list = array())
    {
        global $config;
        $sql = "";
        if (!empty($keywords)) {
            $specialChars = ['=', '+', '@', '#', '$', '^', '&', '*', '(', ')', ';', '\'', '"', '\\', ',', '.', '<', '>', '?', '/'];
            $keywords = str_replace($specialChars, ' ', $keywords);
            switch ($config['website']['search']) {
                case 2:
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
                    if (!empty($list)) {
                        $sql .= "(";
                        foreach ($list as $key => $value) {
                            if ($key != 0) {
                                $sql .= " or ";
                            }
                            $sql .= "($value REGEXP '$keywords_sql')";
                        }
                        $sql .= ")";
                    }
                    break;
                case 3:
                    $array_kw = explode(' ', $keywords);
                    $i_keywords = 0;
                    if (!empty($list)) {
                        $sql .= "(";
                        foreach ($list as $key => $value) {
                            if ($i_keywords != 0) {
                                $sql .= " or ";
                            }
                            foreach ($array_kw as $k_keywords => $v_keywords) {
                                if ($k_keywords != 0) {
                                    $sql .= " and ";
                                }
                                $sql .= "($value LIKE '%$v_keywords%')";
                                $i_keywords++;
                            }
                        }
                        $sql .= ")";
                    }
                    break;
                default:
                    if (!empty($list)) {
                        $sql .= "(";
                        foreach ($list as $key => $value) {
                            if ($key != 0) {
                                $sql .= " or ";
                            }
                            $sql .= "($value LIKE '%$keywords%')";
                        }
                        $sql .= ")";
                    }
                    break;
            }
        }
        return $sql;
    }
    public function handleParamDateSql()
    {
        global $_COM;
        global $_SRC;
        global $_ACT;
        global $array_param_value;

        $data_sql = "";
        $start_hour = ' 00:00:00';
        $end_hour = ' 23:59:59';

        $year = (!empty($array_param_value['year'])) ? htmlspecialchars($array_param_value['year']) : date('Y', time());

        switch ($this->getUrlParam(["com" => $_COM, "act" => $_ACT, "src" => $_SRC])) {
            case $this->getUrlParam(["com" => 'baocao', "act" => "man", "src" => "baocao"]):
                $month = (!empty($array_param_value['month'])) ? htmlspecialchars($array_param_value['month']) : date('m', time());

                $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                $time_start = strtotime($year . '-1-1' . $start_hour);
                $time_end = strtotime($year . '-12-' . $daysInMonth . $end_hour);

                $data_sql = "(date_reports>=$time_start and date_reports<=$time_end)";
                break;
            case $this->getUrlParam(["com" => 'ngansach', "act" => "man", "src" => "ngansach"]):
                $month = (!empty($array_param_value['month'])) ? htmlspecialchars($array_param_value['month']) : date('m', time());

                $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                $time_start = strtotime($year . '-' . $month . '-1' . $start_hour);
                $time_end = strtotime($year . '-' . $month . '-' . $daysInMonth . $end_hour);

                $data_sql = "(date>=$time_start and date<=$time_end)";
                break;
            case $this->getUrlParam(["com" => 'baocao', "act" => "man", "src" => "baocao"]):
                $time_start = strtotime($year . '-1-1' . $start_hour);
                $time_end = strtotime($year . '-12-31' . $end_hour);

                $data_sql = "(date_reports>=$time_start and date_reports<=$time_end)";
                break;
            default:
                break;
        }
        return $data_sql;
    }
    public function handleParamDefaultSql()
    {
        global $_COM;
        global $_SRC;
        global $_ACT;
        global $array_param_value;

        // param
        $i_param = 0;
        $param_sql = '';
        if (!empty($array_param_value)) {
            foreach ($array_param_value as $key_param => $value_param) {
                if (!empty($value_param)) {
                    if (in_array($key_param, ['keywords', 'status'])) {
                        $param_sql .= ($i_param != 0) ? ' and ' : '';
                    }
                    switch ($key_param) {
                        case 'keywords':
                            $param_sql .= $this->getSqlWhereKeywords($value_param, ["title"]);
                            $i_param++;
                            break;
                        case 'status':
                            switch ($this->getUrlParam(["com" => $_COM, "act" => $_ACT, "src" => $_SRC])) {
                                case $this->getUrlParam(["com" => 'ngansach', "act" => "man", "src" => "ngansach"]):
                                    $param_sql .= "loai=$value_param";
                                    $i_param++;
                                    break;
                                default:
                                    break;
                            }
                            break;
                        case 'loai':
                            $param_sql .= "loai=$value_param";
                            $i_param++;
                            break;
                        default:
                            break;
                    }
                }
            }
        }
        return ($i_param > 0) ? "($param_sql)" : "";
    }
    public function getDataList()
    {
        global $_COM;
        global $_SRC;
        global $_ACT;
        global $_TYPE;
        global $config;
        global $array_param_value;

        // where
        $array_option_param = [];
        $where = "";

        // sắp xếp
        switch ($this->getUrlParam(["com" => $_COM, "act" => $_ACT, "src" => $_SRC])) {
            case $this->getUrlParam(["com" => 'baiviet', "src" => $_SRC, "act" => "man",]):
                $array_option_param[] = " type='$_TYPE' ";
                $order_by_ds = "order by stt asc,id desc";
                break;
            case $this->getUrlParam(["com" => 'baocao', "act" => "man", "src" => "baocao"]):
                $array_option_param[] =  " type='$_TYPE' ";
                $order_by_ds = "order by date_reports desc,id desc";
                break;
            default:
                $order_by_ds = "order by id desc";
                break;
        }

        // kiểm tra ngày tháng
        $sql_param_date = $this->handleParamDateSql();
        if (!empty($sql_param_date)) {
            $array_option_param[] =  $sql_param_date;
        }

        // kiểm tra param default
        $sql_param_default = $this->handleParamDefaultSql();
        if (!empty($sql_param_default)) {
            $array_option_param[] =  $sql_param_default;
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

        // phân trang
        $per_page = 10;
        $countPer = ((!empty($array_param_value['page']) ? $array_param_value['page'] : 1) * $per_page);
        $startpoint =  $countPer - $per_page;
        $data = $this->_db->rawQuery("select * from table_$_SRC where 1 $where $order_by_ds limit $startpoint,$per_page");
        $total_data = $this->_db->rawQueryOne("select COUNT(*) as total from table_$_SRC where  1 $where", array());

        $list_data = new stdClass();
        $list_data->data = $data;
        $list_data->total = $total_data['total'];
        $list_data->startpoint = $startpoint;

        return $list_data;
    }
}
