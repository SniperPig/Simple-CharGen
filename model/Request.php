<?php

    class Request{
        public $verb;
        public $url_parameters;
        public $payload;
        public $payload_format;
        public $accept;

        function __construct(){
        //Note-1:
        //Apache web server stores request in formation in the global variable $_SERVER
        //As as associative array.
            $this->verb = $_SERVER['REQUEST_METHOD'];

        // Note-2:
        // URL Parameters are passed as what we call a Query String
        // e.g. http://localhost/videoconversionservice/api/index.php?client=1?name=John%20Johnson
        // parse_str takes the query string and transforms it into an array.
        $this->url_parameters = array();
        parse_str($_SERVER['QUERY_STRING'], $this->url_parameters);
        }
    }

?>