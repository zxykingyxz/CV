<?php

    class templates{

        private $db;

        private $lang;

        public function __construct($db,$lang){

            $this->db=$db;

            $this->lang=$lang;
        }

        function getImage($data=[],$folder=_upload_baiviet_l,$class="",$w,$h){
            global $imgDefault;
            $html="";
            if(is_array($data)){
                $name = (isset($data["ten_$lang"])) ? $data["ten_$lang"] : $data["ten"];
                $photo = $folder.$data['photo'];
                $html.="
                    <span class='d-block hover-left cubic-img ratio-cover ratio-img {$class}' img-width='{$w}' img-height='{$h}'>
                    <img class='ratio-img__content img-scale' width='{$w}' height='{$h}' data-src='".$photo."' src='".$imgDefault."' alt='".$name."'>             
                </span>
                ";
            }
            return $html;

        }

        function getLinkImage($data=[],$folder=_upload_baiviet_l,$class="",$w,$h,$link){
            global $imgDefault;
            $html="";
            if(is_array($data)){
                $name = (isset($data["ten_$lang"])) ? $data["ten_$lang"] : $data["ten"];
                $photo = $folder.$data['photo'];
                $href = ($link == 1) ? $data["type"].'/'.$data["tenkhongdau"] : $data["link"];
                $html.="
                    <a href='".$href."' title='".$name."' class='d-block hover-left cubic-img ratio-cover ratio-img {$class}'
                    role='link' rel='dofollow' img-width='{$w}' img-height='{$h}'>
                    <img class='ratio-img__content img-scale' width='{$w}' height='{$h}' data-src='".$photo."' src='".$imgDefault."' alt='".$name."'>             
                </a>
                ";
            }
            return $html;

        }

        public function getOption($arr=array()){

            $html="";
            if(is_array($arr)){

                foreach($arr as $k => $v){
                    $id = $v["id"];
                    // $name = $v["ten_{$this->lang}"];
                    $name = (isset($v["ten_$lang"])) ? $v["ten_$lang"] : $v["ten"];
                    $html.="<option value='{$id}'>{$name}</option>";
                }
            }
            return $html;

        }

        public function getProduct($arr=array(),$class="col l-12 m-12 c-12"){

            $html="";

                if(is_array($arr)){

                   foreach($arr as $k => $v){
                        $photos = $this->db->rawQuery($sql);
                        $html.="
                            <div class=''>
                                <div class='thumb'>
                                    {$this->getImage()}
                                </div>
                            </div>
                        ";

                   }

                }

            return $html;

        }



    }

?>