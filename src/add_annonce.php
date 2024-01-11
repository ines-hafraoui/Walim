<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('connexion_database.php');

    if(!(isset($_POST["annonce_details"])) &&
        $_POST["annonce_details"] != "" &&
        isset ($_POST["products"]) &&
        $_POST["products"] != "" &&
        isset ($_POST["qte"]) &&
        $_POST["qte"] != "" &&
        isset ($_POST["date"]) &&
        $_POST["date"] != "" &&
        isset ($_POST["ok"]) &&
        $_POST["ok"] == "Ajouter"
    ) {
        echo 'il y a un petit problème';
    }

    $details = $_POST["annonce_details"];
    $products = $_POST["products"];
    $qtes = $_POST["qte"];
    $dates= $_POST["date"];
    //$img= $_POST["prod-img"];
    //readfile($img);

    $db = connexion_database();
    //Garantie que personne n'est passé en même temps
    $db->beginTransaction();

    $adding_annonce_toDB = $db->query(
        "INSERT INTO `annonce` (`productor`,`status`, date, `details`)
        VALUES ('".$_SESSION['user']."',0, '".date("Y-m-d  h:i:s")."', '".$details."');"
    );

    $statement_annonce= $db->query(
        "SELECT MAX(id_notice) AS last FROM annonce;");

    $id_annonce= $statement_annonce->fetchAll(PDO::FETCH_ASSOC)[0]["last"];
    $db->commit();
    //fin de la transaction les autres requêtes peuvent reprendre


    foreach ($products as $k => $product){
        $annonce_products = connexion_database()->query(
        "INSERT INTO `annonce_products` (`id_annonce`, `id_product`, `conservation_date`, `quantity` )
        VALUES (".$id_annonce.", ".$product.", '".$dates[$k]."', " .$qtes[$k].");"
        );
    }
