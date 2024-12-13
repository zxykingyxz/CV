<?php 

	class aipWowmelo{

		public $result;

		public $data;

		private $link_address='https://api.wowmelo.com/';

		private $link_oauth='oauth/token';

		private $link_table='v1/package?total=';

		private $link_info_order='v1/order/';

		private $link_verify='v1/verify';

		private $link_complete='v1/complete';

		private $link_create_order='v1/order';

		// token này lấy sau khi gọi hàm getOauthWowl xong
		private $token_key='eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI2MyIsImp0aSI6IjFiN2M4YjYzODc1MjMzYjA0MmQ2ZjdiMGRkY2FkNjBjMzM4ZDlhODg3NDI3NzNhM2E4NWUwYzFkYmVmYjFiZGIwODMyNTNkNGFmMTJkZGU0IiwiaWF0IjoxNjI1MDQ1NTExLCJuYmYiOjE2MjUwNDU1MTEsImV4cCI6MTYyNjM0MTUxMSwic3ViIjoiIiwic2NvcGVzIjpbXX0.xfVRvh0JrKIcONpsyAwWnYDHDzO3k4Dzq3QuBXBwC6aHD-nkpu9iIILLawrUuRVd1YFYhMmVG57tbIiZAvZgOe3t1e4fS6phuZNcSY7ptWQLX7v851YtBvwKbRjaq1pGLcIaWhfhLw1RIRFoWBy1dGXZQ3PnZwDgze49htg-hRdcvp-3OoK3UiUC6Qt54vBzTX_tYRCJjR5CiWTEQN5tz5F5uPYMhUgmgjPQJP8vF6NvKtGc9shopGJQA_D_cG8jyIwB98qwf9IiuHhlEppR_FpfTFwIi0DWeYXVmct2m8BWbiIoOu_Uopda9Ze3AfK1PsDzUTFIEdXiNkYgSEIt4HvCsnCxSVLolVzYs2sm3-GcSVI-PXmsB-OnqEYVHU7KXOtMcCpcAtgBagAp0StcbHXOudOvJpaFulaj3B6PnqOlSxHBfWz0Y6TSRgwpdInvxeiruY0HgwcNjAgMB-fdoZ2tIqtLjMZT0lnSAmztu4aL2uyJgMOlctMVUbOTctQ3mTrSja7SfApUezl74fhkWWMbOEzoUnyywNWOswE32iWfEH5O_iYET7TP0Nu_mT4XJRlJERN5YqgTKHB2ZhipNrX2e1DzpMwM4CHJ04kd2ZytkZXuVW6b1ENvvhtAhmLPxDoHKZFv7oxJtKmVWUNQDIIxVzUQxOWo2Mso7N9SaMM';

		public function getOauthWowl(){

			$data=array(
				'grant_type'=>'client_credentials',
				'client_id'=>63,//bên wowmelo cung cấp
				'client_secret'=>'QnwdEadUVApEB03XsmeP5jzo7l0tDcElKAe5Ql7C' //bên wowmelo cung cấp
			);

			$linkaddress=$this->link_address;

			$link=$this->link_oauth;

			$curl=curl_init();

			curl_setopt_array($curl, array(
				CURLOPT_URL => $linkaddress . $link,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "POST",
				CURLOPT_POSTFIELDS => json_encode($data,JSON_UNESCAPED_UNICODE),
				CURLOPT_HTTPHEADER => array(
				"Accept: application/json",
				"Content-Type: application/json"
				),
			));
			$response = curl_exec($curl);
			curl_close($curl);
			return $response;


		}

		public function getTableWowl($total){

			$linkaddress=$this->link_address;

			$linktable=$this->link_table;

			$key=$this->token_key;

			$curl=curl_init();

			curl_setopt_array($curl, array(
				CURLOPT_URL => $linkaddress.$linktable.$total,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_HTTPHEADER => array(
				"Accept: application/json",
				"Content-Type: application/json",
				"Authorization: Bearer ".$key
				),
			));
			$response = curl_exec($curl);
			curl_close($curl);
			return $response;


		}

		public function createOrderWowmelo($datapost){

			$data=$datapost;

			$linkaddress=$this->link_address;

			$linkorder=$this->link_create_order;

			$key=$this->token_key;

			$curl=curl_init();

			curl_setopt_array($curl, array(
				CURLOPT_URL => $linkaddress.$linkorder,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "POST",
				CURLOPT_POSTFIELDS => json_encode($data,JSON_UNESCAPED_UNICODE),
				CURLOPT_HTTPHEADER => array(
				"Accept: application/json",
				"Content-Type: application/json",
				"Authorization: Bearer ".$key
				),
			));
			$response = curl_exec($curl);
			curl_close($curl);
			return $response;


		}

		public function getInfoOrder($code){

			$linkaddress=$this->link_address;

			$linkorder=$this->link_info_order;

			$key=$this->token_key;

			$curl=curl_init();

			curl_setopt_array($curl, array(
				CURLOPT_URL => $linkaddress.$linkorder.$code,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_HTTPHEADER => array(
				"Accept: application/json",
				"Content-Type: application/json",
				"Authorization: Bearer ".$key
				),
			));
			$response = curl_exec($curl);
			curl_close($curl);
			return $response;


		}

		public function getVerify($code){

			$data=array(
				'order_code'=>$code
			);

			$linkaddress=$this->link_address;

			$linkverify=$this->link_verify;

			$key=$this->token_key;

			$curl=curl_init();

			curl_setopt_array($curl, array(
				CURLOPT_URL => $linkaddress.$linkverify,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "POST",
				CURLOPT_CUSTOMREQUEST => "POST",
				CURLOPT_POSTFIELDS => json_encode($data,JSON_UNESCAPED_UNICODE),
				CURLOPT_HTTPHEADER => array(
				"Accept: application/json",
				"Content-Type: application/json",
				"Authorization: Bearer ".$key
				),
			));
			$response = curl_exec($curl);
			curl_close($curl);
			return $response;


		}

		public function getComplete($code){

			$data=array(
				'order_code'=>$code,
				'receipt' =>'file'
			);

			$linkaddress=$this->link_address;

			$linkcomplete=$this->link_complete;

			$key=$this->token_key;

			$curl=curl_init();

			curl_setopt_array($curl, array(
				CURLOPT_URL => $linkaddress.$linkcomplete,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "POST",
				CURLOPT_CUSTOMREQUEST => "POST",
				CURLOPT_POSTFIELDS => json_encode($data,JSON_UNESCAPED_UNICODE),
				CURLOPT_HTTPHEADER => array(
				"Accept: application/json",
				"Content-Type: application/json",
				"Authorization: Bearer ".$key
				),
			));
			$response = curl_exec($curl);
			curl_close($curl);
			return $response;


		}

	}