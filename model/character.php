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
        private  $dbConnection;

        function __construct(){
            $this->connectionManager = new ConnectionManager();
            $this->dbConnection = $this->connectionManager->getConnection();
        }

        public function NewCharacter($clientID, $characterJSON){
            $this->clientID = $clientID;
            $this->characterJSON = $characterJSON;

            // Testing values being passed
            // echo $this->clientID;
            // var_dump($this->characterJSON);+
        }

        //! ------------------------------- Character attributes functions -------------------------------- //
        function getRandomSentence() {
            // generate a random food
            $stmt = $this->dbConnection->prepare("SELECT sentence FROM sentences
            ORDER BY RAND()
            LIMIT 1;");
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC); 
        }

        function getRandomWord() {
            // generate a random food
            $stmt = $this->dbConnection->prepare("SELECT word FROM wordlist
            ORDER BY RAND()
            LIMIT 1;");
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC); 
        }

        function getRandomFood() {
            // generate a random food
            $stmt = $this->dbConnection->prepare("SELECT word FROM wordlist WHERE type = '1'
            ORDER BY RAND()
            LIMIT 1;");
            return $stmt->fetch(PDO::FETCH_ASSOC); 
        }

        function getRandomFun() {
            // generate a random fun
            $stmt = $this->dbConnection->prepare("SELECT word FROM wordlist WHERE type = '2'
            ORDER BY RAND()
            LIMIT 1;");
            return $stmt->fetch(PDO::FETCH_ASSOC); 
        }

        function getRandomFurniture() {
            // generate a random furniture
            $stmt = $this->dbConnection->prepare("SELECT word FROM wordlist WHERE type = '3'
            ORDER BY RAND()
            LIMIT 1;");
            return $stmt->fetch(PDO::FETCH_ASSOC); 
        }

        function getRandomDrink() {
            // generate a random drink
            $stmt = $this->dbConnection->prepare("SELECT word FROM wordlist WHERE type = '4'
            ORDER BY RAND()
            LIMIT 1;");
            return $stmt->fetch(PDO::FETCH_ASSOC); 
        }

        function getRandomToy() {
            // generate a random toy
            $stmt = $this->dbConnection->prepare("SELECT word FROM wordlist WHERE type = '5'
            ORDER BY RAND()
            LIMIT 1;");
            return $stmt->fetch(PDO::FETCH_ASSOC); 
        }

        function getRandomAnimal() {
            // generate a random animal
            $stmt = $this->dbConnection->prepare("SELECT word FROM wordlist WHERE type = '6'
            ORDER BY RAND()
            LIMIT 1;");
            return $stmt->fetch(PDO::FETCH_ASSOC); 
        }

        function getRandomVehicle() {
            // generate a random vehicle
            $stmt = $this->dbConnection->prepare("SELECT word FROM wordlist WHERE type = '7'
            ORDER BY RAND()
            LIMIT 1;");
            return $stmt->fetch(PDO::FETCH_ASSOC); 
        }

        function getRandomWeapon() {
            // generate a random weapon
            $stmt = $this->dbConnection->prepare("SELECT word FROM wordlist WHERE type = '8'
            ORDER BY RAND()
            LIMIT 1;");
            return $stmt->fetch(PDO::FETCH_ASSOC); 
        }

        function getRandomTool() {
            // generate a random tool
            $stmt = $this->dbConnection->prepare("SELECT word FROM wordlist WHERE type = '9'
            ORDER BY RAND()
            LIMIT 1;");
            return $stmt->fetch(PDO::FETCH_ASSOC); 
        }
        //! --------------------------------------------------------------------------------------- //





        //! ------------------------------- Character characteristic functions -------------------------------- //

        public function getRandomFname() {
            // generate a random First Name
            $stmt = $this->dbConnection->prepare("SELECT first_name FROM firstName WHERE type = 'fName'
            ORDER BY RAND()
            LIMIT 1;");
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        function getRandomLname() {
            // generate a random Last Name
            $stmt = $this->dbConnection->prepare("SELECT last_name FROM lastName WHERE type = 'fName'
            ORDER BY RAND()
            LIMIT 1;");
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC); 
        }

        function getRandomSpecies() {
            // generate a random species
            $stmt = $this->dbConnection->prepare("SELECT species FROM species WHERE type = 'fName'
            ORDER BY RAND()
            LIMIT 1;");
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC); 
        }

        function getRandomEyeColor() {
            // generate a random eye color 
            $stmt = $this->dbConnection->prepare("SELECT eye_color FROM eyeColor WHERE type = 'eyeColor'
            ORDER BY RAND()
            LIMIT 1;");
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC); 
        }

        function getRandomHeight() {
            // generate a random height
            return rand(54, 272); 
        }

        function getRandomAge() {
            // generate a random age
            return rand(18, 120); 
        }

        function getRandomDateOfBirth() {
            //  generate a data of birth
            $date_start = strtotime('1700-01-01');  //you can change it to your timestamp;
            $date_end = strtotime('2200-12-31');  //you can change it to your timestamp;
            $day_step = 86400; 
            $date_between = abs(($date_end - $date_start) / $day_step);
            $random_day = rand(0, $date_between);
            return date("Y-m-d", $date_start + ($random_day * $day_step));
        }


        //!-------------------------------- CRUD DATABASE FUNCTIONS ---------------------------------//
        /**
         * insert character into database
         */
        function insert() {
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
            
            // Get the day and time (in the MySQL DATETIME format)
            $timezone  = -5; //(GMT -5:00) EST (U.S. & Canada)
            $today = gmdate("Y-m-j H:i:s", time() + 3600*($timezone+date("I")));

            $requestType = "GET";

            $stmtElse = $this->dbConnection->prepare("INSERT INTO requests(clientID, requestTime, requestType)
            VALUES (:clientID, :requestTime, :requestType)");
            $stmtElse->execute(["clientID"=>$this->clientID, "requestTime"=>$today, "requestType"=>$requestType]);

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        /**
         * Get one character created by a client from the database
         */
        function getClientCharacterByID($clientID, $characterID){
            $stmt = $this->dbConnection->prepare("SELECT characterJSON FROM characters WHERE clientID = :clientID AND characterID = :characterID");
            $stmt->execute(["clientID"=>$clientID, "characterID"=>$characterID]);
            
            // Get the day and time (in the MySQL DATETIME format)
            $timezone  = -5; //(GMT -5:00) EST (U.S. & Canada)
            $today = gmdate("Y-m-j H:i:s", time() + 3600*($timezone+date("I")));
            $requestType = "GET";

            $stmtElse = $this->dbConnection->prepare("INSERT INTO requests(clientID, requestTime, requestType)
            VALUES (:clientID, :requestTime, :requestType)");
            $stmtElse->execute(["clientID"=>$clientID, "requestTime"=>$today, "requestType"=>$requestType]);

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        /**
         * Delete one character created by a client in the  database
         */
        function deleteCharacterByID($clientID, $characterID){
            $stmt = $this->dbConnection->prepare("DELETE FROM characters WHERE clientID = :clientID AND characterID = :characterID");
            $stmt->execute(["clientID"=>$clientID, "characterID"=>$characterID]);
            
            // Get the day and time (in the MySQL DATETIME format)
            $timezone  = -5; //(GMT -5:00) EST (U.S. & Canada)
            $today = gmdate("Y-m-j H:i:s", time() + 3600*($timezone+date("I")));

            $requestType = "DELETE";

            $stmtElse = $this->dbConnection->prepare("INSERT INTO requests(clientID, requestTime, requestType)
            VALUES (:clientID, :requestTime, :requestType)");
            $stmtElse->execute(["clientID"=>$clientID, "requestTime"=>$today, "requestType"=>$requestType]);

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        /**
         * Delete one character created by a client in the  database
         */
        function updateCharacterByID($characterID, $clientID){
            $stmt = $this->dbConnection->prepare("UPDATE TABLE characters set characterJSON = :characterJSON WHERE clientID = :clientID AND characterID = :characterID");
            $stmt->execute(["clientID"=>$clientID, "characterID"=>$characterID, "characterJSON"=>$this->characterJSON]);
            
            // Get the day and time (in the MySQL DATETIME format)
            $timezone  = -5; //(GMT -5:00) EST (U.S. & Canada)
            $today = gmdate("Y-m-j H:i:s", time() + 3600*($timezone+date("I")));

            $requestType = "UPDATE";

            $stmtElse = $this->dbConnection->prepare("INSERT INTO requests(clientID, requestTime, requestType)
            VALUES (:clientID, :requestTime, :requestType)");
            $stmtElse->execute(["clientID"=>$clientID, "requestTime"=>$today, "requestType"=>$requestType]);

            return $stmt->fetch(PDO::FETCH_ASSOC);
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
    }
?>