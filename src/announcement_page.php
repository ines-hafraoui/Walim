<?php
if (isset($_GET['id_announcement'])){
    $id_announcement = $_GET['id_announcement'];
}else{
    header("Location:homepage_association.php");
}
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require('src/connexion_database.php');

class Announcement{
    private $id_announcement;
    public function __construct(){
        $this->id_announcement = $_GET['id_announcement'];
    }
    private function recovery_data_annoucement_page(){
        $statement = connexion_database()->query(
            "SELECT productor, name, details, profilpic, name_product, DATE_FORMAT(conservation_date, '%d/%m/%Y'), quantity, name_type, DATE_FORMAT(date, '%d/%m/%Y'), images FROM annonce 
                            INNER JOIN user ON annonce.productor = user.id
                            INNER JOIN annonce_products ON annonce.id_notice = annonce_products.id_annonce 
                            INNER JOIN products ON annonce_products.id_product = products.id_product
                            INNER JOIN product_types ON products.product_type = product_types.id_type
                            WHERE id_annonce = ".$this->id_announcement
        );
        $data_announcements = [];
        while ($row = $statement->fetch()) {
            $data_announcement = ['productor' => $row['productor'],
                'name' => $row['name'],
                'details' => $row['details'],
                'profilpic' => $row['profilpic'],
                'name_product' => $row['name_product'],
                'conservation_date' => $row[5],
                'quantity' => $row['quantity'],
                'name_type' => $row['name_type'],
                'date' => $row[8],
                'images' => $row['images'],
            ];
            $data_announcements[] = $data_announcement;
        }
        return $data_announcements;
    }
    public function display_profilpic_announcement_page(){
        echo '<img src="data:image/png;base64,'. base64_encode($this->recovery_data_annoucement_page()[0]['profilpic']).'" height=50px width=50px/>';
    }
    public function display_productor_announcement_page(){
        return $this->recovery_data_annoucement_page()[0]['productor'];
    }
    public function display_name_announcement_page(){
        return $this->recovery_data_annoucement_page()[0]['name'];
    }
    public function display_details_announcement_page(){
        return $this->recovery_data_annoucement_page()[0]['details'];
    }
    public function display_date_announcement_page(){
        return $this->recovery_data_annoucement_page()[0]['date'];
    }
    public function display_name_product_announcement_page($index){
        return $this->recovery_data_annoucement_page()[$index]['name_product'];
    }
    public function display_quantity_product_announcement_page($index){
        return $this->recovery_data_annoucement_page()[$index]['quantity'];
    }
    public function display_conservation_date_product_announcement_page($index){
        return $this->recovery_data_annoucement_page()[$index]['conservation_date'];
    }
    
    public function get_announcement(){
        echo $this->id_announcement;
    }

    public function display_images_announcement_page($index){
        echo $this->recovery_data_annoucement_page()[$index]['images'];
        if ($this->recovery_data_annoucement_page()[$index]['images'] != ""){
            echo '<img src="data:image/png;base64,'. base64_encode($this->recovery_data_annoucement_page()[$index]['images']).'" height=50px width=50px/>';
        }else{
            echo "<p>Il n'y a pas d'image.</p>";
        }

    }
    public function display_dataproduct_page(){
        for ($i = 0; $i < sizeof($this->recovery_data_annoucement_page()); $i ++){
            echo "<div class='bloc'>";
            $this->display_images_announcement_page($i);
            echo "<p class='produit'>".$this->display_name_product_announcement_page($i)."</p>";
            echo "<p class='quantite'>Unité: ".$this->display_quantity_product_announcement_page($i)."</p>";
            echo "<p class='peremption'>Date de péremption: ".$this->display_conservation_date_product_announcement_page($i)."</p>";
            echo "</div>";
        }
    }
}