<?php
    require_once('../model/client.php');
    require_once('../model/character.php');
    require_once('../model/character.php');
    require_once('../model/character.php');

    class CharacterGeneratoController{

        function GetCharacter($decoded){
            //  Check if License Key is valid.
            //?? this is done below i think?

            $client = new Client();
            $client = $client->getClientIDByLicenseKey($decoded["LicenseKey"]);
            //  Check if the client exists. (Send DENIED ACCESS if does not)
            if(!$client){
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

            if(array_key_exists("Character", $decoded)){
                $json_character = $decoded["Character"];
                // echo json_character result in the word "array" being displayed
            }else{
                //  Just generate a random character if no JSON is passed
                // * generateRandomCharacter();
            }

            $character = new Character();
            // Preparation to check JSON validity
            foreach ($character as $key => $value) {
                // TODO save the keys and their set value, put them in an array.
                $user_set_parameters = array();
                if(array_key_exists($key, $json_character)){
                // TODO add key with value in array.
                    //echo "Array Key $key Exists \n";
                    //$json_value = $json_character[$key];
                    //echo "Value: $json_value \n";
                } else {
                    // * Do nothing.
                }
            }
            // TODO Generate a character by taking account of the parameters in the $user_set_parameters array.
            // * Do here
            // * generateRandomCharacterWithParameters($user_set_parameters)

            
            // TODO Send back the confirmation of update with Character JSON.
            $confirmation = array(
                "code" => "201",
                "message" => "Character successfully generated",
                "time" => "TODO",
                "character" => $character
            );
            var_dump($confirmation);
            return $confirmation;
        }

    }
    
?>