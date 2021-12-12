<?php 

require_once('../database/ConnectionManager.php');

    class Character{
        private $characterID;
        private $clientID;
        private $characterJSON;

        public $fName;
        public $lName;
        public $species;
        public $eyeColor;
        public $height; 
        public $age;
        public $dateOfBirth;

        private  $connectionManager;
        private \PDO $dbConnection;

        function __constructor(){
            $this->connectionManager = new ConnectionManager();
            $this->dbConnection = $this->connectionManager->getConnection();
        }

        public function NewCharacter($clientID, $characterJSON){
            $this->clientID = $clientID;
            $this->characterJSON = $characterJSON;

            $this->connectionManager = new ConnectionManager();
            $this->dbConnection = $this->connectionManager->getConnection();
            // Testing values being passed
            // echo $this->clientID;
            // var_dump($this->characterJSON);
        }


        /**
         * insert character into database
         */
        public function insert() {
            $stmt = $this->dbConnection->prepare("INSERT INTO characters(clientID, characterJSON)
            VALUES (:clientID, :characterJSON)");
            $stmt->execute(["clientID"=>$this->clientID, "characterJSON"=>$this->characterJSON]);

            // Get the day and time (in the MySQL DATETIME format)
            $timezone  = -5; //(GMT -5:00) EST (U.S. & Canada)
            $today = gmdate("Y-m-j H:i:s", time() + 3600*($timezone+date("I")));

            $requestType = "Insert";

            $stmtElse = $this->dbConnection->prepare("INSERT INTO requests(clientID, requestTime, requestType)
            VALUES (:clientID, :requestTime, :requestType)");
            $stmtElse->execute(["clientID"=>$this->clientID, "requestTime"=>$today, "requestType"=>$requestType]);
        }

        /**
         * Get all the characters created by a client from the database
         */
        function getAllCharactersByClient($clientID){
            $stmt = $this->dbConnection->prepare("SELECT * FROM characters WHERE clientID = :clientID");
            $stmt->execute(["clientID"=>$clientID]);
            return $stmt->fetch(PDO::FETCH_ASSOC);

            // Get the day and time (in the MySQL DATETIME format)
            $timezone  = -5; //(GMT -5:00) EST (U.S. & Canada)
            $today = gmdate("Y-m-j H:i:s", time() + 3600*($timezone+date("I")));

            $requestType = "GET";

            $stmtElse = $this->dbConnection->prepare("INSERT INTO requests(clientID, requestTime, requestType)
            VALUES (:clientID, :requestTime, :requestType)");
            $stmtElse->execute(["clientID"=>$this->clientID, "requestTime"=>$today, "requestType"=>$requestType]);
        }

        /**
         * Get one character created by a client from the database
         */
        function getClientCharacterByID($clientID, $characterID){
            $stmt = $this->dbConnection->prepare("SELECT * FROM characters WHERE clientID = :clientID AND characterID = :characterID");
            $stmt->execute(["clientID"=>$clientID, "characterID"=>$characterID]);
            return $stmt->fetch(PDO::FETCH_ASSOC);

            // Get the day and time (in the MySQL DATETIME format)
            $timezone  = -5; //(GMT -5:00) EST (U.S. & Canada)
            $today = gmdate("Y-m-j H:i:s", time() + 3600*($timezone+date("I")));

            $requestType = "GET";

            $stmtElse = $this->dbConnection->prepare("INSERT INTO requests(clientID, requestTime, requestType)
            VALUES (:clientID, :requestTime, :requestType)");
            $stmtElse->execute(["clientID"=>$this->clientID, "requestTime"=>$today, "requestType"=>$requestType]);
        }

        /**
         * Delete one character created by a client in the  database
         */
        function deleteCharacterByID($clientID, $characterID){
            $stmt = $this->dbConnection->prepare("DELETE FROM characters WHERE clientID = :clientID AND characterID = :characterID");
            $stmt->execute(["clientID"=>$clientID, "characterID"=>$characterID]);
            return $stmt->fetch(PDO::FETCH_ASSOC);

            // Get the day and time (in the MySQL DATETIME format)
            $timezone  = -5; //(GMT -5:00) EST (U.S. & Canada)
            $today = gmdate("Y-m-j H:i:s", time() + 3600*($timezone+date("I")));

            $requestType = "GET";

            $stmtElse = $this->dbConnection->prepare("INSERT INTO requests(clientID, requestTime, requestType)
            VALUES (:clientID, :requestTime, :requestType)");
            $stmtElse->execute(["clientID"=>$this->clientID, "requestTime"=>$today, "requestType"=>$requestType]);
        }


        // GETTER AND SETTER //
        /**
         * Get the value of characterID
         */ 
        public function getCharacterID()
        {
            return $this->characterID;
        }

        /**
         * Set the value of characterID
         *
         * @return  self
         */ 
        public function setCharacterID($characterID)
        {
            $this->characterID = $characterID;

            return $this;
        }

        /**
         * Get the value of characterJSON
         */ 
        public function getCharacterJSON()
        {
            return $this->characterJSON;
        }

        /**
         * Set the value of characterJSON
         *
         * @return  self
         */ 
        public function setCharacterJSON($characterJSON)
        {
            $this->characterJSON = $characterJSON;

            return $this;
        }

        /**
         * Get the value of clientID
         */ 
        public function getClientID()
        {
            return $this->clientID;
        }

        /**
         * Set the value of clientID
         *
         * @return  self
         */ 
        public function setClientID($clientID)
        {
            $this->clientID = $clientID;

            return $this;
        }
        
        // function getCurrentTime(){
        //     // Get the day and time (in the MySQL DATETIME format)
        //     $timezone  = -5; //(GMT -5:00) EST (U.S. & Canada)
        //     $today = gmdate("Y-m-j H:i:s", time() + 3600*($timezone+date("I")));
        //     return $today;
        // }
    }
?>