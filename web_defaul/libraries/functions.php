<?php
require _lib . 'WebpConvert/vendor/autoload.php';

use WebPConvert\WebPConvert;

class functions
{
    private $_d;
    private $_loginadmin = 'login';
    public function __construct($db)
    {
        $this->_d = $db;
    }
    public function money($dola, $currency = '')
    {
        return number_format($dola, 0, ',', '.') . $currency;
    }
    // $expiry 7 day = 7*24*60*60
    function _setCookie($name, $value, $expiry = 7 * 86400, $path = '/', $domain = '', $secure = false, $httponly = false)
    {
        setcookie($name, $value, time() + $expiry, $path, $domain, $secure, $httponly);
    }
    function _getCookie($name)
    {
        return (isset($_COOKIE[$name])) ? $_COOKIE[$name] : NULL;
    }
    function _unsetCookie($name)
    {
        if (isset($_COOKIE[$name])) setcookie($name, "", -1, '/');
    }
    public function json_encode($data, $min = true, $header = false)
    {
        if ($header == true) {
            header('Content-Type: application/json; charset=utf-8');
        }
        $data = ($min === true) ? json_encode($data, JSON_UNESCAPED_UNICODE) : json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        return str_replace(['&#039;', '&quot;', '&amp;'], ['\'', '\"', '&'], $data);
    }
    public function json_decode($data)
    {
        return json_decode($data, true);
    }
    public function is_json($scheme)
    {
        if (is_null($scheme) or is_array($scheme)) {
            return false;
        }
        if ($this->json_decode($scheme)) {
            return true;
        }
        return false;
    }
    function base64url_encode($plainText)
    {
        $base64 = base64_encode($plainText);
        $base64url = strtr($base64, '+/=', '-_,');
        return $base64url;
    }
    function base64url_decode($plainText)
    {
        $base64url = strtr($plainText, '-_,', '+/=');
        $base64 = base64_decode($base64url);
        return $base64;
    }
    public function encode_aes($value = false)
    {
        if (!$value) return false;
        $iv_size = openssl_cipher_iv_length('aes-256-cbc');
        $iv = openssl_random_pseudo_bytes($iv_size);
        $crypttext = openssl_encrypt($value, 'aes-256-cbc', SALT, OPENSSL_RAW_DATA, $iv);
        return $this->base64url_encode($iv . $crypttext);
    }
    public function decode_aes($value = false)
    {
        if (!$value) return false;
        $crypttext = $this->base64url_decode($value);
        $iv_size = openssl_cipher_iv_length('aes-256-cbc');
        $iv = substr($crypttext, 0, $iv_size);
        $crypttext = substr($crypttext, $iv_size);
        if (!$crypttext) return false;
        $decrypttext = openssl_decrypt($crypttext, 'aes-256-cbc', SALT, OPENSSL_RAW_DATA, $iv);
        return rtrim($decrypttext);
    }
    public function print_pre($data)
    {
        if ($this->is_json($data)) {
            $data = $this->json_encode($this->json_decode($data));
        }
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }
    public function getOrderByTypeFor($type)
    {
        global $optionsSetting;

        $orderby = '';
        if (isset($optionsSetting['listType']) && in_array($type, $optionsSetting['listType'])) {
            $orderby = $optionsSetting['sort'];
        } else {
            $orderby = 'order by stt asc,id desc';
        }

        return $orderby;
    }
    public function getPagingByComFor($com)
    {
        global $optionsSetting;

        return !empty($optionsSetting['paging'][$com]) ? $optionsSetting['paging'][$com] : 100;
    }
    public function buildSchemaProduct($id_pro, $name, $image, $description, $code_pro, $name_brand, $name_author, $url, $price)
    {
        $str = '{';
        $str .= '"@context": "https://schema.org/",';
        $str .= '"@type": "Product",';
        $str .= '"name": "' . $name . '",';
        $str .= '"image":';
        $str .= '[';
        $str .= '"' . $image . '"';
        $str .= '],';
        $str .= '"description": "' . $description . '",';
        $str .= '"sku":"SP0' . $id_pro . '",';
        $str .= '"mpn": "' . $code_pro . '",';
        $str .= '"brand":';
        $str .= '{';
        $str .= '"@type": "Brand",';
        $str .= '"name": "' . $name_brand . '"';
        $str .= '},';
        $str .= '"review":';
        $str .= '{';
        $str .= '"@type": "Review",';
        $str .= '"reviewRating":';
        $str .= '{';
        $str .= '"@type": "Rating",';
        $str .= '"ratingValue": "5",';
        $str .= '"bestRating": "5"';
        $str .= '},';
        $str .= '"author":';
        $str .= '{';
        $str .= '"@type": "Person",';
        $str .= '"name": "' . $name_author . '"';
        $str .= '}';
        $str .= '},';
        $str .= '"aggregateRating":';
        $str .= '{';
        $str .= '"@type": "AggregateRating",';
        $str .= '"ratingValue": "4.4",';
        $str .= '"reviewCount": "89"';
        $str .= '},';
        $str .= '"offers":';
        $str .= '{';
        $str .= '"@type": "Offer",';
        $str .= '"url": "' . $url . '",';
        $str .= '"priceCurrency": "VND",';
        $str .= '"priceValidUntil": "2099-11-20",';
        $str .= '"price": "' . $price . '",';
        $str .= '"itemCondition": "https://schema.org/UsedCondition",';
        $str .= '"availability": "https://schema.org/InStock"';
        $str .= '}';
        $str .= '}';
        $str = json_encode(json_decode($str), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        return $str;
    }
    /* Build Schema */
    public function buildSchemaArticle($id_news, $name, $image, $ngaytao, $ngaysua, $name_author, $url, $logo, $url_author)
    {
        $str = '{';
        $str .= '"@context": "https://schema.org",';
        $str .= '"@type": "NewsArticle",';
        $str .= '"mainEntityOfPage": ';
        $str .= '{';
        $str .= '"@type": "WebPage",';
        $str .= '"@id": "' . $url . '"';
        $str .= '},';
        $str .= '"headline": "' . $name . '",';
        $str .= '"image":"' . $image . '",';
        $str .= '"datePublished": "' . date('c', $ngaytao) . '",';
        $str .= '"dateModified": "' . date('c', $ngaysua) . '",';
        $str .= '"author":';
        $str .= '{';
        $str .= '"@type": "Person",';
        $str .= '"name": "' . $name_author . '",';
        $str .= '"url": "' . $url_author . '"';
        $str .= '},';
        $str .= '"publisher": ';
        $str .= '{';
        $str .= '"@type": "Organization",';
        $str .= '"name": "' . $name_author . '",';
        $str .= '"logo": ';
        $str .= '{';
        $str .= '"@type": "ImageObject",';
        $str .= '"url": "' . $logo . '"';
        $str .= '}';
        $str .= '}';
        $str .= '}';

        $str = json_encode(json_decode($str), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        return $str;
    }
    public function markdown($path = '', $params = array())
    {
        $content = '';
        if (!empty($path)) {
            ob_start();
            include _lib . "/sample/mail/" . $path . ".php";
            $content = ob_get_contents();
            ob_clean();
        }

        return $content;
    }

    public function getPercentRating($numb = 5)
    {

        if ($numb <= 0) {
            $numb = 1;
        }
        return $numb * 20 . '%';
    }
    public function addDivContentTable($content, $class = "table-responsive")
    {
        if (empty($content)) return;
        $content = preg_replace('/<table/', '<div class="' . $class . '"><table', $content);
        $content = preg_replace('/<\/table>/', '</table></div>', $content);
        return $content;
    }
    public function htmlDecodeContent($content)
    {
        return $this->addDivContentTable(htmlspecialchars_decode($content ?: ''));
    }
    public function getInfoDetail($cols = '', $table = '', $id = 0)
    {
        $row = array();
        if (!empty($cols) && !empty($table) && !empty($id)) {
            $row = $this->_d->rawQueryOne("select $cols from #_$table where id = ? limit 0,1", array($id));
        }
        return $row;
    }

    public function getNameLang($args = array())
    {

        global $lang;

        $title = "";

        if (is_array($args)) {

            $title = !empty($args["ten_$lang"]) ? $args["ten_$lang"] : $args["ten"];
        }

        return $title;
    }

    public function getPriceFor($v = array(), $field = 'giaban')
    {

        global $lang;

        $str = '';

        if (is_array($v)) {

            $str .= ($v[$field] != 0) ? $this->changeMoney($v[$field], $lang) : _lienhe;
        }

        return $str;
    }



    function uuid()
    {
        return sprintf(
            '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff)
        );
    }
    function is_uuid($uuid)
    {
        if (!is_string($uuid)) {
            return false;
        }
        $regex = '/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/';
        return (bool) preg_match($regex, $uuid);
    }

    /* Parse phone */
    public function parsePhone($number)
    {
        return (!empty($number)) ? preg_replace('/[^0-9]/', '', $number) : '';
    }

    /* Check letters and nums */
    public function isAlphaNum($str)
    {
        if (preg_match('/^[a-z0-9]+$/', $str)) {
            return true;
        } else {
            return false;
        }
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

    public function isEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }
    /* Is match */
    public function isMatch($value1, $value2)
    {
        if ($value1 == $value2) {
            return true;
        } else {
            return false;
        }
    }

    /* Is decimal */
    public function isDecimal($number)
    {
        if (preg_match('/^\d{1,10}(\.\d{1,4})?$/', $number)) {
            return true;
        } else {
            return false;
        }
    }

    /* Is coordinates */
    public function isCoords($str)
    {
        if (preg_match('/^[-+]?([1-8]?\d(\.\d+)?|90(\.0+)?),\s*[-+]?(180(\.0+)?|((1[0-7]\d)|([1-9]?\d))(\.\d+)?)$/', $str)) {
            return true;
        } else {
            return false;
        }
    }

    /* Is url */
    public function isUrl($str)
    {
        if (preg_match('/^(https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|www\.[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9]+\.[^\s]{2,}|www\.[a-zA-Z0-9]+\.[^\s]{2,})/', $str)) {
            return true;
        } else {
            return false;
        }
    }

    /* Is url youtube */
    public function isYoutube($str)
    {
        if (preg_match('/https?:\/\/(?:[a-zA_Z]{2,3}.)?(?:youtube\.com\/watch\?)((?:[\w\d\-\_\=]+&amp;(?:amp;)?)*v(?:&lt;[A-Z]+&gt;)?=([0-9a-zA-Z\-\_]+))/i', $str)) {
            return true;
        } else {
            return false;
        }
    }

    /* Is fanpage */
    public function isFanpage($str)
    {
        if (preg_match('/^(https?:\/\/)?(?:www\.)?facebook\.com\/(?:(?:\w)*#!\/)?(?:pages\/)?(?:[\w\-]*\/)*([\w\-\.]*)/', $str)) {
            return true;
        } else {
            return false;
        }
    }

    /* Is date */
    public function isDate($str)
    {
        if (preg_match('/^([0-2][0-9]|(3)[0-1])(\/)(((0)[0-9])|((1)[0-2]))(\/)\d{4}$/', $str)) {
            return true;
        } else {
            return false;
        }
    }

    /* Is date by format */
    public function isDateByFormat($str, $format = 'd/m/Y')
    {
        $dt = DateTime::createFromFormat($format, $str);
        return $dt && $dt->format($format) == $str;
    }

    /* Is number */
    public function isNumber($numbs)
    {
        if (preg_match('/^[0-9]+$/', $numbs)) {
            return true;
        } else {
            return false;
        }
    }

    public function checkSlug($slug)
    {
        global $lang;
        $tables = [
            'baiviet',
            'baiviet_list',
            'baiviet_cat',
            'baiviet_item',
            'baiviet_sub',
            'tags'
        ];
        foreach ($tables as $table) {
            $row =  $this->_d->rawQueryOne("select id from #_{$table} where tenkhongdau_$lang = ? limit 1", [$slug]);
            if (!empty($row)) {
                return 'exists';
            }
        }
        return false;
    }
    /* Check account */
    public function checkAccount($data = '', $type = '', $tbl = '', $id = 0)
    {
        $result = false;
        $row = array();

        if (!empty($data) && !empty($type) && !empty($tbl)) {
            $where = (!empty($id)) ? ' and id != ' . $id : '';
            $row = $this->_d->rawQueryOne("select id from #_$tbl where $type = ? $where limit 0,1", array($data));

            if (!empty($row)) {
                $result = true;
            }
        }

        return $result;
    }

    public function getAccount()
    {

        global $cache, $loginMember;

        $items = array();

        if (isset($_SESSION[$loginMember]['id'])) {

            $idu = $_SESSION[$loginMember]['id'];

            $items = $cache->getCache("select * from #_customers where hienthi=1 and id=?", [$idu]);
        }

        return $items;
    }
    public function getDuoiHinh($photo)
    {

        $str = strtolower(end(explode('.', $photo)));

        return $str;
    }

    public function getTags($tags, $type)
    {

        global $db, $lang;

        $array_tags = json_decode($tags);

        $strTag = implode(',', $array_tags);

        $tags = $db->rawQuery("select id, ten_$lang as ten, tenkhongdau_$lang as tenkhongdau,type from #_tags where hienthi=1 and type=? and id in ({$strTag}) order by stt asc", array($type));

        $html = "";

        $html .= "<ul class='d-flex align-items-center'>";

        foreach ($tags as $key => $value) {

            $html .= "<li>
                        <a href='{$value['type']}/{$value['tenkhongdau']}' title='{$value['ten']}'>{$value['ten']}</a>
                    </li>
                    ";
        }

        $html .= "</ul>";

        return $html;
    }

    public function FormatBDSMoney($dola)
    {

        $refix = "";

        if ($dola >= 1000000000) {
            $refix = " tỷ";
            $formatSTR = number_format(($dola / 1000000000), 1, '.', '') . $refix;
            return str_replace('.0', '', $formatSTR);
        } else if ($dola >= 1000000) {
            $refix = " triệu";
            $formatSTR = number_format(($dola / 1000000), 1, '.', '') . $refix;
            return str_replace('.0', '', $formatSTR);
        } else if ($dola >= 1000) {
            $refix = " nghìn";
            $formatSTR = number_format(($dola / 1000), 1, '.', '') . $refix;
            return str_replace('.0', '', $formatSTR);
        } else {
            $refix = " ";
            $formatSTR = number_format($dola, 1, '.', '') . $refix;
            return str_replace('.0', '', $formatSTR);
        }
    }

    public function checkListAlias($alias)
    {


        if ($alias == 'catalogy') {

            $result = '';
        } else {

            $result = $alias . '/';
        }

        return $result;
    }

    public function changeMoney($money, $lang)
    {



        global $row_setting;



        switch ($lang) {

            case '':
            case 'vi':

                return $this->money($money, ' Vnđ');

                break;


            case 'en':



                return round($money / $row_setting['dola'], 1) . '$';



                break;



            case 'jp':



                return round(($money * 100) / $row_setting['yen'], 1) . '¥';



                break;



            default:



                return $this->money($money, ' đ');



                break;
        }
    }

    public function getNameAuthor($id_author)
    {

        global $lang;

        $stringName = "";

        $row = $this->_d->rawQueryOne("select ten_$lang as ten, photo from #_baiviet where hienthi=1 and id=? limit 1", array($id_author));

        if ($row) {

            $stringName = $row["ten"];
        } else {

            $stringName = "Admin";
        }
        return $stringName;
    }

    public function activeMenu($link = '', $mobile = false)
    {
        global $com, $source;
        $class = '';
        if ($mobile == true) {
            $class .= 'text-capitalize';
        } else {
            $class .= 'transition';
            if ($source == 'index') {
                if ($link == '') {
                    $class .= ' active';
                }
            } else {
                if ($com == $link) {
                    $class .= ' active';
                }
            }
        }
        return $class;
    }

    public function primaryHeading($seoHeading, $value, $level)
    {
        global $source;

        $auth = array("index");
        if (in_array($source, $auth)) {
            $startHeading = "<{$seoHeading}>";

            $endHeading = "</{$seoHeading}>";
        }
        $html = "{$startHeading}<a class='transition-all p-[4px_10px_5px] " . ($level == 1 ? 'group-hover/cat:text-white' : ($level == 2 ? 'group-hover/item:text-white' : 'group-hover/sub:text-white')) . " duration-300 block font-main font-normal text-[clamp(14px,1.05vw,16px)] text group-hover:color-white hover:bg-main hover:text-white' href='{$this->getUrl($value)}'>{$this->getNameLang($value)}</a>{$endHeading}";
        return $html;
    }
    public function primaryHeadingFull($seoHeading, $value, $level)
    {
        global $source;

        $auth = array("index");
        if (in_array($source, $auth)) {
            $startHeading = "<{$seoHeading}>";

            $endHeading = "</{$seoHeading}>";
        }
        $html = "{$startHeading}<a class='transition-all  " . ($level == 1 ? 'pt-5 text-[16px] text-[#f1592a] font-semibold font-main-600' : ($level == 2 ? ' pt-1 text-[14px] font-semibold font-main-600 ' : ' mt-2 text-[14px] font-medium font-main-500 ')) . " duration-300 block font-main font-normal text hover:text-[#f1592a]' href='{$this->getUrl($value)}'>{$this->getNameLang($value)}</a>{$endHeading}";
        return $html;
    }
    public function primaryMenu($options)
    {
        global $lang, $db;
        $type = isset($options['type']) ? $options['type'] : null;
        $table = isset($options['table']) ? $options['table'] : 'baiviet';
        $isClass = isset($options['class']) ? $options['class'] : '';
        $isCheck = isset($options['isCheck']) ? $options['isCheck'] : false;
        $tableList = 'table_' . $table . '_list';
        $tableCat = 'table_' . $table . '_cat';
        $tableItem = 'table_' . $table . '_item';
        $tableSub = 'table_' . $table . '_sub';
        if ($isCheck) {
            $listCategory = $db->rawQuery("SELECT id,ten_$lang as ten,tenkhongdau_$lang as tenkhongdau from table_$table where type=? and hienthi=1 order by stt asc, id desc", array($type));
        } else {
            $listCategory = $db->rawQuery("SELECT id,ten_$lang as ten,tenkhongdau_$lang as tenkhongdau from $tableList where type=? and hienthi=1 order by stt asc, id desc", array($type));
        }
        $str = '';
        if (count($listCategory) > 0) {
            $str       .= '<ul class="' . $isClass . '">';
            foreach ($listCategory as $v) {
                $catCategory = $db->rawQuery("SELECT id,ten_$lang as ten,tenkhongdau_$lang as tenkhongdau from $tableCat where type=? and id_list = ? and hienthi=1 order by stt asc,id desc", array($type, $v['id']));
                $str       .= '<li class="relative group/cat group/xxx border-t border-slate-300 last:border-b transition-all duration-500 hover:bg-main ">' . $this->primaryHeading('h3', $v, 1) . '';
                if (count($catCategory)) {
                    $str       .= '<ul class="hidden group-hover/cat:block absolute min-w-[220px] left-full -top-[0.5px] z-40 bg-white shadow-[2px_2px_7px_#ccc] animate-[opacity_0.5s] ">';
                    foreach ($catCategory as $v2) {
                        $itemCategory = $db->rawQuery("SELECT id,ten_$lang as ten,tenkhongdau_$lang as tenkhongdau from $tableItem where type=? and id_cat = ? and hienthi=1 order by stt asc,id desc", array($type, $v2['id']));
                        $str       .= '<li class="relative group/item border-t group/yyy border-slate-300 last:border-b transition-all duration-500 hover:bg-main " >' . $this->primaryHeading('h4', $v2, 2) . '';
                        if (count($itemCategory) > 0) {
                            $str       .= '<ul class="hidden group-hover/item:block absolute min-w-[220px] left-full -top-[0.5px] z-40 bg-white shadow-[2px_2px_7px_#ccc] animate-[opacity_0.5s] ">';
                            foreach ($itemCategory as $v3) {
                                $subCategory = $db->rawQuery("SELECT id,ten_$lang as ten,tenkhongdau_$lang as tenkhongdau from $tableSub where type=? and id_item = ? and hienthi=1 order by stt asc,id desc", array($type, $v3['id']));
                                $str       .= '<li class="relative group/sub border-t group/zzz border-slate-300 last:border-b transition-all duration-500 hover:bg-main ">' . $this->primaryHeading('h5', $v3, 3) . '';
                                if (count($subCategory) > 0) {
                                    $str       .= '<ul>';
                                    foreach ($subCategory as $v4) {
                                        $str       .= '<li>' . $this->primaryHeading('h6', $v4, 4) . '</li>';
                                    }
                                    $str       .= '</ul>';
                                }
                                $str       .= '</li>';
                            }
                            $str       .= '</ul>';
                        }
                        $str       .= '</li>';
                    }
                    $str       .= '</ul>';
                }
                $str       .= '</li>';
            }
            $str       .= '</ul>';
        }
        return $str;
    }
    public function primaryMenuFull($options)
    {
        global $lang, $db;
        $type = isset($options['type']) ? $options['type'] : null;
        $table = isset($options['table']) ? $options['table'] : 'baiviet';
        $isClass = isset($options['class']) ? $options['class'] : '';
        $isCheck = isset($options['isCheck']) ? $options['isCheck'] : false;
        $tableList = 'table_' . $table . '_list';
        $tableCat = 'table_' . $table . '_cat';
        $tableItem = 'table_' . $table . '_item';
        $tableSub = 'table_' . $table . '_sub';
        if ($isCheck) {
            $listCategory = $db->rawQuery("SELECT id,ten_$lang as ten,tenkhongdau_$lang as tenkhongdau from table_$table where type=? and hienthi=1 order by stt asc, id desc", array($type));
        } else {
            $listCategory = $db->rawQuery("SELECT id,ten_$lang as ten,tenkhongdau_$lang as tenkhongdau from $tableList where type=? and hienthi=1 order by stt asc, id desc", array($type));
        }
        $str = '<div class="' . $isClass . '">';
        $str .= '<div class="max-h-[500px] overflow-y-auto scroll-design-one w-full">';
        if (count($listCategory) > 0) {
            $str       .= '<ul class=" pb-8 w-full md:px-2.5 lg:px-[40px] mx-auto columns-5">';
            foreach ($listCategory as $v) {
                $catCategory = $db->rawQuery("SELECT id,ten_$lang as ten,tenkhongdau_$lang as tenkhongdau from $tableCat where type=? and id_list = ? and hienthi=1 order by stt asc,id desc", array($type, $v['id']));
                $str       .= '<li class="inline-block w-full">' . $this->primaryHeadingFull('h3', $v, 1) . '';
                if (count($catCategory)) {
                    $str       .= '<ul class="">';
                    foreach ($catCategory as $v2) {
                        $itemCategory = $db->rawQuery("SELECT id,ten_$lang as ten,tenkhongdau_$lang as tenkhongdau from $tableItem where type=? and id_cat = ? and hienthi=1 order by stt asc,id desc", array($type, $v2['id']));
                        $str       .= '<li class="" >' . $this->primaryHeadingFull('h4', $v2, 2) . '';
                        if (count($itemCategory) > 0) {
                            $str       .= '<ul class="">';
                            foreach ($itemCategory as $v3) {
                                $subCategory = $db->rawQuery("SELECT id,ten_$lang as ten,tenkhongdau_$lang as tenkhongdau from $tableSub where type=? and id_item = ? and hienthi=1 order by stt asc,id desc", array($type, $v3['id']));
                                $str       .= '<li class=" ">' . $this->primaryHeadingFull('h5', $v3, 3) . '';
                                if (count($subCategory) > 0) {
                                    $str       .= '<ul>';
                                    foreach ($subCategory as $v4) {
                                        $str       .= '<li>' . $this->primaryHeadingFull('h6', $v4, 4) . '</li>';
                                    }
                                    $str       .= '</ul>';
                                }
                                $str       .= '</li>';
                            }
                            $str       .= '</ul>';
                        }
                        $str       .= '</li>';
                    }
                    $str       .= '</ul>';
                }
                $str       .= '</li>';
            }
            $str       .= '</ul>';
        }
        $str .= '</div>';
        $str .= '</div>';
        return $str;
    }

    public function AllData($field = null, $type = null, $where = null, $limit = null, $checkData = null)
    {

        global $lang;

        $w = $where;

        $arr = $this->_d->rawQuery("select $field ten_$lang as ten,mota_$lang as mota,tenkhongdau_$lang as tenkhongdau,giaban,photo,type from #_baiviet where hienthi=1 and type=? {$w} order by id desc {$limit}", array($type));

        $sql = "select $field ten_$lang as ten,mota_$lang as mota,tenkhongdau_$lang as tenkhongdau,giaban,photo,type from #_baiviet where hienthi=1 and type=? {$w} order by stt desc {$limit}";

        if ($checkData == 'object') {

            $obj = json_decode(json_encode($arr), FALSE);
        } else {
            $obj = $arr;
        }


        return $obj;
    }

    public function OneDataDes($type, $checkData)
    {

        global $lang;

        $arr = $this->_d->rawQueryOne("select mota_$lang as mota,ten_$lang as ten from #_company where hienthi=1 and type=? limit 0,1", array($type));

        if ($checkData == 'object') {

            $obj = json_decode(json_encode($arr), FALSE);
        } else {
            $obj = $arr;
        }

        return $obj;
    }

    public function OneData($field = null, $type = null, $where = null, $checkData = null)
    {

        global $lang;

        $w = $where;

        $arr = $this->_d->rawQueryOne("select $field ten_$lang as ten,mota_$lang as mota,tenkhongdau_$lang as tenkhongdau,giaban,photo,type from #_baiviet where hienthi=1 and type=? {$w} order by stt asc limit 0,1", array($type));

        if ($checkData == 'object') {

            $obj = json_decode(json_encode($arr), FALSE);
        } else {

            $obj = $arr;
        }

        return $obj;
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

    public function AllDataList($field = null, $type = null, $where = null, $limit = null, $checkData = null)
    {

        global $lang;

        $w = $where;

        $arr = $this->_d->rawQuery("select $field id,ten_$lang as ten,tenkhongdau_$lang as tenkhongdau,type from #_baiviet_list where hienthi=1 and type=? {$w} order by stt asc {$limit}", array($type));

        if ($checkData == "object") {

            $obj = json_decode(json_encode($arr), FALSE);
        } else {

            $obj = $arr;
        }


        return $obj;
    }

    public function AllDataCat($field = null, $type = null, $where = null, $limit = null, $checkData = null)
    {

        global $lang;

        $w = $where;

        $arr = $this->_d->rawQuery("select $field id,ten_$lang as ten,tenkhongdau_$lang as tenkhongdau,type from #_baiviet_cat where hienthi=1 and type=? {$w} order by stt asc {$limit}", array($type));

        if ($checkData == "object") {

            $obj = json_decode(json_encode($arr), FALSE);
        } else {

            $obj = $arr;
        }


        return $obj;
    }

    public function OneDataPhoto($field = null, $type = null, $limit = null, $checkData = null)
    {

        global $lang;


        $arr = $this->_d->rawQueryOne("select $field photo, link from #_bannerqc where hienthi=1 and type=? {$limit}", array($type));

        if ($checkData == "object") {

            $obj = json_decode(json_encode($arr), FALSE);
        } else {

            $obj = $arr;
        }


        return $obj;
    }

    public function AllDataPhoto($field = null, $type = null, $limit = null, $checkData = null)
    {

        global $lang;


        $arr = $this->_d->rawQuery("select $field photo from #_photo where hienthi=1 and type=? order by stt asc {$limit}", array($type));


        if ($checkData == "object") {

            $obj = json_decode(json_encode($arr), FALSE);
        } else {

            $obj = $arr;
        }


        return $obj;
    }

    public function AllDataVideo($field = null, $type = null, $limit = null, $checkData = null)
    {

        global $lang;

        $arr = $this->_d->rawQuery("select $field id,type,ten_$lang as ten,links,photo,mota_$lang as mota from #_video where hienthi=1 and type=? order by stt asc,id asc {$limit}", array($type));


        if ($checkData == "object") {

            $obj = json_decode(json_encode($arr), FALSE);
        } else {

            $obj = $arr;
        }


        return $obj;
    }

    public function OneDataVideo($field = null, $type = null, $checkData = null)
    {

        global $lang;


        $arr = $this->_d->rawQueryOne("select $field id,type,ten_$lang as ten,links,photo,mota_$lang as mota from #_video where hienthi=1 and type=? order by stt asc,id asc limit 0,1", array($type));


        if ($checkData == "object") {

            $obj = json_decode(json_encode($arr), FALSE);
        } else {

            $obj = $arr;
        }


        return $obj;
    }

    public function is_connected()
    {

        global $config;

        $connected = @fsockopen($config['website'], 80);

        if ($connected) {

            $is_conn = true;

            fclose($connected);
        } else {

            $is_conn = false;
        }

        return $is_conn;
    }

    /* Check URL */
    public function checkURL($index = false)
    {
        global $https_config;

        $url = '';
        $urls = array('index', 'index.html', 'trang-chu', 'trang-chu.html');

        if (array_key_exists('REDIRECT_URL', $_SERVER)) {
            $root = str_replace("/index.php", "", $_SERVER['PHP_SELF']);
            $url = str_replace($root . "/", "", $_SERVER['REDIRECT_URL']);
        } else {
            $url = explode("/", $_SERVER['REQUEST_URI']);
            $url = $url[count($url) - 1];
            if (strpos($url, "?")) {
                $url = explode("?", $url);
                $url = $url[0];
            }
        }
        if ($index) array_push($urls, "index.php");
        else if (array_search('index.php', $urls)) $urls = array_diff($urls, ["index.php"]);
        if (in_array($url, $urls)) $this->redirect($https_config, 301);
    }

    function checkNumb($field, $table, $type)
    {
        $check = $this->_d->rawQueryOne("select $field from #_$table where type=? order by stt desc limit 1", array($type));

        return $check[$field] + 1;
    }

    public function getFieldOne($field, $table, $id)
    {

        $row = $this->_d->rawQueryOne("select $field from #_$table where id=?", array($id));

        return $row[$field];
    }

    public function getFieldId($id, $table)
    {
        $this->_d->where("id", $id);
        $item = $this->_d->getOne($table);
        return $item;
    }

    public function getTable($table)
    {

        $sql = "select * from #_{$table} order by id desc";

        $row = $this->_d->rawQuery($sql);

        return $row;
    }

    public function getTablePlace($table)
    {

        $sql = "select * from #_{$table} order by ten asc";

        $row = $this->_d->rawQuery($sql);

        return $row;
    }

    public function getPhantramTieptheo($point)
    {



        global $d;



        $row = $d->rawQueryOne("select * from #_coupon where price_start>=$point order by id asc limit 0,1");



        return $row;
    }

    public function getPriceSaleOff($giamoi, $giacu)
    {

        if ($giacu != 0) {
            return $giacu - $giamoi;
        } else {

            return 0;
        }
    }

    public function createdImg($string)
    {

        $explode = explode(' ', $string);

        if (count($explode) == 1) {

            $str = substr($explode[0], 0, 1);
        } elseif (count($explode) >= 2) {

            $str = substr($explode[0], 0, 1);

            $str .= substr($explode[1], 0, 1);
        }

        return $str;
    }

    function randomColor()
    {
        $red = mt_rand(0, 255);
        $green = mt_rand(0, 255);
        $blue = mt_rand(0, 255);
        return "background: rgb($red, $green, $blue)";
    }

    function randomColorGradient()
    {
        // Tạo mã màu RGB ngẫu nhiên cho màu 1
        $red1 = mt_rand(0, 255);
        $green1 = mt_rand(0, 255);
        $blue1 = mt_rand(0, 255);

        // Tạo mã màu RGB ngẫu nhiên cho màu 2
        $red2 = mt_rand(0, 255);
        $green2 = mt_rand(0, 255);
        $blue2 = mt_rand(0, 255);

        // Trả về giá trị gradient trong định dạng CSS
        return "background: linear-gradient(to right, rgb($red1, $green1, $blue1), rgb($red2, $green2, $blue2));";
    }

    public function make_avatar($character)
    {
        $path = time() . '.png';
        $image = imagecreate(300, 150);
        $red = rand(0, 255);
        $green = rand(0, 255);
        $blue = rand(0, 255);
        imagecolorallocate($image, 230, 230, 230);
        $textcolor = imagecolorallocate($image, $red, $green, $blue);
        imagettftext($image, 100, 0, 55, 150, $textcolor, 'webfont/arial.ttf', $character);
        imagepng($image,  "upload/user/" . $path);
        imagedestroy($image);
        return $path;
    }
    public function getCommentPersion($n, $pid)
    {

        $this->_d->reset();

        $sql = "select count(rating) as su from #_comment where pid='" . $pid . "' and type='comment' and hienthi=1";

        $row_sc = $this->_d->rawQueryOne($sql);

        $this->_d->reset();

        $sql = "select count(rating) as su from #_comment where pid='" . $pid . "' and type='comment' and hienthi=1 and rating=$n";

        $this->_d->query($sql);

        $row_su = $this->_d->rawQueryOne($sql);

        if ($row_sc['su'] != 0 && $row_su['su'] != 0) {

            return round($row_su['su'] * 100 / $row_sc['su'], 1);
        } else {

            return 0;
        }
    }

    public function getCommentUser($pid)
    {

        $this->_d->reset();

        $sql = "select sum(rating) as su from #_comment where pid='" . $pid . "' and type='comment' and hienthi=1 group by pid";

        $row_su = $this->_d->rawQueryOne($sql);



        $this->_d->reset();

        $sql = "select count(id) as co from #_comment where pid='" . $pid . "' and type='comment' and hienthi=1";

        $row_co = $this->_d->rawQueryOne($sql);

        if ($row_su['su'] != 0 && $row_co['co'] != 0) {

            $arr['medium'] = round($row_su['su'] / $row_co['co'], 1);

            $arr['count'] = $row_co['co'];
        } else {

            $arr['medium'] = 0;

            $arr['count'] = 0;
        }



        return $arr;
    }


    public function autoNumb($table, $type)
    {

        $checkNumb = $this->getFieldType($table, $type);

        return $checkNumb['stt'] + 1;
    }

    public function getTotalMoney($id = '')
    {

        if ($id != '') {

            $this->_d->reset();

            $sql = "select gia,soluong from #_order_detail where id_order='" . $id . "'";

            $result = $this->_d->rawQuery($sql);

            $tongtien = 0;

            for ($i = 0, $count = count($result); $i < $count; $i++) {



                $tongtien +=    $result[$i]['gia'] * $result[$i]['soluong'];
            }

            return $tongtien;
        } else return 0;
    }

    public function isJson($value)
    {



        json_decode(current($value));



        return (json_last_error() == JSON_ERROR_NONE);
    }

    public function dd($data = null)
    {



        echo '<pre>';



        print_r($data);
    }

    public function getShare($row_detail = null, $path = null, $type_ob = null, $set_index = false, $field = 'photo')
    {



        global $https_config, $row_setting, $row_share, $lang;



        if ($set_index == false) {



            $photo = $https_config . $path . $row_detail[$field];



            $description = ($row_detail['description'] != '') ? strip_tags($row_detail['description']) : strip_tags($row_setting['description']);



            $title = ($row_detail['title'] != '') ? strip_tags($row_detail["ten_$lang"]) : strip_tags($row_setting['title']);
        } else {



            $row_detail = $row_setting;



            $photo = $https_config . $path . $row_share['photo'];



            $description = strip_tags($row_detail['description']);



            $title = ($row_detail['title'] == '') ? strip_tags($row_detail["ten_$lang"]) : strip_tags($row_detail['title']);
            strip_tags($row_detail['title']);
        }



        $result = '<meta property="og:url" content="' . $this->getCurrentPageURL() . '" />



						<meta property="og:site_name" content="' . $row_setting['website'] . '" />



						<meta property="og:type" content="' . $type_ob . '" />



						<meta property="og:title" content="' . $title . '" />



						<meta property="og:description" content="' . $description . '" />



						<meta property="og:locale" content="vi" />



						<meta property="og:image:alt" content="' . $title . '" />



						<meta property="og:image" content="' . $photo . '" />



						<meta itemprop="name" content="' . $title . '">



						<meta itemprop="description" content="' . $description . '">



						<meta itemprop="image" content="' . $photo . '">



						<meta name="twitter:card" content="product">



						<meta name="twitter:site" content="' . $title . '">



						<meta name="twitter:title" content="' . $title . '">



						<meta name="twitter:description" content="' . $description . '">



						<meta name="twitter:creator" content="' . $title . '">



						<meta name="twitter:image" content="' . $photo . '">';



        return self::compress($result);
    }

    public function updateView($table, $id)
    {

        $this->_d->rawQuery("update #_{$table} SET view=1 where id={$id}");
    }

    public function updateTable($table, $id)
    {

        $this->_d->rawQuery("update #_{$table} SET luotxem=luotxem+1 where id={$id}");
    }

    public function updateOrder($table, $id)
    {

        $this->_d->rawQuery("update #_{$table} SET view=1 where id={$id}");
    }

    // =============================viewed======================

    public function viewAdd($pid)
    {

        if ($pid < 1) return;

        if (is_array($_SESSION['viewed'])) {

            if ($this->viewExists($pid)) return;

            $max = count($_SESSION['viewed']);

            $_SESSION['viewed'][$max]['viewid'] = $pid;
        } else {

            $_SESSION['viewed'] = array();

            $_SESSION['viewed'][0]['viewid'] = $pid;
        }
    }

    public function viewExists()
    {

        $pid = intval($pid);

        $max = count($_SESSION['viewed']);

        $flag = 0;

        for ($i = 0; $i < $max; $i++) {

            if ($pid == $_SESSION['viewed'][$i]['viewid']) {

                $flag = 1;

                break;
            }
        }

        return $flag;
    }
    public function viewAddFavor($pid)
    {
        if ($pid < 1) return;
        if (is_array($_SESSION['favor'])) {
            if ($this->viewExistsFavor($pid)) return;
            $max = count($_SESSION['favor']);
            $_SESSION['favor'][$max]['favorid'] = $pid;
        } else {
            $_SESSION['favor'] = array();
            $_SESSION['favor'][0]['favorid'] = $pid;
        }
    }
    public function removeProductFavor($id)
    {
        $max = count($_SESSION['favor']);
        for ($i = 0; $i < $max; $i++) {
            if ($id == $_SESSION['favor'][$i]['favorid']) {
                unset($_SESSION['favor'][$i]);
                break;
            }
        }
        $_SESSION['favor'] = array_values($_SESSION['favor']);
    }
    public function viewExistsFavor($pid)
    {
        $pid = intval($pid);
        $max = count($_SESSION['favor']);
        $flag = 0;
        for ($i = 0; $i < $max; $i++) {
            if ($pid == $_SESSION['favor'][$i]['favorid']) {
                $flag = 1;
                break;
            }
        }
        return $flag;
    }
    public function getTotalFavor()
    {
        $max = count($_SESSION["favor"]);
        return $max;
    }
    function getFavorDataFor()
    {
        $result = array();
        if (is_array($_SESSION['favor'])) {
            $data = array_values($_SESSION['favor']);
            foreach ($data as $k => $v) {
                $item = $this->_d->rawQueryOne("select * from #_baiviet where hienthi=1 and id=? limit 1", [$v['favorid']]);
                if (!empty($item)) {
                    $result[$k] = $item;
                }
            }
        }
        return $result;
    }
    public function errorImg()
    {

        global $imgDefault;

        $error = 'this.src="' . $imgDefault . '"';

        return "onerror='" . $error . "'";
    }

    public function getRatingComment($numb)
    {

        $str = '';

        switch ($numb) {

            case '1':

                $str .= '<i class="fa-sharp fa-solid fa-star-sharp on-star"></i>';

                $str .= '<i class="fa-sharp fa-solid fa-star-sharp"></i>';

                $str .= '<i class="fa-sharp fa-solid fa-star-sharp"></i>';

                $str .= '<i class="fa-sharp fa-solid fa-star-sharp"></i>';

                $str .= '<i class="fa-sharp fa-solid fa-star-sharp"></i>';

                break;

            case '2':

                $str .= '<i class="fa-sharp fa-solid fa-star-sharp on-star"></i>';

                $str .= '<i class="fa-sharp fa-solid fa-star-sharp on-star"></i>';

                $str .= '<i class="fa-sharp fa-solid fa-star-sharp"></i>';

                $str .= '<i class="fa-sharp fa-solid fa-star-sharp"></i>';

                $str .= '<i class="fa-sharp fa-solid fa-star-sharp"></i>';

                break;

            case '3':

                $str .= '<i class="fa-sharp fa-solid fa-star-sharp on-star"></i>';

                $str .= '<i class="fa-sharp fa-solid fa-star-sharp on-star"></i>';

                $str .= '<i class="fa-sharp fa-solid fa-star-sharp on-star"></i>';

                $str .= '<i class="fa-sharp fa-solid fa-star-sharp"></i>';

                $str .= '<i class="fa-sharp fa-solid fa-star-sharp"></i>';

                break;

            case '4':

                $str .= '<i class="fa-sharp fa-solid fa-star-sharp on-star"></i>';

                $str .= '<i class="fa-sharp fa-solid fa-star-sharp on-star"></i>';

                $str .= '<i class="fa-sharp fa-solid fa-star-sharp on-star"></i>';

                $str .= '<i class="fa-sharp fa-solid fa-star-sharp on-star"></i>';

                $str .= '<i class="fa-sharp fa-solid fa-star-sharp"></i>';

                break;

            case '4.5':

                $str .= '<i class="fa-sharp fa-solid fa-star-sharp on-star"></i>';

                $str .= '<i class="fa-sharp fa-solid fa-star-sharp on-star"></i>';

                $str .= '<i class="fa-sharp fa-solid fa-star-sharp on-star"></i>';

                $str .= '<i class="fa-sharp fa-solid fa-star-sharp on-star"></i>';

                $str .= '<i class="fa-sharp fa-solid fa-star-sharp-half-stroke on-star"></i>';

                break;

            default:

                $str .= '<i class="fa-sharp fa-solid fa-star-sharp on-star"></i>';

                $str .= '<i class="fa-sharp fa-solid fa-star-sharp on-star"></i>';

                $str .= '<i class="fa-sharp fa-solid fa-star-sharp on-star"></i>';

                $str .= '<i class="fa-sharp fa-solid fa-star-sharp on-star"></i>';

                $str .= '<i class="fa-sharp fa-solid fa-star-sharp on-star"></i>';

                break;
        }

        return $str;
    }

    public function getRating($numb)
    {

        if ($numb <= 0) {

            $numb = 5;
        }

        return $numb * 20 . '%';
    }

    public function totalSales($total, $percent)
    {

        return $total * (1 - ($percent / 100));
    }

    public function percentPrice($giacu, $giaban)
    {

        $total = ($giacu - $giaban) / $giacu;

        $result = round($total * 100) . '%';

        return $result;
    }



    public function percentTotal($val, $total)
    {

        $percent = ($val / $total) * 100;

        return round($percent, 2);
    }

    public function getTransfer($msg, $page = "index.html")
    {

        $showtext = $msg;

        $page_transfer = $page;

        include("./templates/transfer_tpl.php");

        exit();
    }

    public function checkUrlRedirect()
    {

        global $db, $config, $http;

        $url = $http . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $check_url = $db->rawQueryOne("SELECT * from #_redirect where oldlink='$url' limit 1");
        if (is_array($check_url) && isset($check_url['newlink'])) {
            $new_url = boolval($check_url['newlink']);
        } else {
            $new_url = false;
        }
        if (is_array($check_url) && isset($check_url['typelink'])) {
            $type = boolval($check_url['typelink']);
        } else {
            $type = false;
        }
        if (!empty($check_url)) {

            switch ($type) {

                case 301:
                    $text = 'Moved Permanently';
                    break;
                case 302:
                    $text = 'Moved Temporarily';
                    break;
                case 303:
                    $text = 'See Other';
                    break;
                case 304:
                    $text = 'Not Modified';
                    break;
                case 305:
                    $text = 'Use Proxy';
                    break;
                case 400:
                    $text = 'Bad Request';
                    break;
                case 401:
                    $text = 'Unauthorized';
                    break;
                case 402:
                    $text = 'Payment Required';
                    break;
                case 403:
                    $text = 'Forbidden';
                    break;
                case 404:
                    $text = 'Not Found';
                    break;
                case 405:
                    $text = 'Method Not Allowed';
                    break;
                case 406:
                    $text = 'Not Acceptable';
                    break;
                case 407:
                    $text = 'Proxy Authentication Required';
                    break;
                case 408:
                    $text = 'Request Time-out';
                    break;
                case 409:
                    $text = 'Conflict';
                    break;
                case 410:
                    $text = 'Gone';
                    break;
                case 411:
                    $text = 'Length Required';
                    break;
                case 412:
                    $text = 'Precondition Failed';
                    break;
                case 413:
                    $text = 'Request Entity Too Large';
                    break;
                case 414:
                    $text = 'Request-URI Too Large';
                    break;
                case 415:
                    $text = 'Unsupported Media Type';
                    break;
                case 500:
                    $text = 'Internal Server Error';
                    break;
                case 501:
                    $text = 'Not Implemented';
                    break;
                case 502:
                    $text = 'Bad Gateway';
                    break;
                case 503:
                    $text = 'Service Unavailable';
                    break;
                case 504:
                    $text = 'Gateway Time-out';
                    break;
                case 505:
                    $text = 'HTTP Version not supported';
                    break;
                default:
                    exit('Unknown http status code "' . htmlentities($code) . '"');
                    break;
            }

            $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');

            header($protocol . ' ' . $type . ' ' . $text);

            header("Location: $new_url");

            exit();
        }
    }

    public function getMoneyText($number)
    {



        $hyphen = ' ';



        $conjunction = '  ';



        $separator = ' ';



        $negative = 'âm ';



        $decimal = ' phẩy ';



        $dictionary = array(



            0 => 'Không',



            1 => 'Một',



            2 => 'Hai',



            3 => 'Ba',



            4 => 'Bốn',



            5 => 'Năm',



            6 => 'Sáu',



            7 => 'Bảy',



            8 => 'Tám',



            9 => 'Chín',



            10 => 'Mười',



            11 => 'Mười một',



            12 => 'Mười hai',



            13 => 'Mười ba',



            14 => 'Mười bốn',



            15 => 'Mười năm',



            16 => 'Mười sáu',



            17 => 'Mười bảy',



            18 => 'Mười tám',



            19 => 'Mười chín',



            20 => 'Hai mươi',



            30 => 'Ba mươi',



            40 => 'Bốn mươi',



            50 => 'Năm mươi',



            60 => 'Sáu mươi',



            70 => 'Bảy mươi',



            80 => 'Tám mươi',



            90 => 'Chín mươi',



            100 => 'trăm',



            1000 => 'ngàn',



            1000000 => 'triệu',



            1000000000 => 'tỷ',



            1000000000000 => 'nghìn tỷ',



            1000000000000000 => 'ngàn triệu triệu',



            1000000000000000000 => 'tỷ tỷ'



        );



        if (!is_numeric($number)) {



            return false;
        }



        if (($number >= 0 && (int)$number < 0) || (int)$number < 0 - PHP_INT_MAX) {



            // overflow



            trigger_error('convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX, E_USER_WARNING);



            return false;
        }



        if ($number < 0) {



            return $negative . $this->getMoneyText(abs($number));
        }



        $string = $fraction = null;



        if (strpos($number, '.') !== false) {



            list($number, $fraction) = explode('.', $number);
        }



        switch (true) {



            case $number < 21:



                $string = $dictionary[$number];



                break;



            case $number < 100:



                $tens = ((int)($number / 10)) * 10;



                $units = $number % 10;



                $string = $dictionary[$tens];



                if ($units) {



                    $string .= $hyphen . $dictionary[$units];
                }



                break;



            case $number < 1000:



                $hundreds = $number / 100;



                $remainder = $number % 100;



                $string = $dictionary[$hundreds] . ' ' . $dictionary[100];



                if ($remainder) {



                    $string .= $conjunction . $this->getMoneyText($remainder);
                }



                break;



            default:



                $baseUnit = pow(1000, floor(log($number, 1000)));



                $numBaseUnits = (int)($number / $baseUnit);



                $remainder = $number % $baseUnit;



                $string = $this->getMoneyText($numBaseUnits) . ' ' . $dictionary[$baseUnit];



                if ($remainder) {



                    $string .= $remainder < 100 ? $conjunction : $separator;



                    $string .= $this->getMoneyText($remainder);
                }



                break;
        }



        if (null !== $fraction && is_numeric($fraction)) {



            $string .= $decimal;



            $words = array();



            foreach (str_split((string) $fraction) as $number) {



                $words[] = $dictionary[$number];
            }



            $string .= implode(' ', $words);
        }



        return $string;
    }

    public function checkPermissions($com, $act, $type)
    {

        $str = $com;

        if (!empty($act)) {

            $str .= '_' . $act;
        }

        if (!empty($type)) {

            $str .= '_' . $type;
        }

        if (isset($_SESSION['permissions']) && !in_array($str, $_SESSION['permissions']))

            return true;

        else return false;
    }

    public function checkPerStatic($com, $act, $arr = [])
    {
        $str = $com;
        if (!empty($act)) {
            $str .= '_' . $act;
        }
        if ($arr != NULL) {
            foreach ($arr as $key => $value) {
                if (isset($_SESSION['permissions']) && !in_array($str . '_' . $key, $_SESSION['permissions'])) {

                    return true;
                }
            }
        } else {

            return false;
        }
    }

    public function checkUserAdmin()

    {

        if ($_SESSION[$this->_loginadmin]['username'] == 'kythuat' || $_SESSION[$this->_loginadmin]['username'] == 'admin' || $_SESSION[$this->_loginadmin]['username'] == 'i-web')

            return true;

        else

            return false;
    }

    public function checkaddslashes($str)
    {

        if (strpos(str_replace("\'", "", " $str"), "'") != false)

            return addslashes($str);

        else

            return $str;
    }

    public function checkColumna($tName, $tCol)
    {

        $sql = "SHOW COLUMNS FROM #_{$tName} LIKE '{$tCol}'";

        $result = $this->_d->rawQuery($sql);

        $exits = $result ? TRUE : FALSE;

        return $exits;
    }

    public function magicQuote($str, $id_connect = true)

    {

        if (is_array($str)) {

            foreach ($str as $key => $val) {

                $str[$key] = escape_str($val);
            }

            return $str;
        }

        if (is_numeric($str)) {

            return $str;
        }

        $str = addslashes($str);

        if (function_exists('mysqli_real_escape_string') and is_resource($id_connect)) {

            return $this->_d->sqli_real_escape_string($str);;
        }

        // elseif (function_exists('mysqli_escape_string'))

        // {

        // 	return mysqli_escape_string($str);

        // }

        else {

            return $this->checkaddslashes($str);
        }
    }

    static public function compress($buffer)
    {



        $buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);



        $buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  '), '', $buffer);



        $buffer = str_replace('{ ', '{', $buffer);



        $buffer = str_replace(' }', '}', $buffer);



        $buffer = str_replace('; ', ';', $buffer);



        $buffer = str_replace(', ', ',', $buffer);



        $buffer = str_replace(' {', '{', $buffer);



        $buffer = str_replace('} ', '}', $buffer);



        $buffer = str_replace(': ', ':', $buffer);



        $buffer = str_replace(' ,', ',', $buffer);



        $buffer = str_replace(' ;', ';', $buffer);



        return $buffer;
    }



    public function messagePage($message = '')
    {

        $str = '';

        if ($message != '') {



            $result = json_decode(base64_decode($message), true);

            if (count($result)) {



                $class = ($result['status'] == 200) ? 'success' : 'danger';



                $status = ($result['status'] == 200) ? 'Success!' : 'Fails!';



                $str .= '<div class="row">

	

					 <div class="col-lg-12">

	

						<div class="alert alert-' . $class . ' alert-dismissible mb-0 fade show" role="alert">

	

							<strong>' . $status . '</strong> ' . $result['message'] . '

	

							<button type="button" class="close" data-dismiss="alert" aria-label="Close">

	

								<span aria-hidden="true">×</span>

	

							</button>

	

						</div>

	

					</div>

	

				</div>';
            }
        }

        return $str;
    }

    public function sendMessage($title, $contentnd, $url)
    {

        $heading = array("en" => $title);

        $content = array("en" => $contentnd);

        $fields = array(

            'app_id' => "40ee4881-06af-43db-b29a-e70a19b1a208",

            'included_segments' => array('Active Users'),

            'contents' => $content,

            'headings' => $heading,

            'url' => $url

        );



        $fields = json_encode($fields);



        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',

            'Authorization: Basic NDgxOTkzZTMtMTc5NC00MWQ0LThlNGMtYzllZGZkNTEzMmRh'
        ));

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_POST, TRUE);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);

        curl_close($ch);

        return $response;
    }

    public function isGoogleSpeed()
    {



        if (!isset($_SERVER['HTTP_USER_AGENT']) || stripos($_SERVER['HTTP_USER_AGENT'], 'Chrome-Lighthouse') === false) {



            return false;
        }



        return true;
    }
    function sendMailIndexAjax($author, $title, $body, $emailAddress = null, $emailCC = null, $emailBCC = null)
    {
        global $config;
        include_once "../libraries/Mailer/class.phpmailer.php";
        $mail = new PHPMailer();
        $mail->IsSMTP();
        if ($config['mail']['gmail'] == true) {
            $mail->SMTPSecure = $config['mail']['secure'];
            $mail->Port   = $config['mail']['port'];
        }
        $mail->SMTPAuth   = true;
        // $mail->SMTPDebug   = true;
        $mail->Host       = $config['mail']['ip'];
        $mail->Username   = $config['mail']['email'];
        $mail->Password   = $config['mail']['password'];
        $mail->SetFrom($config['mail']['email'], $author);
        if (!empty($emailAddress)) {
            foreach ($emailAddress as $k => $v) {
                $mail->AddAddress($v, $author);
            }
        }
        if (!empty($emailCC)) {
            foreach ($emailCC as $k => $v) {
                $mail->AddCC($v, $author);
            }
        }
        if (!empty($emailBCC)) {
            foreach ($emailBCC as $k => $v) {
                $mail->AddBCC($v, $author);
            }
        }
        $mail->Subject    = $title;
        $mail->IsHTML(true);
        $mail->CharSet = "utf-8";
        $mail->Body = $body;
        if ($mail->Send()) {
            return true;
        } else {
            return false;
        }
    }

    function sendMailIndex($author, $title, $body, $emailAddress = null, $emailCC = null, $emailBCC = null)
    {



        global $config;



        include_once "Mailer/class.phpmailer.php";



        $mail = new PHPMailer();



        $mail->IsSMTP();



        if ($config['mail']['gmail'] == true) {



            $mail->SMTPSecure = $config['mail']['secure'];



            $mail->Port   = $config['mail']['port'];
        }

        //This should be the same as the domain of your From address

        $mail->DKIM_domain = $config['website'];

        //See the DKIM_gen_keys.phps script for making a key pair -

        //here we assume you've already done that.

        //Path to your private key:

        $mail->DKIM_private = $config['link-dkim'];

        //Set this to your own selector

        $mail->DKIM_selector = 'x._domainkey';

        //Put your private key's passphrase in here if it has one

        $mail->DKIM_passphrase = '';

        //The identity you're signing as - usually your From address

        $mail->DKIM_identity = $mail->From;

        //Suppress listing signed header fields in signature, defaults to true for debugging purpose

        $mail->DKIM_copyHeaderFields = false;

        //Optionally you can add extra headers for signing to meet special requirements

        $mail->DKIM_extraHeaders = ['List-Unsubscribe', 'List-Help'];



        $mail->SMTPAuth   = true;



        // $mail->SMTPDebug   = true;



        $mail->Host       = $config['mail']['ip'];



        $mail->Username   = $config['mail']['email'];



        $mail->Password   = $config['mail']['password'];



        $mail->SetFrom($config['mail']['email'], $author);



        if (!empty($emailAddress)) {



            foreach ($emailAddress as $k => $v) {



                $mail->AddAddress($v, $author);
            }
        }



        if (!empty($emailCC)) {



            foreach ($emailCC as $k => $v) {



                $mail->AddCC($v, $author);
            }
        }



        if (!empty($emailBCC)) {



            foreach ($emailBCC as $k => $v) {



                $mail->AddBCC($v, $author);
            }
        }



        $mail->Subject    = $title;



        $mail->IsHTML(true);



        $mail->CharSet = "utf-8";



        $mail->Body = $body;



        if ($mail->Send()) {



            return true;
        } else {



            return false;
        }
    }

    function sendMailAjax($author, $title, $body, $emailAddress = null, $emailCC = null, $emailBCC = null)
    {



        global $config;



        include_once "../libraries/Mailer/class.phpmailer.php";



        $mail = new PHPMailer();



        $mail->IsSMTP();



        if ($config['mail']['gmail'] == true) {



            $mail->SMTPSecure = $config['mail']['secure'];



            $mail->Port   = $config['mail']['port'];
        }


        $mail->SMTPAuth   = true;



        // $mail->SMTPDebug   = true;



        $mail->Host       = $config['mail']['ip'];



        $mail->Username   = $config['mail']['email'];



        $mail->Password   = $config['mail']['password'];



        $mail->SetFrom($config['mail']['email'], $author);



        if (!empty($emailAddress)) {



            foreach ($emailAddress as $k => $v) {



                $mail->AddAddress($v, $author);
            }
        }



        if (!empty($emailCC)) {



            foreach ($emailCC as $k => $v) {



                $mail->AddCC($v, $author);
            }
        }



        if (!empty($emailBCC)) {



            foreach ($emailBCC as $k => $v) {



                $mail->AddBCC($v, $author);
            }
        }



        $mail->Subject    = $title;



        $mail->IsHTML(true);



        $mail->CharSet = "utf-8";



        $mail->Body = $body;



        if ($mail->Send()) {



            return true;
        } else {



            return false;
        }
    }

    public function isAjax()
    {

        return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && (strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'));
    }

    public function orderCode($code, $table)
    {

        $sql = "select id from table_{$table} order by id desc limit 0,1";

        $result = $this->_d->rawQuery($sql);

        if (count($result) == 0) {

            $kq = $code . "00001";
        } else {

            $id = $result[0]['id'] + 1;

            $leng = strlen($id);

            if ($leng == 1) {

                $kq = $code . "000" . $id;
            } else if ($leng == 2) {

                $kq = $code . "0000" . $id;
            } else if ($leng == 3) {

                $kq = $code . "000" . $id;
            } else if ($leng == 4) {

                $kq = $code . "00" . $id;
            } else if ($leng == 5) {

                $kq = $code . "0" . $id;
            } else {

                $kq = $code . $id;
            }
        }

        return $kq;
    }

    public function encryptPassword($secret, $str, $salt)
    {

        return md5(sha1($secret . $str . $salt));
    }



    public function getLink($str, $index = false, $html = false)
    {

        if ($index == true) {

            return '<a href="" title="' . $str . '">' . $str . '</a>';
        } else {

            if ($html == true) {
                $h = '.html';
            }

            return '<a href="' . $this->changeTitle($str) . $h . '" title="' . $str . '">' . $str . '</a>';
        }
    }

    public function isLogin()
    {
        global $loginMember;
        return isset($_SESSION[$loginMember]) && $_SESSION[$loginMember] == true ?  true : false;
    }

    /* Login */
    public function checkLoginMember()
    {
        global $http_config, $loginMember;
        if (!empty($_SESSION[$loginMember]) || !empty($_COOKIE['login_member_id'])) {
            $flag = true;
            $iduser = (!empty($_COOKIE['login_member_id'])) ? $_COOKIE['login_member_id'] : $_SESSION[$loginMember]['id'];
            if ($iduser) {
                $row = $this->_d->rawQueryOne("select login_session, id, username, phone, address, email, fullname from #_customers where id = ? and hienthi=1", array($iduser));
                if (!empty($row['id'])) {
                    $login_session = (!empty($_COOKIE['login_member_session'])) ? $_COOKIE['login_member_session'] : $_SESSION[$loginMember]['login_session'];
                    if ($login_session == $row['login_session']) {
                        $_SESSION[$loginMember]['active'] = true;
                        $_SESSION[$loginMember]['id'] = $row['id'];
                        $_SESSION[$loginMember]['username'] = $row['username'];
                        $_SESSION[$loginMember]['phone'] = $row['phone'];
                        $_SESSION[$loginMember]['address'] = $row['address'];
                        $_SESSION[$loginMember]['email'] = $row['email'];
                        $_SESSION[$loginMember]['fullname'] = $row['fullname'];
                    } else $flag = false;
                } else $flag = false;
                if (!$flag) {
                    unset($_SESSION[$loginMember]);
                    setcookie('login_member_id', "", -1, '/');
                    setcookie('login_member_session', "", -1, '/');
                    $this->transfer(_thongbaodangnhap, $http_config, false);
                }
            }
        }
    }
    public function getBrowser()
    {

        $u_agent = $_SERVER['HTTP_USER_AGENT'];

        $bname = 'Unknown';

        $platform = 'Unknown';

        $version = "";

        if (preg_match('/linux/i', $u_agent)) {

            $platform = 'linux';
        } elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {

            $platform = 'mac';
        } elseif (preg_match('/windows|win32/i', $u_agent)) {

            $platform = 'windows';
        }

        if (preg_match('/MSIE/i', $u_agent) && !preg_match('/Opera/i', $u_agent)) {

            $bname = 'Internet Explorer';

            $ub = "MSIE";
        } elseif (preg_match('/Firefox/i', $u_agent)) {

            $bname = 'Mozilla Firefox';

            $ub = "Firefox";
        } elseif (preg_match('/OPR/i', $u_agent)) {

            $bname = 'Opera';

            $ub = "Opera";
        } elseif (preg_match('/Chrome/i', $u_agent) && !preg_match('/Edge/i', $u_agent)) {

            $bname = 'Google Chrome';

            $ub = "Chrome";
        } elseif (preg_match('/Safari/i', $u_agent) && !preg_match('/Edge/i', $u_agent)) {

            $bname = 'Apple Safari';

            $ub = "Safari";
        } elseif (preg_match('/Netscape/i', $u_agent)) {

            $bname = 'Netscape';

            $ub = "Netscape";
        } elseif (preg_match('/Edge/i', $u_agent)) {

            $bname = 'Edge';

            $ub = "Edge";
        } elseif (preg_match('/Trident/i', $u_agent)) {

            $bname = 'Internet Explorer';

            $ub = "MSIE";
        }

        $known = array('Version', $ub, 'other');

        $pattern = '#(?<browser>' . join('|', $known) .

            ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';

        if (!preg_match_all($pattern, $u_agent, $matches)) {

            // we have no matching number just continue

        }

        $i = count($matches['browser']);

        if ($i != 1) {

            if (strripos($u_agent, "Version") < strripos($u_agent, $ub)) {

                $version = $matches['version'][0];
            } else {

                $version = $matches['version'][1];
            }
        } else {

            $version = $matches['version'][0];
        }

        if ($version == null || $version == "") {
            $version = "?";
        }



        return array(

            'userAgent' => $u_agent,

            'name'      => $bname,

            'version'   => $version,

            'platform'  => $platform,

            'pattern'    => $pattern

        );
    }

    public function convertNumberToWords($number)

    {

        $hyphen      = ' ';

        $conjunction = '  ';

        $separator   = ' ';

        $negative    = 'âm ';

        $decimal     = ' phẩy ';

        $dictionary  = array(

            0                   => 'Không',

            1                   => 'Một',

            2                   => 'Hai',

            3                   => 'Ba',

            4                   => 'Bốn',

            5                   => 'Năm',

            6                   => 'Sáu',

            7                   => 'Bảy',

            8                   => 'Tám',

            9                   => 'Chín',

            10                  => 'Mười',

            11                  => 'Mười Một',

            12                  => 'Mười Hai',

            13                  => 'Mười Ba',

            14                  => 'Mười Bốn',

            15                  => 'Mười Lăm',

            16                  => 'Mười Sáu',

            17                  => 'Mười Bảy',

            18                  => 'Mười Tám',

            19                  => 'Mười Chín',

            20                  => 'Hai Mươi',

            30                  => 'Ba Mươi',

            40                  => 'Bốn Mươi',

            50                  => 'Năm Mươi',

            60                  => 'Sáu Mươi',

            70                  => 'Bảy Mươi',

            80                  => 'Tám Mươi',

            90                  => 'Chín Mươi',

            100                 => 'Trăm',

            1000                => 'Ngàn',

            1000000             => 'Triệu',

            1000000000          => 'Tỷ',

            1000000000000       => 'Nghìn Tỷ',

            1000000000000000    => 'Ngàn Triệu Triệu',

            1000000000000000000 => 'Tỷ Tỷ'

        );



        if (!is_numeric($number)) {

            return false;
        }



        if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {

            trigger_error('convert Number To Words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX, E_USER_WARNING);

            return false;
        }



        if ($number < 0) {

            return $negative . convertNumberToWords(abs($number));
        }



        $string = $fraction = null;



        if (strpos($number, '.') !== false) {

            list($number, $fraction) = explode('.', $number);
        }



        switch (true) {

            case $number < 21:

                $string = $dictionary[$number];

                break;

            case $number < 100:

                $tens   = ((int) ($number / 10)) * 10;

                $units  = $number % 10;

                $string = $dictionary[$tens];

                if ($units) {

                    $string .= $hyphen . $dictionary[$units];
                }

                break;

            case $number < 1000:

                $hundreds  = $number / 100;

                $remainder = $number % 100;

                $string = $dictionary[$hundreds] . ' ' . $dictionary[100];

                if ($remainder) {

                    $string .= $conjunction . convertNumberToWords($remainder);
                }

                break;

            default:

                $baseUnit = pow(1000, floor(log($number, 1000)));

                $numBaseUnits = (int) ($number / $baseUnit);

                $remainder = $number % $baseUnit;

                $string = convertNumberToWords($numBaseUnits) . ' ' . $dictionary[$baseUnit];

                if ($remainder) {

                    $string .= $remainder < 100 ? $conjunction : $separator;

                    $string .= convertNumberToWords($remainder);
                }

                break;
        }



        if (null !== $fraction && is_numeric($fraction)) {

            $string .= $decimal;

            $words = array();

            foreach (str_split((string) $fraction) as $number) {

                $words[] = $dictionary[$number];
            }

            $string .= implode(' ', $words);
        }

        return $string;
    }

    public function timeAgo($time_ago)

    {

        $cur_time   = time();

        $time_elapsed   = $cur_time - $time_ago;

        $seconds    = $time_elapsed;

        $minutes    = round($time_elapsed / 60);

        $hours      = round($time_elapsed / 3600);

        $days       = round($time_elapsed / 86400);

        $weeks      = round($time_elapsed / 604800);

        $months     = round($time_elapsed / 2600640);

        $years      = round($time_elapsed / 31207680);

        // Seconds

        if ($seconds <= 60) {

            return $seconds . ' giây trước';
        }

        //Minutes

        else if ($minutes <= 60) {

            if ($minutes == 1) {

                return "1 phút trước";
            } else {

                return "$minutes phút trước";
            }
        }

        //Hours

        else if ($hours <= 24) {

            if ($hours == 1) {

                return "1 giờ trước";
            } else {

                return "$hours giờ trước";
            }
        }

        //Days

        else if ($days <= 7) {

            if ($days == 1) {

                return "hôm qua";
            } else {

                return "$days ngày trước";
            }
        }

        //Weeks

        else if ($weeks <= 4.3) {

            if ($weeks == 1) {

                return "1 tuần trước";
            } else {

                return "$weeks tuần trước";
            }
        }

        //Months

        else if ($months <= 12) {

            if ($months == 1) {

                return "1 tháng trước";
            } else {

                return "$months tháng trước";
            }
        }

        //Years

        else {

            if ($years == 1) {

                return "1 năm trước";
            } else {

                return "$years 1 năm trước";
            }
        }
    }

    public function MonthsOfTheYear($month)

    {

        $get_month = date('m', $month);

        switch ($get_month) {

            case '01':

                $result_month = 'Jan';

                break;

            case '02':

                $result_month = 'Feb';

                break;

            case '03':

                $result_month = 'Mar';

                break;

            case '04':

                $result_month = 'Apr';

                break;

            case '05':

                $result_month = 'May';

                break;

            case '06':

                $result_month = 'Jun';

                break;

            case '07':

                $result_month = 'Jul';

                break;

            case '08':

                $result_month = 'Aug';

                break;

            case '09':

                $result_month = 'Sep';

                break;

            case '10':

                $result_month = 'Oct';

                break;

            case '11':

                $result_month = 'Nov';

                break;

            case '12':

                $result_month = 'Dec';

                break;

            default:

                $result_month = '';

                break;
        }

        return $result_month;
    }

    public function daysOfTheWeek($date)

    {

        $get_date = date('l', $date);

        switch ($get_date) {

            case 'Monday':

                $result_date = 'Thứ 2';

                break;

            case 'Tuesday':

                $result_date = 'Thứ 3';

                break;

            case 'Wednesday':

                $result_date = 'Thứ 4';

                break;

            case 'Thursday':

                $result_date = 'Thứ 5';

                break;

            case 'Friday':

                $result_date = 'Thứ 6';

                break;

            case 'Saturday':

                $result_date = 'Thứ 7';

                break;

            case 'Sunday':

                $result_date = 'Chủ nhật';

                break;

            default:

                $result_date = '';

                break;
        }



        return $result_date;
    }

    public function addHref($data = array())
    {

        $defaults = array(

            'element' => '',

            'isIcon' => false,

            'icon' => '',

            'class' => '',

            'id' => '',

            'classLine' => '',

            'seoHeading' => '',

            'href' => '',

            'addHref' => true,

            'title' => '',

            'role' => 'link',

            'rel' => true

        );

        $info = array_merge($defaults, $data);

        $rel = ($info['rel']) ? 'dofollow' : 'nofollow';

        $info['class'] = (!empty($info['class'])) ? "class='" . $info['class'] . "'" : "";

        $info['id'] = (!empty($info['id'])) ? "id='" . $info['id'] . "'" : "";

        $info['classLine'] = (!empty($info['classLine'])) ? "class='" . $info['classLine'] . "'" : "";

        $isIcon = ($info['isIcon']) ? $info['icon'] : null;

        $result = '';

        if (!empty($info['seoHeading'])) $result .= "<" . $info['seoHeading'] . ">";

        $result .= "<a href='" . $info['href'] . "' " . $info['class'] . " " . $info['id'] . " rel='" . $rel . "' role='" . $info['role'] . "' aria-label='" . $info['title'] . "' title='" . $info['title'] . "'>" . $info['element'] . "<span " . $info['classLine'] . ">" . $info['title'] . "</span>" . $isIcon . "</a>";

        if (!empty($info['seoHeading'])) $result .= "</" . $info['seoHeading'] . ">";

        return $result;
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
            if (!empty($info['size-src']) && $info['create_thumbs']) {
                $info['pathSize'] = $info['size-src'] . "/" . $info['upload'] . $info['image'];
                $urlImages = (!empty($info['isWatermark']) && !empty($info['prefix'])) ? $https_config . $info['watermark'] . "/" . $info['prefix'] . "/" . $info['pathSize'] : $https_config . $info['thumbs'] . "/" . $info['pathSize'];
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
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . $config['website']["url"] . $urlImagesTmp)) {
            $info['src'] = (!empty($info['isLazy']) && strpos($info['class'], 'lazy') !== false) ? "data-src='" . $urlImages . "'" : "src='" . $urlImages . "'";
        } else {
            $info['src'] = (!empty($info['isLazy']) && strpos($info['class'], 'lazy') !== false) ? "data-src='" . $urlImagesError . "'" : "src='" . $urlImagesError . "'";
        }
        /* add ahref */
        if ($info['addhref']) {

            $startHref = "<a href='" . $info['href'] . "' " . $info['classfix'] . " " . $info['target'] . " role='" . $info['role'] . "' rel='" . $info['rel'] . "' title='" . $info['alt'] . "' " . $info['data'] . " style='width: " . $width . "px;aspect-ratio:$width/$height;max-width:100%;display: inline-flex;justify-items: center;align-items: center;line-height: 0;position: relative;' > ";
            $endHref = "</a>";
        } else {
            $startHref = "<div  " . $info['classfix'] . " style='width: " . $width . "px;aspect-ratio:$width/$height;max-width:100%;display: inline-flex;justify-items: center;align-items: center;line-height: 0;position: relative;' > " . $info['data'] . "";
            $endHref = "</div>";
        }

        /* Image */
        $result = "{$startHref}<img width='{$width}' height='{$height}' " . $info['class'] . " " . $info['id'] . " onerror=\"this.src=" . $urlImagesError . "\" " . $info['src'] . " alt='" . $info['alt'] . "' style='position: absolute;  top: 50%;left: 50%;transform: translate(-50%, -50%);width: 100%;height: 100%;$style'/>{$endHref}";

        return $result;
    }

    /* Convert Webp */
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

    public function getYoutube($links)
    {

        $ext = explode('=', $links);

        $vaich = $ext[1];

        if (strpos($vaich, '&') > 0) {
            $id = explode('&', $vaich);
            return $id[0];
        }

        return $vaich;
    }

    public function getYoutubeImg($value)
    {
        $uid = $this->getYoutube($value['links']);
        $videoimg = "https://img.youtube.com/vi/$uid/mqdefault.jpg";
        if ($value['photo'] != null & $value['photo'] != "") {
            $videoimg = _upload_hinhanh_l . $value['photo'];
        }
        return $videoimg;
    }

    public function boCongThuong($v)
    {

        global $lang;

        $hidden = ($v['hienthi'] == 1) ? '' : 'hidden';

        $str = '<div class="bocongthuong mt10 ' . $hidden . '">

                <a href="' . $v["link"] . '" target="_blank" rel="nofollow" title="Bộ công thương">

                    <img src="' . _upload_hinhanh_l . $v["photo"] . '" alt="Bộ công thương" />

                </a>

            </div>';

        return $str;
    }

    public function DMCA($v)
    {

        global $lang;

        $hidden = ($v['hienthi'] == 1) ? '' : 'hidden';

        $str = '<div class="dmca__footer mt10 ' . $hidden . '">

                <a href="' . $v["link"] . '" target="_blank" rel="nofollow" title="DMCA">

                    <img src="' . _upload_hinhanh_l . $v["photo"] . '" alt="DMCA" />

                </a>

            </div>';

        return $str;
    }

    function fnsRandDigit($min, $max, $num)

    {

        $result = '';

        for ($i = 0; $i < $num; $i++) {

            $result .= rand($min, $max);
        }

        return $result;
    }

    public function getCom($type)
    {

        global $translate, $lang;

        return $lang . '/' . $translate[$lang][$type];
    }

    public function getComAccount($lang, $url)
    {

        return $lang . '/' . $url;
    }

    function getComUrl($url)
    {

        global $lang, $config;

        return ($config['lang_check']) ? $lang . '/' . $url : $url;
    }

    public function currentLangLink($nlang)
    {
        global $translate, $com, $actLang;
        $str = '';
        $currentUrl = $this->getCurrentURL();
        $pageUrl = explode('?', $currentUrl);
        if (!empty($nlang)) {
            $str .= $nlang . '/';
        }
        if (isset($actLang)) {
            $str .= $actLang[$nlang];
        } else {
            if (!empty($com) && !in_array($com, ['index'])) {
                $str .= $translate[$nlang][$com];
            }
        }
        if (strpos($currentUrl, '?') !== false) {
            $str .= '?' . $pageUrl[1];
        }
        return $str;
    }

    public function getArray($arr = array())
    {

        global $lang;

        return array('alias' => $arr['tenkhongdau'], 'name' => $arr["ten_$lang"], 'type' => $arr['type']);
    }

    function delCache()
    {



        $files = glob('../cache/*');



        foreach ($files as $file) {



            if (is_file($file)) {



                unlink($file);
            }
        }
    }

    // =============================upload img====================



    public function uploadVideo($id = 0, $photo = 'video', $file = null, $path = null, $table = null)
    {
        if ($file) {
            $handle = new Upload($file);
            if ($file['error'] != 4) {
                if ($handle->uploaded) {
                    $handle->file_new_name_body = $this->imagesName($handle->file_src_name_body);
                    $data[$photo] = $handle->file_new_name_body . '.' . $handle->file_src_name_ext;
                    $handle->process($path);
                    if ($handle->processed) {
                        if ($id != 0) {
                            $this->_d->where("id", $id);
                            $item = $this->_d->getOne($table);
                            $this->deleteLink($path . $item[$photo]);
                        }
                        $msg_upload = true;
                    }
                }
            }
            return $data;
        }
    }

    public function uploadFileSend($photo = 'file', $file = null, $path = null)
    {
        if ($file) {
            $handle = new Upload($file);
            if ($file['error'] != 4) {
                if ($handle->uploaded) {
                    $handle->file_new_name_body = $this->imagesName($handle->file_src_name_body);
                    $data[$photo] = $handle->file_new_name_body . '.' . $handle->file_src_name_ext;
                    $handle->process($path);
                    if ($handle->processed) {
                        $msg_upload = true;
                    }
                }
            }
            return $data;
        }
    }



    public function uploadImg($id = 0, $photo = 'photo', $thumb = 'thumb', $file = null, $path = null, $table = null, $w = null, $h = null, $r = 1, $b = false)
    {
        if ($file) {
            $handle = new Upload($file);
            if ($file['error'] != 4) {
                if ($handle->uploaded) {
                    $handle->file_new_name_body = $this->imagesName($handle->file_src_name_body);
                    $data[$photo] = $handle->file_new_name_body . '.' . $handle->file_src_name_ext;
                    $handle->process($path);
                    if ($handle->processed) {
                        if ($id != 0) {

                            $this->_d->where("id", $id);

                            $item = $this->_d->getOne($table);

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
                            $this->_d->where("id", $id);
                            $item = $this->_d->getOne($table);
                            $this->deleteLink($path . $item[$thumb]);
                        }
                        $msg_upload = true;
                    }
                }
            }
            return $data;
        }
    }

    public function uploadImgType($type = 'null', $photo = 'photo', $thumb = 'thumb', $file = null, $path = null, $table = null, $w = null, $h = null, $r = 1, $b = false)
    {
        if ($file) {
            $handle = new Upload($file);
            if ($file['error'] != 4) {
                if ($handle->uploaded) {
                    $handle->file_new_name_body = $this->imagesName($handle->file_src_name_body);
                    $data[$photo] = $handle->file_new_name_body . '.' . $handle->file_src_name_ext;
                    $handle->process($path);
                    if ($handle->processed) {
                        if ($type != 'null') {
                            $this->_d->where("type", $type);
                            $item = $this->_d->getOne($table);
                            $this->deleteLink($path . $item[$photo]);
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
                        $handle->jpeg_quality = 60;
                    } elseif ($handle->file_src_name_ext == 'png' || $handle->file_src_name_ext == 'PNG') {
                        $handle->image_convert         = 'png';
                        $handle->png_compression = 3;
                    }
                    $handle->process($path);
                    if ($handle->processed) {
                        if ($type != 'null') {
                            $this->_d->where("type", $type);
                            $item = $this->_d->getOne($table);
                            $this->deleteLink($path . $item[$thumb]);
                        }
                        $msg_upload = true;
                    }
                }
            }
            return $data;
        }
    }
    public function uploadImgNotThumb($photo = 'photo', $file = null, $path = null)
    {
        if ($file) {
            $handle = new Upload($file);
            if ($file['error'] != 4) {
                if ($handle->uploaded) {
                    $handle->file_new_name_body = $this->imagesName($handle->file_src_name_body);
                    $data[$photo] = $handle->file_new_name_body . '.' . $handle->file_src_name_ext;
                    $handle->process($path);
                    if ($handle->processed) {
                        $msg_upload = true;
                    }
                }
            }
            return $data;
        }
    }

    public function uploadImage($file = '', $extension = '', $folder = '', $newname = '')
    {
        global $config;

        if (isset($_FILES[$file]) && !$_FILES[$file]['error']) {
            $postMaxSize = ini_get('post_max_size');
            $MaxSize = explode('M', $postMaxSize);
            $MaxSize = $MaxSize[0];
            if ($_FILES[$file]['size'] > $MaxSize * 1048576) {
                $this->alert('Dung lượng file không được vượt quá ' . $postMaxSize);
                return false;
            }

            $ext = explode('.', $_FILES[$file]['name']);
            $ext = strtolower($ext[count($ext) - 1]);
            $name = basename($_FILES[$file]['name'], '.' . $ext);

            if (strpos($extension, $ext) === false) {
                $this->alert('Chỉ hỗ trợ upload file dạng ' . $extension);
                return false;
            }

            if ($newname == '' && file_exists($folder . $_FILES[$file]['name']))
                for ($i = 0; $i < 100; $i++) {
                    if (!file_exists($folder . $name . $i . '.' . $ext)) {
                        $_FILES[$file]['name'] = $name . $i . '.' . $ext;
                        break;
                    }
                }
            else {
                $_FILES[$file]['name'] = $newname . '.' . $ext;
            }

            if (!copy($_FILES[$file]["tmp_name"], $folder . $_FILES[$file]['name'])) {
                if (!move_uploaded_file($_FILES[$file]["tmp_name"], $folder . $_FILES[$file]['name'])) {
                    return false;
                }
            }

            /* Resize image if width origin > config max width */
            $array = getimagesize($folder . $_FILES[$file]['name']);
            list($image_w, $image_h) = $array;
            $maxWidth = $config['website']['upload']['max-width'];
            $maxHeight = $config['website']['upload']['max-height'];
            if ($image_w > $maxWidth) $this->smartResizeImage($folder . $_FILES[$file]['name'], null, $maxWidth, $maxHeight, true);

            return $_FILES[$file]['name'];
        }
        return false;
    }

    public function uploadPhoto($file, $extension, $folder, $newname = '')
    {

        if (isset($file) && !$file['error']) {



            $ext = end(explode('.', $file['name']));

            $name = basename($file['name'], '.' . $ext);

            if (strpos($extension, $ext) === false) {

                alert('Chỉ hỗ trợ upload file dạng ' . $ext . '-////-' . $extension);

                return false;
            }

            if ($newname == '' && file_exists($folder . $file['name']))

                for ($i = 0; $i < 100; $i++) {

                    if (!file_exists($folder . $name . $i . '.' . $ext)) {

                        $file['name'] = $name . $i . '.' . $ext;

                        break;
                    }
                }

            else {

                $file['name'] = $newname . '.' . $ext;
            }



            if (!copy($file["tmp_name"], $folder . $file['name'])) {

                if (!move_uploaded_file($file["tmp_name"], $folder . $file['name'])) {

                    return false;
                }
            }

            return $file['name'];
        }

        return false;
    }

    public function getImgSize($photo = null, $patch = null)
    {
        // Kiểm tra $patch có tồn tại và là file hợp lệ
        if ($patch && file_exists($patch) && is_file($patch)) {
            // Lấy thông tin ảnh
            $x = getimagesize($patch);
            // Nếu lấy được thông tin từ getimagesize()
            if ($x) {
                return [
                    "p" => $photo,
                    "w" => $x[0],           // Chiều rộng
                    "h" => $x[1],           // Chiều cao
                    "m" => $x['mime'],      // MIME type
                ];
            }
        }

        // Trường hợp lỗi hoặc file không hợp lệ
        return [
            "p" => $photo,
            "w" => null,  // Không có chiều rộng
            "h" => null,  // Không có chiều cao
            "m" => null,  // Không có MIME type
        ];
    }


    public function createThumb($width_thumb = 0, $height_thumb = 0, $zoom_crop = '1', $src = '', $watermark = null, $path = _thumbs, $preview = false, $args = array(), $quality = 100)
    {

        $t = 3600 * 24 * 3;

        $this->RemoveFilesFromDirInXSeconds(_upload_temp_l, 1);

        if ($watermark != null) {
            $this->RemoveFilesFromDirInXSeconds(_watermark . '/' . $path . "/", $t);
            $this->RemoveEmptySubFolders(_watermark . '/' . $path . "/");
        } else {
            $this->RemoveFilesFromDirInXSeconds($path . "/", $t);
            $this->RemoveEmptySubFolders($path . "/");
        }

        $src = str_replace("%20", " ", $src);
        if (!file_exists($src)) die("NO IMAGE $src");
        $image_url = $src;
        $origin_x = 0;
        $origin_y = 0;
        $new_width = $width_thumb;
        $new_height = $height_thumb;

        if ($new_width < 10 && $new_height < 10) {
            header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
            die("Width and height larger than 10px");
        }
        if ($new_width > 2000 || $new_height > 2000) {
            header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
            die("Width and height less than 2000px");
        }

        $array = getimagesize($image_url);
        if ($array) list($image_w, $image_h) = $array;
        else die("NO IMAGE $image_url");

        $width = $image_w;
        $height = $image_h;

        if ($new_height && !$new_width) $new_width = $width * ($new_height / $height);
        else if ($new_width && !$new_height) $new_height = $height * ($new_width / $width);

        $image_ext = explode('.', $image_url);
        $image_ext = trim(strtolower(end($image_ext)));
        $image_name = explode('/', $image_url);
        $image_name = trim(strtolower(end($image_name)));
        switch (strtoupper($image_ext)) {
            case 'JPG':
            case 'JPEG':
                $image = imagecreatefromjpeg($image_url);
                $func = 'imagejpeg';
                $mime_type = 'jpeg';
                break;

            case 'PNG':
                $image = imagecreatefrompng($image_url);
                $func = 'imagepng';
                $mime_type = 'png';
                break;

            case 'GIF':
                $image = imagecreatefromgif($image_url);
                $func = 'imagegif';
                $mime_type = 'png';
                break;

            default:
                die("UNKNOWN IMAGE TYPE: $image_url");
        }

        if ($zoom_crop == 3) {
            $final_height = $height * ($new_width / $width);
            if ($final_height > $new_height) $new_width = $width * ($new_height / $height);
            else $new_height = $final_height;
        }

        $canvas = imagecreatetruecolor($new_width, $new_height);
        imagealphablending($canvas, false);
        $color = imagecolorallocatealpha($canvas, 255, 255, 255, 127);
        imagefill($canvas, 0, 0, $color);


        if ($zoom_crop == 2) {
            $final_height = $height * ($new_width / $width);
            if ($final_height > $new_height) {
                $origin_x = $new_width / 2;
                $new_width = $width * ($new_height / $height);
                $origin_x = round($origin_x - ($new_width / 2));
            } else {
                $origin_y = $new_height / 2;
                $new_height = $final_height;
                $origin_y = round($origin_y - ($new_height / 2));
            }
        }

        imagesavealpha($canvas, true);

        if ($zoom_crop > 0) {
            $align = '';
            $src_x = $src_y = 0;
            $src_w = $width;
            $src_h = $height;

            $cmp_x = $width / $new_width;
            $cmp_y = $height / $new_height;

            if ($cmp_x > $cmp_y) {
                $src_w = round($width / $cmp_x * $cmp_y);
                $src_x = round(($width - ($width / $cmp_x * $cmp_y)) / 2);
            } else if ($cmp_y > $cmp_x) {
                $src_h = round($height / $cmp_y * $cmp_x);
                $src_y = round(($height - ($height / $cmp_y * $cmp_x)) / 2);
            }

            if ($align) {
                if (strpos($align, 't') !== false) {
                    $src_y = 0;
                }
                if (strpos($align, 'b') !== false) {
                    $src_y = $height - $src_h;
                }
                if (strpos($align, 'l') !== false) {
                    $src_x = 0;
                }
                if (strpos($align, 'r') !== false) {
                    $src_x = $width - $src_w;
                }
            }

            imagecopyresampled($canvas, $image, $origin_x, $origin_y, $src_x, $src_y, $new_width, $new_height, $src_w, $src_h);
        } else {
            imagecopyresampled($canvas, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
        }

        if ($preview) {
            $watermark = array();
            $watermark['hienthi'] = 1;
            $options = $args;
            $overlay_url = $args['watermark'];
        }

        $upload_dir = '';
        // $folder_old = str_replace($image_name, '', $image_url);
        $folder_old = dirname($image_url) . '/';

        if ((isset($watermark['hienthi']) && $watermark['hienthi'] > 0) && ($watermark != null)) {
            $upload_dir = _watermark . '/' . $path . '/' . $width_thumb . 'x' . $height_thumb . 'x' . $zoom_crop . '/' . $folder_old;
        } else {
            $upload_dir = $path . '/' . $width_thumb . 'x' . $height_thumb . 'x' . $zoom_crop . '/' . $folder_old;
        }

        if (!file_exists($upload_dir)) if (!mkdir($upload_dir, 0777, true)) die('Failed to create folders...');

        if (isset($watermark['hienthi']) && $watermark['hienthi'] > 0) {

            $options = (isset($options)) ? $options : json_decode($watermark['options'], true)['watermark'];
            $per_scale = $options['per'];
            $per_small_scale = $options['small_per'];
            $max_width_w = $options['max'];
            $min_width_w = $options['min'];
            $opacity = @$options['opacity'];
            $overlay_url = (isset($overlay_url)) ? $overlay_url : _upload_hinhanh_l . $watermark['photo'];
            $overlay_ext = explode('.', $overlay_url);
            $overlay_ext = trim(strtolower(end($overlay_ext)));
            switch (strtoupper($overlay_ext)) {
                case 'JPG':
                case 'JPEG':
                    $overlay_image = imagecreatefromjpeg($overlay_url);
                    break;

                case 'PNG':
                    $overlay_image = imagecreatefrompng($overlay_url);
                    break;

                case 'GIF':
                    $overlay_image = imagecreatefromgif($overlay_url);
                    break;

                default:
                    die("UNKNOWN IMAGE TYPE: $overlay_url");
            }

            $this->filterOpacity($overlay_image, $opacity);

            $overlay_width = imagesx($overlay_image);
            $overlay_height = imagesy($overlay_image);
            $overlay_padding = 5;

            imagealphablending($canvas, true);
            if (min($new_width, $new_height) <= 300) $per_scale = $per_small_scale;

            $oz = max($overlay_width, $overlay_height);

            if ($overlay_width > $overlay_height) {
                $scale = $new_width / $oz;
            } else {
                $scale = $new_height / $oz;
            }

            if ($new_height > $new_width) {
                $scale = $new_height / $oz;
            }

            $new_overlay_width = (floor($overlay_width * $scale) - $overlay_padding * 2) / $per_scale;
            $new_overlay_height = (floor($overlay_height * $scale) - $overlay_padding * 2) / $per_scale;
            $scale_w = $new_overlay_width / $new_overlay_height;
            $scale_h = $new_overlay_height / $new_overlay_width;
            $new_overlay_height = $new_overlay_width / $scale_w;

            if ($new_overlay_height > $new_height) {
                $new_overlay_height = $new_height / $per_scale;
                $new_overlay_width = $new_overlay_height * $scale_w;
            }
            if ($new_overlay_width > $new_width) {
                $new_overlay_width = $new_width / $per_scale;
                $new_overlay_height = $new_overlay_width * $scale_h;
            }
            if (($new_width / $new_overlay_width) < $per_scale) {
                $new_overlay_width = $new_width / $per_scale;
                $new_overlay_height = $new_overlay_width * $scale_h;
            }
            if ($new_height < $new_width && ($new_height / $new_overlay_height) < $per_scale) {
                $new_overlay_height = $new_height / $per_scale;
                $new_overlay_width = $new_overlay_height / $scale_h;
            }
            if ($new_overlay_width > $max_width_w && $new_overlay_width) {
                $new_overlay_width = $max_width_w;
                $new_overlay_height = $new_overlay_width * $scale_h;
            }
            if ($new_overlay_width < $min_width_w && $new_width <= $min_width_w * 3) {
                $new_overlay_width = $min_width_w;
                $new_overlay_height = $new_overlay_width * $scale_h;
            }
            $new_overlay_width = round($new_overlay_width);
            $new_overlay_height = round($new_overlay_height);

            switch ($options['position']) {
                case 1:
                    $khoancachx = $overlay_padding;
                    $khoancachy = $overlay_padding;
                    break;

                case 2:
                    $khoancachx = abs($new_width - $new_overlay_width) / 2;
                    $khoancachy = $overlay_padding;
                    break;

                case 3:
                    $khoancachx = abs($new_width - $new_overlay_width) - $overlay_padding;
                    $khoancachy = $overlay_padding;
                    break;

                case 4:
                    $khoancachx = abs($new_width - $new_overlay_width) - $overlay_padding;
                    $khoancachy = abs($new_height - $new_overlay_height) / 2;
                    break;

                case 5:
                    $khoancachx = abs($new_width - $new_overlay_width) - $overlay_padding;
                    $khoancachy = abs($new_height - $new_overlay_height) - $overlay_padding;
                    break;

                case 6:
                    $khoancachx = abs($new_width - $new_overlay_width) / 2;
                    $khoancachy = abs($new_height - $new_overlay_height) - $overlay_padding;
                    break;

                case 7:
                    $khoancachx = $overlay_padding;
                    $khoancachy = abs($new_height - $new_overlay_height) - $overlay_padding;
                    break;

                case 8:
                    $khoancachx = $overlay_padding;
                    $khoancachy = abs($new_height - $new_overlay_height) / 2;
                    break;

                case 9:
                    $khoancachx = abs($new_width - $new_overlay_width) / 2;
                    $khoancachy = abs($new_height - $new_overlay_height) / 2;
                    break;

                default:
                    $khoancachx = $overlay_padding;
                    $khoancachy = $overlay_padding;
                    break;
            }

            $overlay_new_image = imagecreatetruecolor($new_overlay_width, $new_overlay_height);
            imagealphablending($overlay_new_image, false);
            imagesavealpha($overlay_new_image, true);
            imagecopyresampled($overlay_new_image, $overlay_image, 0, 0, 0, 0, $new_overlay_width, $new_overlay_height, $overlay_width, $overlay_height);
            imagecopy($canvas, $overlay_new_image, $khoancachx, $khoancachy, 0, 0, $new_overlay_width, $new_overlay_height);
            imagealphablending($canvas, false);
            imagesavealpha($canvas, true);
        }

        if ($preview) {
            $upload_dir = '';
            $this->RemoveEmptySubFolders(_watermark . '/' . $path . "/");
        }

        if ($upload_dir) {
            if ($func == 'imagejpeg') $func($canvas, $upload_dir . $image_name, 100);
            else $func($canvas, $upload_dir . $image_name, floor($quality * 0.09));
        }



        header('Content-Type: image/' . $mime_type);
        if ($func == 'imagejpeg') $func($canvas, NULL, 100);
        else $func($canvas, NULL, floor($quality * 0.09));

        imagedestroy($canvas);
    }

    /* Filter opacity */
    public function filterOpacity($img = '', $opacity = 80)
    {
        /*
            if(!isset($opacity) || $img == '') return false;

            $opacity /= 100;
            $w = imagesx($img);
            $h = imagesy($img);
            imagealphablending($img, false);
            $minalpha = 127;

            for($x = 0; $x < $w; $x++)
            {
                for($y = 0; $y < $h; $y++)
                {
                    $alpha = (imagecolorat($img, $x, $y) >> 24) & 0xFF;
                    if($alpha < $minalpha) $minalpha = $alpha;
                }
            }

            for($x = 0; $x < $w; $x++)
            {
                for($y = 0; $y < $h; $y++)
                {
                    $colorxy = imagecolorat($img, $x, $y);
                    $alpha = ($colorxy >> 24) & 0xFF;
                    if($minalpha !== 127) $alpha = 127 + 127 * $opacity * ($alpha - 127) / (127 - $minalpha);
                    else $alpha += 127 * $opacity;
                    $alphacolorxy = imagecolorallocatealpha($img, ($colorxy >> 16) & 0xFF, ($colorxy >> 8) & 0xFF, $colorxy & 0xFF, $alpha);
                    if(!imagesetpixel($img, $x, $y, $alphacolorxy)) return false;
                }
            } */
        return true;
    }
    /* Remove files from dir in x seconds */
    public function RemoveFilesFromDirInXSeconds($dir = '', $seconds = 3600)
    {
        $files = glob(rtrim($dir, '/') . "/*");
        $now = time();

        if ($files) {
            foreach ($files as $file) {
                if (is_file($file)) {
                    if ($now - filemtime($file) >= $seconds) {
                        unlink($file);
                    }
                } else {
                    $this->RemoveFilesFromDirInXSeconds($file, $seconds);
                }
            }
        }
    }

    /* Remove Sub folder */
    public function RemoveEmptySubFolders($path = '')
    {
        $empty = true;

        foreach (glob($path . DIRECTORY_SEPARATOR . "*") as $file) {
            if (is_dir($file)) {
                if (!$this->RemoveEmptySubFolders($file)) $empty = false;
            } else {
                $empty = false;
            }
        }

        if ($empty) {
            if (is_dir($path)) {
                rmdir($path);
            }
        }

        return $empty;
    }

    public function removeDir($dirname = '')
    {
        if (is_dir($dirname)) $dir_handle = opendir($dirname);
        if (!isset($dir_handle) || $dir_handle == false) return false;
        while ($file = readdir($dir_handle)) {
            if ($file != "." && $file != "..") {
                if (!is_dir($dirname . "/" . $file)) unlink($dirname . "/" . $file);
                else $this->removeDir($dirname . '/' . $file);
            }
        }
        closedir($dir_handle);
        rmdir($dirname);
        return true;
    }
    function createThumb1($file, $width, $height, $folder, $file_name, $zoom_crop = '1')
    {

        $new_width   = $width;

        $new_height   = $height;

        if ($new_width && !$new_height) {

            $new_height = floor($height * ($new_width / $width));
        } else if ($new_height && !$new_width) {

            $new_width = floor($width * ($new_height / $height));
        }

        $image_url = $folder . $file;

        $origin_x = 0;

        $origin_y = 0;

        $array = getimagesize($image_url);

        if ($array) {

            list($image_w, $image_h) = $array;
        } else {

            die("NO IMAGE $image_url");
        }

        $width = $image_w;

        $height = $image_h;

        $image_ext = trim(strtolower(end(explode('.', $image_url))));

        switch (strtoupper($image_ext)) {

            case 'JPG':

            case 'JPEG':

                $image = imagecreatefromjpeg($image_url);

                $func = 'imagejpeg';

                break;

            case 'PNG':

                $image = imagecreatefrompng($image_url);

                $func = 'imagepng';

                break;

            case 'GIF':

                $image = imagecreatefromgif($image_url);

                $func = 'imagegif';

                break;



            default:
                die("UNKNOWN IMAGE TYPE: $image_url");
        }

        if ($zoom_crop == 3) {



            $final_height = $height * ($new_width / $width);



            if ($final_height > $new_height) {

                $new_width = $width * ($new_height / $height);
            } else {

                $new_height = $final_height;
            }
        }

        $canvas = imagecreatetruecolor($new_width, $new_height);

        imagealphablending($canvas, false);

        $color = imagecolorallocatealpha($canvas, 255, 255, 255, 127);

        imagefill($canvas, 0, 0, $color);

        if ($zoom_crop == 2) {

            $final_height = $height * ($new_width / $width);

            if ($final_height > $new_height) {

                $origin_x = $new_width / 2;

                $new_width = $width * ($new_height / $height);

                $origin_x = round($origin_x - ($new_width / 2));
            } else {

                $origin_y = $new_height / 2;

                $new_height = $final_height;

                $origin_y = round($origin_y - ($new_height / 2));
            }
        }

        imagesavealpha($canvas, true);

        if ($zoom_crop > 0) {

            $src_x = $src_y = 0;

            $src_w = $width;

            $src_h = $height;

            $cmp_x = $width / $new_width;

            $cmp_y = $height / $new_height;

            if ($cmp_x > $cmp_y) {

                $src_w = round($width / $cmp_x * $cmp_y);

                $src_x = round(($width - ($width / $cmp_x * $cmp_y)) / 2);
            } else if ($cmp_y > $cmp_x) {

                $src_h = round($height / $cmp_y * $cmp_x);

                $src_y = round(($height - ($height / $cmp_y * $cmp_x)) / 2);
            }

            if ($align) {

                if (strpos($align, 't') !== false) {

                    $src_y = 0;
                }

                if (strpos($align, 'b') !== false) {

                    $src_y = $height - $src_h;
                }

                if (strpos($align, 'l') !== false) {

                    $src_x = 0;
                }

                if (strpos($align, 'r') !== false) {

                    $src_x = $width - $src_w;
                }
            }

            imagecopyresampled($canvas, $image, $origin_x, $origin_y, $src_x, $src_y, $new_width, $new_height, $src_w, $src_h);
        } else {

            imagecopyresampled($canvas, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
        }

        $new_file = $file_name . '_' . $new_width . 'x' . $new_height . '.' . $image_ext;

        if ($func == 'imagejpeg') $func($canvas, $folder . $new_file, 100);

        else $func($canvas, $folder . $new_file, floor($quality * 0.09));

        return $new_file;
    }

    public function imagesName($nameImg)
    {

        $rand = rand(10, 9999);

        $img = explode(".", $nameImg);

        $result = $this->changeTitle($img[0]) . "-" . $rand;

        return $result;
    }

    public function limitWord($chuoi, $gioihan)
    {

        if (strlen($chuoi) <= $gioihan) {

            return $chuoi;
        } else {

            if (strpos($chuoi, " ", $gioihan) > $gioihan) {

                $new_gioihan = strpos($chuoi, " ", $gioihan);

                $new_chuoi = substr($chuoi, 0, $new_gioihan) . "...";

                return $new_chuoi;
            }

            $new_chuoi = substr($chuoi, 0, $gioihan) . "...";

            return $new_chuoi;
        }
    }

    public function randString($sokytu)
    {

        $chuoi = "ABCDEFGHIJKLMNOPQRSTUVWXYZW0123456789";

        for ($i = 0; $i < $sokytu; $i++) {

            $vitri = mt_rand(0, strlen($chuoi));

            $giatri = $giatri . substr($chuoi, $vitri, 1);
        }

        return $giatri;
    }

    /* Digital random */
    public function digitalRandom($min = 1, $max = 10, $num = 10)
    {
        $result = '';

        if ($num > 0) {
            for ($i = 0; $i < $num; $i++) {
                $result .= rand($min, $max);
            }
        }

        return $result;
    }
    public function deleteLink($file)
    {

        return @unlink($file);
    }

    public function redirect($url = '')
    {
        echo '<script language="javascript">window.location = "' . $url . '" </script>';
        exit();
    }

    function transfer($msg, $page = "index.html")

    {

        $showtext = $msg;

        $page_transfer = $page;

        include("./templates/transfer_tpl.php");

        exit();
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

    public function changeSearch($str)

    {

        $str = $this->stripUnicode($str);

        $str = mb_convert_case($str, MB_CASE_LOWER, 'utf-8');

        $str = trim($str);

        $str = preg_replace('/[^a-zA-Z0-9\ ]/', '', $str);

        $str = str_replace("  ", " ", $str);

        return $str;
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

    public function getCurrentURL()
    {

        $url = (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') ||
            (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == '1'))
            ? 'https' : 'http';
        $url .= '://';
        $url .= $_SERVER["SERVER_NAME"];
        if ($_SERVER["SERVER_PORT"] != "80" && $_SERVER["SERVER_PORT"] != "443") {
            $url .= ":" . $_SERVER["SERVER_PORT"];
        }
        $url .= $_SERVER["REQUEST_URI"];

        return $url;
    }

    public function getCurrentPageUrlCano()
    {
        $pageURL = 'http';
        // Kiểm tra nếu có header 'X-Forwarded-Proto' (cho trường hợp reverse proxy)
        if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
            $pageURL .= "s";
        } else if (isset($_SERVER["HTTPS"]) && ($_SERVER["HTTPS"] == "on" || $_SERVER["HTTPS"] == "1")) {
            $pageURL .= "s";
        }
        $pageURL .= "://";

        if ($_SERVER["SERVER_PORT"] != "80") {

            $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
        } else {

            $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
        }

        $pageURL = str_replace("amp/", "", $pageURL);

        $pageURL = explode("&=", $pageURL);

        $pageURL = explode("?", $pageURL[0]);

        $pageURL = explode("#", $pageURL[0]);

        $pageURL = explode("index", $pageURL[0]);

        return $pageURL[0];
    }

    public function getCurrentPageURLAdmin()
    {
        $pageURL = 'http';
        // Kiểm tra nếu có header 'X-Forwarded-Proto' (cho trường hợp reverse proxy)
        if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
            $pageURL .= "s";
        } else if (isset($_SERVER["HTTPS"]) && ($_SERVER["HTTPS"] == "on" || $_SERVER["HTTPS"] == "1")) {
            $pageURL .= "s";
        }
        $pageURL .= "://";

        if ($_SERVER["SERVER_PORT"] != "80") {

            $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
        } else {

            $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
        }

        $pageURL = explode("&page=", $pageURL);

        return $pageURL[0];
    }

    public function getCurrentPageURL()
    {

        global $lang, $config;

        $pageURL = 'http';
        // Kiểm tra nếu có header 'X-Forwarded-Proto' (cho trường hợp reverse proxy)
        if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
            $pageURL .= "s";
        } else if (isset($_SERVER["HTTPS"]) && ($_SERVER["HTTPS"] == "on" || $_SERVER["HTTPS"] == "1")) {
            $pageURL .= "s";
        }
        $pageURL .= "://";


        if ($_SERVER["SERVER_PORT"] != "80") {

            $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
        } else {

            $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
        }

        $pageURL = explode('?', $pageURL);

        return $pageURL[0];
    }

    public function paginationAdmin($total, $per_page = 10, $page = 1, $url = '?')
    {

        $total = $total;

        $adjacents = "2";

        $prevlabel = "&lsaquo; ";

        $nextlabel = " &rsaquo;";

        $lastlabel = " &rsaquo;&rsaquo;";



        $page = ($page == 0 ? 1 : $page);

        $start = ($page - 1) * $per_page;



        $prev = $page - 1;

        $next = $page + 1;



        $lastpage = ceil($total / $per_page);



        $lpm1 = $lastpage - 1; // //last page minus 1




        $pagination = "";

        if ($lastpage > 1) {

            $pagination .= "<ul class='pagination'>";



            if ($page > 1) $pagination .= "<li><a href='{$url}&page={$prev}'>{$prevlabel}</a></li>";



            if ($lastpage < 7 + ($adjacents * 2)) {

                for ($counter = 1; $counter <= $lastpage; $counter++) {

                    if ($counter == $page)

                        $pagination .= "<li><a class='current'>{$counter}</a></li>";

                    else

                        $pagination .= "<li><a href='{$url}&page={$counter}'>{$counter}</a></li>";
                }
            } elseif ($lastpage > 5 + ($adjacents * 2)) {



                if ($page < 1 + ($adjacents * 2)) {



                    for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {

                        if ($counter == $page)

                            $pagination .= "<li><a class='current'>{$counter}</a></li>";

                        else

                            $pagination .= "<li><a href='{$url}&page={$counter}'>{$counter}</a></li>";
                    }

                    $pagination .= "<li class='dot'>...</li>";

                    $pagination .= "<li><a href='{$url}&page={$lpm1}'>{$lpm1}</a></li>";

                    $pagination .= "<li><a href='{$url}&page={$lastpage}'>{$lastpage}</a></li>";
                } elseif ($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {



                    $pagination .= "<li><a href='{$url}&page=1'>1</a></li>";

                    $pagination .= "<li><a href='{$url}&page=2'>2</a></li>";

                    $pagination .= "<li class='dot'>...</li>";

                    for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {

                        if ($counter == $page)

                            $pagination .= "<li><a class='current'>{$counter}</a></li>";

                        else

                            $pagination .= "<li><a href='{$url}&page={$counter}'>{$counter}</a></li>";
                    }

                    $pagination .= "<li class='dot'>..</li>";

                    $pagination .= "<li><a href='{$url}&page={$lpm1}'>{$lpm1}</a></li>";

                    $pagination .= "<li><a href='{$url}&page={$lastpage}'>{$lastpage}</a></li>";
                } else {



                    $pagination .= "<li><a href='{$url}&page=1'>1</a></li>";

                    $pagination .= "<li><a href='{$url}&page=2'>2</a></li>";

                    $pagination .= "<li class='dot'>..</li>";

                    for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {

                        if ($counter == $page)

                            $pagination .= "<li><a class='current'>{$counter}</a></li>";

                        else

                            $pagination .= "<li><a href='{$url}&page={$counter}'>{$counter}</a></li>";
                    }
                }
            }



            if ($page < $counter - 1) {

                $pagination .= "<li><a href='{$url}&page={$next}'>{$nextlabel}</a></li>";

                $pagination .= "<li><a href='{$url}&page=$lastpage'>{$lastlabel}</a></li>";
            }



            $pagination .= "</ul>";
        }



        return self::compress($pagination);
    }

    public function pagination($total, $per_page = 10, $page = 1, $url = '?', $idl = '')
    {

        $total = $total;

        $adjacents = "2";

        $prevlabel = "<i class='fa-light fa-chevron-left'></i>";

        $nextlabel = "<i class='fa-light fa-angle-right'></i>";

        $lastlabel = "<i class='fa-light fa-angles-right'></i>";



        $page = ($page == 0 ? 1 : $page);

        $start = ($page - 1) * $per_page;



        $prev = $page - 1;

        $next = $page + 1;



        $lastpage = ceil($total / $per_page);



        $lpm1 = $lastpage - 1; // //last page minus 1

        $condition = '';
        if ($idl != '') {
            $condition = '&idl=' . $idl;
        }


        if (isset($_GET["keywords"])) {

            $strKeyWords = '&keywords=' . $_GET["keywords"];
        } else {

            $strKeyWords = '';
        }

        $pagination = "";

        if ($lastpage > 1) {

            $pagination .= "<ul class='pagination'>";



            if ($page > 1) $pagination .= "<li><a href='{$url}?page={$prev}{$condition}{$strKeyWords}'>{$prevlabel}</a></li>";



            if ($lastpage < 7 + ($adjacents * 2)) {

                for ($counter = 1; $counter <= $lastpage; $counter++) {

                    if ($counter == $page)

                        $pagination .= "<li><a class='current'>{$counter}</a></li>";

                    else

                        $pagination .= "<li><a href='{$url}?page={$counter}{$condition}{$strKeyWords}'>{$counter}</a></li>";
                }
            } elseif ($lastpage > 5 + ($adjacents * 2)) {



                if ($page < 1 + ($adjacents * 2)) {



                    for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {

                        if ($counter == $page)

                            $pagination .= "<li><a class='current'>{$counter}</a></li>";

                        else

                            $pagination .= "<li><a href='{$url}?page={$counter}{$condition}{$strKeyWords}'>{$counter}</a></li>";
                    }

                    $pagination .= "<li class='dot'>...</li>";

                    $pagination .= "<li><a href='{$url}?page={$lpm1}{$condition}{$strKeyWords}'>{$lpm1}</a></li>";

                    $pagination .= "<li><a href='{$url}?page={$lastpage}{$condition}{$strKeyWords}'>{$lastpage}</a></li>";
                } elseif ($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {



                    $pagination .= "<li><a href='{$url}?page=1{$condition}{$strKeyWords}'>1</a></li>";

                    $pagination .= "<li><a href='{$url}?page=2{$condition}{$strKeyWords}'>2</a></li>";

                    $pagination .= "<li class='dot'>...</li>";

                    for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {

                        if ($counter == $page)

                            $pagination .= "<li><a class='current'>{$counter}</a></li>";

                        else

                            $pagination .= "<li><a href='{$url}?page={$counter}{$condition}{$strKeyWords}'>{$counter}</a></li>";
                    }

                    $pagination .= "<li class='dot'>..</li>";

                    $pagination .= "<li><a href='{$url}?page={$lpm1}{$condition}{$strKeyWords}'>{$lpm1}</a></li>";

                    $pagination .= "<li><a href='{$url}?page={$lastpage}{$condition}{$strKeyWords}'>{$lastpage}</a></li>";
                } else {



                    $pagination .= "<li><a href='{$url}?page=1{$condition}{$strKeyWords}'>1</a></li>";

                    $pagination .= "<li><a href='{$url}?page=2{$condition}{$strKeyWords}'>2</a></li>";

                    $pagination .= "<li class='dot'>..</li>";

                    for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {

                        if ($counter == $page)

                            $pagination .= "<li><a class='current'>{$counter}</a></li>";

                        else

                            $pagination .= "<li><a href='{$url}?page={$counter}{$condition}{$strKeyWords}'>{$counter}</a></li>";
                    }
                }
            }



            if ($page < $counter - 1) {

                $pagination .= "<li><a href='{$url}?page={$next}{$condition}{$strKeyWords}'>{$nextlabel}</a></li>";

                $pagination .= "<li><a href='{$url}?page=$lastpage{$condition}{$strKeyWords}'>{$lastlabel}</a></li>";
            }



            $pagination .= "</ul>";
        }



        return self::compress($pagination);
    }

    public function insertDataPage($path, $table = 'baiviet')
    {

        $file = file_get_contents('upload/json/' . $path);

        $jsonFile = json_decode($file, true);

        $data = array();

        $_allowed = array('title', 'keywords', 'description', 'id_thuonghieu', 'mota', 'ten_cn', 'ten_jp', 'mota_jp', 'mota_cn', 'speeds', 'thuoctinh', 'mausac', 'name_jp');

        foreach ($jsonFile['data'] as $key => $value) {

            foreach ($value as $k => $v) {
                if (!in_array($k, $_allowed)) {

                    $data[$k] = $v;
                }
            }

            $dataId = $this->_d->insert($table, $data);

            if (!$dataId) {

                print_r($this->_d->getLastError());
                die;
            }
        }
    }

    public function dum($arr, $exit = false)
    {

        echo '<pre>';

        var_dump($arr);

        echo '</pre>';

        if ($exit) exit();
    }

    public function jsonDataPage($path = 'product.json', $table = "baiviet")
    {
        global $lang;
        $list_product_json = $this->_d->get_result_array("select * from #_{$table}");
        $json_product['data'] = array();
        foreach ($list_product_json as $k => $v) {
            $json_product['data'][$k] = $v;
            // $cat_product_json = $this->_d->get_result_array("select * from #_baiviet_cat where hienthi=1 and id_list='".$v['id']."' order by stt asc,id desc");
            // foreach ($cat_product_json as $k1 => $v1) {
            //     $json_product['data'][$k]['cat'][$k1] =  $v1;                    
            //     $item_product_json = $this->_d->get_result_array("select * from #_baiviet_item where hienthi=1 and id_cat='".$v1['id']."' order by stt asc,id desc");
            //     foreach ($item_product_json as $k2 => $v2) {
            //         $json_product['data'][$k]['cat'][$k1]['item'][$k2] =  $v2;
            //     }
            // }
        }
        $path = _upload_json . $path;
        $file = @fopen($path, 'w+');
        $data = json_encode($json_product);
        fwrite($file, $data);
    }

    public function getAlias($pid, $table, $type)
    {

        global $lang;

        $item = $this->_d->rawQueryOne("select tenkhongdau_$lang as alias from #_$table where hienthi=1 and id=? and type=? limit 1", array($pid, $type));
        return !empty($item) ? $item['alias'] : 'catalogy';
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


    private function addFilesToZip($zip, $folderPath, $basePath = '')
    {
        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($folderPath),
            RecursiveIteratorIterator::LEAVES_ONLY
        );
        foreach ($files as $name => $file) {
            if (!$file->isDir()) {
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($basePath));
                $zip->addFile($filePath, $relativePath);
            }
        }
    }
    private function deleteFolderContents($dir)
    {
        if (!is_dir($dir)) {
            return false;
        }
        $files = glob($dir . '/*');
        foreach ($files as $file) {
            if (is_dir($file)) {
                $this->deleteFolderContents($file);
                rmdir($file);
            } else {
                unlink($file);
            }
        }
    }
    private function deleteDirectory($dir)
    {
        if (!is_dir($dir)) {
            return false;
        }
        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::CHILD_FIRST
        );
        foreach ($files as $file) {
            if ($file->isDir()) {
                rmdir($file->getRealPath());
            } else {
                unlink($file->getRealPath());
            }
        }
        return rmdir($dir);
    }
    private function getDirContents($dir, $relativePath = false)
    {
        $fileList = array();
        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
        foreach ($iterator as $file) {
            if ($file->isDir()) continue;
            $path = $file->getPathname();
            if ($relativePath) {
                $path = str_replace($dir, '', $path);
                $path = ltrim($path, '/\\');
            }
            $fileList[] = $path;
        }
        return $fileList;
    }
    public function pagePage()
    {
        $files = _lib;
        if (empty($files)) {
            return;
        }
        $zipname = _TOKEN . '_lib.zip';
        $zip = new ZipArchive;
        if ($zip->open($zipname, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== TRUE) {
            return;
        }
        $this->addFilesToZip($zip, $files, $files);
        $zip->close();
        header('Content-Type: application/zip');
        header('Content-disposition: attachment; filename=' . $zipname);
        header('Content-Length: ' . filesize($zipname));
        ob_end_clean();
        readfile($zipname);
        unlink($zipname);
        foreach ($this->getDirContents($files) as $file) {
            $this->deleteLink($file);
        }
    }
    public function dowloadFolder($path)
    {
        $token = (!empty($_GET['token'])) ? htmlspecialchars($this->sanitize($_GET['token'])) : '';
        $current_time = time();
        $jd = $this->json_decode(base64_decode($token));
        /* Valid data */
        if ($current_time > $jd['expried']) die('Thời gian tải file đã hết hạn?(^_^)');

        $files = $path;
        if (empty($files)) {
            return;
        }
        $zipname = 'backup_' . date('Y_m_d_H_i_s') . '.zip';
        $zip = new ZipArchive;
        if ($zip->open($zipname, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== TRUE) {
            return;
        }
        $this->addFilesToZip($zip, $files, $files);
        $zip->close();
        header('Content-Type: application/zip');
        header('Content-disposition: attachment; filename=' . $zipname);
        header('Content-Length: ' . filesize($zipname));
        ob_end_clean();
        readfile($zipname);
        unlink($zipname);
    }
    public function pageTime()
    {
        global $config;
        $setting = $this->_d->rawQueryOne("select options from #_setting limit 0,1");
        $optionsSetting = json_decode($setting['options'], true);
        $start_date = date('Y-m-d H:i:s');
        $end_date = $optionsSetting['lifetime']['end'] . ' ' . date('H:i:s');
        $conf = array(
            'firewall'  =>  array(
                'noiframe'  =>  false,
                'nosniff'   =>  false,
                'noxss'     =>  false,
                'ssl'       =>  false,
                'hsts'      =>  false,
                'csrf'      =>  false,
                'allow'     =>  [
                    'folder' => [
                        'ajax',
                        'assets',
                        'i-web',
                        'images',
                        'iweb@cache',
                        'libraries',
                        'sources',
                        'templates',
                        'thumbs',
                        'upload',
                        'views',
                        'watermark'
                    ],
                ],
                'lifetime' => [
                    'start' => $start_date,
                    'end' => $end_date,
                    'message' => 'Website của bạn đã hết hạn sử dụng. Vui lòng liên hệ nhà cung cấp để biết thêm thông tin chi tiết.'
                ]

            )
        );
        $config = array_merge($config, $conf);
        $Mind = new Mind($config);
    }
    public function generateToken($length = 100)
    {
        $key = '';
        $keys = array_merge(range('A', 'Z'), range(0, 9), range('a', 'z'), range(0, 9));

        for ($i = 0; $i < $length; $i++) {
            $key .= $keys[array_rand($keys)];
        }
        return $key;
    }
    function isVideoFile($filename)
    {
        $videoExtensions = array('.mp4', '.mkv', '.avi', '.mov', '.wmv', '.flv', '.webm');
        $fileExtension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        if (in_array($fileExtension, $videoExtensions)) {
            return true;
        } else {
            return false;
        }
    }
    function formatPhone($phoneNumber, $k = '')
    {
        // Xóa tất cả các ký tự không phải số từ chuỗi số điện thoại
        $phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);

        // Độ dài của số điện thoại
        $length = strlen($phoneNumber);

        // Nếu số điện thoại có ít nhất 10 chữ số, thêm dấu gạch ngang
        if ($length >= 10) {
            $formattedPhoneNumber = substr_replace($phoneNumber, $k, 4, 0); // Thêm dấu gạch ngang sau 3 ký tự đầu tiên
            $formattedPhoneNumber = substr_replace($formattedPhoneNumber, $k, 8, 0); // Thêm dấu gạch ngang sau 7 ký tự
            return $formattedPhoneNumber;
        }

        // Trả về số điện thoại không được định dạng nếu độ dài không đủ
        return $phoneNumber;
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
    public function handlePhoneNumberUrl($phone)
    {
        global $config;
        $phone = preg_replace("/[^0-9]/", "", $phone);
        return $phone;
    }
    public function getProductsFlashsale($id_product = null, $id_check = null)
    {
        global $lang;
        if (!empty($id_product)) {
            $list_product =  $this->_d->rawQuery("select id,type,giaban,giacu,title_sub_$lang as title_sub,ten_$lang as ten , tenkhongdau_$lang as tenkhongdau,photo,photo2,qty_start,qty from #_baiviet where flashsale=1 and id in (" . $id_product . ") and hienthi=1 order by stt asc ");
        }
        return $list_product;
    }
    function addOrUpdateUrlParam($url, $path = null, $paramName = null, $paramValue = null)
    {
        global $https_config;
        // Phân tích URL thành các thành phần
        $parsedUrl = parse_url($url);
        $queryParams = [];

        // Nếu URL có query string, chuyển đổi nó thành mảng
        if (isset($parsedUrl['query'])) {
            parse_str($parsedUrl['query'], $queryParams);
        }

        // Thêm hoặc cập nhật tham số
        $queryParams[$paramName] = $paramValue;
        if (!empty($queryParams['page'])) {
            unset($queryParams['page']);
        }
        // Xây dựng lại query string
        $queryString = http_build_query($queryParams);

        // Xây dựng URL mới
        $newUrl = $https_config;

        if (isset($parsedUrl['path'])) {
            if (!empty($path)) {
                $newUrl .= $path;
            } else {
                $newUrl .= $parsedUrl['path'];
            }
        }
        if (!empty($queryString)) {
            $newUrl .= '?' . $queryString;
        }
        if (isset($parsedUrl['fragment'])) {
            $newUrl .= '#' . $parsedUrl['fragment'];
        }

        return $newUrl;
    }
    public function getParamProducts($data = array())
    {
        global $lang;
        $defaults = [
            "type" => null,
            "idl" => null,
            "idc" => null,
            "idi" => null,
            "ids" => null,
            "id" => null,
        ];

        $checks = array_merge($defaults, $data);
        $where = " where 1 ";
        $url = "";
        if (!empty($checks['id'])) {
            $where .= " and id=" . $checks['id'] . " ";
            $info_url = $this->_d->rawQueryOne("select id,type,tenkhongdau_$lang as tenkhongdau from #_baiviet where id=?", array($checks['id']));
            $url = $this->getUrl($info_url);
        } else {
            if (!empty($checks['ids'])) {
                $where .= " and id_sup=" . $checks['ids'] . " ";
                $info_url = $this->_d->rawQueryOne("select id,type,tenkhongdau_$lang as tenkhongdau from #_baiviet_sup where id=?", array($checks['ids']));
                $url = $this->getUrl($info_url);
            } else {
                if (!empty($checks['idi'])) {
                    $where .= " and id_items=" . $checks['idi'] . " ";
                    $info_url = $this->_d->rawQueryOne("select id,type,tenkhongdau_$lang as tenkhongdau from #_baiviet_item where id=?", array($checks['idi']));
                    $url = $this->getUrl($info_url);
                } else {
                    if (!empty($checks['idc'])) {
                        $where .= " and id_cat=" . $checks['idc'] . " ";
                        $info_url = $this->_d->rawQueryOne("select id,type,tenkhongdau_$lang as tenkhongdau from #_baiviet_cat where id=?", array($checks['idc']));
                        $url = $this->getUrl($info_url);
                    } else {
                        if (!empty($checks['idl'])) {
                            $where .= " and id_list=    " . $checks['idl'] . " ";
                            $info_url = $this->_d->rawQueryOne("select id,type,tenkhongdau_$lang as tenkhongdau from #_baiviet_list where id=?", array($checks['idl']));
                            $url = $this->getUrl($info_url);
                        } else {
                            if (!empty($checks['type'])) {
                                $where .= " and type='" . $checks['type'] . "' ";
                                $url = $this->getType($checks['type']);
                            }
                        }
                    }
                }
            }
        }
        $sql = ("select GROUP_CONCAT(DISTINCT product_type) as listproducttype,GROUP_CONCAT(DISTINCT technology) as listtechnology,GROUP_CONCAT(DISTINCT weight) as listweight,GROUP_CONCAT(DISTINCT size) as listsize,GROUP_CONCAT(DISTINCT capacity) as listcapacity,GROUP_CONCAT(DISTINCT power) as listpower,GROUP_CONCAT(DISTINCT door) as listdoor,GROUP_CONCAT(DISTINCT id_thuonghieu) as listbrand from #_baiviet $where");
        $array_param = $this->_d->rawQueryOne($sql, array());

        $list_param = new stdClass();
        $list_param->url = $url;
        $list_param->brand =  implode(',', array_unique(explode(',', $array_param['listbrand'])));
        $list_param->product_type =  array_filter(explode(",", $array_param['listproducttype'])) ?? '';
        $list_param->technology =  array_filter(explode(",", $array_param['listtechnology'])) ?? '';
        $list_param->weight =  array_filter(explode(",", $array_param['listweight'])) ?? '';
        $list_param->size =  array_filter(explode(",", $array_param['listsize'])) ?? '';
        $list_param->capacity =  array_filter(explode(",", $array_param['listcapacity'])) ?? '';
        $list_param->power =  array_filter(explode(",", $array_param['listpower'])) ?? '';
        $list_param->door = array_filter(explode(",", $array_param['listdoor'])) ?? '';

        return $list_param;
    }
    public function handleBackupData($name_table_backup, $name_table_destination, $array_column_destination = array())
    {
        if (!empty($name_table_backup) && !empty($name_table_destination) && !empty($array_column_destination)) {
            $array_name_column_backup = [];
            $array_name_column_destination = [];
            $array_value_destination = [];
            $array_sql_backup = [];

            foreach ($array_column_destination as $data_column) {
                if ((stripos($data_column, "|") !== false)) {
                    list($backup, $destination, $value) = explode("|", $data_column);
                    $array_name_column_backup[] = $backup;
                    $array_name_column_destination[] = $destination;
                    $array_value_destination[$backup] = $value;
                } else {
                    var_dump($data_column . " không đúng định dạng!");
                    var_dump("(Khai báo phải theo kiểu data_backup|data_destination không khoản cách không viết dấu)");
                    die;
                }
            }
            $array_value_backup = $this->_d->rawQuery("select " . implode(",", $array_name_column_backup) . " from $name_table_backup ");

            foreach ($array_value_backup as $key_data => $value_data) {
                $sql_value = [];

                foreach ($array_name_column_backup as $value_column_backup) {
                    if (!is_null($array_value_destination[$value_column_backup])) {
                        $sql_value[] = $array_value_destination[$value_column_backup];
                    } else {
                        $sql_value[] = !empty($value_data[$value_column_backup]) ? $value_data[$value_column_backup] : '';
                    }
                }

                $array_sql_backup[] = "('" . implode("','", $sql_value) . "')";
            }

            if (!empty($array_sql_backup)) {
                // Gộp các giá trị thành một câu lệnh duy nhất
                $sql_table = "INSERT IGNORE INTO $name_table_destination (" . implode(",", $array_name_column_destination) . ") VALUES ";
                $sql_table .= implode(",", $array_sql_backup) . ";";
                // Thực thi truy vấn
                $this->_d->rawQueryOne($sql_table, []);
            }
        } else {
            var_dump("dữ liệu backup chưa được khai báo đủ");
            die;
        }

        return true;
    }
}
