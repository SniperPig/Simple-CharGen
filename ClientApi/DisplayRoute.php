<html?>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700;800&display=swap");
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Poppins", sans-serif;
}

div {
    color: #fff;
}

body {
    display: flex;
    justify-content: left;
    align-items: center;
    flex-wrap: wrap;
    min-height: 100vh;
    background: #232427;
}

body .container {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;
    max-width: 900px;
    margin: 40px 0;
}

body .container .card {
    position: relative;
    min-width: 700px;
    height: 180px;
    box-shadow: inset 5px 5px 5px rgba(0, 0, 0, 0.2),
    inset -5px -5px 15px rgba(255, 255, 255, 0.1),
    5px 5px 15px rgba(0, 0, 0, 0.3), -5px -5px 15px rgba(255, 255, 255, 0.1);
    border-radius: 10px;
    margin: 20px;
    transition: 0.5s;
}

body .container .card:nth-child(1) .box .content a {
    background: #2196f3;
}

body .container .card:nth-child(2) .box .content a {
    background: #e91e63;
}

body .container .card:nth-child(3) .box .content a {
    background: #23c186;
}

body .container .card .box {
    position: absolute;
    top: 20px;
    left: 20px;
    right: 20px;
    bottom: 20px;
    background: #2a2b2f;
    border-radius: 15px;
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
    transition: 0.5s;
}

body .container .card .box:hover {
    transform: translateY(-50px);
}

body .container .card .box:before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 50%;
    height: 100%;
    background: rgba(255, 255, 255, 0.03);
}

body .container .card .box .content {
    padding: 20px;
    text-align: center;
}

body .container .card .box .content h2 {
    position: absolute;
    top: -10px;
    right: 30px;
    font-size: 8rem;
    color: rgba(255, 255, 255, 0.1);
}

body .container .card .box .content h3 {
    font-size: 1.8rem;
    color: #fff;
    z-index: 1;
    transition: 0.5s;
    margin-bottom: 15px;
}

body .container .card .box .content p {
    font-size: 1rem;
    font-weight: 300;
    color: rgba(255, 255, 255, 0.9);
    z-index: 1;
    transition: 0.5s;
}

body .container .card .box .content a {
    position: relative;
    display: inline-block;
    padding: 8px 20px;
    background: black;
    border-radius: 5px;
    text-decoration: none;
    color: white;
    margin-top: 20px;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    transition: 0.5s;
}
body .container .card .box .content a:hover {
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.6);
    background: #fff;
    color: #000;
}


</style>

<body>


<?php

$curl = curl_init();

curl_setopt_array($curl, array(
CURLOPT_URL => 'http://localhost/coursechecker/api/route/getDirections?'.file_get_contents('php://input').'',
CURLOPT_RETURNTRANSFER => true,
CURLOPT_ENCODING => '',
CURLOPT_MAXREDIRS => 10,
CURLOPT_TIMEOUT => 0,
CURLOPT_FOLLOWLOCATION => true,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => 'GET',
CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJMaWNlbnNlS0VZMTIzIiwiaWF0IjoxNjM5Mjg1MjAwLCJleHAiOjE2NDAxNDkyMDB9.Mj04ZxHZcS-uy0Z1UOAFPvf_XXoY2GDAeoUj26xriXU'
),
));

$response = curl_exec($curl);
curl_close($curl);
$response = json_decode($response);
echo'<div class="container">';

$count = 1;
foreach($response->routes[0]->legs[0]->steps as $step){
    // echo "Distance: ".$step->distance->text."<br>";
    // echo $step->html_instructions."<br>";
    // echo '<div class="card"> Step '.$count.'<br>'.'Distance: '.$step->distance->text.' ~ '.$step->duration->text.'<br>'
    // .$step->html_instructions.'<br>'.'</div>';
    echo '
    <div class="card">
        <div class="box">
            <div class="content">
            <h2>'.$count.'</h2>
            <h3>'.'Distance: '.$step->distance->text.' ~ '.$step->duration->text.'</h3>
            <p>'.$step->html_instructions.'</p>
        </div>
        </div>
    </div>';
    $count = $count + 1;
}
?>
</div>
</body>

</html>