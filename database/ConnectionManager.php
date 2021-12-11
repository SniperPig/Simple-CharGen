<?php
class ConnectionManager {
    private $conn;
    private $host;
    private $user;
    private $password;
    private $dbname;


    function __construct(){
        $config = simplexml_load_file(__DIR__.'\config.xml');

        $this->host = $config->host;
        $this->user = $config->user;
        $this->password = $config->password;
        $this->dbname = $config->dbname;
    }

    function getConnection(){
        try{
            $this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->dbname, $this->user, $this->password);
        }catch(PDOException $exception){
            echo "Database Connection Error: " . $exception->getMessage();
        }

        return $this->conn;
    }

}

?> 