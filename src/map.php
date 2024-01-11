<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//require_once('connexion_database.php');
require_once ('./src/homepage_association.php');

trait loc {
    public abstract function get_lat();
    public abstract function get_long();
}


Class Userloc {
    use loc;

    private $user;
    private $lat;
    private $long;

    public function __construct() {
        $this->user = $_SESSION['user'];
        $this->lat = $this->get_lat();
        $this->long = $this->get_long();
    }

    public function user_coords(){
        $statement = connexion_database()->query(
            "SELECT latitude, longitude
            FROM user 
            WHERE id = '".$this->user."';");
        $coords = $statement->fetchAll()[0];
        return $coords;

    }

    public function get_lat(){
        $this->lat = $this->user_coords()['latitude'];
        return $this->lat;
    }

    public function get_long(){
        $this->long = $this->user_coords()['longitude'];
        return $this->long;
    }
}

Class Prodloc{
    use loc;

    private $rolep;
    private $rolea;
    private $lat = [];
    private $long = [];
    private $prods = [];
    private $annonce = [];

    public function __construct() {
        $this->rolep = 2;
        $this->rolea = 0;
        $this->lat = $this->get_lat();
        $this->long = $this->get_long();
        $this->prods = $this->get_productor();
        $this->annonce = $this->get_annonce();
    }

    public function prod_coords(){
        $statement = connexion_database()->query(
            "SELECT DISTINCT id AS productor, latitude, longitude
            FROM user
            JOIN annonce ON user.id = annonce.productor
            WHERE user.role = ".$this->rolep." OR user.role = ".$this->rolea.";");
        $coords_prod = [];
        while ($row = $statement->fetch()) {
            $data = ['productor' => $row['productor'],
                'latitude' => $row['latitude'],
                'longitude' => $row['longitude']
            ];
            $coords_prod[] = $data;
        }

        for($i = 0; $i < sizeof($coords_prod); $i ++){
            $this->prods[] = $coords_prod[$i]["productor"];
            $this->lat[] = $coords_prod[$i]["latitude"];
            $this->long[] = $coords_prod[$i]["longitude"];
        }
    }

    public function get_lat(){
        return $this->lat;
    }

    public function get_long(){
        return $this->long;
    }

    public function get_productor(){
        return $this->prods;
    }

    public function get_annonce(){
        return $this->annonce;
    }

    public function annonce_prod(){
        $annonce_data = [];
        for($i = 0; $i < sizeof(recovery_announcement_data()); $i ++){
            $productor =  recovery_announcement_data()[$i]["productor"];
            $date = recovery_announcement_data()[$i]["date"];
            $id_notice = recovery_announcement_data()[$i]["id_notice"];
            $table_product = recovery_announcement_products_data(recovery_announcement_data()[$i]["id_notice"]);
            $annonce_data[]=['productor'=>$productor,
                'date'=>$date,
                'products_info'=> $table_product,
                'id_notice' => $id_notice
            ];
        }
        return $annonce_data;
    }

}

