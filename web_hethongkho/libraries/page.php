<?php
    class page{

        private $_d;

        private $_func;

        private $_table;

        private $_temp_table;

        public function __construct($db,$func,$table,$temp_table){

            $this->_d = $db;

            $this->_func = $func;

            $this->_table =$table;

            $this->_temp_table =$temp_table;

        }
        public function getInfo(){

            global $type,$url_path, $item,$dsInfo,$GLOBAL,$table;

            if(!empty($type)){

                $where=" where type='{$type}'";

            }
            $table=$GLOBAL[$this->_table][$type];

            $sql = "select * from #_{$this->_table}{$where} limit 0,1";
           
            $item = $this->_d->rawQueryOne($sql);

            $sql_ds="select * from #_{$this->_temp_table}{$where} order by stt asc, id desc ";
            
            $dsInfo = $this->_d->rawQuery($sql_ds);
        
        }
        public function saveInfo(){
           
            global $config,$url_path,$folder,$type,$GLOBAL,$table;

            $com=isset($_GET['com']) ? $_GET['com'] : '';

            if(!empty($type)){

                $where=" where type='{$type}'";

                $send['type']=$type;

            }

            $file_name=$this->_func->imagesName($_FILES['file']['name']);
            $sql="select id from #_{$this->_table}{$where}";

            $checkRow = $this->_d->rawQueryOne($sql);

            $table=$GLOBAL[$this->_table][$type];

            $data=$_POST['data'];

            if($_POST){
                
                foreach($data as $k=>$v){

                    $send[$k]=htmlspecialchars($this->_func->magicQuote($v));
                    
                }
            }

            $file=$_FILES['file'];

            $file1=$_FILES['file1'];

            $file2=$_FILES['file2'];

            if(!empty($file)){

                if($file['error']==0){
                        
                    $photo = $this->_func->uploadImg(0,"photo","",$file,$folder,$this->_table,$table['img-width'],$table['img-height'],$table['img-ratio'],$table['img-b']);
                    
                    $send['photo'] = $photo['photo'];

                }
            }
            if(!empty($file1)){
               
                if($file1['error']==0){
                        
                    $photo = $this->_func->uploadImg(0,"bgtop","",$file1,$folder,$this->_table,$table['img-width'],$table['img-height'],$table['img-ratio'],$table['img-b']);
                    
                    $send['bgtop'] = $photo['bgtop'];

                }

            }
            if(!empty($file2)){
               
                if($file2['error']==0){
                        
                    $photo = $this->_func->uploadImg(0,"bgcontent","",$file2,$folder,$this->_table,$table['img-width'],$table['img-height'],$table['img-ratio'],$table['img-b']);
                    
                    $send['bgcontent'] = $photo['bgcontent'];

                }

            } 

            if($this->_func->checkColumna($this->_table,'seo')){
                $send['seo']=implode(',',$_POST['seo']);
            }


            if($this->_func->checkColumna($this->_table,'hienthi')){

                $send['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;

            };
            if((isset($table['seo'])&&$table['seo']==true)
                || (isset($GLOBAL['setting']['seo'])&&$GLOBAL['setting']['seo']==true)){

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
                        $dataSeo['idmuc'] = 0;
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
                        $dataSeo['idmuc'] = 0;
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