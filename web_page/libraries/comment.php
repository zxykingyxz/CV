<?php 
    class comment{

        private $db;

        private $func;

        private $table = 'comment';

        private $com;

        public function __construct($db,$func,$com){

            $this->db=$db;

            $this->func=$func;

            $this->com=$com;

        }

        public function getMans(){

            global $type,$url_path, $items, $paging,$page;

            $perPage = 10;

            $startpoint = ($page * $perPage) - $perPage;

            $limit = ' limit '.$startpoint.','.$perPage;

            $where = '#_'.$this->table;

            $where.=" where 1";

            if($_GET['pid']!='')
            {
                $where.=" and pid = {$_GET['pid']}";
            }

            if($_GET['type']!='')
            {
                $where.=" and type = '{$_GET['type']}'";
            }

            if($_GET['keyword']!='')
            {
                $keyword=   ($_GET['keyword']);
                $where.=" and hoten LIKE '%{$keyword}%'";
            }
           
            $where .=" order by id desc";
            
            $sql = "select * from {$where} {$limit}";

            $items = $this->db->rawQuery($sql);

            $url = $this->func->getCurrentPageURLAdmin();

            $sql = "SELECT COUNT(*) as `num` FROM {$where}";
        
            $count = $this->db->rawQueryOne($sql);

            $total=$count['num'];

            $paging = $this->func->paginationAdmin($total,$perPage,$page,$url);

        }

        public function getMan(){

            global $id,$url_path, $item;

            $id = (int)($_GET['id']);
            $sql = "select * from #_{$this->table} where id=?";
            $item = $this->db->rawQueryOne($sql,array($id));
            
            if(empty($item)){

                $response['status']=201;

                $response['message']="Dữ liệu #id{$id} không có trong hệ thống ";

                $message=base64_encode(json_encode($response));

                $this->func->redirect("index.html?com={$this->com}&act=man{$url_path}&message={$message}");

            }

        }

        /* public function saveMan(){

           

            global $config,$url_path,$folder,$type,$GLOBAL,$table;



            $com=isset($_GET["com"]) ? $_GET["com"] : '';



            $act=isset($_GET["act"]) ? $_GET["act"] : '';



            $tbl=isset($_GET["tbl"]) ? '_'.$_GET["tbl"] : '';



            $file_name=$this->func->imagesName($_FILES['file']['name']);



            $table=$GLOBAL[$com][$type];



            $id = (int)$_GET['id'];



            $data=$_POST['data'];

          

            $file=$_FILES['file'];



            if(!empty($file)){
                if($id){
                    if($file['error']==0){
                        $photo = $this->func->uploadImg($id,"photo","",$file,$folder,$this->com,$table['img-width'],$table['img-height'],$table['img-ratio'],$table['img-b']);
                        $send['photo'] = $photo['photo'];
                    }
                }else{
                    if($file['error']==0){
                        $photo = $this->func->uploadImg(0,"photo","",$file,$folder,$this->com,$table['img-width'],$table['img-height'],$table['img-ratio'],$table['img-b']);
                        $send['photo'] = $photo['photo'];
                    }
                }
            }

            $send['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;

            $savehere = (isset($_POST['save-here'])) ? true : false;

            if($id){

                $send['ngaysua']=time();

                $this->db->where('id', $id);

                $updateData=$this->db->update($this->table);

                var_dump($this->com);die();

                if($updateData){

                    $response['status']=200;

                    $response['message']="Cập nhật thông tin #id{$id} thành cônghaaaaaa";

                    $message=base64_encode(json_encode($response));

                    if($savehere) $this->func->redirect("index.html?com={$this->com}&act=edit{$url_path}&message={$message}");

                    else $this->func->redirect("index.html?com={$this->com}&act=man{$url_path}&message={$message}");

                }else{

                    $response['status']=201;

                    $response['message']="Cập nhật thông tin #id{$id} không thành công";

                    $message=base64_encode(json_encode($response));

                    $this->func->redirect("index.html?com={$this->com}&act=man{$url_path}&message={$message}");

                }

            }

        } */

        public function deleteMan(){

            global $url_path,$folder;
           
            if(isset($_GET['id'])){

                $id =  (int)$_GET['id'];
                $item=$this->db->rawQueryOne("select id from #_{$this->table} where id=?",array($id));

                if($item){

                    $this->db->where('id', $item['id']);
                    $this->db->delete($this->table);
                    $response['status']=200;
                    $response['message']="Xóa thông tin #id{$id} thành công";
                    $message=base64_encode(json_encode($response));
                    $this->func->redirect("index.html?com={$this->com}&act=man{$url_path}&message={$message}");

                }else{

                    $response['status']=201;
                    $response['message']='Hệ thống đang gặp vấn đề, không thể xóa dữ liệu!';
                    $message=base64_encode(json_encode($response));
                    $this->func->redirect("index.html?com={$this->com}&act=man{$url_path}&message={$message}");

                }

            } elseif (isset($_GET['listid'])==true){

                $listid = explode(",",$_GET['listid']);
                if(count($listid)){
                    foreach ($listid as $k => $v) {
                        $id=(int)$v;
                        $item=$this->db->rawQueryOne("select id from #_{$this->table} where id=?",array($id));
                        if($item){
                            $this->db->where('id', $item['id']);
                            $this->db->delete($this->table);
                        }
                    }

                    $response['status']=200;
                    $response['message']="Xóa thông tin thành công";
                    $message=base64_encode(json_encode($response));
                    $this->func->redirect("index.html?com={$this->com}&act=man{$url_path}&message={$message}");
                }else{

                    $response['status']=200;

                    $response['message']='Không nhận được dữ liệu';

                    $message=base64_encode(json_encode($response));

                    $this->func->redirect("index.html?com={$this->com}&act=man{$url_path}&message={$message}");

                }

            }

        }

    }
?>