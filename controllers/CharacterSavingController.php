<?php
    require_once('../model/client.php');
    require_once('../model/character.php');

    class CharacterSavingController{
        
        function SaveCharacter($json_character){
            // TODO Check if License Key is valid.
            // $client = new Client();
            // $client = $client->getClientByLicenseKey($decoded["LicenseKey"]);

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
                }
            }
            // TODO Check if the client exists. (Send DENIED ACCESS if does not)

            // TODO Insert the JSON in the DB.

            // TODO Send back the confirmation of update with Character ID.
            $confirmation = array(
            "code" => 201,
            "message" => "Ara Ara",
            "time" => "TODO",
            "characterID" => 777,
            );
            return $confirmation;
        }

        function UpdateCharacter($id, $json_character){
            // TODO Check if License Key is valid and get ClientID.

            $character = new Character();

            // Preparation to check JSON validity
            foreach ($character as $key => $value) {
                if(array_key_exists($key, $json_character)){
                    echo "Array Key $key Exists \n";
                    $json_value = $json_character[$key];
                    echo "Value: $json_value \n";
                }
                else{
                    echo "No Array Key ".$key."\n";
                }
            }
            // TODO Check if the client owns the character. (Send DENIED ACCESS if does not)

            // TODO Update the JSON in the DB.

            // TODO Send back the confirmation of update with Character ID.
            $confirmation = array();
            $confirmation->code = "201";
            $confirmation->message = "Ara Ara";
            $confirmation->time = '';
            $confirmation->characterID = $id;
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

?>