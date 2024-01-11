<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require('connexion_database.php');

class myDonations{
    private $login_productor;
    private $tab_donation_productor;
    private $tab_donation_product;

    public function __construct(){
        $this->login_productor = $_SESSION['user'];
    }
    public function recovery_annoucement_productor(){
        $statement = connexion_database()->query(
            "SELECT id_notice, association, DATE_FORMAT(date, '%d/%m/%Y'), details, name_product FROM annonce
                            INNER JOIN annonce_products ON annonce.id_notice = annonce_products.id_annonce
                            INNER JOIN products ON annonce_products.id_product = products.id_product
                            WHERE productor = '".$this->login_productor."'
                            ORDER BY id_notice"
        );

        $data_annonces_productor = [];
        while ($row = $statement->fetch()) {
            $data_annonce_productor = ['id_notice' => $row['id_notice'],
                'association' => $row['association'],
                'date' => $row[2],
                'details' => $row['details'],
                'name_product' => $row['name_product'],
            ];
            $data_annonces_productor[] =  $data_annonce_productor;
        }
        $this->tab_donation_productor = $data_annonces_productor;
    }


    public function sort_table_donations(){
        $this->recovery_annoucement_productor();
        $tab_product = [];
        $id_donation = "";
        $index = 0;
        for($i = 0; $i < sizeof($this->tab_donation_productor); $i++){
            if ($this->tab_donation_productor[$i]['id_notice'] == $id_donation){
                $tab_product[$index]['name_product'][] = $this->tab_donation_productor[$i]['name_product'];
            }else{
                $id_donation = $this->tab_donation_productor[$i]['id_notice'];
                $tab_product[$index]['id_notice'][] = $this->tab_donation_productor[$i]['id_notice'];
                $tab_product[$index]['name_product'][] = $this->tab_donation_productor[$i]['name_product'];
                $tab_product[$index]['association'][] = $this->tab_donation_productor[$i]['association'];
                $tab_product[$index]['date'][] = $this->tab_donation_productor[$i]['date'];
                $tab_product[$index]['details'][] = $this->tab_donation_productor[$i]['details'];
                $index = + 1;
            }

        }
        $this->tab_donation_product = $tab_product;
    }
    public function display(){
        var_dump($this->tab_donation_product);
    }

    public function returnsizetab(){
        $tab = $this->tab_donation_product;
        return sizeof($tab);
    }
    public function returnsizetabproduct($i){
        $tab = $this->tab_donation_product[$this->display_id($i)];
        return sizeof($tab);
    }
    public function display_date($i){
        return $this->tab_donation_product[$i]['date'];
    }
    public function display_details($i){
        return $this->tab_donation_product[$i]['details'];
    }
    public function display_id($i){
        return $this->tab_donation_product[$i]['id_notice'];
    }


}





