<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('connexion_database.php');
require('register.php');

class Data_productor{
    private $id_productor;
    private $tab_data_productor;
    private $twins;

    public function __construct(){
        $this->id_productor = $_SESSION['user'];
        $statement = connexion_database()->query(
            "SELECT * FROM user WHERE id = '".$this->id_productor."'"
        );

        $data_productor = [];
        while ($row = $statement->fetch()) {
            $data_productor = ['id' => $row['id'],
                'password' => $row['password'],
                'name' => $row['name'],
                'description' => $row['description'],
                'mail' => $row['mail'],
                'profilpic' => $row['profilpic'],
            ];
        }
        $this->tab_data_productor = $data_productor;
    }
    public function display_data_productor(){
        return $this->tab_data_productor;
    }
    public function display(){
        echo "<pre>";
        var_dump($this->tab_data_productor);
        echo"</pre>";
    }

    public function display_data(){
        echo $_REQUEST['name'];
        echo "<br>";
        echo $_REQUEST['id'];
        echo "<br>";
        echo $_REQUEST['description'];
        echo "<br>";
        echo $_REQUEST['password'];
        echo "<br>";
        echo $_REQUEST['mail'];
        echo "<br>";
        echo $_REQUEST['adresse'];
        echo "<br>";
    }
    public function display_img(){
        echo "<pre>";
        var_dump($_FILES);
        echo "</pre>";
    }
    private function verification_data(){
        if(($this->verification_twins_login($_POST['login'])) && ($this->verification_twins_email($_POST['email']))){
            $this->twins = 0;
        }else if((!$this->verification_twins_login($_POST['login'])) && ($this->verification_twins_email($_POST['email']))){
            $this->twins = 1;
        }else if(($this->verification_twins_login($_POST['login'])) && (!$this->verification_twins_email($_POST['email']))){
            $this->twins = 2;
        }else{
            $this->twins = 3;
        }
    }
    private function verification_twins_email($email_input){
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
    private function verification_twins_login($login_input){
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
    private function modify_data(){
        $statement = connexion_database()->query(
            "UPDATE user
                        SET name='".$_REQUEST['name']."', id='".$_REQUEST['id']."', description='".$_REQUEST['description']."', password='".$_REQUEST['password']."', mail='".$_REQUEST['mail']."'
                        WHERE id = '".$_SESSION['user']."'"
        );
    }
    public function display_edit(){
        $this->verification_data();
        if($this->twins == 0){
            $this->modify_data();
            return "";
        }else if ($this->twins == 1){
            return "Cet e-mail est déja utilisé";
        }else if ($this->twins == 2){
            return "Ce nom d'utilisateur est déja utilisé";
        }else{
            return "Ce nom d'utilisateur et cette e-mail sont déja utilisés";
        }

    }
}

