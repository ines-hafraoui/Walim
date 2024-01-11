<?php
require_once('src/connection_check.php');
$connection_check = new Connected;
$connection_check->relocalisation_Connect_Check();
if($_SESSION['role']==1 OR $_SESSION['role']==0) {
    require('src/announcement_page.php');
    require('templates/announcement_page.php');
}
else{
    echo"vous n'avez pas acces à cette page";
}