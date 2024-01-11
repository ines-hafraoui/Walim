<?php
require('templates/register.php');
require('src/register.php');
if (isset($_POST["login"])){
    session_start();
    add_data_account();
}
