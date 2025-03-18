<?php
class userAdmin
{
    private $_db; //kết nối database
    private $_func; //hàm được gọi để thực thi chức năng cần thiết
    private $_tableSql = "user";
    private $_tblPer = "phanquyen";
    private $_role = 3;

    public function __construct($db, $func)
    {
        $this->_db = $db;
        $this->_func = $func;
    }
    public function login()
    {
        global $config;

        if (!empty($_POST)) {
            $data = $_POST;
            $result = [];

            $username =  htmlspecialchars($this->_func->sanitize($data['username']));
            $password =  htmlspecialchars($this->_func->sanitize($data['password']));

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
                $password = $this->_func->encryptPassword($config['secret'], $password, $config['salt']);
            }

            $ipAddres = $this->_func->getClientIpServer();

            $sql = "select id, login_ip, login_attempts, locked_time FROM #_user_limit WHERE login_ip = ? AND login_attempts = ? AND locked_time > 0 ";

            $account_lock_check = $this->_db->rawQueryOne($sql, [$ipAddres, $config['login_lock']['login_attempts']]);

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
                    $this->_db->rawQuery($sql);
                }
                return $result;
            }

            $dataAccount = $this->_db->rawQueryOne("select * from #_user where username=? and password=? limit 0,1", array($username, $password));

            if (!empty($dataAccount)) {
                $_SESSION[LOGINADMIN] = true;

                $_SESSION['login'] = $dataAccount['id'];
                $_SESSION['isLoggedIn'] = true;

                $timenow = time();
                $id_user = $dataAccount['id'];
                $user_agent = $_SERVER['HTTP_USER_AGENT'];

                //Ghi log truy cập thành công
                $sql = "insert into #_user_log (id_user,ip,timelog,user_agent) values ('$id_user','$ipAddres','$timenow','$user_agent')";
                $this->_db->rawQuery($sql);

                //Tạo token và login session			
                $cookiehash = md5(sha1($dataAccount['password'] . $dataAccount['username']));
                $token = md5(time());
                $sql = "update #_user SET login_session= '$cookiehash', lastlogin = '$timenow', user_token = '$token' WHERE id ='$id_user'";
                $this->_db->rawQuery($sql);

                $_SESSION['login_session'] = $cookiehash;
                $_SESSION['login_token'] = $token;

                //Login thành công thì reset số lần login sai và thời gian khóa
                $sql = "select id,login_ip,login_attempts,locked_time from #_user_limit where login_ip = ? and login_attempts > ? and locked_time > ? order by  id desc ";
                $row_limitlogin = $this->_db->rawQueryOne($sql, [$ipAddres, 0, 0]);

                if (!empty($row_limitlogin)) {
                    $id_login = $row_limitlogin['id'];
                    $sql = "update #_user_limit set login_attempts = 0,locked_time = 0 where id = '$id_login'";
                    $this->_db->rawQuery($sql);
                }

                $result['status'] = 200;
                $result['message'] = 'Đăng nhập thành công';
            } else {
                $sql = "select id,login_ip,login_attempts,locked_time from #_user_limit where login_ip =  '$ipAddres'  order by  id desc limit 1";
                $row_check = $this->_db->rawQueryOne($sql);

                if (!empty($row_check)) { //Trường hơp đã tồn tại trong database	
                    $id_login = $row_check['id'];
                    $attempt = $row_check['login_attempts']; //Số lần thực hiện
                    $noofattmpt = $config['login_lock']['login_attempts']; //Số lần giới hạn
                    if ($attempt < $noofattmpt) { //Trường hợp còn trong giới hạn
                        $attempt = $attempt + 1;
                        $sql = "update #_user_limit set login_attempts = ?,locked_time=? where id = ?";
                        $this->_db->rawQueryOne($sql, [$attempt, time(), $id_login]);
                        $no_ofattmpt =  $noofattmpt + 1;
                        $remain_attempt = $no_ofattmpt - $attempt;
                        $msg = 'Sai thông tin. Còn ' . $remain_attempt . ' lần thử!';
                        $result['status'] = 202;
                    }
                } else { //Trường hợp IP lần đầu tiên đăng nhập sai
                    $sql = "insert into #_user_limit (login_ip,login_attempts,locked_time) values(?,?,?)";
                    $this->_db->rawQuery($sql, [$ipAddres, 1, time()]);
                    $remain_attempt = $config['login_lock']['login_attempts'];
                    $msg = 'Sai thông tin. Còn ' . $remain_attempt . ' lần thử!';
                    $result['status'] = 203;
                }
                $result['message'] = $msg;
            }

            return $result;
        }
    }
    public function getMans()
    {

        global $type, $url_path, $items, $paging, $page;

        $perPage = 10;
        $startpoint = ($page * $perPage) - $perPage;
        $limit = ' limit ' . $startpoint . ',' . $perPage;
        $where = '#_' . $this->_tableSql;
        $where .= " where role='{$this->_role}'";
        if ($_GET['type'] == 'daduyet') {
            $where .= " and hienthi = 1";
        }
        if ($_GET['type'] == 'chuaduyet') {
            $where .= " and hienthi = 0";
        }
        if (!empty($_GET['key'])) {
            $keyword = htmlspecialchars($_GET['keyword']);
            $where .= " and (ten like '%{$keyword}%' or username = '{$keyword}')";
        }
        $where .= " and com!='admin' order by stt desc,id desc";
        $sql = "select * from {$where} {$limit}";
        $items = $this->_db->rawQuery($sql);
        $url = $this->_func->getCurrentPageURLAdmin();
        $sql = "SELECT COUNT(*) as `numb` FROM {$where}";
        $count = $this->_db->rawQueryOne($sql);
        $total = $count['numb'];
        $paging = $this->_func->paginationAdmin($total, $perPage, $page, $url);
    }

    public function getMan()
    {

        global $type, $url_path, $item;
        $id = (int)($_GET['id']);
        if (!$id) {
            $response['status'] = 201;
            $response['message'] = "Không nhận dữ liệu";
            $message = base64_encode(json_encode($response));
            $this->_func->redirect("index.html?com={$this->_tableSql}&act=man" . $url_path . "&message=" . $message);
        }

        $sql = "select * from #_{$this->_tableSql} where id='{$id}' and role={$this->_role}";
        $item = $this->_db->rawQueryOne($sql);

        if (empty($item)) {
            $response['status'] = 201;
            $response['message'] = "Dữ liệu không có thực";
            $message = base64_encode(json_encode($response));
            $this->_func->redirect("index.html?com={$this->_tableSql}&act=man" . $url_path . "&message=" . $message);
        }
    }

    public function saveMan()
    {
        global $config, $url_path, $folder, $type, $GLOBAL;

        $file_name = $this->_func->imagesName($_FILES['file']['name']);

        $table = $GLOBAL[$this->_tableSql][$type];

        $id = (int)$_GET['id'];

        $data = $_POST['data'];

        if ($_POST) {

            foreach ($data as $k => $v) {

                if ($k != 'oldpassword') {

                    $send[$k] = htmlspecialchars($this->_func->magicQuote($v));
                }
            }
        }

        if (!preg_match('/^[a-zA-Z_\-.0-9]/', $data['username'])) {

            $response['status'] = 201;

            $response['message'] = "Tên đăng nhập phải là số và ký tự không dấu";

            $message = base64_encode(json_encode($response));

            $this->_func->redirect("index.html?com={$this->_tableSql}&act=man{$url_path}&message={$message}");
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {

            $response['status'] = 201;

            $response['message'] = "Địa chỉ email không đúng định dạng";

            $message = base64_encode(json_encode($response));

            $this->_func->redirect("index.html?com={$this->_tableSql}&act=man{$url_path}&message={$message}");
        }

        $file = $_FILES['avatar'];

        if (!empty($file)) {

            if ($id) {

                if ($file['error'] == 0) {

                    $photo = $this->_func->uploadImg($id, "avatar", "", $file, $folder, $this->_tableSql, $table['img-width'], $table['img-height'], $table['img-ratio'], $table['img-b']);

                    $send['avatar'] = $photo['avatar'];
                }
            } else {

                if ($file['error'] == 0) {

                    $photo = $this->_func->uploadImg(0, "avatar", "", $file, $folder, $this->_tableSql, $table['img-width'], $table['img-height'], $table['img-ratio'], $table['img-b']);

                    $send['avatar'] = $photo['avatar'];
                }
            }
        }

        $send['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;

        if ($id) {

            if (!empty($data['oldpassword'])) {

                $sql = "select password from table_user where username='" . $data['username'] . "'";

                $row_user = $this->_db->rawQueryOne($sql);

                $oldpassword = $this->_func->encryptPassword($config['secret'], $data['oldpassword'], $config['salt']);

                if ($row_user['password'] == $oldpassword) {

                    if (!empty($_POST['newpassword'])) {

                        if (!empty($_POST['cfpassword'])) {

                            if ($_POST['newpassword'] == $_POST['cfpassword']) {

                                if (!empty($data['oldpassword'])) {

                                    $send['password'] = $this->_func->encryptPassword($config['secret'], $_POST['newpassword'], $config['salt']);
                                }

                                $send['ngaysua'] = time();

                                $this->_db->where('id', $id);

                                $this->_db->where('role', $this->_role);

                                $updateData = $this->_db->update($this->_tableSql, $send);

                                if ($updateData) {

                                    $response['status'] = 200;

                                    $response['message'] = "Cập nhật thông tin #id{$id} thành công";

                                    $message = base64_encode(json_encode($response));

                                    $this->_func->redirect("index.html?com={$this->_tableSql}&act=man{$url_path}&message={$message}");
                                } else {

                                    $response['status'] = 201;

                                    $response['message'] = "Cập nhật thông tin #id{$id} không thành công";

                                    $message = base64_encode(json_encode($response));

                                    $this->_func->redirect("index.html?com={$this->_tableSql}&act=man{$url_path}&message={$message}");
                                }
                            } else {
                                $response['status'] = 201;

                                $response['message'] = "Mật khẩu mới không khớp nhau!";

                                $message = base64_encode(json_encode($response));

                                $this->_func->redirect("index.html?com={$this->_tableSql}&act=edit{$url_path}&message={$message}");
                            }
                        } else {
                            $response['status'] = 201;

                            $response['message'] = "Vui lòng nhập lại mật khẩu mới!";

                            $message = base64_encode(json_encode($response));

                            $this->_func->redirect("index.html?com={$this->_tableSql}&act=edit{$url_path}&message={$message}");
                        }
                    } else {
                        $response['status'] = 201;

                        $response['message'] = "Vui lòng nhập mật khẩu mới!";

                        $message = base64_encode(json_encode($response));

                        $this->_func->redirect("index.html?com={$this->_tableSql}&act=edit{$url_path}&message={$message}");
                    }
                } else {
                    $response['status'] = 201;

                    $response['message'] = "Mật khẩu cũ không khớp!";

                    $message = base64_encode(json_encode($response));

                    $this->_func->redirect("index.html?com={$this->_tableSql}&act=edit{$url_path}&message={$message}");
                }
            } else {
                $response['status'] = 201;

                $response['message'] = "Vui lòng nhập mật khẩu cũ!";

                $message = base64_encode(json_encode($response));

                $this->_func->redirect("index.html?com={$this->_tableSql}&act=edit{$url_path}&message={$message}");
            }
        } else {

            $send['password'] = $this->_func->encryptPassword($config['secret'], $_POST['newpassword'], $config['salt']);

            $send['ngaytao'] = time();

            $send['type'] = $type;

            $insertID = $this->_db->insert($this->_tableSql, $send);

            if ($insertID) {

                $response['status'] = 200;

                $response['message'] = "Thêm dữ liệu #id{$insertID} thành công";

                $message = base64_encode(json_encode($response));

                $this->_func->redirect("index.html?com={$this->_tableSql}&act=man{$url_path}&message={$message}");
            } else {

                $response['status'] = 201;

                $response['message'] = "Thêm dữ liệu #id{$insertID} không thành công";

                $message = base64_encode(json_encode($response));

                $this->_func->redirect("index.html?com={$this->_tableSql}&act=man{$url_path}&message={$message}");
            }
        }
    }
    public function deleteMan()
    {

        global $type, $url_path, $folder;

        if (isset($_GET['id'])) {

            $id =  (int)$_GET['id'];

            $item = $this->_db->rawQueryOne("select * from #_{$this->_tableSql} where id=?", array($id));

            if ($item) {

                $this->_func->deleteLink($folder . $item['avatar']);

                $this->_db->rawQuery("delete from #_{$this->_tableSql} where id=?", array($id));

                $response['status'] = 200;

                $response['message'] = "Xóa thông tin #id{$id} thành công";

                $message = base64_encode(json_encode($response));

                $this->_func->redirect("index.html?com={$this->_tableSql}&act=man{$url_path}&message={$message}");
            } else {

                $response['status'] = 201;

                $response['message'] = 'Dũ liệu không có trong hệ thống!';

                $message = base64_encode(json_encode($response));

                $this->_func->redirect("index.html?com={$this->_tableSql}&act=man{$url_path}&message={$message}");
            }
        } elseif (isset($_GET['listid']) == true) {

            $listid = explode(",", $_GET['listid']);

            foreach ($listid as $k => $v) {

                $id = (int)$v;

                $item = $this->_db->rawQuery("select avatar from #_{$this->_tableSql} where id=?", array($id));

                if ($item) {

                    $this->_func->deleteLink($folder . $item['avatar']);

                    $this->_db->rawQuery("delete from #_{$this->_tableSql} where id={$id}");
                }
            }

            $response['status'] = 200;

            $response['message'] = 'Xóa thông tin thành công';

            $message = base64_encode(json_encode($response));

            $this->_func->redirect("index.html?com={$this->_tableSql}&act=man{$url_path}&message={$message}");
        } else {

            $response['status'] = 201;

            $response['message'] = 'Hệ thống đang gặp vấn đề, không thể xóa dữ liệu!';

            $message = base64_encode(json_encode($response));

            $this->_func->redirect("index.html?com={$this->_tableSql}&act=man{$url_path}&message={$message}");
        }
    }

    function perMission()
    {

        global $item, $ds_quyen;

        $id = (int)($_GET['id']);

        if (!$id) {

            $response['status'] = 201;

            $response['message'] = "Không nhận được dữ liệu";

            $message = base64_encode(json_encode($response));

            $this->_func->redirect("index.html?com={$this->_tableSql}&act=man" . $url_path . "&message=" . $message);
        }

        $item = $this->_db->rawQueryOne("select * from #_{$this->_tableSql} where id='{$id}' and role={$this->_role}");

        if (empty($item)) {

            $response['status'] = 201;

            $response['message'] = "Tài khoản không tồn tại";

            $message = base64_encode(json_encode($response));

            $this->_func->redirect("index.html?com={$this->_tableSql}&act=man" . $url_path . "&message=" . $message);
        }

        $arr = $this->_db->rawQueryOne("select id,funtions from #_{$this->_tblPer} where permission='{$id}'");

        if (!empty($arr)) {
            foreach ($arr as $quyen) {
                $ds_quyen[] = $quyen['funtions'];
            }
        } else {
            $ds_quyen[] = '';
        }
    }
    function savePerMission()
    {
        global $url_path;

        $id = (int)($_POST['id']);

        if (!$id) {

            $response['status'] = 201;

            $response['message'] = "Không nhận được dữ liệu";

            $message = base64_encode(json_encode($response));

            $this->_func->redirect("index.html?com={$this->_tableSql}&act=man" . $url_path . "&message=" . $message);
        }

        $item = $this->_db->rawQueryOne("select * from #_{$this->_tableSql} where id='{$id}' and role={$this->_role}");

        if (empty($item)) {

            $response['status'] = 201;

            $response['message'] = "Tài khoản không tồn tại";

            $message = base64_encode(json_encode($response));

            $this->_func->redirect("index.html?com={$this->_tableSql}&act=man" . $url_path . "&message=" . $message);
        }
        $this->_db->rawQuery("delete from #_{$this->_tblPer} where permission='{$id}'");

        $quyen = $_POST['quyen'];

        for ($i = 0; $i < count($quyen); $i++) {

            $data['permission'] = $id;

            $data['funtions'] = $quyen[$i];

            $this->_db->insert($this->_tblPer, $data);
        }

        unset($_SESSION['permissions']);

        unset($_SESSION['login']);

        $this->_func->redirect("index.html?com={$this->_tableSql}&act=login" . $url_path . "&message=" . $message);
    }

    public function logOut()
    {
        unset($_SESSION[LOGINADMIN]);
        unset($_SESSION['login']);

        $response['status'] = 200;
        $response['message'] = "Đăng xuất thành công";
        $message = base64_encode(json_encode($response));

        $this->_func->redirect($this->_func->getUrlParam(["com" => "user", "act" => "login"]) . "&message=" . $message);
    }
}
