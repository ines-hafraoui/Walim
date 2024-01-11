<?php
require('templates/index.php');
require('src/index.php');
if (isset($_POST["login"])){
    session_start();
    connexion_user($_POST["login"], $_POST["password"]);
}
