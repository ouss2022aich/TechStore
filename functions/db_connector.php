<?php 

    define("DB_USER" , "root");
    define("DB_PASS" , "");
    define("DB_NAME" , "tech_shop_db");
    define("DB_HOST" , "localhost");


    function get_conn() {

       $dsn = 'mysql:host='.DB_HOST.';dbname='.DB_NAME;
       try {
         return new PDO( $dsn , DB_USER , DB_PASS);
       } catch (Exception $e) {
         echo '<div class="alert alert-danger"> '.$e->getMessage().' </div>';
       }
    }


?>