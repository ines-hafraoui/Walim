<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('connexion_database.php');

Class Reserve {

    private $user;

    public function __construct(){
        $this->user = $_SESSION['user'];
    }

    public function update_annonce(){
        $updating_annoncetable = connexion_database()->query(
            "UPDATE annonce
            SET association = '".$this->user."', status = 1 
            WHERE annonce.id_notice = '" .$_POST['annonce']."';"
        );
    }

    public function undo_reservation(){
        $db = connexion_database();
        $undo = $db->query(
            "UPDATE annonce
            SET status = 0 
            WHERE annonce.id_notice = ".$_POST['leaveit'].";"
        );
    }

    public function recovery_reservation_data(){
        $statement = connexion_database()->query(
            "SELECT productor, name, DATE_FORMAT(date, '%d/%m/%Y'), id_notice FROM annonce 
                        INNER JOIN user ON annonce.productor = user.id 
                        WHERE association = '".$this->user."' AND annonce.status = 1;"
        );

        $data_annonces = [];
        while ($row = $statement->fetch()) {
            $data_annonce = ['productor' => $row['productor'],
                'name' => $row['name'],
                'date' => $row[2],
                'id_notice' => $row['id_notice']
            ];
            $data_annonces[] = $data_annonce;
        }
        return $data_annonces;
    }

    public function recovery_reservation_products_data($id_reservation){
        $statement = connexion_database()->query(
            "SELECT name_product FROM annonce 
                        INNER JOIN annonce_products ON annonce.id_notice = annonce_products.id_annonce 
                        INNER JOIN products ON annonce_products.id_product = products.id_product 
                        WHERE id_annonce = ".$id_reservation
        );

        $data_products = [];
        while ($row = $statement->fetch()) {
            $data_product = ['name_product' => $row['name_product']
            ];
            $data_products[] = $data_product;
        }
        return $data_products;
    }

    public function reservation_done(){
        $delete = connexion_database()->query(
            "DELETE FROM annonce_products WHERE id_annonce=".$_POST['annonce'].";
            DELETE FROM annonce WHERE id_notice=".$_POST['annonce'].";"
        );
    }
}



