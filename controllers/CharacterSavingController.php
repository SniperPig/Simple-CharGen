<?php
    require_once('../model/client.php');
    require_once('../model/character.php');

    class CharacterSavingController{
        
        function SaveCharacter($decoded){
            // TODO Check if License Key is valid.
            //?? this is done below i think?

            $client = new Client();
            $client = $client->getClientIDByLicenseKey($decoded["LicenseKey"]);
            // TODO Check if the client exists. (Send DENIED ACCESS if does not)
            if(!$client){
                echo"Not valid $client \n";
                $timezone  = -5; //(GMT -5:00) EST (U.S. & Canada)
                $today = gmdate("H:i:s", time() + 3600*($timezone+date("I")));
                $confirmation = array(
                    "code" => "400",
                    "message" => "The license key is NOT VALID",
                    "time" => "$today",
                );
                var_dump($confirmation);
                return $confirmation;
            }else{
                echo"Valid ID ".$client["clientID"] ."\n";
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
                        "time" => "$today",
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
                        "time" => "$today",
                    );
                    var_dump($confirmation);
                    return $confirmation;
                }
            }
            
            // TODO Insert the JSON in the DB.
            var_dump(json_encode($json_character));
            $character = $character->NewCharacter($client["clientID"], json_encode($json_character));
            $character->insert();
            $timezone  = -5; //(GMT -5:00) EST (U.S. & Canada)
            $today = gmdate("H:i:s", time() + 3600*($timezone+date("I")));
            // TODO Send back the confirmation of update with Character ID.
            $confirmation = array(
                "code" => "201",
                "message" => "Ara Ara",
                "time" => "$today",
                "characterID" => "777",
            );
            var_dump($confirmation);
            return $confirmation;
        }

        function UpdateCharacter($id, $json_character){
            // TODO Check if License Key is valid.
            $client = new Client();
            $client = $client->getClientIDByLicenseKey($decoded["LicenseKey"]);
            // TODO Check if the client exists. (Send DENIED ACCESS if does not)
            if(!$client){
                echo"Not valid $client \n";
                $timezone  = -5; //(GMT -5:00) EST (U.S. & Canada)
                $today = gmdate("H:i:s", time() + 3600*($timezone+date("I")));
                $confirmation = array(
                    "code" => "400",
                    "message" => "The license key is NOT VALID",
                    "time" => "$today",
                );
                var_dump($confirmation);
                return $confirmation;
            }else{
                echo"Valid ID ".$client["clientID"] ."\n";
            }

            if(array_key_exists("CharacterID", $decoded)){
                // TODO check if character is owned by ClientID
                $character_check = $character->getClientCharacterByID($client["clientID"], $decoded["CharacterID"]);
                if(!$character_check){
                    echo"Not valid $character_check \n";
                    $timezone  = -5; //(GMT -5:00) EST (U.S. & Canada)
                $today = gmdate("H:i:s", time() + 3600*($timezone+date("I")));
                    $confirmation = array(
                    "code" => "400",
                    "message" => "The Character does not match the User",
                    "time" => "$today",
                );
                var_dump($confirmation);
                return $confirmation;
                }else{
                    echo"Valid Character and ID $character_check \n";
                }
            }else{
                // ! Missing Character ID to be updated
                $confirmation = array(
                        "code" => "400",
                        "message" => "The key 'CharacterID' is missing from the JSON, do not know which character to UPDATE",
                        "time" => "TODO",
                    );
                var_dump($confirmation);
                return $confirmation;
            }

            if(array_key_exists("Character", $decoded)){
                $json_character = $decoded["Character"];
            }else{
                
                // ! Missing Character key
                $confirmation = array(
                        "code" => "400",
                        "message" => "The key 'Character' is missing from the JSON",
                        "time" => "TODO",
                    );
                var_dump($confirmation);
                return $confirmation;
            }

            $character = new Character();

            // Preparation to check JSON validity
            foreach ($character as $key => $value) {
                if(array_key_exists($key, $json_character)){
                    // echo "Array Key $key Exists \n";
                    // $json_value = $json_character[$key];
                    // echo "Value: $json_value \n";
                }
                else{
                    // echo "No Array Key ".$key."\n";
                    // ! Missing key in the character
                    $confirmation = array(
                        "code" => "400",
                        "message" => "The key $key is missing in the character JSON",
                        "time" => "TODO",
                    );
                    var_dump($confirmation);
                    return $confirmation;
                }
            }
            

            // TODO Insert the JSON in the DB.
            var_dump(json_encode($json_character));
            $character = $character->NewCharacter($client->clientID, json_encode($json_character));
            $character->updateCharacterByID();

            // TODO Send back the confirmation of update with Character ID.
            $confirmation = array(
                "code" => "201",
                "message" => "Ara Ara",
                "time" => "TODO",
                "characterID" => "777",
            );
            var_dump($confirmation);
            return $confirmation;
        }

        function GetCharacter($id, $licenseKey){
            // TODO Check if License Key is valid and get ClientID.
            $character = new Character();
            $character = $character->getClientCharacterByID($clientID, $id);
        }

        function DeleteCharacter($id, $licenseKey){
            // TODO Check if License Key is valid and get ClientID.
            // TODO Check if client owns the character (Send DENIED ACCESS if does not)
            $character = new Character();
            $character = $character->deleteCharacterByID($clientID, $id);
        }
    }
    
    // $character = new CharacterSavingController();
    // $json_test = array();
    // $json_test->fName = "Name Testing";
    // $character->index($json_test);
