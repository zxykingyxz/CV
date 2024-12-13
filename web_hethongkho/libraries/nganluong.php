<?php	
    define('URL_API', (isset($_SERVER['HTTPS']) ? "https" : "http") . "://" . $_SERVER['HTTP_HOST']);
    
    define('URL_CALLBACK', URL_API . '/result.php');

    $config['alepay'] = array(
   
        "apiKey" => "Sz2MNBUwSvEOZPjuDiRSZjPUYw8I7S", //Là key dùng để xác định tài khoản nào đang được sử dụng.
    
        "encryptKey" => "MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDELgVH29rIuWgzPd7cLhGM3kcM37LfQx1z3YTyFCphzaqq7ou1JLKo2w8hVQV2w2sHf0RR/Q+sZ83HL1VOkdAU+y5zQ/zKQv6hemCkCyijEVE5aHrgw/1ZtELXc+xwnQ3nnj8lCFL/nJNoxaw3DtyNR8ICkznBBc5ywXtbgTH+4QIDAQAB", //Là key dùng để mã hóa dữ liệu truyền tới Alepay.
   
        "checksumKey" => "rLCQoW90f57c33RVd4MJZQGV40vzil", //Là key dùng để tạo checksum data.
    
        "callbackUrl" => URL_CALLBACK,
   
        "env" => "test"

    );
    
    class nganluong{

        private $_d;

        private $_alepay;

        public function __construct($db){

            $this->_d=$db;

            $this->initAlepay();

        }
        public function initAlepay(){

            global $config;
            
            require('../Lib/Alepay.php');

            $this->_alepay = new Alepay($config['alepay']);

        }
        public function errorAlepay($data){

            foreach($data as $k => $v){

                if(empty($v)){

                    return false;

                    break;

                }

            }

            return true;

        }
        public function getAlepay($data){

            $result=$this->_alepay->sendOrderToAlepay($data);

            if(isset($result) && !empty($result->checkoutUrl)){
                
                return $result->checkoutUrl;

            }else{

                return $result->errorDescription;

            }

        }

    }

?>