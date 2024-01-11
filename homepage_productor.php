<?php
require_once('src/connection_check.php');
$connection_check = new Connected;
$connection_check->relocalisation_Connect_Check();
if($_SESSION['role']==2 OR $_SESSION['role']==0) {
    require('src/homepage_productor.php');
    $data_productor = new myDonations();
    require('templates/homepage_productor.php');
}
else{
    echo"vous n'avez pas acces à cette page";
}

