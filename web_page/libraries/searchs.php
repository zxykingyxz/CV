<?php
    class searchs{

        private $_d;//kết nối database

        private $_func;//tất cả hàm được gọi để thực hiện chức năng cần thiết

        private $_com;//com của page

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

            $where.=" where type='$type'";

            if($_GET['id_list']!='')
            {
                $where.=" and id_list = {$_GET['id_list']}";
            }
            if($_GET['id_cat']!='')
            {
                $where.=" and id_cat = {$_GET['id_cat']}";
            }
            if($_GET['id_item']!='')
            {
                $where.=" and id_item = {$_GET['id_item']}";
            }
            if($_GET['id_sub']!='')
            {
                $where.=" and id_sub = {$_GET['id_sub']}";
            }

            if($_GET['keyword']!='')
            {
                $keyword=   ($_GET['keyword']);
                
                $where.=" and ten_vi LIKE '%{$keyword}%'";
            }

            $where .=" order by stt asc, id desc";

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

            $sql = "select * from #_{$this->_com} where id='{$id}'";
           
            $item=$this->_d->rawQueryOne($sql);
            
            if(empty($item)){
               
                $response['status']=201;
               
                $response['message']="Dữ liệu #id{$id} không có trong hệ thống ";
               
                $message=base64_encode(json_encode($response));
                
                $this->_func->redirect("index.html?com={$this->_com}&act=man{$url_path}&message={$message}");
            
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

                    $send[$k]=htmlspecialchars($this->_func->magicQuote($v));
                    
                }
                
            }

            $file=$_FILES['file'];

            if(!empty($file)){

                if($id){

                    if($file['error']==0){
                        
                        $photo = $this->_func->uploadImg($id,"photo","thumb",$file,$folder,$this->_com,$table['img-width'],$table['img-height'],$table['img-ratio'],$table['img-b']);
                        
                        $send['photo'] = $photo['photo'];
                        
                        $send['thumb'] = $photo['thumb'];
                    }

                }else{

                    if($file['error']==0){
                        
                        $photo = $this->_func->uploadImg(0,"photo","thumb",$file,$folder,$this->_com,$table['img-width'],$table['img-height'],$table['img-ratio'],$table['img-b']);
                        
                        $send['photo'] = $photo['photo'];
                        
                        $send['thumb'] = $photo['thumb'];

                    }
                }
            }

            if($data['phantram']){

                $send['phantram']=str_replace(',','',$data['phantram']);

            }
            
            if($data['giatu']){

                $send['giatu']=str_replace(',','',$data['giatu']);

            }
            if($data['giaden']){

                $send['giaden']=str_replace(',','',$data['giaden']);

            }
            if($data['tenkhongdau']){

                $data['tenkhongdau'] = $this->_func->changeTitle($_POST['ten_vi']);

            }
            $send['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
            
            if($id){
                $send['ngaysua']=time();
                $this->_d->where('id', $id);
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
            global $type,$lang,$url_path,$folder;
            if(isset($_GET['id'])){
                $id =  (int)$_GET['id'];
                $item=$this->_d->rawQueryOne("select id from #_{$this->_com} where id=?",array($id));
                if($item){
                    $this->_d->where('id', $item['id']);
                    $this->_d->delete($this->_com);
                    $response['status']=200;
                    $response['message']="Xóa thông tin #id{$id} thành công";
                    $message=base64_encode(json_encode($response));
                    $this->_func->redirect("index.html?com={$this->_com}&act=man{$url_path}&message={$message}");
                }else{
                    $response['status']=201;
                    $response['message']='Hệ thống đang gặp vấn đề, không thể xóa dữ liệu!';
                    $message=base64_encode(json_encode($response));
                    $this->_func->redirect("index.html?com={$this->_com}&act=man{$url_path}&message={$message}");
                }
            } elseif (isset($_GET['listid'])==true){
        
                $listid = explode(",",$_GET['listid']);
                if(count($listid)){
                    foreach ($listid as $k => $v) {
                        $id=(int)$v;
                        $item=$this->_d->rawQueryOne("select id from #_{$this->_com} where id=?",array($id));
                        if($item){
                            $this->_d->where('id', $item['id']);
                            $this->_d->delete($this->_com);
                        }
                    }
                    $response['status']=200;
                    $response['message']="Xóa thông tin thành công";
                    $message=base64_encode(json_encode($response));
                    $this->_func->redirect("index.html?com={$this->_com}&act=man{$url_path}&message={$message}");
                }else{
                    $response['status']=200;
                    $response['message']='Không nhận được dữ liệu';
                    $message=base64_encode(json_encode($response));
                    $this->_func->redirect("index.html?com={$this->_com}&act=man{$url_path}&message={$message}");
                }
            }
        }

    }
?>