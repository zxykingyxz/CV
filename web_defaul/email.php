<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include_once _lib . "PHPMailer/PHPMailer.php";
include_once _lib . "PHPMailer/SMTP.php";
include_once _lib . "PHPMailer/Exception.php";

class email
{
	private $db;
	private $data = array();
	private $config = array();
	private $setting = array();
	private $opt = '';

	function __construct($db, $config, $setting)
	{
		$this->db = $db;
		$this->config = $config;
		$this->setting = $setting;
		$this->infoEmail();
	}

	public function infoEmail()
	{
		global $https_config, $lang;
		$logo = array();
		$social = array();
		$socialString = '';
		$this->opt = $this->config['optionsEmail'];
		$this->data['email'] = ($this->opt['mailertype'] == 1) ? $this->opt['email_host'] : $this->opt['email_gmail'];
		$logo = $this->db->rawQueryOne("select photo as photo from #_bannerqc where hienthi=1 and type=? limit 0,1", array('logo'));
		$social = $this->db->rawQuery("select photo as photo,ten_$lang as ten,link from #_photo where hienthi=1 and type=? order by stt asc,id desc", array("mangxahoi"));
		if ($social && count($social) > 0) {
			foreach ($social as $value) {
				$socialString .= '<a href="' . $value['link'] . '" target="_blank"><img src="' . $https_config . _upload_hinhanh_l . $value['photo'] . '" style="max-height:30px;margin:0 0 0 5px" /></a>';
			}
		}
		$this->data['email'] = ($this->optcompany['mailertype'] == 1) ? $this->optcompany['email_host'] : $this->optcompany['email_gmail'];
		$this->data['color'] = '#94130F';
		$this->data['home'] = $https_config;
		$this->data['logo'] = '<img src="' . $https_config . _upload_hinhanh_l . $logo['photo'] . '" style="max-height:70px;" >';
		$this->data['social'] = $socialString;
		$this->data['datesend'] = time();
		$this->data['company'] = $this->setting['name_' . $lang];
		$this->data['company:address'] = $this->setting['address_' . $lang];
		$this->data['company:email'] = $this->setting['email'];
		$this->data['company:hotline'] = $this->setting['hotline'];
		$this->data['company:website'] = $this->setting['website'];
		$this->data['company:worktime'] = '(8-21h cả T7,CN)';
	}

	public function setEmail($key, $value)
	{
		if ($key != '' && $value != '') {
			$this->data[$key] = $value;
		}
	}

	public function getEmail($key)
	{
		return $this->data[$key];
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

	public function defaultAttrs()
	{
		$default = array();
		$default['vars'] = array(
			'{emailColor}',
			'{emailHome}',
			'{emailLogo}',
			'{emailSocial}',
			'{emailMail}',
			'{emailDateSend}',
			'{emailCompanyName}',
			'{emailCompanyWebsite}',
			'{emailCompanyAddress}',
			'{emailCompanyMail}',
			'{emailCompanyHotline}',
			'{emailCompanyWorktime}'
		);
		$default['vals'] = array(
			$this->getEmail('color'),
			$this->getEmail('home'),
			$this->getEmail('logo'),
			$this->getEmail('social'),
			$this->getEmail('email'),
			'Ngày ' . date('d', time()) . ' tháng ' . date('m', time()) . ' năm ' . date('Y H:i:s', time()),
			$this->getEmail('company'),
			$this->getEmail('company:website'),
			$this->getEmail('company:address'),
			$this->getEmail('company:email'),
			$this->getEmail('company:hotline'),
			$this->getEmail('company:worktime')
		);

		return $default;
	}

	public function addAttrs($array1 = array(), $array2 = array())
	{
		if (!empty($array1) && !empty($array2)) {
			foreach ($array2 as $k2 => $v2) {
				array_push($array1, $v2);
			}
		}

		return $array1;
	}

	public function sendEmail($owner = '', $arrayEmail = array(), $subject = "", $message = "", $file = '')
	{
		global $https_config, $lang;

		$mail = new PHPMailer(true);

		$config_host = '';
		$config_port = 0;
		$config_secure = '';
		$config_email = '';
		$config_password = '';

		if ($this->opt['mailertype'] == 1) {
			$config_host = $this->opt['ip_host'];
			$config_port = $this->opt['port_host'];
			$config_secure = $this->opt['secure_host'];
			$config_email = $this->opt['email_host'];
			$config_password = $this->opt['password_host'];

			$mail->IsSMTP();
			$mail->SMTPAuth = true;
			$mail->SMTPDebug = false;
			$mail->SMTPSecure = $config_secure;
			$mail->SMTPOptions = array(
				'ssl' => array(
					'verify_peer' => false,
					'verify_peer_name' => false,
					'allow_self_signed' => true
				)
			);
			$mail->Host = $config_host;
			$mail->Port = $config_port;
			$mail->Username = $config_email;
			$mail->Password = $config_password;
			$mail->SetFrom($this->opt['email_host'], $this->setting['name_' . $lang]);
		} else if ($this->opt['mailertype'] == 2) {
			$config_host = $this->opt['host_gmail'];
			$config_port = $this->opt['port_gmail'];
			$config_secure = $this->opt['secure_gmail'];
			$config_email = $this->opt['email_gmail'];
			$config_password = $this->opt['password_gmail'];

			$mail->IsSMTP();
			$mail->SMTPAuth = true;
			$mail->SMTPDebug = false;
			$mail->SMTPSecure = $config_secure;
			$mail->Host = $config_host;
			$mail->Port = $config_port;
			$mail->Username = $config_email;
			$mail->Password = $config_password;
			$mail->SetFrom($config_email, $this->setting['name_' . $lang]);
			$mail->From = $config_email;
			$mail->FromName = $this->setting['name_' . $lang];
		}

		if ($owner == 'admin') {
			$mail->AddAddress($this->opt['email_host'], $this->setting['name_' . $lang]);
			$mail->addCC($this->setting['email'], $this->setting['name_' . $lang]);
		} else if ($owner == 'customer') {
			if ($arrayEmail && count($arrayEmail) > 0) {
				foreach ($arrayEmail as $vEmail) {
					$mail->AddAddress($vEmail['email'], $vEmail['name']);
				}
			}
		}
		$mail->CharSet = "utf-8";
		$mail->AltBody = "To view the message, please use an HTML compatible email viewer!";
		$mail->Subject = $subject;
		$mail->MsgHTML($message);
		if ($file != '' && isset($_FILES[$file]) && !$_FILES[$file]['error']) {
			$mail->AddAttachment($_FILES[$file]["tmp_name"], $_FILES[$file]["name"]);
		}

		if ($mail->Send()) return true;
		else return false;
	}
}
