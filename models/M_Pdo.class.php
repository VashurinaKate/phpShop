<?php

class M_Pdo {
    private static $instance;
    private $db;

    public static function Instance()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct()
    {
        setlocale(LC_ALL, 'ru_RU.UTF8');	
        $this->db = new PDO(DB_DRIVER.':host=' .DB_SERVER . ';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
        $this->db->exec('SET NAMES UTF8');
        $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }

    public function Select($query) {
        $sql = $this->db->prepare($query);
        $sql->execute();

        // if ($sql->errorCode() != PDO::ERR_NONE){
        //     $info = $sql->errorInfo();
        //     die($info[2]); 
        // }

        return $sql->fetch();
    }

    public function Insert ($table, $object) {
        $columns = array();

        foreach ($object as $key => $value) {
            $columns[] = $key;
            // $masks[] = "'$value'";
            $masks[] = ":$key";
            
            if ($value === null) {
                $object[$key] = 'NULL';
            }
        }

        $columns_s = implode(',', $columns);
        $masks_s = implode(',', $masks);

        $query = "INSERT INTO $table ($columns_s) VALUES ($masks_s)";

        $q = $this -> db -> prepare($query);
        $q->execute($object);

        if ($q -> errorCode() != PDO::ERR_NONE) {
            // $info = $q -> errorInfo();
            // die($info[2]);
            die(print_r($object));
        }
        return $this -> db -> lastInsertId();		
    }
	
    public function Update($table, $object, $where) {
        $sets = array();

        foreach($object as $key => $value){
            $sets[] = "$key='$value'";
            if($value === NULL){
                $object[$key]='NULL';
            }
        }

        $sets_s = implode(',',$sets);
        $query = "UPDATE $table SET $sets_s WHERE $where";
        $q = $this->db->prepare($query);
        $q->execute($object);

        // if($q->errorCode() != PDO::ERR_NONE){
        //     $info = $q->errorInfo();
        //     die($info[2]); 
        // }

        return $q->rowCount();
    }

    public function Delete ($table, $where) {
        $query = "DELETE FROM $table WHERE $where";
        $q = $this->db->prepare($query);
        $q->execute();

        // if($q->errorCode() != PDO::ERR_NONE){
        //     $info = $q->errorInfo();
        //     die($info[2]); 
        // }
        return $q->rowCount();
    }
}
