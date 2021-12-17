<?php

require_once('../model/Request.php');
require_once('../model/Response.php');
require_once('../model/client.php');
require_once('../api/JWT.php');
    // Note-4
    // We register our custom autoload function as a callback to tbe called when PHP is loading dependencies or required files.
    spl_autoload_register('autoload');

    function autoload($className){
        if(preg_match('/[a-zA-Z]+Controller$/', $className)){
            require_once('../controllers/'.$className.'.php');
            return true;
        }
    }
    
    $request = new Request();
    $request->accept = "application/json";
    
    $response = new Response();
    // Check if the request is a GET or POST
    if(strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') == 0){
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
        if(strcasecmp($contentType, 'application/json') != 0){
            throw new Exception('Content type must be: application/json');
        }

        //Receive the RAW post data.
        $content = trim(file_get_contents("php://input"));

        //Attempt to decode the incoming RAW post data from JSON.
        $decoded = array();
        $decoded = json_decode($content, true);

        //! TOKEN BASED AUTHENTICATION, KEEP COMMENTED FOR NOW

        //! ==================================================================
        // if (array_key_exists('LicenseKey', $decoded) && !array_key_exists('Token', $decoded)) {
        //     $encoding_key = $decoded['LicenseKey'];
        //     $client = new Client();
        //     $client = $client->getClientByLicenseKey($decoded["LicenseKey"]); 
        //     $jwt = JWT::encode($client, $encoding_key, 'HS256');
        //     $response->payload["token"] = $jwt;
        //         header('Content-Type: application/json; charset=utf-8');
        //         echo json_encode($response->payload);
        //     return;
        // }

        // if (array_key_exists('Token', $decoded)) {
            
        //     if(!is_array($decoded)){
        //     throw new Exception('Received content contained invalid JSON!');
        //     }
        //     $encoding_key = $decoded['LicenseKey']; 

        //     $key_object = array();
        //     $key_object = ['HS256'];

        //     try{
        //         $decoded_jwt = JWT::decode($decoded['Token'], $encoding_key, $key_object);
        //     }
        //     catch(Exception $ex){
        //         echo "INVALID TOKEN!";
        //         return;
        //     }
        
        //! ======================================================================
            
            

            $keys = array();
            $keys = array_keys($request->url_parameters);

            // $keys[0] in this case is -> 'client'
            // Capitalize the first letter.
            if(empty($keys))
                $controllerName = ucfirst('CharacterSaving').'Controller';
            else
                $controllerName = ucfirst($keys[0]).'Controller';

            // Check whether the class $controllerName exists or not
            // class_exists takes a second parameter $autoload of type boolean and is true by default.
            // So the $controllerName is matched by $classname in autoload($classname)
            if(class_exists($controllerName)){
                $controller = new $controllerName();
            
                
                // Testing
                // var_dump($controller->getAllClients());
                // echo "<br>";

                if($request->accept == "application/json"){
                    
                    $response->payload = json_encode($controller->SaveCharacter($decoded));
                    header('Content-Type: application/json; charset=utf-8');
                    // var_dump($request->payload);
                }
                
                
            }else{

            }
        }
        

        //If json_decode failed, the JSON is invalid.
        
    //}
    else if (strcasecmp($_SERVER['REQUEST_METHOD'], 'GET') == 0){

        // * echo "Request Method: ".$request->verb."<br><br>";
        if(array_key_exists("token", $_GET)){
            $licenseKey = $_GET["token"];
        }else{
            $confirmation = array(
                "code" => "400",
                "message" => "Missing Token Key",
                "time" => "TODO"
            );
            var_dump($confirmation);
            return $confirmation;
            }
        if(array_key_exists("id", $_GET)){
            $id = $_GET["id"];
        }else{
            $confirmation = array(
                "code" => "400",
                "message" => "Missing Character ID Key",
                "time" => "TODO"
            );
            var_dump($confirmation);
            return $confirmation;
        }

        // var_dump($request->url_parameters);
        // * echo "<br><br>";

        
        // Note-3
            // Given an URL with a parameter "client=123"
            // We need to determine that this request is asking for a client with ID 123
            // We need to implement a general way that allows us to load the appropriate controller depending on the URL parameter.
            // Check Note-4

            // Get the target resource controller name.
        $keys = array();
        $keys = array_keys($request->url_parameters);
        // var_dump($keys);

        // $keys[0] in this case is -> 'client'
        // Capitalize the first letter.
        if(empty($keys))
            $controllerName = ucfirst('CharacterSaving').'Controller';
        else
        $controllerName = ucfirst($keys[0]).'Controller';

        // Check whether the class $controllerName exists or not
        // class_exists takes a second parameter $autoload of type boolean and is true by default.
        // So the $controllerName is matched by $classname in autoload($classname)
        if(class_exists($controllerName)){
            $controller = new $controllerName();
            
            // Testing
            // var_dump($controller->getAllClients());
            // echo "<br>";

            if($request->accept == "application/json"){
                $response->payload = json_encode($controller->GetCharacter($id, $licenseKey));
            }
            header('Content-Type: application/json; charset=utf-8');
            echo $response->payload;
        }
    }

    else if (strcasecmp($_SERVER['REQUEST_METHOD'], 'DELETE') == 0){
        // * echo "Request Method: ".$request->verb."<br><br>";
        if(array_key_exists("token", $_GET))
            $licenseKey = $_GET["token"];
        if(array_key_exists("id", $_GET))
            $id = $_GET["id"];
        // var_dump($request->url_parameters);
        // * echo "<br><br>";

        
        // Note-3
            // Given an URL with a parameter "client=123"
            // We need to determine that this request is asking for a client with ID 123
            // We need to implement a general way that allows us to load the appropriate controller depending on the URL parameter.
            // Check Note-4

            // Get the target resource controller name.
        $keys = array();
        $keys = array_keys($request->url_parameters);
        // var_dump($keys);

        // $keys[0] in this case is -> 'client'
        // Capitalize the first letter.
        if(empty($keys))
            $controllerName = ucfirst('CharacterSaving').'Controller';
        else
        $controllerName = ucfirst($keys[0]).'Controller';

        // Check whether the class $controllerName exists or not
        // class_exists takes a second parameter $autoload of type boolean and is true by default.
        // So the $controllerName is matched by $classname in autoload($classname)
        if(class_exists($controllerName)){
            $controller = new $controllerName();
            
            // Testing
            // var_dump($controller->getAllClients());
            // echo "<br>";

            if($request->accept == "application/json"){
                $response->payload = json_encode($controller->DeleteCharacter($id, $licenseKey));
            }
            header('Content-Type: application/json; charset=utf-8');
            echo $response->payload;
        }
    }
?>