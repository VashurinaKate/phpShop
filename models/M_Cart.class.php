<?php
// include_once('../configuration/db.config.php');
define('DB_DRIVER','mysql');
define('DB_HOST','localhost');
define('DB_NAME','shop');
define('DB_USER','root');
define('DB_PASS','root');

class M_Cart {
    const DB_DRIVER = 'mysql';
    const DB_HOST = 'localhost';
    const DB_NAME = 'shop';
    const DB_USER = 'root';
    const DB_PASS = 'root';

    function getCart($userId) {
        $connect_str = self::DB_DRIVER . ':host='. self::DB_HOST . ';dbname=' . self::DB_NAME;
        $db = new PDO($connect_str,self::DB_USER,self::DB_PASS);

        $sql = "SELECT * FROM cart WHERE user_id=$userId";
        $res = $db->prepare($sql);
        $res->execute();
        $data = $res->fetchAll(PDO::FETCH_ASSOC);
        if ($data) {
            return $data;
        } else {
            // die($userId);
            return false;
        }
        unset($db);
    }

    function addToCart($userId, $goodId) {
        $connect_str = self::DB_DRIVER . ':host='. self::DB_HOST . ';dbname=' . self::DB_NAME;
        $db = new PDO($connect_str,self::DB_USER,self::DB_PASS);

        $sql = "INSERT INTO cart (`good_id`, `order_id`, `user_id`, `amount`, `date_of_create`, `date_of_update`, `status`) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $res = $db->prepare($sql);

        $date = date("Y-m-d");
        $data = $res->execute([$goodId, 1, $userId, 1, $date, $date, 'active']);
        if ($data) {
            return $res->fetchAll(PDO::FETCH_ASSOC);
        } else {
            // return false;
            die($res->fetchAll(PDO::FETCH_ASSOC));
        }
        unset($db);
    }

    function removeFromCart($userId, $goodId) {
        $connect_str = self::DB_DRIVER . ':host='. self::DB_HOST . ';dbname=' . self::DB_NAME;
        $db = new PDO($connect_str,self::DB_USER,self::DB_PASS);

        $sql = "UPDATE cart SET amount=$amount WHERE good_id=$id";
        $res = $db->prepare($sql);
        $data = $res->execute();
        if ($data) {
            return $res->fetchAll(PDO::FETCH_ASSOC); // true
        } else {
            die('error');
        }
        unset($db);
    }
}
