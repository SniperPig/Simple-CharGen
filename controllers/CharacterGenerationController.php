<?php
    require_once('../model/client.php');
    require_once('../model/character.php');

    class CharacterGenerationController{

        function generateNewCharacter(){
            $character = new Character(); 
        }

        function index($decoded){
            $client = new Client();
            $client = $client->getClientByLicenseKey($decoded["LicenseKey"]);

            // create the character
            $character = new Character();


            // Parse the json



            // create the character with the json and client id
            $character->NewCharacter($client["clientID"], $characterJSON);

            // $response = array("Code"=>"203", "Output File"=>$videoConversion->output_file);
            // return $response;
        }
    }
    

?>