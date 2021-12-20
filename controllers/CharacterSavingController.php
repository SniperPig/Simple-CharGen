<?php
    require_once('../model/client.php');
    require_once('../model/character.php');

    class CharacterSavingController{
        
        function index($decoded){
            //  Check if License Key is valid.
            //?? this is done below i think?
            if(array_key_exists("LicenseKey", $decoded)){

            }else{
                $timezone  = -5; //(GMT -5:00) EST (U.S. & Canada)
                $today = gmdate("H:i:s", time() + 3600*($timezone+date("I")));
                $confirmation = array(
                    "code" => "400",
                    "message" => "The license key is NOT SET",
                    "time" => "$today"
                );
                //var_dump($confirmation);
                return $confirmation;
            }

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
                //var_dump($confirmation);
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
                //var_dump($confirmation);
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
                    //var_dump($confirmation);
                    return $confirmation;
                }
            }
            
            //  Insert the JSON in the DB.
            $character->NewCharacter($client["clientID"], json_encode($json_character));
            $character->insert();
            $timezone  = -5; //(GMT -5:00) EST (U.S. & Canada)
            $today = gmdate("H:i:s", time() + 3600*($timezone+date("I")));
            //  Send back the confirmation of update with Character ID.
            $confirmation = array(
                "code" => "201",
                "message" => "Character successfully CREATED",
                "time" => "$today",
                "characterID" => $character->getLastCharacterIDByClient($client["clientID"])["characterID"]
            );
            //var_dump($confirmation);
            return $confirmation;
        }

        function UpdateCharacter($decoded){
            //  Check if License Key is valid.
            if(array_key_exists("LicenseKey", $decoded)){

            }else{
                $timezone  = -5; //(GMT -5:00) EST (U.S. & Canada)
                $today = gmdate("H:i:s", time() + 3600*($timezone+date("I")));
                $confirmation = array(
                    "code" => "400",
                    "message" => "The license key is NOT SET",
                    "time" => "$today"
                );
                //var_dump($confirmation);
                return $confirmation;
            }
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
                //var_dump($confirmation);
                return $confirmation;
            }else{
                // * echo"Valid ID ".$client["clientID"] ."\n";
            }

            $character = new Character();

            if(array_key_exists("CharacterID", $decoded)){
                //  check if character is owned by ClientID
                $character_check = $character->getClientCharacterByID($client["clientID"], $decoded["CharacterID"]);
                if(!$character_check){
                    // * echo"Not valid $character_check \n";
                    $timezone  = -5; //(GMT -5:00) EST (U.S. & Canada)
                    $today = gmdate("H:i:s", time() + 3600*($timezone+date("I")));
                    $confirmation = array(
                    "code" => "400",
                    "message" => "The Character does not match the User",
                    "time" => "$today"
                );
                //var_dump($confirmation);
                return $confirmation;
                }else{
                    //echo"Valid Character and ID $character_check \n";
                }
            }else{
                // ! Missing Character ID to be updated
                $timezone  = -5; //(GMT -5:00) EST (U.S. & Canada)
                $today = gmdate("H:i:s", time() + 3600*($timezone+date("I")));
                $confirmation = array(
                        "code" => "400",
                        "message" => "The key 'CharacterID' is missing from the JSON, do not know which character to UPDATE",
                        "time" => $today
                    );
                //var_dump($confirmation);
                return $confirmation;
            }

            if(array_key_exists("Character", $decoded)){
                $json_character = $decoded["Character"];
            }else{
                
                // ! Missing Character key
                $timezone  = -5; //(GMT -5:00) EST (U.S. & Canada)
                $today = gmdate("H:i:s", time() + 3600*($timezone+date("I")));
                $confirmation = array(
                        "code" => "400",
                        "message" => "The key 'Character' is missing from the JSON",
                        "time" => $today
                    );
                //var_dump($confirmation);
                return $confirmation;
            }

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
                    $timezone  = -5; //(GMT -5:00) EST (U.S. & Canada)
                    $today = gmdate("H:i:s", time() + 3600*($timezone+date("I")));
                    $confirmation = array(
                        "code" => "400",
                        "message" => "The key $key is missing in the character JSON",
                        "time" => $today
                    );
                    //var_dump($confirmation);
                    return $confirmation;
                }
            }
            

            //  Update the JSON in the DB.
            $character->NewCharacter($client["clientID"], json_encode($json_character));
            $character->updateCharacterByID($decoded["CharacterID"], $client["clientID"], json_encode($json_character));

            //  Send back the confirmation of update with Character ID.
            $timezone  = -5; //(GMT -5:00) EST (U.S. & Canada)
            $today = gmdate("H:i:s", time() + 3600*($timezone+date("I")));
            $confirmation = array(
                "code" => "201",
                "message" => "Character successfully UPDATED",
                "time" =>$today,
                "characterID" => $decoded["CharacterID"]
            );
            //var_dump($confirmation);
            return $confirmation;
        }

        function GetCharacter($id, $licenseKey){
            //  Check if License Key is valid.
            $client = new Client();
            $client = $client->getClientIDByLicenseKey($licenseKey);
            //  Check if the client exists. (Send DENIED ACCESS if does not)
            if(!$client){
                $timezone  = -5; //(GMT -5:00) EST (U.S. & Canada)
                $today = gmdate("H:i:s", time() + 3600*($timezone+date("I")));
                $confirmation = array(
                    "code" => "400",
                    "message" => "The license key is NOT VALID",
                    "time" => "$today"
                );
                return $confirmation;
            }else{
                // * echo"Valid ID ".$client["clientID"] ."\n";
            }
            if($id == "all"){
                $character = new Character();
                $character = $character->getAllCharactersByClient($client["clientID"]);
                if(!$character){
                    $timezone  = -5; //(GMT -5:00) EST (U.S. & Canada)
                    $today = gmdate("H:i:s", time() + 3600*($timezone+date("I")));
                    $confirmation = array(
                    "code" => "400",
                    "message" => "No Characters Found",
                    "time" => $today
                );
                return $confirmation;
                }else{
                    $timezone  = -5; //(GMT -5:00) EST (U.S. & Canada)
                    $today = gmdate("H:i:s", time() + 3600*($timezone+date("I")));
                    $confirmation = array(
                    "code" => "201",
                    "message" => "Character successfully retrieved",
                    "time" => $today,
                    "characters" => $character
                );
                return $confirmation;
                }
            }else{
                $character = new Character();
                $character = $character->getClientCharacterByID($client["clientID"], $id);
                if(!$character){
                    $timezone  = -5; //(GMT -5:00) EST (U.S. & Canada)
                    $today = gmdate("H:i:s", time() + 3600*($timezone+date("I")));
                    $confirmation = array(
                    "code" => "400",
                    "message" => "Character ID not found.",
                    "time" => $today
                );
                return $confirmation;
                }else{
                    $character_JSON = $character["characterJSON"];
                    $character_JSON = json_decode($character_JSON);
                    $timezone  = -5; //(GMT -5:00) EST (U.S. & Canada)
                    $today = gmdate("H:i:s", time() + 3600*($timezone+date("I")));
                    $confirmation = array(
                    "code" => "201",
                    "message" => "Character successfully retrieved",
                    "time" => $today,
                    "character" => $character_JSON
                );
                return $confirmation;
                }
            }
            
        }

        function GetAllCharacters($licenseKey){
            //  Check if License Key is valid.
            $client = new Client();
            $client = $client->getClientIDByLicenseKey($licenseKey);
            //  Check if the client exists. (Send DENIED ACCESS if does not)
            if(!$client){
                $timezone  = -5; //(GMT -5:00) EST (U.S. & Canada)
                $today = gmdate("H:i:s", time() + 3600*($timezone+date("I")));
                $confirmation = array(
                    "code" => "400",
                    "message" => "The license key is NOT VALID",
                    "time" => "$today"
                );
                return $confirmation;
            }else{
                // * echo"Valid ID ".$client["clientID"] ."\n";
            }
            $character = new Character();
            $characters = $character->getAllCharactersByClient($client["clientID"]);
            foreach($characters as $character) {
                if(!$character){
                    $timezone  = -5; //(GMT -5:00) EST (U.S. & Canada)
                    $today = gmdate("H:i:s", time() + 3600*($timezone+date("I")));
                    $confirmation = array(
                    "code" => "400",
                    "message" => "No Characters for this Client.",
                    "time" => $today
                );
                return $confirmation;
                }
                else{
                    $character_JSON = $character["characterJSON"];
                    var_dump($character_JSON);
                    $character_JSON = json_decode($character_JSON);
                    $timezone  = -5; //(GMT -5:00) EST (U.S. & Canada)
                    $today = gmdate("H:i:s", time() + 3600*($timezone+date("I")));
                    $confirmation = array(
                    "code" => "201",
                    "message" => "Character successfully retrieved",
                    "time" => $today,
                    "character" => $character_JSON
                );
                return $confirmation;
                } 
            }
        }

        function DeleteCharacter($id, $licenseKey){
            //  Check if License Key is valid.
            $client = new Client();
            $client = $client->getClientIDByLicenseKey($licenseKey);
            //  Check if the client exists. (Send DENIED ACCESS if does not)
            if(!$client){
                //  * echo"Not valid $client \n";
                $timezone  = -5; //(GMT -5:00) EST (U.S. & Canada)
                $today = gmdate("H:i:s", time() + 3600*($timezone+date("I")));
                $confirmation = array(
                    "code" => "400",
                    "message" => "The license key is NOT VALID",
                    "time" => "$today"
                );
                return $confirmation;
            }else{
                // * echo"Valid ID ".$client["clientID"] ."\n";
            }
            $character = new Character();

            //  check if character is owned by ClientID
            $character_check = $character->getClientCharacterByID($client["clientID"], $id);
            if(!$character_check){
                $timezone  = -5; //(GMT -5:00) EST (U.S. & Canada)
                $today = gmdate("H:i:s", time() + 3600*($timezone+date("I")));
                $confirmation = array(
                "code" => "400",
                "message" => "The Character does not match the User",
                "time" => "$today"
                );
                return $confirmation;
            }
            $character = new Character();
            $character->deleteCharacterByID($client["clientID"], $id);

            $timezone  = -5; //(GMT -5:00) EST (U.S. & Canada)
            $today = gmdate("H:i:s", time() + 3600*($timezone+date("I")));

            // * echo"Valid Character and ID $character_check \n";
                $confirmation = array(
                    "code" => "201",
                    "message" => "The Character is deleted",
                    "id" => $id,
                    "time" => "$today"
                    );
                return $confirmation;
        }
    }
    
    // $character = new CharacterSavingController();
    // $json_test = array();
    // $json_test->fName = "Name Testing";
    // $character->index($json_test);
