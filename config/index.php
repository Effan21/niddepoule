<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$host = "niddepoule.mysql.database.azure.com";
$db_name = "niddepoule";
$username = "maxime21@niddepoule";
$password = "C0mpreh@nsion";
$port = "3306";



try{
    $db = new PDO("mysql:host=" . $host . ";port=" . $port . ";dbname=" . $db_name, $username, $password);
    $db->exec("set names utf8");
}catch(PDOException $exception){
    echo "Erreur de connexion : " . $exception->getMessage();
}

$sql = "SELECT * FROM nidcoordonees";

// On prépare la requête
$query = $db->prepare($sql);

// On exécute la requête
$query->execute();

while($row = $query->fetch(PDO::FETCH_ASSOC)){
    extract($row);

    $nid = [
        "id" => $id,
        "lat" => $lati,
        "lon" => $longi,
    ];

    $tableauNid['nidcoordonees'][] = $nid;
}

// On encode en json et on envoie
echo json_encode($tableauNid);
