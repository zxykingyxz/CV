<?php

class midleWare{

    public $post = [];

    public $errors = [];

    public function __construct($conf){
        
        $this->firewall($conf);

    }

    /**
     * Firewall
     * 
     * @param array $conf
     * @return string header()
     */
    public function firewall($conf=array()){

        if(empty($conf['firewall']['allow']['folder'])){
            $conf['firewall']['allow']['folder'] = array('public');
        }

        if(empty($_SERVER['HTTP_USER_AGENT'])){
            $this->abort('400', 'User agent is required.');
        }

        $noiframe = "X-Frame-Options: SAMEORIGIN";
        $noxss = "X-XSS-Protection: 1; mode=block";
        $nosniff = "X-Content-Type-Options: nosniff";
        $ssl = "Set-Cookie: user=t=".$this->generateToken()."; path=/; Secure";
        $hsts = "Strict-Transport-Security: max-age=16070400; includeSubDomains; preload";

        $noiframe_status = (isset($conf['noiframe']) AND $conf['firewall']['noiframe'] == TRUE) ? TRUE : FALSE;
        $noxss_status = (isset($conf['firewall']['noxss']) AND $conf['firewall']['noxss'] == TRUE) ? TRUE : FALSE;
        $nosniff_status = (isset($conf['firewall']['nosniff']) AND $conf['firewall']['nosniff'] == TRUE) ? TRUE : FALSE;
        $ssl_status = (isset($conf['firewall']['ssl']) AND $conf['firewall']['ssl'] == TRUE) ? TRUE : FALSE;
        $hsts_status = (isset($conf['firewall']['hsts']) AND $conf['firewall']['hsts'] == TRUE) ? TRUE : FALSE;

        if($noiframe_status === TRUE){ header($noiframe); }
        if($noxss_status === TRUE){ header($noxss); }
        if($nosniff_status === TRUE){ header($nosniff); }
        if($ssl_status === TRUE){ header($ssl); }
        if($hsts_status === TRUE){ header($hsts); }

        if($ssl_status === TRUE AND $this->is_ssl() === FALSE){
            $this->abort('400', 'SSL is required.');
        }        
        if($hsts_status === TRUE AND ($this->is_ssl() OR $ssl_status == FALSE)){
            $this->abort('503', 'SSL is required for HSTS.');
        }
        
        $limit = 200;
        $name = 'csrf_token';
        $status = true;

        if(!empty($conf)){

            if(isset($conf['firewall']['csrf'])){
                if(!empty($conf['firewall']['csrf']['name'])){
                    $name = $conf['firewall']['csrf']['name'];
                }
                if(!empty($conf['firewall']['csrf']['limit'])){
                    $limit = $conf['firewall']['csrf']['limit'];
                }
                if(is_bool($conf['firewall']['csrf'])){
                    $status = $conf['firewall']['csrf'];
                }
            }            
        }

        if($status){

            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                if(isset($this->post[$name]) AND isset($_SESSION['csrf']['token'])){
                    if($this->post[$name] == $_SESSION['csrf']['token']){
                        unset($this->post[$name]);
                    } else {
                        $this->abort('401', 'A valid token could not be found.');
                    }
                } else {
                    $this->abort('400', 'Token not found.');
                }
                
            } 

            if(!isset($_SESSION['csrf']) OR $_SERVER['REQUEST_METHOD'] === 'POST'){

                $_SESSION['csrf'] = array(
                    'name'  =>  $name,
                    'token' =>  $this->generateToken($limit)                    
                );
                $_SESSION['csrf']['input'] = "<input type=\"hidden\" name=\"".$_SESSION['csrf']['name']."\" value=\"".$_SESSION['csrf']['token']."\">";
            }

        } else {
            if(isset($_SESSION['csrf'])){
                unset($_SESSION['csrf']);
            }
        }

        if(
            $_SERVER['REQUEST_METHOD'] === 'POST' AND isset($this->post['captcha']) AND 
            isset($_SESSION['captcha']) AND ($_SESSION['captcha'] != $this->post['captcha']))
        {
            $this->errors['captcha']['required'] = 'Captcha validation failed.';
        }

        $conf['firewall']['allow']['platform'] = (isset($conf['firewall']['allow']['platform']) ? $conf['firewall']['allow']['platform'] : []);
        $conf['firewall']['allow']['browser'] = (isset($conf['firewall']['allow']['browser']) ? $conf['firewall']['allow']['browser'] : []);
        $conf['firewall']['allow']['ip'] = (isset($conf['firewall']['allow']['ip']) ? $conf['firewall']['allow']['ip'] : []);
        $conf['firewall']['allow']['folder'] = (isset($conf['firewall']['allow']['folder']) ? $conf['firewall']['allow']['folder'] : []);
        $conf['firewall']['deny']['platform'] = (isset($conf['firewall']['deny']['platform']) ? $conf['firewall']['deny']['platform'] : []);
        $conf['firewall']['deny']['browser'] = (isset($conf['firewall']['deny']['browser']) ? $conf['firewall']['deny']['browser'] : []);
        $conf['firewall']['deny']['ip'] = (isset($conf['firewall']['deny']['ip']) ? $conf['firewall']['deny']['ip'] : []);
        $conf['firewall']['deny']['folder'] = (isset($conf['firewall']['deny']['folder']) ? $conf['firewall']['deny']['folder'] : []);

        $conf['firewall']['allow']['platform'] = (!is_array($conf['firewall']['allow']['platform']) ? [$conf['firewall']['allow']['platform']] : $conf['firewall']['allow']['platform']);
        $conf['firewall']['allow']['browser'] = (!is_array($conf['firewall']['allow']['browser']) ? [$conf['firewall']['allow']['browser']] : $conf['firewall']['allow']['browser']);
        $conf['firewall']['allow']['ip'] = (!is_array($conf['firewall']['allow']['ip']) ? [$conf['firewall']['allow']['ip']] : $conf['firewall']['allow']['ip']);
        $conf['firewall']['allow']['folder'] = (!is_array($conf['firewall']['allow']['folder']) ? [$conf['firewall']['allow']['folder']] : $conf['firewall']['allow']['folder']);
        $conf['firewall']['deny']['platform'] = (!is_array($conf['firewall']['deny']['platform']) ? [$conf['firewall']['deny']['platform']] : $conf['firewall']['deny']['platform']);
        $conf['firewall']['deny']['browser'] = (!is_array($conf['firewall']['deny']['browser']) ? [$conf['firewall']['deny']['browser']] : $conf['firewall']['deny']['browser']);
        $conf['firewall']['deny']['ip'] = (!is_array($conf['firewall']['deny']['ip']) ? [$conf['firewall']['deny']['ip']] : $conf['firewall']['deny']['ip']);
        $conf['firewall']['deny']['folder'] = (!is_array($conf['firewall']['deny']['folder']) ? [$conf['firewall']['deny']['folder']] : $conf['firewall']['deny']['folder']);

        $platform = $this->getClientOS();

        if(
            !empty($conf['firewall']['deny']['platform']) AND
            in_array($platform, array_values($conf['firewall']['deny']['platform'])) OR
            !empty($conf['firewall']['allow']['platform']) AND
            !in_array($platform, array_values($conf['firewall']['allow']['platform']))
            ){
            $this->abort('401', 'Your operating system is not allowed.');
        }

        $browser = $this->getBrowser();
       
        if(
            !empty($conf['firewall']['deny']['browser']) AND
            in_array($browser, array_values($conf['firewall']['deny']['browser'])) OR
            !empty($conf['firewall']['allow']['browser']) AND 
            !in_array($browser, array_values($conf['firewall']['allow']['browser']))
            ){
            $this->abort('401', 'Your browser is not allowed.');
        }

        $ip = $this->getIPAddress();
        if(
            !empty($conf['firewall']['deny']['ip']) AND
            in_array($ip, array_values($conf['firewall']['deny']['ip'])) OR
            !empty($conf['firewall']['allow']['ip']) AND
            !in_array($ip, array_values($conf['firewall']['allow']['ip']))
            ){
            $this->abort('401', 'Your IP address is not allowed.');
        }

        $folders = array_filter(glob('*'), 'is_dir');
        $filename = '';
        $deny_content = '';
        $allow_content = '';
        switch ($this->getSoftware()) {
            case ('Apache' || 'LiteSpeed'):
                $deny_content = 'Deny from all';
                $allow_content = 'Allow from all';
                $filename = '.htaccess';
            break;
            case 'Microsoft-IIS':
                $deny_content = implode("\n", array(
                    "<authorization>",
                    "\t<deny users=\"?\"/>",
                    "</authorization>"
                ));
                $allow_content = implode("\n", array(
                    "<configuration>",
                    "\t<system.webServer>",
                    "\t\t<directoryBrowse enabled=\"true\" showFlags=\"Date,Time,Extension,Size\" />",
                    "\t\t\t</system.webServer>",
                    "</configuration>"
                ));
                $filename = 'web.config';
            break;
            
        }

        if($platform != 'Nginx'){
            if(!empty($folders)){
                foreach ($folders as $dir){
    
                    if(in_array($dir, $conf['firewall']['deny']['folder']) AND !file_exists($dir.'/'.$filename)){
                        $this->write($deny_content, $dir.'/'.$filename);
                    }
                    if(in_array($dir, $conf['firewall']['allow']['folder']) AND !file_exists($dir.'/'.$filename)){
                        $this->write($allow_content, $dir.'/'.$filename);
                    }
                    
                    if(!file_exists($dir.'/'.$filename)){
                        $this->write($deny_content, $dir.'/'.$filename);
                    }
                    if(!file_exists($dir.'/index.html')){
                        $this->write(' ', $dir.'/index.html');
                    }

                }
            }
        }


        if(isset($conf['firewall']['lifetime'])){

            
            // if only two are specified
            if(isset($conf['firewall']['lifetime']['start']) AND isset($conf['firewall']['lifetime']['end'])){
                if((!$this->lifetime($conf['firewall']['lifetime']['end'])) OR 
                (!$this->lifetime($conf['firewall']['lifetime']['start'], $conf['firewall']['lifetime']['end']))){
                        $message = (isset($conf['firewall']['lifetime']['message'])) ? $conf['firewall']['lifetime']['message'] : 'The access right granted to you has expired.';
                        $this->abort('401', $message);
                    }
                }
                
                // only if the start date is specified
                if(isset($conf['firewall']['lifetime']['start']) AND !isset($conf['firewall']['lifetime']['end'])){
                    if(!$this->lifetime($conf['firewall']['lifetime']['start'], $this->timestamp)){
                        $message = (isset($conf['firewall']['lifetime']['message'])) ? $conf['firewall']['lifetime']['message'] : 'You must wait for the specified time to use your access right.';
                    $this->abort('401', $message);
                }
            }

            // only if the end date is specified
            if(!isset($conf['firewall']['lifetime']['start']) AND isset($conf['firewall']['lifetime']['end'])){
                if(!$this->lifetime($conf['firewall']['lifetime']['end'])){
                    $message = (isset($conf['firewall']['lifetime']['message'])) ? $conf['firewall']['lifetime']['message'] : 'The deadline for your access has expired.';
                    $this->abort('401', $message);
                }
            }
        }

    }
    /**
     * @return string
     */
    public function getIPAddress(){
        if($_SERVER['REMOTE_ADDR'] === '::1'){
            $_SERVER['REMOTE_ADDR'] = '127.0.0.1';
        }
        return $_SERVER['REMOTE_ADDR'];
    }
    /**
     * Detecting an operating system
     * @return string
     */
    public function getOS(){
        $os = PHP_OS;
        switch (true) {
            case stristr($os, 'dar'): return 'Darwin';
            case stristr($os, 'win'): return 'Windows';
            case stristr($os, 'lin'): return 'Linux';
            default : return 'Unknown';
        }
    }
    /**
     * Detecting an client operating system
     * @return string
     */
    public function getClientOS(){
        $userAgent = $_SERVER['HTTP_USER_AGENT'];

        if (strpos($userAgent, 'Windows') !== false) {
            $os = 'Windows';
        } elseif (strpos($userAgent, 'Mac') !== false) {
            $os = 'Mac';
        } elseif (strpos($userAgent, 'Linux') !== false) {
            $os = 'Linux';
        } elseif (strpos($userAgent, 'Android') !== false) {
            $os = 'Android';
        } elseif (strpos($userAgent, 'iOS') !== false) {
            $os = 'iOS';
        } else {
            $os = 'Unknown';
        }
        return $os;
    }
    /**
     * Client browser identifier.
     */
    public function getBrowser($agent=null){
        $browserName = 'Unknown';
        $_SERVER['HTTP_USER_AGENT'] = empty($_SERVER['HTTP_USER_AGENT']) ? $browserName : $_SERVER['HTTP_USER_AGENT'];
        $agent = ($agent!=null) ? $agent : $_SERVER['HTTP_USER_AGENT']; 
        
        if(preg_match('/Edg/i',$agent)) 
        { 
            $browserName = "Edge";
        } 
        elseif(preg_match('/OPR/i',$agent)) 
        { 
            $browserName = "Opera"; 
        } 
        elseif(preg_match('/Firefox/i',$agent)) 
        { 
            $browserName = "Firefox"; 
        } 
        elseif(preg_match('/Chrome/i',$agent)) 
        { 
            $browserName = "Chrome"; 
        } 
        elseif(preg_match('/Safari/i',$agent)) 
        { 
            $browserName = "Safari"; 
        } 

        return $browserName;
    }
       /**
     * Detecting an server software
     * @return string
     */
    public function getSoftware(){
        $software = $_SERVER['SERVER_SOFTWARE'];
        switch (true) {
            case stristr($software, 'apac'): return 'Apache';
            case stristr($software, 'micr'): return 'Microsoft-IIS';
            case stristr($software, 'lites'): return 'LiteSpeed';
            case stristr($software, 'nginx'): return 'Nginx';
            default : return 'Unknown';
        }
    }
    /**
     * Absolute path syntax
     *
     * @param string $path
     * @return string
     */
    public function get_absolute_path($path) {
        $path = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $path);
        $parts = array_filter(explode(DIRECTORY_SEPARATOR, $path), 'strlen');
        $absolutes = array();
        foreach ($parts as $part) {
            if ('.' == $part) continue;
            if ('..' == $part) {
                array_pop($absolutes);
            } else {
                $absolutes[] = $part;
            }
        }
        $outputdir = implode(DIRECTORY_SEPARATOR, $absolutes);
        if(strstr($outputdir, '\\')){
            $outputdir = str_replace('\\', '/', $outputdir);
        }
        return $outputdir;
    }
     /**
     * Path information
     *
     * @param string $fileName
     * @param string $type
     * @return bool|string
     */
    public function info($fileName, $type){

        if(empty($fileName) AND isset($type)){
            return false;
        }

        $object = pathinfo($fileName);

        if($type == 'extension'){
            return strtolower($object[$type]);
        }

        if($type == 'dirname'){
            return $this->get_absolute_path($object[$type]);
        }
        
        return $object[$type];
    }
    /**
     * File writer.
     *
     * @param array $data
     * @param string $filePath
     * @param string $delimiter
     * @return bool
     */
    public function write($data, $filePath, $delimiter = ':') {

        if(is_array($data)){
            $content    = implode($delimiter, $data);
        } else {
            $content    = $data;
        }

        if(isset($content)){
            $dirPath = $this->info($filePath, 'dirname');
            if(!empty($dirPath)){
                if(!is_dir($dirPath)){
                    mkdir($dirPath, 0777, true);
                }
            }
            if(!file_exists($filePath)){ touch($filePath); }
            if(file_exists($filePath)){ 
                $fileName        = fopen($filePath, "a+");
                fwrite($fileName, $content."\r\n");
                fclose($fileName);
            }

            return true;
        }

        return false;
    }
    /**
     * lifetime
     *
     * @param string $start_date
     * @param string|null $end_date
     * @return bool
     */
    public function lifetime($start_date, $end_date = null){
        if(!is_null($end_date)){
            $start_date = date_create($start_date);
            $end_date = date_create($end_date);
        } else {
            $end_date = date_create($start_date);
            $start_date = date_create($this->timestamp);
        }
        return ($start_date<$end_date);
    }
    /**
     * addressCodeList
     * @return array
     * 
     */
    public function addressCodeList(){
        $httpStatusCodes = array(0 => "Not defined",100 => "Continue",101 => "Switching Protocols",102 => "Processing",200 => "OK",201 => "Created",202 => "Accepted",203 => "Non-Authoritative Information",204 => "No Content",205 => "Reset Content",206 => "Partial Content",207 => "Multi-Status",208 => "Already Reported",226 => "IM Used",300 => "Multiple Choices",301 => "Moved Permanently",302 => "Found",303 => "See Other",304 => "Not Modified",305 => "Use Proxy",306 => "(Unused)",307 => "Temporary Redirect",308 => "Permanent Redirect",400 => "Bad Request",401 => "Unauthorized",402 => "Payment Required",403 => "Forbidden",404 => "Not Found",405 => "Method Not Allowed",406 => "Not Acceptable",407 => "Proxy Authentication Required",408 => "Request Timeout",409 => "Conflict",410 => "Gone",411 => "Length Required",412 => "Precondition Failed",413 => "Payload Too Large",414 => "URI Too Long",415 => "Unsupported Media Type",416 => "Range Not Satisfiable",417 => "Expectation Failed",418 => "I'm a teapot",419 => "Authentication Timeout",420 => "Method Failure",422 => "Unprocessable Entity",423 => "Locked",424 => "Failed Dependency",425 => "Unordered Collection",426 => "Upgrade Required",428 => "Precondition Required",429 => "Too Many Requests",431 => "Request Header Fields Too Large",444 => "Connection Closed Without Response",449 => "Retry With",450 => "Blocked by Windows Parental Controls",451 => "Unavailable For Legal Reasons",494 => "Request Header Too Large",495 => "Cert Error",496 => "No Cert",497 => "HTTP to HTTPS",499 => "Client Closed Request",500 => "Internal Server Error",501 => "Not Implemented",502 => "Bad Gateway",503 => "Service Unavailable",504 => "Gateway Timeout",505 => "HTTP Version Not Supported",506 => "Variant Also Negotiates",507 => "Insufficient Storage",508 => "Loop Detected",509 => "Bandwidth Limit Exceeded",510 => "Not Extended",511 => "Network Authentication Required",598 => "Network read timeout error",599 => "Network connect timeout error");
        return $httpStatusCodes;
    }
    /**
     * Abort Page
     * @param string $code
     * @param string message
     * @return void
     */
    public function abort($code, $message){    
        $codelist = $this->addressCodeList();
        if(isset($codelist[$code])){
            header($_SERVER['SERVER_PROTOCOL']." ".$code." ".$codelist[$code]);
        }
        exit('<!DOCTYPE html><html lang="en"><head> <meta charset="utf-8"> <meta name="viewport" content="width=device-width, initial-scale=1"> <title>'.$code.'</title> <style>html, body{background-color: #fff; color: #636b6f; font-family: Arial, Helvetica, sans-serif; font-weight: 100; height: 100vh; margin: 0;}.full-height{height: 100vh;}.flex-center{align-items: center; display: flex; justify-content: center;}.position-ref{position: relative;}.code{border-right: 2px solid; font-size: 26px; padding: 0 15px 0 15px; text-align: center;}.message{font-size: 18px; text-align: center;}div.buttons{position:absolute;margin-top: 60px;}a{color: #333;font-size: 14px;text-decoration: underline;}a:hover{text-decoration:none;}</style></head><body><div class="flex-center position-ref full-height"> <div class="buttons"><a href="'.$this->page_back.'">Back to Page</a>&nbsp;|&nbsp;<a href="'.$this->base_url.'">Home</a></div><div class="code"> '.$code.' </div><div class="message" style="padding: 10px;"> '.$message.' </div></div></body></html>');
    }
    /**
     * Token generator
     * 
     * @param int $length
     * @return string
     */
    public function generateToken($length=100){
        $key = '';
        $keys = array_merge(range('A', 'Z'), range(0, 9), range('a', 'z'), range(0, 9));

        for ($i = 0; $i < $length; $i++) {
            $key .= $keys[array_rand($keys)];
        }

        return $key;
    }
    /**
	 * Determines if SSL is used.	 
	 * @return bool True if SSL, otherwise false.
	 */
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
}