<?php 
    abstract class Connection {
        private static $con;

        public static function getCon(){
            if (self::$con == null){ //para criar apenas um objeto de conexão
                self::$con = new PDO('mysql: host=localhost; dbname=sitepost;', 'root', 'root123');

            }
            //self ao invés de this por conta do atributo ser estático
            return self::$con;
        }
    }
?>