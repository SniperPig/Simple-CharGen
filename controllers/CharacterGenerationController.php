<?php
    require_once('../model/client.php');
    require_once('../model/character.php');
    require_once('../model/character.php');
    require_once('../model/character.php');

    class CharacterGenerationController{

        function generateNewCharacter($decoded){
            $client = new Client();
            $client = $client->getClientByLicenseKey($decoded["LicenseKey"]);

            // if the client doesn't exist
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

            $sentence = new Sentence();
            $allSentence = $sentence->getAllSentences();


            // if the client is valid, get sentences from database
            // fill the sentences by getting words from database
            // return the new character for it to be saved in the saveCharacterController

            


            // Parse the json



            // create the character with the json and client id
            $character->NewCharacter($client["clientID"], $characterJSON);

            // $response = array("Code"=>"203", "Output File"=>$videoConversion->output_file);
            // return $response;
        }
    }
?>