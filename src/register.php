<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('src/index.php');
require_once('src/connection_check.php');
$connection_check = new Connected;
if($connection_check->relocation_connected()){
    redirection();
}

function verification_twins_login($login_input){
    $statement = connexion_database()->query(
        "SELECT id FROM user WHERE id = '".$login_input."'"
    );
    $data_user = [];
    while (($row = $statement->fetch())) {
        $data_user = ['login' => $row['id']];
    }
    if ($data_user == []){
        return true;
    }else{
        return false;
    }
}

function verification_twins_email($email_input){
    $statement = connexion_database()->query(
        "SELECT mail FROM user WHERE mail = '".$email_input."'"
    );
    $data_user = [];
    while (($row = $statement->fetch())) {
        $data_user = ['mail' => $row['mail']];
    }
    if ($data_user == []){
        return true;
    }else{
        return false;
    }
}
function selection_role(){
    if (isset($_POST['role'])){
        return 2;
    }else{
        return 1;
    }
}

function add_data_account(){
    if((verification_twins_login($_POST['login'])) && (verification_twins_email($_POST['email']))){
        $statement = connexion_database()->query(
            "INSERT INTO `user` (`id`, `password`, `name`, `role`, `latitude`, `longitude`, `mail`)
VALUES ('".$_POST['login']."', '".$_POST['password']."', '".$_POST['name']."', '".selection_role()."', '".$_POST['lat']."', '".$_POST['long']."', '".$_POST['email']."');"
        );
        connexion_user($_POST['login'], $_POST['password']);
    }else if((!verification_twins_login($_POST['login'])) && (verification_twins_email($_POST['email']))){
        echo "probleme login";
    }else if((verification_twins_login($_POST['login'])) && (!verification_twins_email($_POST['email']))){
        echo "probleme mail";
    }else{
        echo "probleme mail et login";
    }
}


