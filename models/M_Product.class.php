<?php
// include_once('../configuration/db.config.php');
define('DB_DRIVER','mysql');
define('DB_HOST','localhost');
define('DB_NAME','shop');
define('DB_USER','root');
define('DB_PASS','root');

class M_Product {
    const DB_DRIVER = 'mysql';
    const DB_HOST = 'localhost';
    const DB_NAME = 'shop';
    const DB_USER = 'root';
    const DB_PASS = 'root';

    function getProduct($id) {
        $connect_str = self::DB_DRIVER . ':host='. self::DB_HOST . ';dbname=' . self::DB_NAME;
        $db = new PDO($connect_str,self::DB_USER,self::DB_PASS);

        $sql = "SELECT * FROM goods WHERE id=$id";
        $res = $db->prepare($sql);
        $data = $res->execute();
        if ($data) {
            return $res->fetchAll(PDO::FETCH_ASSOC);
        } else {
            die('error');
        }
        unset($db);
    }
}
