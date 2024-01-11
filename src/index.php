<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('src/connexion_database.php');
require_once('src/connection_check.php');
$connection_check = new Connected;
if($connection_check->relocation_connected()){
    redirection();
}

function verification_login($login_input){
    $statement = connexion_database()->query(
        "SELECT id FROM user WHERE id = '".$login_input."'"
    );

    $data_user = [];
    while (($row = $statement->fetch())) {
        $data_user = ['login' => $row['id']];
    }
    if ($data_user == []){
        return false;
    }else{
        return true;
    }
}

function verification_password($login_input, $password_input){
    $statement = connexion_database()->query(
        "SELECT password FROM user WHERE id = '".$login_input."'"
    );
    $data_password = [];
    while (($row = $statement->fetch())) {
        $data_password = ['password' => $row['password']];
    }

    if(($data_password['password'] == $password_input)){
        return true;
    }else{
        return false;
    }
}

function comparison($login, $password){
    if (verification_login($login)){
        if (verification_password($login, $password)){
            return true;
        }else{
            echo "Votre mot de passe est incorrect.";
        }
    }else{
        echo "le nom d'utilisateur n'existe pas";
    }
}

function redirection(){
    $statement = connexion_database()->query(
        "SELECT role FROM user WHERE id = '".$_SESSION['user']."'"
    );

    while (($row = $statement->fetch())) {
        $data_role = $row['role'];
    }
    if ($data_role == 1){
        //If it's an association
        header('Location:homepage_association.php');
    }else if ($data_role == 2){
        //If it's a producer
        header('Location:homepage_productor.php');
    }else{
        //If it's an admin
        header('Location:homepage_admin.php');
    }
    $_SESSION['role']=$data_role;
}

function connexion_user($user_login, $user_password){
    if (comparison($user_login, $user_password)){
        $_SESSION['user'] = $user_login;
        redirection();
    }
}

