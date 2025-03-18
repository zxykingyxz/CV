<?php

switch ($_ACT) {
    case "login":
        if (!empty($_POST) && $func->isAjax()) {
            echo json_encode(login());
            exit;
        }
        $layouts = "layouts/user/login";
        break;
    case "logout":
        logOut();
        break;
    default:
        break;
}

function login()
{
    global $config, $func, $db;

    if (!empty($_POST)) {
        $data = $_POST;
        $result = [];

        $username =  htmlspecialchars($func->sanitize($data['username']));
        $password =  htmlspecialchars($func->sanitize($data['password']));

        if (empty($username)) {
            $msg = 'Tên tài khoản không được để trống!';
            $result['status'] = 203;
            $result['message'] = $msg;
            return  $result;
        }

        if (empty($password)) {
            $msg = 'Mật khẩu không được để trống!';
            $result['status'] = 203;
            $result['message'] = $msg;
            return  $result;
        } else {
            $password = $func->encryptPassword($config['secret'], $password, $config['salt']);
        }

        $ipAddres = $func->getClientIpServer();

        $sql = "select id, login_ip, login_attempts, locked_time FROM #_user_limit WHERE login_ip = ? AND login_attempts = ? AND locked_time > 0 ";

        $account_lock_check = $db->rawQueryOne($sql, [$ipAddres, $config['login_lock']['login_attempts']]);

        if (!empty($account_lock_check)) {
            $id_login = $account_lock_check['id'];
            $time_now = time();
            //Kiểm tra thời gian bị khóa đăng nhập
            $locked_time = $account_lock_check['locked_time'];
            $lock_time = $config['login_lock']['lock_time'];
            $interval = $time_now - $locked_time;
            if ($interval <= $lock_time) {
                $time_remain = $lock_time - $interval;
                $msg = "Xin lỗi..! Vui lòng thử lại sau " . round($time_remain / (60 * 1000)) . " phút..!";
                $result['status'] = 201;
                $result['message'] = $msg;
            } else {
                $sql = "update #_user_limit set login_attempts = 0, locked_time = 0 where id = '$id_login'";
                $db->rawQuery($sql);
            }
            return $result;
        }

        $dataAccount = $db->rawQueryOne("select * from #_user where username=? and password=? limit 0,1", array($username, $password));

        if (!empty($dataAccount)) {
            $_SESSION[LOGINADMIN] = true;

            $_SESSION['login'] = $dataAccount['id'];
            $_SESSION['isLoggedIn'] = true;

            $timenow = time();
            $id_user = $dataAccount['id'];
            $user_agent = $_SERVER['HTTP_USER_AGENT'];

            //Ghi log truy cập thành công
            $sql = "insert into #_user_log (id_user,ip,timelog,user_agent) values ('$id_user','$ipAddres','$timenow','$user_agent')";
            $db->rawQuery($sql);

            //Tạo token và login session			
            $cookiehash = md5(sha1($dataAccount['password'] . $dataAccount['username']));
            $token = md5(time());
            $sql = "update #_user SET login_session= '$cookiehash', lastlogin = '$timenow', user_token = '$token' WHERE id ='$id_user'";
            $db->rawQuery($sql);

            $_SESSION['login_session'] = $cookiehash;
            $_SESSION['login_token'] = $token;

            //Login thành công thì reset số lần login sai và thời gian khóa
            $sql = "select id,login_ip,login_attempts,locked_time from #_user_limit where login_ip = ? and login_attempts > ? and locked_time > ? order by  id desc ";
            $row_limitlogin = $db->rawQueryOne($sql, [$ipAddres, 0, 0]);

            if (!empty($row_limitlogin)) {
                $id_login = $row_limitlogin['id'];
                $sql = "update #_user_limit set login_attempts = 0,locked_time = 0 where id = '$id_login'";
                $db->rawQuery($sql);
            }

            $result['status'] = 200;
            $result['message'] = 'Đăng nhập thành công';
        } else {
            $sql = "select id,login_ip,login_attempts,locked_time from #_user_limit where login_ip =  '$ipAddres'  order by  id desc limit 1";
            $row_check = $db->rawQueryOne($sql);

            if (!empty($row_check)) { //Trường hơp đã tồn tại trong database	
                $id_login = $row_check['id'];
                $attempt = $row_check['login_attempts']; //Số lần thực hiện
                $noofattmpt = $config['login_lock']['login_attempts']; //Số lần giới hạn
                if ($attempt < $noofattmpt) { //Trường hợp còn trong giới hạn
                    $attempt = $attempt + 1;
                    $sql = "update #_user_limit set login_attempts = ?,locked_time=? where id = ?";
                    $db->rawQueryOne($sql, [$attempt, time(), $id_login]);
                    $no_ofattmpt =  $noofattmpt + 1;
                    $remain_attempt = $no_ofattmpt - $attempt;
                    $msg = 'Sai thông tin. Còn ' . $remain_attempt . ' lần thử!';
                    $result['status'] = 202;
                }
            } else { //Trường hợp IP lần đầu tiên đăng nhập sai
                $sql = "insert into #_user_limit (login_ip,login_attempts,locked_time) values(?,?,?)";
                $db->rawQuery($sql, [$ipAddres, 1, time()]);
                $remain_attempt = $config['login_lock']['login_attempts'];
                $msg = 'Sai thông tin. Còn ' . $remain_attempt . ' lần thử!';
                $result['status'] = 203;
            }
            $result['message'] = $msg;
        }

        return $result;
    }
}
function logOut()
{
    global $func;
    unset($_SESSION[LOGINADMIN]);
    unset($_SESSION['login']);

    $response['status'] = 200;
    $response['message'] = "Đăng xuất thành công";
    $message = base64_encode(json_encode($response));

    $func->redirect($func->getUrlParam(["com" => "user", "src" => "user", "act" => "login", "message" => $message]));
}
