<?php
class Validator
{

    private $error = [];
    private $csrfInput;
    private $csrfMeta;

    public function __construct($func)
    {
        $this->createCsrf($func);
    }

    private function json_encode($data, $min = true, $header = false)
    {
        if ($header == true) {
            header('Content-Type: application/json; charset=utf-8');
        }
        $data = ($min === true) ? json_encode($data, JSON_UNESCAPED_UNICODE) : json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        return str_replace(['&#039;', '&quot;', '&amp;'], ['\'', '\"', '&'], $data);
    }
    private function json_decode($data)
    {
        return json_decode($data, true);
    }
    private function is_json($scheme)
    {
        if (is_null($scheme) or is_array($scheme)) {
            return false;
        }
        if ($this->json_decode($scheme)) {
            return true;
        }
        return false;
    }
    private function base64url_encode($plainText)
    {
        $base64 = base64_encode($plainText);
        $base64url = strtr($base64, '+/=', '-_,');
        return $base64url;
    }
    private function base64url_decode($plainText)
    {
        $base64url = strtr($plainText, '-_,', '+/=');
        $base64 = base64_decode($base64url);
        return $base64;
    }
    private function encode_aes($value = false)
    {
        if (!$value) return false;
        $iv_size = openssl_cipher_iv_length('aes-256-cbc');
        $iv = openssl_random_pseudo_bytes($iv_size);
        $crypttext = openssl_encrypt($value, 'aes-256-cbc', SALT, OPENSSL_RAW_DATA, $iv);
        return $this->base64url_encode($iv . $crypttext);
    }
    private function decode_aes($value = false)
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


    public function isRequired($data)
    {
        if (strlen(trim($data)) != 0) {
            return false;
        }
        return true;
    }

    public function checkMaxLenght($data, $max_lenght)
    {
        if (strlen(trim($data)) <= $max_lenght) {
            return false;
        }
        return true;
    }
    public function validateMinNum($data, $max_lenght)
    {
        if (strlen(trim($data)) <= $max_lenght) {
            return false;
        }
        return true;
    }
    public function maxSizeValid($file, $max_size)
    {
        if ($file['size'] > $max_size) {
            return false;
        }
    }
    public function checkMinLenght($data, $min_lenght)
    {
        if (strlen(trim($data)) >= $min_lenght) {
            return false;
        }
        return true;
    }
    public function minNum($data, $min)
    {
        if (strlen(trim($data)) >= $min) {
            return false;
        }
        return true;
    }
    public function maxNum($data, $max)
    {
        if (strlen(trim($data)) <= $max) {
            return false;
        }
        return true;
    }
    public function isEmail($data)
    {
        if (filter_var($data, FILTER_VALIDATE_EMAIL)) {
            return false;
        } else {
            return true;
        }
    }
    public function isPhone($data)
    {
        $number = trim($data);
        if (preg_match_all('/^(0|84)(2(0[3-9]|1[0-6|8|9]|2[0-2|5-9]|3[2-9]|4[0-9]|5[1|2|4-9]|6[0-3|9]|7[0-7]|8[0-9]|9[0-4|6|7|9])|3[2-9]|5[5|6|8|9]|7[0|6-9]|8[0-6|8|9]|9[0-4|6-9])([0-9]{7})$/m', $number, $matches, PREG_SET_ORDER, 0)) {
            return false;
        } else {
            return true;
        }
    }
    public function isFileValid($file, $allowed_types = [])
    {
        // Check if file was uploaded successfully
        if (!isset($file['error']) || is_array($file['error'])) {
            return false; // Error occurred during file upload
        }

        // Check if file upload encountered any error
        switch ($file['error']) {
            case UPLOAD_ERR_OK:
                break;
            case UPLOAD_ERR_NO_FILE:
                return false; // No file was uploaded
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                return false; // File size exceeds the upload_max_filesize directive in php.ini
            default:
                return false; // Unknown error occurred
        }  // Check file type if allowed types are specified
        if (!empty($allowed_types) && !in_array($file['type'], $allowed_types)) {
            return false; // File type is not allowed
        }

        // All checks passed, file is valid
        return true;
    }

    public function createCsrf($func)
    {
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = $func->generateToken(30);
        }
    }


    public function validate($validate, $rules = [], $status = true)
    {
        if ($status) {
            if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                $this->error['csrf'] = "Token không tồn tại!";
            }
        }
        foreach ($validate as $key => $item) {
            $x = explode('|', $item);
            $x = array_reverse($x);
            foreach ($x as $y) {
                list($key1, $value1) = explode(':', $y);
                switch ($key1) {
                    case 'required':
                        if ($this->isRequired($_POST['data'][$key])) {
                            if ($rules[$key][$key1] != null) {
                                $this->error[$key] = $rules[$key][$key1];
                            } else {
                                $this->error[$key] = 'Vui lòng nhập thông tin';
                            }
                        }
                        break;
                    case 'max-lenght':
                        if ($this->checkMaxLenght($_POST['data'][$key], $value1)) {
                            if ($rules[$key][$key1] != null) {
                                $this->error[$key] = $rules[$key][$key1];
                            } else {
                                $this->error[$key] = 'Vui lòng nhập tối đa ' . $value1 . ' ký tự';
                            }
                        }
                        break;
                    case 'min-lenght':
                        if ($this->checkMinLenght($_POST['data'][$key], $value1)) {
                            if ($rules[$key][$key1] != null) {
                                $this->error[$key] = $rules[$key][$key1];
                            } else {
                                $this->error[$key] = 'Vui lòng nhập tối thiểu ' . $value1 . ' ký tự';
                            }
                        }
                        break;
                    case 'min':
                        if ($this->minNum($_POST['data'][$key], $value1)) {
                            if ($rules[$key][$key1] != null) {
                                $this->error[$key] = $rules[$key][$key1];
                            } else {
                                $this->error[$key] = 'Vui lòng số >=' . $value1;
                            }
                        }
                        break;
                    case 'max':
                        if ($this->maxNum($_POST['data'][$key], $value1)) {
                            if ($rules[$key][$key1] != null) {
                                $this->error[$key] = $rules[$key][$key1];
                            } else {
                                $this->error[$key] = 'Vui lòng số <=' . $value1;
                            }
                        }
                        break;

                    case 'email':
                        if ($this->isEmail($_POST['data'][$key])) {
                            if ($rules[$key][$key1] != null) {
                                $this->error[$key] = $rules[$key][$key1];
                            } else {
                                $this->error[$key] = 'Email không đúng định dạng';
                            }
                        }
                        break;
                    case 'phone':
                        if ($this->isPhone($_POST['data'][$key])) {
                            if ($rules[$key][$key1] != null) {
                                $this->error[$key] = $rules[$key][$key1];
                            } else {
                                $this->error[$key] = 'Số điện thoại không đúng định dạng';
                            }
                        }
                        break;
                    case 'file':
                        if (!$this->isFileValid($_FILES[$key], explode(",", $value1))) {
                            if ($rules[$key][$key1] != null) {
                                $this->error[$key] = $rules[$key][$key1];
                            } else {
                                $this->error[$key] = 'Tệp không hợp lệ';
                            }
                        }
                        break;
                    case 'image':
                        if (isset($_FILES[$key])) {
                            $type = [
                                'image/jpeg',
                                'image/png',
                                'image/jpg',
                                'image/svg+xml',
                                'image/gif',
                            ];
                            if (!$this->isFileValid($_FILES[$key],  $type)) {
                                if ($rules[$key][$key1] != null) {
                                    $this->error[$key] = $rules[$key][$key1];
                                } else {
                                    $this->error[$key] = 'Vui lòng nhập đúng định dang file image : .jpeg, .jpg, .svg, .gif, .png, ...';
                                }
                            }
                        }
                        break;
                    case 'size':
                        if (!$this->maxSizeValid($_FILES[$key],  $value1)) {
                            if ($rules[$key][$key1] != null) {
                                $this->error[$key] = $rules[$key][$key1];
                            } else {
                                $this->error[$key] = "Kích thước file nhập vào phải <= {$value1}";
                            }
                        }
                        break;
                }
            }
        }
        return $this->error;
    }
    public function getJson()
    {
        return $this->json_encode($this->error);
    }
}
