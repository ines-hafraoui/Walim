<?php
require_once('connexion_database.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
class Header{
    private $login_producteur;
    private $tab_producteur_data;
    public function __construct(){
        $this->login_producteur = $_SESSION['user'];
    }
    function recovery_data_productor_header(){
        $statement = connexion_database()->query(
            "Select name, profilpic from user where id= '" . $this->login_producteur . "'"
        );
        while (($row = $statement->fetch())) {
            $this->tab_producteur_data = ['name' => $row['name'],
                'profilpic' => $row['profilpic'],
            ];
        }
    }
    function display_profilpic_productor_header(){
        echo '<img src="data:image/png;base64,'. base64_encode($this->tab_producteur_data['profilpic']).'" height=50px width=50px/>';
    }
    function display_name_productor_header(){
        return $this->tab_producteur_data['name'];
    }
}
