<?php 
	class apiGHTK{

		public $result;
		public $ship;
		public $data;
		/*public $pick_province='TP. Hồ Chí Minh';
		public $pick_district='Quận Tân Phú';
		public $pick_ward='Tây Thạnh';
		public $pick_street='Đường D10';
		public $pick_address='Số 21, Đường D10, Tây Thạnh, Tân Phú, Hồ Chí Minh';*/

		private $pick_province;
		private $pick_district;
		private $pick_ward;
		private $pick_street;
		private $pick_address;


		private $link_address = 'https://services.giaohangtietkiem.vn';
		private $token_key = '8B02Cd6f985E5220d807f0adCf509FfCe7C78E36';

		private $link_fee = '/services/shipment/fee?';
		private $link_create_order = '/services/shipment/order/?ver=1.5';
		private $link_status = '/services/shipment/v2/';
		private $link_cancel = '/services/shipment/cancel/';
		
		
		public function getKeyGHTK(){
			return true;
		}


		public function setProvince($pick_province){
			$this->pick_province = $pick_province;
		}
		public function getProvince(){
			return $this->pick_province;
		}

		public function setDistrict($pick_district){
			$this->pick_district = $pick_district;
		}
		public function getDistrict(){
			return $this->pick_district;
		}

		public function setWard($pick_ward){
			$this->pick_ward = $pick_ward;
		}
		public function getWard(){
			return $this->pick_ward;
		}

		public function setStreet($pick_street){
			$this->pick_street = $pick_street;
		}
		public function getStreet(){
			return $this->pick_street;
		}

		public function setAddress($pick_address){
			$this->pick_address = $pick_address;
		}
		public function getAddress(){
			return $this->pick_address;
		}

		public function GetShipGHTK($datapost){
			$data = $datapost;
			$data['pick_province'] = $this->getProvince();
			$data['pick_district'] = $this->getDistrict();
			$data['pick_ward'] = $this->getWard();
			$data['pick_street'] = $this->getStreet();
			
			$linkaddress = $this->link_address;
			$link = $this->link_fee;
			$key = $this->token_key;

			$curl = curl_init();
			curl_setopt_array($curl, array(
				CURLOPT_URL => $linkaddress . $link . http_build_query($data),
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_HTTPHEADER => array(
				"Token: ".$key,
				),
			));
			$response = curl_exec($curl);	
			curl_close($curl);
			return $response;
		}

		public function CreateOrderGHTK($postData){
			$data = json_encode($postData);
			$linkaddress = $this->link_address;
			$link = $this->link_create_order;
			$key = $this->token_key;
			
			$curl = curl_init();
			curl_setopt_array($curl, array(
				CURLOPT_URL => $linkaddress . $link,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "POST",
				CURLOPT_POSTFIELDS => $data,
				CURLOPT_HTTPHEADER => array(
				"Content-Type: application/json",
				"Token: ".$key,
				"Content-Length: " . strlen($data),
				),
			));
			$response = curl_exec($curl);
			curl_close($curl);
			return $response;
		}

		public function CheckStatusGHTK($getData){
			$data = $getData;
			$linkaddress = $this->link_address;
			$link = $this->link_status;
			$key = $this->token_key;

			$curl = curl_init();
			curl_setopt_array($curl, array(
				CURLOPT_URL => $linkaddress . $link . $data,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_HTTPHEADER => array(
				"Token: ".$key,
				),
			));

			$response = curl_exec($curl);	
			curl_close($curl);

			return $response;
		}

		public function cancelGHTK($postdata){
			$data = $postdata;
			$linkaddress = $this->link_address;
			$link = $this->link_cancel;
			$key = $this->token_key;
			
			$curl = curl_init();
			curl_setopt_array($curl, array(
				CURLOPT_URL => $linkaddress . $link . $data,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "POST",
				CURLOPT_POSTFIELDS => '',
				CURLOPT_HTTPHEADER => array(
				"Content-Type: application/json",
				"Token: ".$key,
				"cache-control: no-cache"
				),
			));
			$response = curl_exec($curl);
			curl_close($curl);
			return $response;
		}
	}

?>