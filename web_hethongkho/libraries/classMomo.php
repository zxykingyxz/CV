<?php
    class classMomo{
        public $endpoint        = 'https://test-payment.momo.vn/v2/gateway/api/create';
        public $accesskey       = 'OmAmjUlAc0n02HDk';
        public $secrectkey      = 'JECIfiwYHoOAQCma7GbRpgBk3bFyCIla';
        public $redirectUrl     = 'https://athc.edu.vn/success';
        public $ipnUrl          = 'https://athc.edu.vn/success';
        public function __construct(){
            header('Content-type: text/html; charset=utf-8');
        }
        public function callApi($url,$data=[],$method="POST"){
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($data))
            );
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            $result = curl_exec($ch);
            curl_close($ch);
            return $result;
        }
        public function sendRequestMomo($data=array()){
            if(!empty($data['orderId'])){
                $orderId = $data['orderId'];
            }else{
                die('orderId is required!');
            }
            if(!empty($data['partnerCode'])){
                $partnerCode = $data['partnerCode'];
            }else{
                die('partnerCode is required!');
            }
            if(!empty($data['partnerName'])){
                $partnerName = $data['partnerName'];
            }else{
                $partnerName = 'partner momo';
            }
            $storeId = $data['storeId'];
            $orderId = $data['orderId'];
            $orderInfo = 'Thanh toán qua MoMo';
            $amount = $data['amount'];
            $extraData = $data['extraData'];//Thêm dữ liệu cần trả về
            $requestId = time();
            switch ($data['requestType']) {
                case 'captureWallet':
                    $requestType = "captureWallet";
                    break;
                case 'payWithCC':
                    $requestType = "payWithCC";
                    break;
                case 'payWithATM':
                    $requestType = "payWithATM";
                    break;
                default:
                    $requestType = "payWithATM";
                    break;
            }
            $rawHash = "accessKey=" . $this->accesskey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $this->ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $this->partnerCode . "&redirectUrl=" . $this->redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
            $signature = hash_hmac("sha256", $rawHash, $this->secrectkey);
            $rawdata = array(
                'partnerCode' => $partnerCode,
                'partnerName' => $partnerName,
                "storeId" => $storeId,
                'requestId' => $requestId,
                'amount' => $amount,
                'orderId' => $orderId,
                'orderInfo' => $orderInfo,
                'redirectUrl' => $this->redirectUrl,
                'ipnUrl' => $this->ipnUrl,
                'lang' => 'vi',
                'extraData' => $extraData,
                'requestType' => $requestType,
                'signature' => $signature);
            $result = $this->callApi($this->endpoint, json_encode($rawdata));
            $jsonResult = json_decode($result, true);
            header('Location: ' . $jsonResult['payUrl']);
        }
    }

?>