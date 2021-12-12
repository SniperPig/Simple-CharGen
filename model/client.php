<?php

require_once('../database/ConnectionManager.php');

    class Client {
        private $clientID;
        private $clientName;
        private $licenseNumber;
        private $licenseStartDate;
        private $licenseEndDate;
        private $licenseKey;

        private $connectionManager;
        private $dbConnection;

        function __construct(){
            $this->connectionManager = new ConnectionManager();
            $this->dbConnection = $this->connectionManager->getConnection();
        }

        function NewClient($clientName, $licenseNumber, $licenseStartDate, $licenseEndDate, $licenseKey){
            $this->clientName = $clientName;
            $this->licenseNumber = $licenseNumber;
            $this->licenseStartDate = $licenseStartDate;
            $this->licenseEndDate = $licenseEndDate;
            $this->licenseKey = $licenseKey;
        }

        // ? Should not be as accessible
        // function getAllClients(){
        //     $query = "SELECT * FROM client";
        //     $stmt = $this->dbConnection->prepare($query);
        //     $stmt->execute();
        //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
        // }

        function getClientIDByLicenseKey($licenseKey){
            $stmt = $this->dbConnection->prepare("SELECT clientID FROM client WHERE licenseKey = :licenseKey");
            $stmt->execute(["licenseKey"=>$licenseKey]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function GetClientID(){
            return $this->clientID;
        }
    }
?>