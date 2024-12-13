<?php
    class base{

        private $imgDefault = './assets/images/loading-image.png';
        
        public function __construct($db,$lang){

            $this->db=$db;

            $this->lang=$lang;
        }

    }

?>