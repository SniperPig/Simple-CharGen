<?php
    require_once('../model/client.php');
    require_once('../model/character.php');
    require_once('../model/sentence.php');
    require_once('../model/word.php');

    class CharacterGeneratorController{

        function index($decoded){
            //  Check if License Key is valid.

            $client = new Client();
            $client = $client->getClientIDByLicenseKey($decoded["LicenseKey"]);
            //  Check if the client exists. (Send DENIED ACCESS if does not);
            if(!$client) {
                // * echo"Not valid $client \n";
                $timezone  = -5; //(GMT -5:00) EST (U.S. & Canada)
                $today = gmdate("H:i:s", time() + 3600*($timezone+date("I")));
                $confirmation = array(
                    "code" => "400",
                    "message" => "The license key is NOT VALID",
                    "time" => "$today"
                );
                var_dump($confirmation);
                return $confirmation;
            }else{
                // * echo"Valid ID ".$client["clientID"] ."\n";
            }
            $generated_character = this->generateRandomCharacter();

            $confirmation = array(
                "code" => "201",
                "message" => "Character successfully generated",
                "time" => "TODO",
                "character" => $generated_character
            );
            var_dump($confirmation);
            return $confirmation;
        }

        function generateRandomCharacter() {
            $character = new Character();
            $info = generateRandomInfo();
            $generated_character = array(
                "fName" => $character->getRandomFname,
                "lName" => $character->getRandomLname,
                "species" => $character->getRandomSpecies,
                "eyeColor" => $character->getRandomEyeColor,
                "height" => $character->getRandomHeight,
                "age" => $character->getRandomAge,
                "dateOfBirth" => $character->getRandomDateOfBirth,

                "info" => $info
            );
            return $info;
        }

        function generateRandomInfo(){
            $character = new Character();
            $sentence = $character->getRandomSentence();
            $needle = "%BLANK%";
            $lastPos = 0;
            $positions = array();

            while (($lastPos = strpos($html, $needle, $lastPos))!== false) {
                $positions[] = $lastPos;
                $lastPos = $lastPos + strlen($needle);
            }

            // Displays 3 and 10
            foreach ($positions as $value) {
                echo $value ."<br />";
            }
        }
    }
?>