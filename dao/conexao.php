<?php
    class ConexaoComBanco extends PDO{

        private static $instance = null;

        public function __construct($bd,$user,$pass){
            parent::__construct($bd,$user,$pass);
        }

        public static function getInstence(){
            try{
                if(!isset(self::$instance)){
                    self::$instance = new ConexaoComBanco("mysql:dbname=bdtestes;host=localhost","root","");
                }
                return self::$instance;
            }catch(PDOExeption $erro){
                header("location:../erro-bd.html");
            }
        }
    }