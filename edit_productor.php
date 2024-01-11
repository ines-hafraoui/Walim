<?php
require_once('src/connection_check.php');
$connection_check = new Connected;
$connection_check->relocalisation_Connect_Check();

require('src/edit_productor.php');
if(isset($_REQUEST["id"])){
    $productor_account = new Data_productor();
    $respond = $productor_account->display_edit();
    //$productor_account->display_data();
    //$productor_account->display_img();
    $productor_account = new Data_productor();
}else{
    $productor_account = new Data_productor();
}


require('templates/edit_productor.php');

