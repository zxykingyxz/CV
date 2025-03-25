<?php

class Encryption
{

    private $_ipad;
    private $_opad;
    private $_key;
    public function __construct($key)
    {
        $this->_key = sha1($key);
        if (isset($key[64])) {
            $key = pack('H32', $this->_key);
        }

        if (!isset($key[64])) {
            $key = str_pad($key, 64, chr(0));
        }

        $this->_ipad = substr($key, 0, 64) ^ str_repeat(chr(0x36), 64);
        $this->_opad = substr($key, 0, 64) ^ str_repeat(chr(0x5C), 64);
    }
    public function hash($data, $is_salt = false)
    {
        $inner = pack('H32', sha1($this->_ipad . $data));
        $digest = sha1($this->_opad . $inner);
        if (! $is_salt) {
            return $digest;
        }
        $mhast = constant('MHASH_SHA1');
        $salt = substr(sha1(microtime() . $this->_key), 0, 8);
        $salt = mhash_keygen_s2k($mhast, $digest, substr(pack('h*', md5($salt)), 0, 8), 4);
        $hash = strtr(base64_encode(mhash($mhast, $digest . $salt) . $salt), '+/=', '-_,');
        return $hash;
    }
    // $crypt->hash_password($_user['password1'], $global_config['hashprefix']);
    public function hash_password($password, $hashprefix = '{SSHA}')
    {
        switch ($hashprefix) {
            case '{SSHA512}':
                $salt = substr(sha1(microtime() . $this->_key), 0, 4);
                return '{SSHA512}' . base64_encode(hash('sha512', $password . $salt, true) . $salt);

            case '{SSHA256}':
                $salt = substr(sha1(microtime() . $this->_key), 0, 4);
                return '{SSHA256}' . base64_encode(hash('sha256', $password . $salt, true) . $salt);
            case '{SSHA}':
                $salt = substr(sha1(microtime() . $this->_key), 0, 4);
                return '{SSHA}' . base64_encode(sha1($password . $salt, true) . $salt);
            case '{SHA}':
                return '{SHA}' . base64_encode(sha1($password, true));
            case '{MD5}':
                return '{MD5}' . base64_encode(md5($password, true));
            default:
                return $this->hash($password);
        }
    }
    // !$crypt->validate_password($nv_password, $row['password']))
    public function validate_password($password, $hash)
    {
        switch (true) {
            case (substr($hash, 0, 9) == '{SSHA512}'):
                $salt = substr(base64_decode(substr($hash, 9)), 64);
                $validate_hash = '{SSHA512}' . base64_encode(hash('sha512', $password . $salt, true) . $salt);
                break;
            case (substr($hash, 0, 9) == '{SSHA256}'):
                $salt = substr(base64_decode(substr($hash, 9)), 32);
                $validate_hash = '{SSHA256}' . base64_encode(hash('sha256', $password . $salt, true) . $salt);
                break;
            case (substr($hash, 0, 6) == '{SSHA}'):
                $salt = substr(base64_decode(substr($hash, 6)), 20);
                $validate_hash = '{SSHA}' . base64_encode(sha1($password . $salt, true) . $salt);
                break;
            case (substr($hash, 0, 5) == '{SHA}'):
                $validate_hash = '{SHA}' . base64_encode(sha1($password, true));
                break;
            case (substr($hash, 0, 5) == '{MD5}'):
                $validate_hash = '{MD5}' . base64_encode(md5($password, true));
                break;
            default:
                $validate_hash = $this->hash($password);
                break;
        }
        return hash_equals($hash, $validate_hash);
    }

    function generalPassword($length = 8, $type = 0)
    {
        $array_chars = array();
        $array_chars[0] = 'abcdefghijklmnopqrstuvwxyz';
        $array_chars[1] = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $array_chars[2] = '0123456789';
        $array_chars[3] = '-=~!@#$%^&*()_+,./<>?;:[]{}\|';

        $_arr_m = array();
        $_arr_m[] = 0; // Chữ
        $_arr_m[] = 2; // 1. Số
        $_arr_m[] = ($type == 2 or $type == 4) ? 3 : mt_rand(0, 2); // 2. Đặc biệt
        $_arr_m[] = ($type == 3 or $type == 4) ? 1 : mt_rand(0, 2); // 3. HOA

        $length = $length - 4;
        for ($k = 0; $k < $length; ++$k) {
            $_arr_m[] = ($type == 2 or $type == 4) ? mt_rand(0, 3) : mt_rand(0, 2);
        }

        $pass = '';
        foreach ($_arr_m as $m) {
            $chars = $array_chars[$m];
            $max = strlen($chars) - 1;
            $pass .= $chars[mt_rand(0, $max)];
        }
        return $pass;
    }
    public function encrypt($data, $iv = '')
    {
        $iv = empty($iv) ? substr($this->_key, 0, 16) : substr($iv, 0, 16);

        $data = openssl_encrypt($data, 'aes-256-cbc', $this->_key, 0, $iv);
        return strtr($data, '+/=', '-_,');
    }
    public function decrypt($data, $iv = '')
    {
        $iv = empty($iv) ? substr($this->_key, 0, 16) : substr($iv, 0, 16);

        $data = strtr($data, '-_,', '+/=');
        return openssl_decrypt($data, 'aes-256-cbc', $this->_key, 0, $iv);
    }
}
