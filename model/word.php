<?php 

require_once('../database/ConnectionManager.php');

    class Word{

        private $wordID;
        public $word;
        public $gender;
        public $type;
        public $tense;

        private $connectionManager;
        private $dbConnection;

        function __constructor(){
            $this->connectionManager = new ConnectionManager();
            $this->dbConnection = $this->connectionManager->getConnection();
        }

        public function NewWord($word, $gender, $type, $tense){
            $this->gender = $gender;
            $this->type = $type;
            $this->tense = $tense;
        }

        /**
         * get the client by gender
         */
        function getWordsByGender($gender){
            $stmt = $this->dbConnection->prepare("SELECT * FROM words WHERE gender = :gender");
            $stmt->execute(["gender"=>$gender]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        /**
         * get the client by type
         */
        function getWordsByType($type){
            $stmt = $this->dbConnection->prepare("SELECT * FROM words WHERE type = :type");
            $stmt->execute(["type"=>$type]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        /**
         * get the client by tense
         */
        function getWordsByForm($tense){
            $stmt = $this->dbConnection->prepare("SELECT * FROM words WHERE tense = :tense");
            $stmt->execute(["tense"=>$tense]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        /**
         * get the client by tense
         */
        function getAllWords(){
            $stmt = $this->dbConnection->prepare("SELECT * FROM words");
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }

?>