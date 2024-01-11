<?php
require_once('src/connection_check.php');
$connection_check = new Connected;
$connection_check->relocalisation_Connect_Check();
if($_SESSION['role']==1 OR $_SESSION['role']==0) {
    require_once('src/reservation.php');
    $res = new Reserve();
    $res_update = $res->update_annonce();
    require_once('templates/reservation.php');
}
else{
    echo"vous n'avez pas acces à cette page";
}




