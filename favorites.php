<?php
require_once('src/connection_check.php');
$connection_check = new Connected;
$connection_check->relocalisation_Connect_Check();
require('src/favorites.php');
session_start();
if (isset($_SESSION["user"])){
    recovery_favourite_data($_SESSION["user"]);
}else{
    header('Location:index.php');
}
require('templates/favorites.php');
