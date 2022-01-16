<?php
// include_once('../configuration/db.config.php');
define('DB_DRIVER','mysql');
define('DB_HOST','localhost');
define('DB_NAME','shop');
define('DB_USER','root');
define('DB_PASS','root');

class M_Catalog {
    const DB_DRIVER = 'mysql';
    const DB_HOST = 'localhost';
    const DB_NAME = 'shop';
    const DB_USER = 'root';
    const DB_PASS = 'root';

    function getGoods($limit) {
        $connect_str = self::DB_DRIVER . ':host='. self::DB_HOST . ';dbname=' . self::DB_NAME;
        $db = new PDO($connect_str,self::DB_USER,self::DB_PASS);

        if (isset($_GET['limit'])) {
            $limit = $_GET['limit'];
        } else {
            $limit = 3;
        }
        $sql = "SELECT * FROM goods LIMIT $limit";
        $res = $db->prepare($sql);
        $data = $res->execute();
        if ($data) {
            return $res->fetchAll(PDO::FETCH_ASSOC);
        } else {
            die('Error');
        }
        unset($db);
    }
}
