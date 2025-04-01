<?php
ini_set('max_execution_time', 3000000);
require _lib . 'WebpConvert/vendor/autoload.php';

use WebPConvert\WebPConvert;

class cartFrontEnd
{

    private $d;
    private $table = 'baiviet';
    private $table_properties = 'attribute';
    private $name = 'cart';
    private $cookieName = '_CART_';
    private $cacheTime = 60 * 60;
    public function __construct($d)
    {
        $this->d = $d;
        $this->updateCartCookie();
    }

    public function addToCart($pid = null, $attribute = array(), $q = 1)
    {

        if ($pid < 1 or $q < 1) return;
        $code_attribute = null;
        foreach ($attribute as $k => $v) {
            if ($v == 0) {
                unset($attribute[$k]);
            } else {
                $code_attribute = $code_attribute . $v;
            }
        }

        $code = md5($pid . $code_attribute);
        if (is_array($_SESSION[$this->name])) {
            if ($this->productExists($code, $q)) return;
            $max = count($_SESSION[$this->name]);
            $_SESSION[$this->name][$max]['productid'] = $pid;
            $_SESSION[$this->name][$max]['qty'] = $q;
            $_SESSION[$this->name][$max]['attribute'] = (!empty($attribute)) ? $attribute : null;
            $_SESSION[$this->name][$max]['code'] = $code;
            $_SESSION[$this->name][$max]['checked'] = 1;
            return count($_SESSION[$this->name]);
        } else {
            $_SESSION[$this->name] = array();
            $_SESSION[$this->name][0]['productid'] = $pid;
            $_SESSION[$this->name][0]['qty'] = $q;
            $_SESSION[$this->name][0]['attribute'] = (!empty($attribute)) ? $attribute : null;
            $_SESSION[$this->name][0]['code'] = $code;
            $_SESSION[$this->name][0]['checked'] = 1;
            return count($_SESSION[$this->name]);
        }
    }
    public function updateCartCookie()
    {
        if (isset($_SESSION[$this->name])) {
            $this->_unsetCookie($this->cookieName);
            $jsonCart = $this->json_encode($_SESSION[$this->name]);
            if ($this->is_json($jsonCart)) {
                $this->_setCookie($this->cookieName, $jsonCart);
            }
        }
    }
    public function getCartCookie()
    {
        if (
            isset($_COOKIE[$this->cookieName])
            && !empty($_COOKIE[$this->cookieName])
            && empty($_SESSION[$this->name])
        ) {
            $jsonCart = $_COOKIE[$this->cookieName];
            if ($this->is_json($jsonCart)) {
                $decodeCart = $this->json_decode($jsonCart);
                foreach ($decodeCart as $k => $v) {
                    $_SESSION[$this->name][$k]['productid'] = $v['productid'];
                    $_SESSION[$this->name][$k]['qty'] = $v['qty'];
                    $_SESSION[$this->name][$k]['attribute'] = (!empty($v['attribute'])) ? $v['attribute'] : null;
                    $_SESSION[$this->name][$k]['code'] = $v['code'];
                    $_SESSION[$this->name][$k]['checked'] = $v['checked'];
                }
            }
        }
    }
    // $expiry 7 day = 7*24*60*60
    public function _setCookie($name = null, $value = null, $expiry = 7 * 86400, $path = '/', $domain = '', $secure = false, $httponly = false)
    {
        setcookie($name, $value, time() + $expiry, $path, $domain, $secure, $httponly);
    }
    public function _getCookie($name = null)
    {
        return (isset($_COOKIE[$name])) ? $_COOKIE[$name] : NULL;
    }
    public function _unsetCookie($name = null)
    {
        if (isset($_COOKIE[$name])) setcookie($name, "", -1, '/');
    }
    public function json_encode($data = null, $min = true, $header = false)
    {
        if ($header == true) {
            header('Content-Type: application/json; charset=utf-8');
        }
        $data = ($min === true) ? json_encode($data, JSON_UNESCAPED_UNICODE) : json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        return str_replace(['&#039;', '&quot;', '&amp;'], ['\'', '\"', '&'], $data);
    }
    public function json_decode($data = null)
    {
        return json_decode($data, true);
    }
    public function is_json($scheme = null)
    {
        if (is_null($scheme) or is_array($scheme)) {
            return false;
        }
        if ($this->json_decode($scheme)) {
            return true;
        }
        return false;
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
    public function transfer($msg, $page = "index.html")

    {
        $showtext = $msg;

        $page_transfer = $page;

        include(_template . "transfer_tpl.php");

        exit();
    }

    public function isAjax()
    {
        return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && (strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'));
    }
    public function getAttribute($pid = null, $field = null)
    {
        $sql = "select $field from #_" . $this->table_properties . " where id='" . $pid . "'";
        $row = $this->d->rawQueryOne($sql);
        return $row;
    }
    public function productExists($code = null, $q = null)
    {
        $max = count($_SESSION[$this->name]);
        $flag = 0;
        for ($i = 0; $i < $max; $i++) {
            if ($code == $_SESSION[$this->name][$i]['code']) {
                $_SESSION[$this->name][$i]['qty'] = $_SESSION[$this->name][$i]['qty'] + $q;
                $flag = 1;
                break;
            }
        }
        return $flag;
    }

    public function updateQuality($code = null, $q = null)
    {
        $max = count($_SESSION[$this->name]);
        $flag = 0;
        for ($i = 0; $i < $max; $i++) {
            if ($code == $_SESSION[$this->name][$i]['code']) {
                $_SESSION[$this->name][$i]['qty'] = $q;
                $flag = 1;
                break;
            }
        }
        return $flag;
    }
    public function updateAttributeCart($code = null, $id = null, $type = null)
    {
        $max = count($_SESSION[$this->name]);

        for ($i = 0; $i < $max; $i++) {
            if ($code == $_SESSION[$this->name][$i]['code']) {
                $_SESSION[$this->name][$i]['attribute'][$type] = $id;
                return true;
                break;
            }
        }
        return false;
    }
    public function convert_vn2latin($str)
    {
        // Mảng các ký tự tiếng việt không dấu theo mã unicode tổ hợp
        $tv_unicode_tohop  =
            ["à", "á", "ạ", "ả", "ã", "â", "ầ", "ấ", "ậ", "ẩ", "ẫ", "ă", "ằ", "ắ", "ặ", "ẳ", "ẵ", "è", "é", "ẹ", "ẻ", "ẽ", "ê", "ề", "ế", "ệ", "ể", "ễ", "ì", "í", "ị", "ỉ", "ĩ", "ò", "ó", "ọ", "ỏ", "õ", "ô", "ồ", "ố", "ộ", "ổ", "ỗ", "ơ", "ò", "ớ", "ợ", "ở", "õ", "ù", "ú", "ụ", "ủ", "ũ", "ư", "ừ", "ứ", "ự", "ử", "ữ", "ỳ", "ý", "ỵ", "ỷ", "ỹ", "đ", "À", "À", "Ạ", "Ả", "Ã", "Â", "Ầ", "Ấ", "Ậ", "Ẩ", "Ẫ", "Ă", "Ằ", "Ắ", "Ặ", "Ẳ", "Ẵ", "È", "É", "Ẹ", "Ẻ", "Ẽ", "Ê", "Ề", "Ế", "Ệ", "Ể", "Ễ", "Ì", "Í", "Ị", "Ỉ", "Ĩ", "Ò", "Ó", "Ọ", "Ỏ", "Õ", "Ô", "Ồ", "Ố", "Ộ", "Ổ", "Ỗ", "Ơ", "Ờ", "Ớ", "Ợ", "Ở", "Ỡ", "Ù", "Ú", "Ụ", "Ủ", "Ũ", "Ư", "Ừ", "Ứ", "Ự", "Ử", "Ữ", "Ỳ", "Ý", "Ỵ", "Ỷ", "Ỹ", "Đ"];
        // Mảng các ký tự tiếng việt không dấu theo mã unicode dựng sẵn   
        $tv_unicode_dungsan  =
            ["à", "á", "ạ", "ả", "ã", "â", "ầ", "ấ", "ậ", "ẩ", "ẫ", "ă", "ằ", "ắ", "ặ", "ẳ", "ẵ", "è", "é", "ẹ", "ẻ", "ẽ", "ê", "ề", "ế", "ệ", "ể", "ễ", "ì", "í", "ị", "ỉ", "ĩ", "ò", "ó", "ọ", "ỏ", "õ", "ô", "ồ", "ố", "ộ", "ổ", "ỗ", "ơ", "ờ", "ớ", "ợ", "ở", "ỡ", "ù", "ú", "ụ", "ủ", "ũ", "ư", "ừ", "ứ", "ự", "ử", "ữ", "ỳ", "ý", "ỵ", "ỷ", "ỹ", "đ", "À", "Á", "Ạ", "Ả", "Ã", "Â", "Ầ", "Ấ", "Ậ", "Ẩ", "Ẫ", "Ă", "Ằ", "Ắ", "Ặ", "Ẳ", "Ẵ", "È", "É", "Ẹ", "Ẻ", "Ẽ", "Ê", "Ề", "Ế", "Ệ", "Ể", "Ễ", "Ì", "Í", "Ị", "Ỉ", "Ĩ", "Ò", "Ó", "Ọ", "Ỏ", "Õ", "Ô", "Ồ", "Ố", "Ộ", "Ổ", "Ỗ", "Ơ", "Ờ", "Ớ", "Ợ", "Ở", "Ỡ", "Ù", "Ú", "Ụ", "Ủ", "Ũ", "Ư", "Ừ", "Ứ", "Ự", "Ử", "Ữ", "Ỳ", "Ý", "Ỵ", "Ỷ", "Ỹ", "Đ"];
        // Mảng các ký không dấu sẽ thay thế cho ký tự có dấu
        $tv_khongdau =
            ["a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "i", "i", "i", "i", "i", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "y", "y", "y", "y", "y", "d", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "E", "E", "E", "E", "E", "E", "E", "E", "E", "E", "E", "I", "I", "I", "I", "I", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "Y", "Y", "Y", "Y", "Y", "D"];

        $str = str_replace($tv_unicode_dungsan, $tv_khongdau, $str);
        $str = str_replace($tv_unicode_tohop,   $tv_khongdau, $str);
        return $str;
    }
    public function returnUnsignedName($name)
    {
        global $lang;

        $name = $this->convert_vn2latin($name);

        $name = str_replace([' ', ',', '.', '?', '!'], '-', $name);

        $name = strtolower($name);

        return $name;
    }
    public function changeMoney($money, $lang = null)
    {
        global $row_setting;
        switch ($lang) {
            case 'en':
                return round($money / $row_setting['dola'], 1) . ' $';
                break;
            case 'jp':
                return round(($money * 100) / $row_setting['yen'], 1) . ' ¥';
                break;
            default:
                return $this->money($money, ' đ');
                break;
        }
    }
    public function money($dola, $currency = '')
    {
        return number_format($dola, 0, ',', '.') . $currency;
    }
    public function arrangeAttributeCart($code = null)
    {
        global $func;

        $max = count($_SESSION[$this->name]);

        $array_arrange = array();
        for ($i = 0; $i < $max; $i++) {
            if ($code == $_SESSION[$this->name][$i]['code']) {
                $options_product = $this->d->rawQueryOne("select options from #_baiviet where id=?", array($_SESSION[$this->name][$i]['productid']));

                if (!empty($options_product['options'])) {
                    $options_product = json_decode($options_product['options'], true);
                } else {
                    $options_product = [];
                }
                foreach ($options_product['attribute'] as  $v_t) {
                    $type = $this->returnUnsignedName($v_t);
                    if (!empty($type) && (array_key_exists($type, $_SESSION[$this->name][$i]['attribute']))) {
                        array_push($array_arrange[$type], 0);
                    };
                };

                $array_arrange = array_merge($array_arrange, $_SESSION[$this->name][$i]['attribute']);

                $_SESSION[$this->name][$i]['attribute'] = $array_arrange;
            }
        }

        $array_return = [
            'options' => $options_product,
            'session' => $array_arrange,
        ];
        return $array_return;
    }
    public function removeProduct($code)
    {
        $max = count($_SESSION[$this->name]);
        for ($i = 0; $i < $max; $i++) {
            if ($code == $_SESSION[$this->name][$i]['code']) {
                unset($_SESSION[$this->name][$i]);
                break;
            }
        }
        $_SESSION[$this->name] = array_values($_SESSION[$this->name]);
        $this->updateCartCookie();
    }
    public function getTotalQuality()
    {
        $sum = 0;
        if (!empty($_SESSION[$this->name])) {
            $max = count($_SESSION[$this->name]);
            for ($i = 0; $i < $max; $i++) {
                $q = $_SESSION[$this->name][$i]['qty'];
                $sum += $q;
            }
            if ($sum > 99) {
                $sum = "99+";
            }
        }
        return $sum;
    }
    public function getTotalQualityChecked()
    {
        $sum = 0;
        if (!empty($_SESSION[$this->name])) {
            $max = count($_SESSION[$this->name]);
            for ($i = 0; $i < $max; $i++) {
                if ($_SESSION[$this->name][$i]['checked'] == 1) {
                    $q = $_SESSION[$this->name][$i]['qty'];
                    $sum += $q;
                }
            }
            if ($sum > 99) {
                $sum = "99+";
            }
        }
        return $sum;
    }
    public function getPrice($pid = null, $attribute = null, $old_price = false)
    {
        global $config;

        $current_time = time();
        $flash_sale = $this->d->rawQueryOne("select id,id_product, time_start, time_end from #_flashsale where hienthi=1 and time_start<={$current_time} and time_end>={$current_time} limit 1", array());
        if (!empty($pid) && !empty($flash_sale['id_product']) && in_array($pid, explode(',', $flash_sale['id_product']))) {
            $name_price = "giabansale";
        } else if ($old_price) {
            $name_price = "giacu";
        } else {
            $name_price = "giaban";
        }

        if (!empty($attribute)) {

            $total_attribute = count($attribute);
            $total_tmp = 0;
            $total_price = 0;
            foreach ($attribute as $k => $v) {

                if ($config['cart']['price_attribute']['total_price']) {
                    $sql_attribute = "select $name_price from #_attribute where id='" .  $v . "'";
                    $row_attribute = $this->d->rawQueryOne($sql_attribute);
                    $total_price +=  $row_attribute[$name_price];
                } else {
                    if ($total_tmp == ($total_attribute - 1)) {
                        $sql = "select $name_price from #_attribute where id='" .  $v . "'";
                        $total_tmp = 0;
                        break;
                    }
                }

                $total_tmp++;
            }
        } else {
            if (!($config['cart']['price_attribute']['total_price'])) {
                $sql = "select $name_price from #_" . $this->table . " where id='" . $pid . "'";
            }
        }

        if ($config['cart']['price_attribute']['total_price']) {
            $sql = "select $name_price from #_" . $this->table . " where id='" . $pid . "'";
            $row = $this->d->rawQueryOne($sql);
            $total_price +=  $row[$name_price];
            $price = $total_price;
        } else {
            $row = $this->d->rawQueryOne($sql);
            $price = $row[$name_price];
        }

        return $price;
    }
    public function getUrl($v)
    {
        global $config, $lang;
        $str = '';
        if ($config['lang_check']) $str .= $lang . '/';
        $alias = isset($v['tenkhongdau_' . $lang]) ? $v['tenkhongdau_' . $lang] : $v['tenkhongdau'];
        return $str . $alias;
    }

    public function getType($type)
    {
        global $config, $lang, $translate;
        $result = ($config['lang_check']) ? $lang . '/' . $translate[$lang][$type] : $type;
        return $result;
    }
    public function randString($sokytu)
    {

        $chuoi = "ABCDEFGHIJKLMNOPQRSTUVWXYZW0123456789";

        $giatri = "";
        for ($i = 0; $i < $sokytu; $i++) {

            $vitri = mt_rand(0, strlen($chuoi));

            $giatri = $giatri . substr($chuoi, $vitri, 1);
        }

        return $giatri;
    }
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
    public function getInfoDetail($cols = '', $table = '', $id = 0)
    {
        $row = array();
        if (!empty($cols) && !empty($table) && !empty($id)) {
            $row = $this->d->rawQueryOne("select $cols from #_$table where id = ? limit 0,1", array($id));
        }
        return $row;
    }
    public function getFieldOne($field, $table, $id)
    {

        $row = $this->d->rawQueryOne("select $field from #_$table where id=?", array($id));

        return $row[$field];
    }
    public function isEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }
    public function redirect($url = '')
    {

        echo '<script language="javascript">window.location = "' . $url . '" </script>';

        exit();
    }
    /* Kiểm tra dữ liệu nhập vào */
    public function cleanInput($input = '', $type = '')
    {
        $output = '';

        if ($input != '') {
            /*
                        // Loại bỏ HTML tags
                        '@<[\/\!]*?[^<>]*?>@si',
                    */

            $search = array(
                'script' => '@<script[^>]*?>.*?</script>@si',
                'style' => '@<style[^>]*?>.*?</style>@siU',
                'blank' => '@<![\s\S]*?--[ \t\n\r]*>@',
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
    public function getTotalOrder_tmp()
    {
        $max = !empty($_SESSION[$this->name]) ? count($_SESSION[$this->name]) : 0;
        $sum = 0;
        for ($i = 0; $i < $max; $i++) {
            if ($_SESSION[$this->name][$i]['checked'] == 1) {
                $pid = $_SESSION[$this->name][$i]['productid'];
                $code = $_SESSION[$this->name][$i]['code'];
                $q = $_SESSION[$this->name][$i]['qty'];
                $priceTotal = $this->getPrice($pid, $_SESSION[$this->name][$i]['attribute']);
                $sum += $priceTotal * $q;
            }
        }
        return $sum;
    }
    public function getTotalOrder()
    {
        global $config;

        $sum = $this->getTotalOrder_tmp();

        if ((!empty($_SESSION['coupons'])) && (($config['coupon_cart']) == true)) {
            $coupon_item = $this->d->rawQueryOne("select * from #_coupons where code=?  ", array($_SESSION['coupons']));
            if (!empty($coupon_item)) {
                switch ($coupon_item['ispercent']) {
                    case 1:
                        $sum = ($sum * (1 - ($coupon_item['percents'] / 100)));
                        break;
                    case 0:
                        $sum = $sum - $coupon_item['price'];
                        break;
                    default:
                };
            };
            if ($sum < 0) {
                $sum = 0;
            }
        };
        return $sum;
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

            $startHref = "<a href='" . $info['href'] . "' " . $info['classfix'] . " " . $info['target'] . " role='" . $info['role'] . "' rel='" . $info['rel'] . "' title='" . $info['alt'] . "' " . $info['data'] . " style='aspect-ratio:$width/$height;max-width:" . $width . "px;display: inline-flex;justify-items: center;align-items: center;line-height: 0;$style' > ";

            $endHref = "</a>";
        } else {
            $startHref = "<div  " . $info['classfix'] . " style='aspect-ratio:$width/$height;max-width:" . $width . "px;display: inline-flex;justify-items: center;align-items: center;line-height: 0;$style' > " . $info['data'] . "";

            $endHref = "</div>";
        }

        /* Image */
        $result = "{$startHref}<img width='{$width}' height='{$height}' " . $info['class'] . " " . $info['id'] . " onerror=\"this.src=" . $info['pathError'] . "\" " . $info['src'] . " alt='" . $info['alt'] . "'/>{$endHref}";

        return $result;
    }
    public function getAttributeField($pid, $field)
    {
        $sql = "select $field from #_" . $this->table_properties . " where id='" . $pid . "'";
        $row = $this->d->rawQueryOne($sql);
        return $row[$field];
    }

    public function getProduct($pid)
    {
        $sql = "select * from #_" . $this->table . " where id='" . $pid . "'";
        $row = $this->d->rawQueryOne($sql);
        return $row;
    }
    public function getProductName($pid, $field)
    {
        $sql = "select $field from #_" . $this->table . " where id='" . $pid . "'";
        $row = $this->d->rawQueryOne($sql);
        return $row[$field];
    }
    public function getPropertiesName($pid, $field)
    {
        $sql = "select $field from #_" . $this->table_properties . " where id='" . $pid . "'";
        $row = $this->d->rawQueryOne($sql);
        return $row[$field];
    }
    public function getAlias($pid, $table, $type)
    {
        global $lang;
        $item = $this->d->rawQueryOne("select tenkhongdau_$lang as alias from #_$table where hienthi=1 and id=? and type=? limit 1", array($pid, $type));
        return !empty($item) ? $item['alias'] : 'catalogy';
    }
    public function getPrice_All($result = array())
    {
        global $lang;
        $result['total-product'] = $this->getTotalQuality();
        $result['total-product-checked'] = $this->getTotalQualityChecked();
        $result['price-string'] = $this->numbMoney($this->getTotalOrder(), ' ₫');
        $result['price-string-tmp'] = $this->numbMoney($this->getTotalOrder_tmp(), ' ₫');
        $result['price-string-coupons'] = $this->numbMoney($this->getTotalOrder_tmp() - $this->getTotalOrder(), ' ₫');
        return $result;
    }
    public function getCart()
    {

        $result['cart'] = $this->checkArrayChecked($_SESSION['cart']);
        $result['count-cart'] = !empty($result['cart']) ? count($result['cart']) : 0;
        $result['total-price'] = $this->getTotalOrder();
        $result['total-product'] = $this->getTotalQuality();
        $result['total-product-checked'] = $this->getTotalQualityChecked();

        return $result;
    }

    public function checkArrayChecked($input_data)
    {
        global $src;
        $output_data = [];
        switch ($src) {
            case 'gio-hang':
                $output_data = $input_data;
                break;
            case 'thanh-toan':
                foreach ($input_data as $k => $v) {
                    if ($v['checked'] === 1) {
                        array_push($output_data, $v);
                    }
                }
                break;

            case 'thanh-cong':
                break;

            default:
                break;
        }
        return $output_data;
    }
    public function numbMoney($val, $car = 'đ')
    {
        return number_format($val, 0, ',', '.') . '' . $car;
    }
    public function checkedPaymentCart($code, $key, $status)
    {

        $strMsg = "";

        if ($_SESSION[$this->name][$key]['code'] == $code) {

            if ($status == "on") {

                $_SESSION[$this->name][$key]["check_payment"] = 1;

                $strMsg = $status;
            } else {

                unset($_SESSION[$this->name][$key]["check_payment"]);

                $strMsg = $status;
            }
        }

        return $strMsg;
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
    public function getTemplateLayoutsFor($data = array())
    {
        global $config;
        $defaults = [
            'name_layouts' => '',
            'data' => '',
            'save_cache' => true,
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
    public function getTemplate($templateName, $data = [], $isCache = false)
    {
        echo $this->getTemplateContent($templateName, $data, $isCache);
    }
    public function getCacheFilePath($key)
    {
        return _basename . 'iweb@cache' . '/cache_' . md5($key);
    }
    public function getTemplateContent($templateName, $data = [])
    {
        global $config;
        global $com;
        global $lang;
        global $db;
        global $jv0;
        global $func;

        if ($data !== null) extract($data);
        ob_start();
        include $templateName . ".php";
        $htmlContent = ob_get_clean();

        return $htmlContent;
    }
    public function getValueCart($value)
    {
        global $lang;
        $id = $value['productid'];
        $qty = $value['qty'];
        $code = $value['code'];
        $checked = $value['checked'];
        $attribute = $value['attribute'];
        $price = $this->getPrice($id, $attribute);
        $name = $this->getProductName($id, 'ten_' . $lang);
        $info_product =  $this->d->rawQueryOne("select *,ten_$lang as ten,tenkhongdau_$lang as tenkhongdau from #_baiviet where id=?", array($id));
        $price_old = $info_product['giacu'];
        if (!empty($info_product['options'])) {
            $options_product = json_decode($info_product['options'], true);
        } else {
            $options_product = [];
        }
        $result = new stdClass();
        $result->id = $id;
        $result->qty = $qty;
        $result->code = $code;
        $result->checked = $checked;
        $result->attribute = $attribute;
        $result->price = $price;
        $result->price_old = $price_old;
        $result->name = $name;
        $result->info_product = $info_product;
        $result->options_product = $options_product;
        return $result;
    }
}
