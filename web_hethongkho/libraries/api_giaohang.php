<?php 
	/**
	 * summary
	 */
	class apiGiaoHang
	{
	    /**
	     * summary
	     */
	    public function __construct()
	    {
	        
	    }
	    function gettoken_GHN() {
		    return array(
		        'token' => '5b5ae51894c06b624c58623d',
		        //'token' => 'TokenStaging',//dung de test
		    );
		}
	    function createNewHub() {
	
		    $data = $this->gettoken_GHN();   
		    $ch = curl_init();
		    //curl_setopt($ch, CURLOPT_URL, 'https://apiv3-test.ghn.vn/api/v1/apiv3/GetHubs');
		    curl_setopt($ch, CURLOPT_URL, 'https://console.ghn.vn/api/v1/apiv3/GetHubs');
		    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		    curl_setopt($ch, CURLOPT_POST, 1);
		    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		    $response = curl_exec($ch);
		    $PickHubID = json_decode($response, true);
		    return $PickHubID;
		}

	}
?>