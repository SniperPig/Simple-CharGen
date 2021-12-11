<?php 

require_once('../database/ConnectionManager.php');

    class Sentence{

        private $sentenceID;
        public $sentence;

        private $connectionManager;
        private $dbConnection;

        function __constructor(){
            $this->connectionManager = new ConnectionManager();
            $this->dbConnection = $this->connectionManager->getConnection();
        }

        public function NewSentence($sentence){
            $this->sentence = $sentence;
        }

        /**
         * get all the sentences
         */
        function getAllSentences(){
            $stmt = $this->dbConnection->prepare("SELECT * FROM words");
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }
?>