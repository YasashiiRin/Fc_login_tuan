<?php
class DatabasePDO{
    private $servername = "mysql";
    private $username = "root";
    private $password = "root";
    private $conn;
    public function connect(){
        try{
            $this->conn = new PDO("mysql:host=$this->servername;dbname=appLad", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully";
            return $this->conn;
        }catch(PDOException $e){
            echo "Connection failed: " . $e->getMessage();
            return null;
        }
    }

}
class DatabaseMysql{
    private $servername = "mysql";
    private $username = "root";
    private $password ="root";
    private $dbname = "appLad";

    public function connect(){
        $conn = new mysqli($this->servername, $this->username, $this->password,$this->dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }else{
            echo "Connected successfully";
        }
    }

}
// $testdb = new DatabasePDO();
// $conn= $testdb->connect();
?>