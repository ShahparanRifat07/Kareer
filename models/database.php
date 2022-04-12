<?php


class Database{
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $db = "kareer_db";

    public function connect_db(){
        $connection =  mysqli_connect($this->host,$this->username,$this->password,$this->db);
        return $connection;
    }

    public function save($query){
        $con = $this->connect_db();
        $result = mysqli_query($con,$query);

        if(!$result){
            return false;
        }else{
            return true;
        }
    }
}

?>
