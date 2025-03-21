<?php
    class userAdmin{

        private $_d;//kết nối database

        private $_func;//hàm được gọi để thực thi chức năng cần thiết

        private $_com;//com của page cũng là bảng để lưu dữ liệu

        private $_tblPer="phanquyen";

        private $_role=3;

        public function __construct($db,$func,$com){

            $this->_d=$db;

            $this->_func=$func;

            $this->_com=$com;

        }

        public function getMans(){

            global $type,$url_path, $items, $paging,$page;

            $perPage = 10;

            $startpoint = ($page * $perPage) - $perPage;
            
            $limit = ' limit '.$startpoint.','.$perPage;

            $where = '#_'.$this->_com;

            $where.=" where role='{$this->_role}'";

            if($_GET['type'] == 'daduyet'){

                $where.=" and hienthi = 1";

            }
            if($_GET['type'] == 'chuaduyet'){

                $where.=" and hienthi = 0";

            }

            if(!empty($_GET['key']))
            {
                $keyword=htmlspecialchars($_GET['keyword']);
                
                $where.=" and (ten like '%{$keyword}%' or username = '{$keyword}')";
            }

            $where.=" and com!='admin' order by stt desc,id desc";

            $sql = "select * from {$where} {$limit}";

            $items = $this->_d->rawQuery($sql);

            $url = $this->_func->getCurrentPageURLAdmin();

            $sql = "SELECT COUNT(*) as `numb` FROM {$where}";
            
            $count = $this->_d->rawQueryOne($sql);

            $total=$count['numb'];

            $paging = $this->_func->paginationAdmin($total,$perPage,$page,$url);

        }

        public function getMan(){

            global $type,$url_path, $item;
    
            $id = (int)($_GET['id']);

            if(!$id){

                $response['status']=201;

                $response['message']="Không nhận dữ liệu";

                $message=base64_encode(json_encode($response));

                $this->_func->redirect("index.html?com={$this->_com}&act=man".$url_path."&message=".$message);

            }
            
            $sql = "select * from #_{$this->_com} where id='{$id}' and role={$this->_role}";

            $item=$this->_d->rawQueryOne($sql);

            if(empty($item)){

                $response['status']=201;

                $response['message']="Dữ liệu không có thực";

                $message=base64_encode(json_encode($response));

                $this->_func->redirect("index.html?com={$this->_com}&act=man".$url_path."&message=".$message);

            }
        
        }

        public function saveMan(){
            global $config,$url_path,$folder,$type,$GLOBAL;

            $file_name=$this->_func->imagesName($_FILES['file']['name']);

            $table=$GLOBAL[$this->_com][$type];

            $id = (int)$_GET['id'];

            $data=$_POST['data'];

            if($_POST){

                foreach($data as $k=>$v){

                    if($k != 'oldpassword'){

                        $send[$k]=htmlspecialchars($this->_func->magicQuote($v));

                    }
                    
                }
                
            }

            if(!preg_match('/^[a-zA-Z_\-.0-9]/',$data['username'])){

                $response['status']=201;

                $response['message']="Tên đăng nhập phải là số và ký tự không dấu";

                $message=base64_encode(json_encode($response));

                $this->_func->redirect("index.html?com={$this->_com}&act=man{$url_path}&message={$message}");

            }

            if(!filter_var($data['email'],FILTER_VALIDATE_EMAIL)){

                $response['status']=201;

                $response['message']="Địa chỉ email không đúng định dạng";

                $message=base64_encode(json_encode($response));

                $this->_func->redirect("index.html?com={$this->_com}&act=man{$url_path}&message={$message}");

            }

            $file=$_FILES['avatar'];

            if(!empty($file)){

                if($id){

                    if($file['error']==0){
                        
                        $photo = $this->_func->uploadImg($id,"avatar","",$file,$folder,$this->_com,$table['img-width'],$table['img-height'],$table['img-ratio'],$table['img-b']);
                        
                        $send['avatar'] = $photo['avatar'];
                    }

                }else{

                    if($file['error']==0){
                        
                        $photo = $this->_func->uploadImg(0,"avatar","",$file,$folder,$this->_com,$table['img-width'],$table['img-height'],$table['img-ratio'],$table['img-b']);
                        
                        $send['avatar'] = $photo['avatar'];

                    }
                }
            }
            
            $send['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
            
            if($id){
                
                if(!empty($data['oldpassword'])){

                    $sql="select password from table_user where username='".$data['username']."'";

                    $row_user=$this->_d->rawQueryOne($sql);

                    $oldpassword=$this->_func->encryptPassword($config['secret'],$data['oldpassword'] ,$config['salt']);
                    
                    if($row_user['password']==$oldpassword){

                        if(!empty($_POST['newpassword'])){

                            if(!empty($_POST['cfpassword'])){

                                if($_POST['newpassword']==$_POST['cfpassword']){
                    
                                    if(!empty($data['oldpassword'])){
                                    
                                        $send['password'] = $this->_func->encryptPassword($config['secret'],$_POST['newpassword'] ,$config['salt']);
                                
                                    }

                                    $send['ngaysua']=time();
                                    
                                    $this->_d->where('id', $id);
                                
                                    $this->_d->where('role', $this->_role);
                                    
                                    $updateData=$this->_d->update($this->_com,$send);
                                    
                                    if($updateData){
                                    
                                        $response['status']=200;
                                    
                                        $response['message']="Cập nhật thông tin #id{$id} thành công";
                                        
                                        $message=base64_encode(json_encode($response));
                                        
                                        $this->_func->redirect("index.html?com={$this->_com}&act=man{$url_path}&message={$message}");
                                    
                                    }else{
                                    
                                        $response['status']=201;
                                        
                                        $response['message']="Cập nhật thông tin #id{$id} không thành công";
                                    
                                        $message=base64_encode(json_encode($response));
                                        
                                        $this->_func->redirect("index.html?com={$this->_com}&act=man{$url_path}&message={$message}");
                                    
                                    }
                                }else{
                                    $response['status']=201;

                                    $response['message']="Mật khẩu mới không khớp nhau!";
                
                                    $message=base64_encode(json_encode($response));
                
                                    $this->_func->redirect("index.html?com={$this->_com}&act=edit{$url_path}&message={$message}");
                                }
                            }else{
                                $response['status']=201;

                                $response['message']="Vui lòng nhập lại mật khẩu mới!";
            
                                $message=base64_encode(json_encode($response));
            
                                $this->_func->redirect("index.html?com={$this->_com}&act=edit{$url_path}&message={$message}");
                            }
                        }else{
                            $response['status']=201;

                            $response['message']="Vui lòng nhập mật khẩu mới!";
        
                            $message=base64_encode(json_encode($response));
        
                            $this->_func->redirect("index.html?com={$this->_com}&act=edit{$url_path}&message={$message}");
                        }
                    }else{
                        $response['status']=201;

                        $response['message']="Mật khẩu cũ không khớp!";

                        $message=base64_encode(json_encode($response));

                        $this->_func->redirect("index.html?com={$this->_com}&act=edit{$url_path}&message={$message}");
                    }
                }else{
                    $response['status']=201;

                    $response['message']="Vui lòng nhập mật khẩu cũ!";

                    $message=base64_encode(json_encode($response));

                    $this->_func->redirect("index.html?com={$this->_com}&act=edit{$url_path}&message={$message}");
                }
            }else{
                
                $send['password'] = $this->_func->encryptPassword($config['secret'],$_POST['newpassword'] ,$config['salt']);
               
                $send['ngaytao']=time();
                
                $send['type']=$type;

                $insertID=$this->_d->insert($this->_com,$send);
                
                if($insertID){

                    $response['status']=200;

                    $response['message']="Thêm dữ liệu #id{$insertID} thành công";

                    $message=base64_encode(json_encode($response));

                    $this->_func->redirect("index.html?com={$this->_com}&act=man{$url_path}&message={$message}");
                
                }else{

                    $response['status']=201;

                    $response['message']="Thêm dữ liệu #id{$insertID} không thành công";

                    $message=base64_encode(json_encode($response));

                    $this->_func->redirect("index.html?com={$this->_com}&act=man{$url_path}&message={$message}");
                
                }
            }
        }
        public function deleteMan(){

            global $type,$url_path,$folder;
        
            if(isset($_GET['id'])){

                $id =  (int)$_GET['id'];

                $item=$this->_d->rawQueryOne("select * from #_{$this->_com} where id=?",array($id));

                if($item){
        
                   $this->_func->deleteLink($folder.$item['avatar']);

                    $this->_d->rawQuery("delete from #_{$this->_com} where id=?",array($id));

                    $response['status']=200;
                    
                    $response['message']="Xóa thông tin #id{$id} thành công";
                    
                    $message=base64_encode(json_encode($response));
                    
                    $this->_func->redirect("index.html?com={$this->_com}&act=man{$url_path}&message={$message}");

                }else{

                     $response['status']=201;
                   
                    $response['message']='Dũ liệu không có trong hệ thống!';
                   
                    $message=base64_encode(json_encode($response));
                   
                    $this->_func->redirect("index.html?com={$this->_com}&act=man{$url_path}&message={$message}");
                }
                

            } elseif (isset($_GET['listid'])==true){
        
                $listid = explode(",",$_GET['listid']);

                foreach ($listid as $k => $v){

                    $id =(int)$v;

                    $item=$this->_d->rawQuery("select avatar from #_{$this->_com} where id=?",array($id));

                    if($item){

                        $this->_func->deleteLink($folder.$item['avatar']);

                        $this->_d->rawQuery("delete from #_{$this->_com} where id={$id}");

                    }
                }

                $response['status']=200;

                $response['message']='Xóa thông tin thành công';

                $message=base64_encode(json_encode($response));

                $this->_func->redirect("index.html?com={$this->_com}&act=man{$url_path}&message={$message}");

            } else {

                $response['status']=201;

                $response['message']='Hệ thống đang gặp vấn đề, không thể xóa dữ liệu!';

                $message=base64_encode(json_encode($response));

                $this->_func->redirect("index.html?com={$this->_com}&act=man{$url_path}&message={$message}");

            }
        }

        function perMission(){

            global $item, $ds_quyen;

            $id = (int)($_GET['id']);

            if(!$id){

                $response['status']=201;

                $response['message']="Không nhận được dữ liệu";

                $message=base64_encode(json_encode($response));

                $this->_func->redirect("index.html?com={$this->_com}&act=man".$url_path."&message=".$message);

            }

            $item=$this->_d->rawQueryOne("select * from #_{$this->_com} where id='{$id}' and role={$this->_role}");

            if(empty($item)){

                $response['status']=201;

                $response['message']="Tài khoản không tồn tại";

                $message=base64_encode(json_encode($response));

                $this->_func->redirect("index.html?com={$this->_com}&act=man".$url_path."&message=".$message);

            }

            $arr = $this->_d->rawQueryOne("select id,funtions from #_{$this->_tblPer} where permission='{$id}'");

            if(!empty($arr))
            {
                foreach($arr as $quyen)
                {
                    $ds_quyen[] = $quyen['funtions'];
                }
            }
            else
            {
                $ds_quyen[] = '';
            }
        }
        function savePerMission()
        {
            global $url_path;

            $id = (int)($_POST['id']);

            if(!$id){

                $response['status']=201;

                $response['message']="Không nhận được dữ liệu";

                $message=base64_encode(json_encode($response));

                $this->_func->redirect("index.html?com={$this->_com}&act=man".$url_path."&message=".$message);

            }

            $item=$this->_d->rawQueryOne("select * from #_{$this->_com} where id='{$id}' and role={$this->_role}");

            if(empty($item)){

                $response['status']=201;

                $response['message']="Tài khoản không tồn tại";

                $message=base64_encode(json_encode($response));

                $this->_func->redirect("index.html?com={$this->_com}&act=man".$url_path."&message=".$message);

            }
            $this->_d->rawQuery("delete from #_{$this->_tblPer} where permission='{$id}'");

            $quyen=$_POST['quyen'];

            for($i=0;$i<count($quyen);$i++)
            {   

                $data['permission'] = $id;

                $data['funtions'] = $quyen[$i];

                $this->_d->insert($this->_tblPer,$data);

            }

            unset($_SESSION['permissions']);

            unset($_SESSION['login']);

            $this->_func->redirect("index.html?com={$this->_com}&act=login".$url_path."&message=".$message);

        }

        public function logOut(){

            global $login_name,$url_path;

            $_SESSION[$login_name] = false;

            $response['status']=200;

            $response['message']="Đăng xuất thành công";

            $message=base64_encode(json_encode($response));

            $this->_func->redirect("index.html?com={$this->_com}&act=login".$url_path."&message=".$message);

        }
        
    }
?>