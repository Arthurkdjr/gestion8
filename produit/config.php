<?php
header("Access-Control-Allow-Origin: http://localhost:4200");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Gérer les requêtes preflight CORS (OPTIONS)
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}


use Taf\TafAuth;

try {
    require '../TafConfig.php';
    $reponse = array();
    $table_name = "produit";
    $taf_config = new \Taf\TafConfig();
    $taf_config->allow_cors();
    if (file_get_contents('php://input')=="") {
        $params=[];
    } else {
        $params=json_decode(file_get_contents('php://input'),true);
    }    
} catch (\Throwable $th) {
    echo "<h1>" . $th->getMessage() . "</h1>";
}
