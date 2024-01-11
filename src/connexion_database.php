<?php
function connexion_database(){
// We connect to the database.
try {
$database = new PDO('mysql:host=localhost;dbname=b06sae301;charset=utf8', 'b06sae301', 'Yu9phieL');
} catch (Exception $e) {
die('Erreur : ' . $e->getMessage());
}
return $database;
}