<?php
require_once('src/connection_check.php');
$connection_check = new Connected;
$connection_check->relocalisation_Connect_Check();
if($_SESSION['role']==2 OR $_SESSION['role']==0) {
    require('templates/add_annonce.php');
    if (isset($_POST["ok"])){
        require('src/add_annonce.php');
    }
}
else{
    echo"vous n'avez pas acces à cette page";
}
