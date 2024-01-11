<?php require_once('src/connection_check.php');
$connection_check = new Connected;
$connection_check->relocalisation_Connect_Check();
if($_SESSION['role']==1 OR $_SESSION['role']==0) {
    require('src/reservation.php');
    require('templates/myreservation.php');
    if (isset($_POST["annonce"])){
        $delete= new Reserve();
        $delete->reservation_done();
        header("Location:myreservation.php");
    }
    if (isset($_POST["leaveit"])){
        $undo= new Reserve();
        $undo->undo_reservation();
        header("Location:myreservation.php");
    }
}
else{
    echo"vous n'avez pas acces à cette page";
}
