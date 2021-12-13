<?php 

require_once('../database/ConnectionManager.php');

    class Word{

        private $wordID;
        public $word;
        public $gender;
        public $type;
        public $form;

        private $connectionManager;
        private $dbConnection;

        function __constructor(){
            $this->connectionManager = new ConnectionManager();
            $this->dbConnection = $this->connectionManager->getConnection();
        }

        public function NewWord($word, $gender, $form, $type ){
            $this->gender = $gender;
            $this->form = $form;
            $this->type = $type;
        }

        /**
         * get the word by gender
         */
        function getWordsByGender($gender){
            $stmt = $this->dbConnection->prepare("SELECT * FROM wordlist WHERE gender = :gender");
            $stmt->execute(["gender"=>$gender]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        /**
         * get the word by type
         */
        function getWordsByType($type){
            $stmt = $this->dbConnection->prepare("SELECT * FROM wordlist WHERE type = :type");
            $stmt->execute(["type"=>$type]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        /**
         * get the word by form
         */
        function getWordsByForm($tense){
            $stmt = $this->dbConnection->prepare("SELECT * FROM wordlist WHERE form = :form");
            $stmt->execute(["form"=>$form]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        /**
         * get all the words
         */
        function getAllWords(){
            $stmt = $this->dbConnection->prepare("SELECT * FROM wordlist");
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }

?>