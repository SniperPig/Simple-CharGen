<?php
    require_once('../model/client.php');
    require_once('../model/character.php');
    require_once('../model/character.php');
    require_once('../model/character.php');

    class CharacterGeneratoController{

        function generateNewCharacter($decoded){
            // TODO Check if License Key is valid.
            //?? this is done below i think?

            $client = new Client();
            $client = $client->getClientIDByLicenseKey($decoded["LicenseKey"]);
            // TODO Check if the client exists. (Send DENIED ACCESS if does not)
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
                $timezone  = -5; //(GMT -5:00) EST (U.S. & Canada)
                $today = gmdate("H:i:s", time() + 3600*($timezone+date("I")));
                // ! Missing Character key
                $confirmation = array(
                        "code" => "400",
                        "message" => "The key 'Character' is missing from the JSON",
                        "time" => "$today"
                    );
                var_dump($confirmation);
                return $confirmation;
            }

            $character = new Character();
            // Preparation to check JSON validity
            foreach ($character as $key => $value) {
                if(array_key_exists($key, $json_character)){
                    //echo "Array Key $key Exists \n";
                    //$json_value = $json_character[$key];
                    //echo "Value: $json_value \n";
                } else {
                    $timezone  = -5; //(GMT -5:00) EST (U.S. & Canada)
                    $today = gmdate("H:i:s", time() + 3600*($timezone+date("I")));
                    // echo "No Array Key ".$key."\n";
                    // ! Missing key in the character
                    $confirmation = array(
                        "code" => "400",
                        "message" => "The key $key is missing in the character JSON",
                        "time" => "$today"
                    );
                    var_dump($confirmation);
                    return $confirmation;
                }
            }
            
            // TODO Insert the JSON in the DB.
            var_dump(json_encode($json_character));
            $character->NewCharacter($client["clientID"], json_encode($json_character));
            $character->insert();
            $timezone  = -5; //(GMT -5:00) EST (U.S. & Canada)
            $today = gmdate("H:i:s", time() + 3600*($timezone+date("I")));
            // TODO Send back the confirmation of update with Character ID.
            $confirmation = array(
                "code" => "201",
                "message" => "Ara Ara",
                "time" => "$today",
                "characterID" => "777"
            );
            var_dump($confirmation);
            return $confirmation;
        }

    }
    
?>