<?php
    class seopages{

        private $_d;

        private $_func;

        private $_table;

        public function __construct($db,$func,$table){

            $this->_d = $db;

            $this->_func = $func;

            $this->_table =$table;

        }
        public function getSeoPage(){

            global $type,$url_path, $item,$setting,$table;

            if(!empty($type)){

                $where=" where type='{$type}'";

            }
            $table=$setting[$this->_table];

            $sql = "select * from #_{$this->_table}{$where} limit 0,1";
           
            $item = $this->_d->rawQueryOne($sql);
        
        }
        public function saveSeoPage(){
           
            global $config,$url_path,$folder,$type,$setting,$table;

            $com=isset($_GET['com']) ? $_GET['com'] : '';

            if(!empty($type)){

                $where=" where type='{$type}'";

                $send['type']=$type;

            }

            $file_name=$this->_func->imagesName($_FILES['file']['name']);
            
            $checkRow = $this->_d->rawQueryOne("select id from #_{$this->_table}{$where}");

            $table=$setting[$this->_table];

            $data=$_POST['data'];

            if($_POST){
                
                foreach($data as $k=>$v){

                    $send[$k]=htmlspecialchars($v);

                }
            }

            $file=$_FILES['file'];

            if(!empty($file)){

                if($file['error']==0){
                        
                    $photo = $this->_func->uploadImg(0,"photo","",$file,$folder,$this->_table,$table['img-width'],$table['img-height'],$table['img-ratio'],$table['img-b']);
                    
                    $send['photo'] = $photo['photo'];

                }
            }

            if(isset($table['seo'])&&$table['seo']==true){

                $dataSeo = (isset($_POST['dataseo'])) ? $_POST['dataseo'] : null;
                if($dataSeo)
                {
                    foreach($dataSeo as $column => $value)
                    {
                        $dataSeo[$column] = htmlspecialchars($value);
                    }
                }

            }

           

            if(!empty($checkRow)){

                $send['ngaysua']=time();

                if(!empty($type)){

                    $this->_d->where('type', $type);

                }

                $updateData=$this->_d->update($this->_table,$send);

                if($updateData){

                    if(isset($table['seo'])&&$table['seo']==true){
                        $this->_d->rawQuery("delete from #_seo where idmuc = ? and com = ? and act = ? and type = ?",array($checkRow['id'],$com,'capnhat',$type));
                        $dataSeo['idmuc'] = $checkRow['id'];
                        $dataSeo['com'] = $com;
                        $dataSeo['act'] = 'capnhat';
                        $dataSeo['type'] = $type;
                        $this->_d->insert('seo',$dataSeo);
                    }
                   
                    $response['status']=200;
                    
                    $response['message']="Cập nhật thông tin thành công";
                    
                    $message=base64_encode(json_encode($response));
                    
                    $this->_func->redirect("index.html?com={$this->_table}&act=capnhat{$url_path}&message={$message}");
                
                }else{
                    
                    $response['status']=201;
                    
                    $response['message']="Cập nhật thông tin không thành công";
                    
                    $message=base64_encode(json_encode($response));
                    
                    $this->_func->redirect("index.html?com={$this->_table}&act=capnhat{$url_path}&message={$message}");
                
                }
            }else{
                $send['ngaytao']=time();
                $insertID=$this->_d->insert($this->_table,$send);
                if($insertID){
                    if(isset($table['seo'])&&$table['seo']==true){
                        $this->_d->rawQuery("delete from #_seo where idmuc = ? and com = ? and act = ? and type = ?",array($insertID,$com,'capnhat',$type));
                        $dataSeo['idmuc'] = $insertID;
                        $dataSeo['com'] = $com;
                        $dataSeo['act'] = 'capnhat';
                        $dataSeo['type'] = $type;
                        $this->_d->insert('seo',$dataSeo);
                    }
                    $response['status']=200;
                    $response['message']="Thêm dữ liệu thành công";
                    $message=base64_encode(json_encode($response));
                    $this->_func->redirect("index.html?com={$this->_table}&act=capnhat{$url_path}&message={$message}");
                }else{
                    $response['status']=201;
                    $response['message']="Thêm dữ liệu không thành công";
                    $message=base64_encode(json_encode($response));
                    $this->_func->redirect("index.html?com={$this->_table}&act=capnhat{$url_path}&message={$message}");
                }
            }
        }
    }
?>