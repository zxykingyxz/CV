<?php

    class request{
        public $post    =   [];
        public $errors  =   [];
        public $db      =   null;
        public function __construct($db){
            $this->db = $db;
        }
        public function sw_get($param,$default = null){
            return isset($_GET[$param]) && !empty($_GET[$param]) ? $_GET[$param] : $default;
        }
        public function sw_post($param,$default = null,$nullString = true){
            if (isset($_POST[$parameter])) {
                if ($_POST[$parameter] == '') {
                    if ($nullString) {
                        return $_POST[$parameter];
                    } else {
                        return $default;
                    }
                } else {
                    if (is_array($_POST[$parameter])) {
                        return $_POST[$parameter];
                    } else {
                        return $_POST[$parameter];
                    }
                }
            } else {
                return $default;
            }
        }
        public function sw_any($param,$default = null){
            return sw_get($parameter, $default) ?: sw_post($parameter, $default);
        }

        public function validate($rule, $data, $message = array()){
            $extra = '';
            $limit = '';
            $rules = array();
            foreach($rule as $name => $value){
                if(strstr($value, '|')){
                    foreach(explode('|', trim($value, '|')) as $val){
                        $rules[$name][] = $val;
                    }
                } else {
                    $rules[$name][] = $value;
                }
            }
            foreach($rules as $column => $rule){
                foreach($rule as $name){
                    if(strstr($name, ':')){
                        $ruleData = explode(':', trim($name, ':'));
                        if(count($ruleData) == 2){
                            list($name, $extra) = $ruleData;
                        }
                        if(count($ruleData) == 3 AND $ruleData[0] != 'knownunique'){
                            list($name, $extra, $limit) = $ruleData;
                        }
                        if($ruleData[0] == 'knownunique'){
    
                            $name = $ruleData[0];
                            $extra = $ruleData[1];
    
                            if(count($ruleData) == 3){
                                $knownuniqueColumn = $column;                        
                                $knownuniqueValue = $ruleData[2];
                            }
    
                            if(count($ruleData) > 3){
                                $knownuniqueColumn = $ruleData[2]; 
                                $knownuniqueValue = implode(':', array_slice($ruleData, ($this->is_column($ruleData[1], $ruleData[2]) ? 3 : 2)));
                            }
                        }
                        
                        if(count($ruleData) > 2 AND strstr($name, ' ') AND $ruleData[0] != 'knownunique'){
                            $x = explode(' ', $name);
                            list($left, $right) = explode(' ', $name);
                            list($name, $date1) = explode(':', $left);
                            $extra = $date1.' '.$right;
                        }
                    }
                    $data[$column] = (isset($data[$column])) ? $data[$column] : '';
                    if(empty($message[$column][$name])){
                        $message[$column][$name] = $name;
                    }
                    switch ($name) {
                        case 'min-num':
                            if(!is_numeric($data[$column])){
                                $this->errors[$column][$name] = $message[$column][$name];
                            } else {
                                if($data[$column]<$extra){
                                    $this->errors[$column][$name] = $message[$column][$name];
                                }
                            }
                        break;

                        case 'max-num':
                            if(!is_numeric($data[$column])){
                                $this->errors[$column][$name] = $message[$column][$name];
                            } else {
                                if($data[$column]>$extra){
                                    $this->errors[$column][$name] = $message[$column][$name];
                                }
                            }
                        break;
      
                        case 'min-char':
                            if(strlen($data[$column])<$extra){
                                $this->errors[$column][$name] = $message[$column][$name];
                            }
                            break;
                        case 'max-char':
                            if(strlen($data[$column])>$extra){
                                $this->errors[$column][$name] = $message[$column][$name];
                            }
                            break;
                        case 'email':
                            if(!$this->is_email($data[$column])){
                                $this->errors[$column][$name] = $message[$column][$name];
                            }
                        break;
                        case 'required':
                            if(!isset($data[$column])){
                                $this->errors[$column][$name] = $message[$column][$name];
                            } else {
                                if($data[$column] === ''){
                                    $this->errors[$column][$name] = $message[$column][$name];
                                }
                            }
                            
                        break;
                        case 'phone':
                            if(!$this->is_phone($data[$column])){
                                $this->errors[$column][$name] = $message[$column][$name];
                            }
                        break;
                        case 'date':
                            if(empty($extra)){
                                $extra = 'Y-m-d';
                            }
                            if(!$this->is_date($data[$column], $extra)){
                                $this->errors[$column][$name] = $message[$column][$name];
                            }
                        break;
                        case 'json':
                            if(!$this->is_json($data[$column])){
                                $this->errors[$column][$name] = $message[$column][$name];
                            }
                        break;
                        case 'color':
                            if(!$this->is_color($data[$column])){
                                $this->errors[$column][$name] = $message[$column][$name];
                            }
                        break;
                        case 'url':
                            if(!$this->is_url($data[$column])){
                                $this->errors[$column][$name] = $message[$column][$name];
                            }
                        break;
                        case 'https':
                            if(!$this->is_https($data[$column])){
                                $this->errors[$column][$name] = $message[$column][$name];
                            }
                        break;
                        case 'http':
                            if(!$this->is_http($data[$column])){
                                $this->errors[$column][$name] = $message[$column][$name];
                            }
                        break;
                        case 'numeric':
                            if(!is_numeric($data[$column])){
                                $this->errors[$column][$name] = $message[$column][$name];
                            }
                        break;
                        case 'min-age':
                            if(!$this->is_age($data[$column], $extra)){
                                $this->errors[$column][$name] = $message[$column][$name];
                            }
                        break;
                        case 'max-age':
                            if(!$this->is_age($data[$column], $extra, 'max')){
                                $this->errors[$column][$name] = $message[$column][$name];
                            }
                        break;
                        case 'bool':
                            $acceptable = array(true, false, 'true', 'false', 0, 1, '0', '1');
                            $wrongTypeMessage = 'True, false, 0 or 1 must be specified.';
                            if(isset($extra)){
                                if($extra === ''){
                                    unset($extra);
                                }
                                
                            }
                            if(isset($data[$column]) AND isset($extra)){
                                if(in_array($data[$column], $acceptable, true) AND in_array($extra, $acceptable, true)){
                                    if($data[$column] === 'true' OR $data[$column] === '1' OR $data[$column] === 1){
                                        $data[$column] = true;
                                    }
                                    if($data[$column] === 'false' OR $data[$column] === '0' OR $data[$column] === 0){
                                        $data[$column] = false;
                                    }
        
                                    if($extra === 'true' OR $extra === '1' OR $extra === 1){
                                        $extra = true;
                                    }
                                    if($extra === 'false' OR $extra === '0' OR $extra === 0){
                                        $extra = false;
                                    }
        
                                    if($data[$column] !== $extra){
                                        $this->errors[$column][$name] = $message[$column][$name];
                                    }
                                    
                                } else {
                                    $this->errors[$column][$name] = $message[$column][$name];
                                }
                            } 
    
                            if(isset($data[$column]) AND !isset($extra)){
                                if(!in_array($data[$column], $acceptable, true)){
                                    $this->errors[$column][$name] = $message[$column][$name];
                                }
                            }
    
                            if(!isset($data[$column]) AND isset($extra)){
                                if(!in_array($extra, $acceptable, true)){
                                    $this->errors[$column][$name] = $message[$column][$name];
                                }
                            }
    
                            break;
                        case 'iban':
                            if(!$this->is_iban($data[$column])){
                                $this->errors[$column][$name] = $message[$column][$name];
                            }
                        break;
                        case 'ipv4':
                            if(!$this->is_ipv4($data[$column])){
                                $this->errors[$column][$name] = $message[$column][$name];
                            }
                        break;
                        case 'ipv6':
                            if(!$this->is_ipv6($data[$column])){
                                $this->errors[$column][$name] = $message[$column][$name];
                            }
                        break;
                        case 'blood':
                            if(!empty($extra)){
                                if(!$this->is_blood($data[$column], $extra)){
                                    $this->errors[$column][$name] = $message[$column][$name];
                                }
                            } else {
                                if(!$this->is_blood($data[$column])){
                                    $this->errors[$column][$name] = $message[$column][$name];
                                }
                            }
                        break;
                        case 'coordinate':
    
                            if(!strstr($data[$column], ',')){
                                $this->errors[$column][$name] = $message[$column][$name];
                            } else {
    
                                $coordinates = explode(',', $data[$column]);
                                if(count($coordinates)==2){
    
                                    list($lat, $long) = $coordinates;
    
                                    if(!$this->is_coordinate($lat, $long)){
                                        $this->errors[$column][$name] = $message[$column][$name];
                                    }
    
                                } else {
                                    $this->errors[$column][$name] = $message[$column][$name];
                                }
    
                            }
    
                        break;
                        case 'distance':
                            if(strstr($data[$column], '@')){
                                $coordinates = explode('@', $data[$column]);
                                if(count($coordinates) == 2){
    
                                    list($p1, $p2) = $coordinates;
                                    $point1 = explode(',', $p1);
                                    $point2 = explode(',', $p2);
    
                                    if(strstr($extra, ' ')){
                                        $options = str_replace(' ', ':', $extra);
                                        if(!$this->is_distance($point1, $point2, $options)){
                                            $this->errors[$column][$name] = $message[$column][$name];
                                        }
                                    } else {
                                        $this->errors[$column][$name] = $message[$column][$name];
                                    }
                                } else {
                                    $this->errors[$column][$name] = $message[$column][$name];
                                }
                            } else {
                                $this->errors[$column][$name] = $message[$column][$name];
                            }
                            break;
                            case 'languages':
                                if(!in_array($data[$column], array_keys($this->languages()))){
                                    $this->errors[$column][$name] = $message[$column][$name];
                                }
                                break;
                            case 'morse':
                                if(!$this->is_morse($data[$column])){
                                    $this->errors[$column][$name] = $message[$column][$name];
                                }
                                break;
                            case 'binary':
                                if(!$this->is_binary($data[$column])){
                                    $this->errors[$column][$name] = $message[$column][$name];
                                }
                                break;
                            case 'timecode':
                                if(!$this->is_timecode($data[$column])){
                                    $this->errors[$column][$name] = $message[$column][$name];
                                }
                                break;
                            case 'currencies':
                                if(!in_array($data[$column], array_keys($this->currencies()))){
                                    $this->errors[$column][$name] = $message[$column][$name];
                                }
                                break;
                            case 'decimal':
                                if(!$this->is_decimal($data[$column])){
                                    $this->errors[$column][$name] = $message[$column][$name];
                                }
                                break;
                            case 'isbn':
                                if(!$this->is_isbn($data[$column])){
                                    $this->errors[$column][$name] = $message[$column][$name];
                                }
                                break;
                            case 'in':
                                if(!empty($extra)){
                                    $extra = strpos($extra, ',') ? explode(',', $extra) : [$extra];
                                    if(!in_array($data[$column], $extra)){
                                        $this->errors[$column][$name] = $message[$column][$name];
                                    }
                                } else {
                                    $this->errors[$column][$name] = 'The haystack was not found.';
                                }
    
                                break;
                            case 'slug':
                                if(!$this->is_slug($data[$column])){
                                    $this->errors[$column][$name] = $message[$column][$name];
                                }
                                break;
                            case 'port':
                                if(!$this->is_port($data[$column])){
                                    $this->errors[$column][$name] = $message[$column][$name];
                                }
                                break;
                            case 'port_open':
                                $extra = ($extra == '') ? null : $extra;
                                if(!$this->is_port_open($data[$column], $extra)){
                                    $this->errors[$column][$name] = $message[$column][$name];
                                }
                                break;
                            case 'fileExists':
                                if(!$this->fileExists($data[$column])){
                                    $this->errors[$column][$name] = $message[$column][$name];
                                }
                                break;
                            case 'md5':
                                if(!$this->is_md5($data[$column])){
                                    $this->errors[$column][$name] = $message[$column][$name];
                                }
                                break;
                            case 'base64':
                                if(!$this->is_base64($data[$column])){
                                    $this->errors[$column][$name] = $message[$column][$name];
                                }
                                break;
                            case 'bot':
                                if(!$this->is_bot($data[$column])){
                                    $this->errors[$column][$name] = $message[$column][$name];
                                }
                                break;
                        default:
                            $this->errors[$column][$name] = 'Invalid rule has been blocked.';
                        break;
                    }
                    $extra = '';
                }
            }
           
            if(empty($this->errors)){
                return true;
            } else {
                return false;
            }
        }
        public function is_column($tblName, $column){
            $columns = $this->columnList($tblName);
            if(in_array($column, $columns)){
                return true;
            } else {
                return false;
            }        
        }
        public function columnList($tblName){

            global $config;

            $columns = array();
    
            switch ($config['database']['type']) {
                case 'mysql':
                    $sql = 'SHOW COLUMNS FROM `' . $tblName.'`';
    
                    try{
                        $query = $this->db->rawQuery($sql);
    
                        $columns = array();
    
                        foreach ( $query as $column ) {
    
                            $columns[] = $column['Field'];
                        }
    
                    } catch (Exception $e){
                        return $columns;
                    }
                break;
                case 'sqlite':
                    
                    $statement = $this->db->rawQuery('PRAGMA TABLE_INFO(`'. $tblName . '`)');
                    foreach ($statement as $key => $column) {
                        $columns[] = $column['name'];
                    }
                break;
            }
    
            return $columns;
            
        }
    
        public function is_email($email){
            if ( filter_var($email, FILTER_VALIDATE_EMAIL) ) {
                return true;
            } else {
                return false;
            }
        }
        public function is_phone($str){
            return preg_match('/^\(?\+?([0-9]{1,4})\)?[-\. ]?(\d{3})[-\. ]?([0-9]{7})$/', implode('', explode(' ', $str))) ? true : false;
        }
        public function is_date($date, $format = 'Y-m-d H:i:s'){
            $d = DateTime::createFromFormat($format, $date);
            return $d && $d->format($format) == $date;
        }
        public function is_json($scheme){
            if(is_null($scheme) OR is_array($scheme)) {
                return false;
            }
            if($this->json_decode($scheme)){
                return true;
            }
            return false;
        }
        public function json_decode($data){
            return json_decode($data, true);
        }
        public function json_encode($data, $min = true, $header=false){
            if($header==true){ header('Content-Type: application/json; charset=utf-8'); }
            $data = ($min === true) ? json_encode($data, JSON_UNESCAPED_UNICODE) : json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            return str_replace(['&#039;', '&quot;', '&amp;'], ['\'', '\"', '&'], $data);
        }
        public function is_color($color){
            $colorArray = $this->json_decode('["AliceBlue","AntiqueWhite","Aqua","Aquamarine","Azure","Beige","Bisque","Black","BlanchedAlmond","Blue","BlueViolet","Brown","BurlyWood","CadetBlue","Chartreuse","Chocolate","Coral","CornflowerBlue","Cornsilk","Crimson","Cyan","DarkBlue","DarkCyan","DarkGoldenRod","DarkGray","DarkGrey","DarkGreen","DarkKhaki","DarkMagenta","DarkOliveGreen","DarkOrange","DarkOrchid","DarkRed","DarkSalmon","DarkSeaGreen","DarkSlateBlue","DarkSlateGray","DarkSlateGrey","DarkTurquoise","DarkViolet","DeepPink","DeepSkyBlue","DimGray","DimGrey","DodgerBlue","FireBrick","FloralWhite","ForestGreen","Fuchsia","Gainsboro","GhostWhite","Gold","GoldenRod","Gray","Grey","Green","GreenYellow","HoneyDew","HotPink","IndianRed ","Indigo ","Ivory","Khaki","Lavender","LavenderBlush","LawnGreen","LemonChiffon","LightBlue","LightCoral","LightCyan","LightGoldenRodYellow","LightGray","LightGrey","LightGreen","LightPink","LightSalmon","LightSeaGreen","LightSkyBlue","LightSlateGray","LightSlateGrey","LightSteelBlue","LightYellow","Lime","LimeGreen","Linen","Magenta","Maroon","MediumAquaMarine","MediumBlue","MediumOrchid","MediumPurple","MediumSeaGreen","MediumSlateBlue","MediumSpringGreen","MediumTurquoise","MediumVioletRed","MidnightBlue","MintCream","MistyRose","Moccasin","NavajoWhite","Navy","OldLace","Olive","OliveDrab","Orange","OrangeRed","Orchid","PaleGoldenRod","PaleGreen","PaleTurquoise","PaleVioletRed","PapayaWhip","PeachPuff","Peru","Pink","Plum","PowderBlue","Purple","RebeccaPurple","Red","RosyBrown","RoyalBlue","SaddleBrown","Salmon","SandyBrown","SeaGreen","SeaShell","Sienna","Silver","SkyBlue","SlateBlue","SlateGray","SlateGrey","Snow","SpringGreen","SteelBlue","Tan","Teal","Thistle","Tomato","Turquoise","Violet","Wheat","White","WhiteSmoke","Yellow","YellowGreen"]', true);
            if(in_array($color, $colorArray)){
                return true;
            }
            if($color == 'transparent'){
                return true;
            }
            if(preg_match('/^#[a-f0-9]{6}$/i', mb_strtolower($color, 'utf-8'))){
                return true;
            }
            if(preg_match('/^rgb\((?:\s*\d+\s*,){2}\s*[\d]+\)$/', mb_strtolower($color, 'utf-8'))) {
                return true;
            }
            if(preg_match('/^rgba\((\s*\d+\s*,){3}[\d\.]+\)$/i', mb_strtolower($color, 'utf-8'))){
                return true;
            }
            if(preg_match('/^hsl\(\s*\d+\s*(\s*\,\s*\d+\%){2}\)$/i', mb_strtolower($color, 'utf-8'))){
                return true;
            }
            if(preg_match('/^hsla\(\s*\d+(\s*,\s*\d+\s*\%){2}\s*\,\s*[\d\.]+\)$/i', mb_strtolower($color, 'utf-8'))){
                return true;
            }
            return false;
        }

        public function is_url($url=null){
            if(!is_string($url)){
                return false;
            }
            $temp_string = (!preg_match('#^(ht|f)tps?://#', $url)) ? 'http://' . $url : $url;
            if ( filter_var($temp_string, FILTER_VALIDATE_URL)) {
                return true;
            } else {
                return false;
            }

        }
        public function is_http($url){
            if (substr($url, 0, 7) == "http://"){
                return true;
            } else {
                return false;
            }
        }
        public function is_https($url){
            if (substr($url, 0, 8) == "https://"){
                return true;
            } else {
                return false;
            }
        }
        public function is_age($date, $age, $type='min'){
            $today = date("Y-m-d");
            $diff = date_diff(date_create($date), date_create($today));
            if($type === 'max'){
                if($age >= $diff->format('%y')){
                    return true;
                }
            }
            if($type === 'min'){
                if($age <= $diff->format('%y')){
                    return true;
                }
            }
            return false;
        }

        public function is_iban($iban){
            $iban = strtoupper(str_replace(' ', '', $iban));
            if (preg_match('/^[A-Z]{2}[0-9]{2}[A-Z0-9]{1,30}$/', $iban)) {
                $country = substr($iban, 0, 2);
                $check = intval(substr($iban, 2, 2));
                $account = substr($iban, 4);
                $search = range('A','Z');
                foreach (range(10,35) as $tmp)
                    $replace[]=strval($tmp);
                $numstr = str_replace($search, $replace, $account.$country.'00');
                $checksum = intval(substr($numstr, 0, 1));
                for ($pos = 1; $pos < strlen($numstr); $pos++) {
                    $checksum *= 10;
                    $checksum += intval(substr($numstr, $pos,1));
                    $checksum %= 97;
                }
                return ((98-$checksum) == $check);
            } else
                return false;
        }
        public function is_ipv4($ip){
            if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
                return true;
            } else {
                return false;
            }
        }
        public function is_ipv6($ip){
            if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
                return true;
            } else {
                return false;
            }
        }
        public function is_blood($blood, $donor = null){
            $bloods = array(
                'AB+'=> array(
                    'AB+', 'AB-', 'B+', 'B-', 'A+', 'A-', '0+', '0-'
                ),
                'AB-'=> array(
                    'AB-', 'B-', 'A-', '0-'
                ),
                'B+'=> array(
                    'B+', 'B2-', '0+', '0-'
                ),
                'B-'=> array(
                    'B-', '0-'
                ),
                'A+'=> array(
                    'A+', 'A-', '0+', '0-'
                ),
                'A-'=> array(
                    'A-', '0-'
                ),
                '0+'=> array(
                    '0+', '0-'
                ),
                '0-'=> array(
                    '0-'
                )
            );
            $map = array_keys($bloods);
            $blood = str_replace(array('RH', ' '), '', mb_strtoupper($blood));
            if(!is_null($donor)) $donor = str_replace(array('RH', ' '), '', mb_strtoupper($donor));
            if(in_array($blood, $map) AND is_null($donor)){
                return true;
            }
            if(in_array($blood, $map) AND in_array($donor, $bloods[$blood]) AND !is_null($donor)){
                return true;
            }
            return false;
        }
        public function is_latitude($latitude){
            $lat_pattern  = '/\A[+-]?(?:90(?:\.0{1,18})?|\d(?(?<=9)|\d?)\.\d{1,18})\z/x';
            if (preg_match($lat_pattern, $latitude)) {
                return true;
            } else {
                return false;
            }
        }
        public function is_longitude($longitude){
            $long_pattern = '/\A[+-]?(?:180(?:\.0{1,18})?|(?:1[0-7]\d|\d{1,2})\.\d{1,18})\z/x';

            if (preg_match($long_pattern, $longitude)) {
                return true;
            } else {
                return false;
            }
        }
        public function is_coordinate($lat, $long) {

            if ($this->is_latitude($lat) AND $this->is_longitude($long)) {
                return true;
            } else {
                return false;
            }
        }
        public function is_distance($point1, $point2, $options){
            $symbols = array('m', 'km', 'mi', 'ft', 'yd');
        if(empty($options)){
            return false;
        }
        if(!strstr($options, ':')){
            return false;
        }
        $options = explode(':', trim($options, ':'));
        if(count($options) != 2){
            return false;
        }
        list($range, $symbol) = $options;
        if(!in_array(mb_strtolower($symbol), $symbols)){
            return false;
        }
            if(empty($point1) OR empty($point2)){
                return false;
            }
            if(!is_array($point1) OR !is_array($point2)){
                return false;
            }
            if(count($point1) != 2 OR count($point2) != 2){
                return false;
            }
            if(isset($point1[0]) AND isset($point1[1]) AND isset($point2[0]) AND isset($point2[1])){
                $distance_range = $this->distanceMeter($point1[0], $point1[1], $point2[0], $point2[1], $symbol);
                if($distance_range <= $range){
                    return true;
                }
            }
            return false;
        }

        public function is_md5($md5 = ''){
            return strlen($md5) == 32 && ctype_xdigit($md5);
        }
        public function is_base64($value) {
            $decoded = base64_decode($value, true);
            return base64_encode($decoded) === $value;
        }
        public function is_ssl() {
            if ( isset( $_SERVER['HTTPS'] ) ) {
                if ( 'on' === strtolower( $_SERVER['HTTPS'] ) ) {
                    return true;
                }
        
                if ( '1' == $_SERVER['HTTPS'] ) {
                    return true;
                }
            } elseif ( isset( $_SERVER['SERVER_PORT'] ) && ( '443' == $_SERVER['SERVER_PORT'] ) ) {
                return true;
            }
            return false;
        }
        public function distanceMeter($lat1, $lon1, $lat2, $lon2, $type = '') {
            $output = array();
            if(!$this->is_coordinate($lat1, $lon1) OR !$this->is_coordinate($lat2, $lon2)){ return false; }
            if (($lat1 == $lat2) AND ($lon1 == $lon2)) { return false; }
            $latFrom = deg2rad($lat1);
            $lonFrom = deg2rad($lon1);
            $latTo = deg2rad($lat2);
            $lonTo = deg2rad($lon2);

            $lonDelta = $lonTo - $lonFrom;
            $a = pow(cos($latTo) * sin($lonDelta), 2) +
                pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
            $b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);

            $angle = atan2(sqrt($a), $b);

            $meters     = $angle * 6371000;
            $kilometers = $meters / 1000;
            $miles      = $meters * 0.00062137;
            $feet       = $meters * 3.2808399;
            $yards      = $meters * 1.0936;

            $data = array(
                'm'     =>  round($meters, 2),
                'km'    =>  round($kilometers, 2),
                'mi'    =>  round($miles, 2),
                'ft'    =>  round($feet, 2),
                'yd'    =>  round($yards, 2)
            );
            if(empty($type)){
                return $data;
            }
            if(!is_array($type) AND in_array($type, array_keys($data))){
                $type = array($type);
            }
            if(!is_array($type) AND !in_array($type, array_keys($data))){
                return $output;
            }
            foreach ($type as $name){
                if(!in_array($name, array_keys($data))){
                    return $output;
                }
            }
            foreach ($type as $name){
                $output[$name] = $data[$name];
            }
            if(count($type)==1){
                $name = implode('', $type);
                return $output[$name];
            }
            return $output;
        }
        public function is_slug($str){
            return preg_match('/^[a-zA-Z0-9-]+$/', $str);
        }
        public function is_bot($userAgent = null) {
            $userAgent = (empty($userAgent)) ? $_SERVER['HTTP_USER_AGENT'] : $userAgent;
            foreach ($this->bots() as $bot) {
                if (stripos($userAgent, $bot) !== false) {
                    return true;
                }
            }
            return false;
        }
        public function bots(){
            return ['Alexabot','AhrefsBot','Applebot','ArchiveBot','Baiduspider','Barkrowler','BLEXBot','Bingbot','BUbiNG','CCBot','Charlotte','Cliqzbot','cortex','Crawler','Discordbot','DotBot','DuckDuckBot','Embedly','ExB Language Crawler','Exabot','facebookexternalhit','Facebot','FatBot','FlipboardProxy','Flamingo_Search','Genieo','Googlebot','Google-InspectionTool', 'ia_archiver','Infohelfer','Instagram Bot','LinkedInBot','Linguee Bot','LivelapBot','LoadImpactPageAnalyzer','MagpieRSS','Mail.RU_Bot','MetaJobBot','MetaURI','MJ12bot','MojeekBot','MSRBOT','Netvibes','OpenHoseBot','OutclicksBot','Phantom','PhantomJS','Pinterest','Pinterestbot','Python-urllib','QQBrowser','Qseero','Qwantify','Redditbot','RubedoBot','SafeBrowsing','SafeDNSBot','Screaming Frog','SemrushBot','Sogou','Soso','spbot','SurveyBot','TelegramBot','Tumblrbot','Twitterbot','UnwindFetchor','VimeoBot','VoilàBot','WBSearchBot','Weibo','WhatsApp','WordPress','YandexBot','YouTubeBot'];
        }
    }

?>