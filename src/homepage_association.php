<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require('src/connexion_database.php');

function recovery_announcement_data(){
    $statement = connexion_database()->query(
        "SELECT productor, name, DATE_FORMAT(date, '%d/%m/%Y'), id_notice FROM annonce 
                        INNER JOIN user ON annonce.productor = user.id 
                        WHERE status = 0 ;"
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

function recovery_announcement_products_data($id_announcement){
    $statement = connexion_database()->query(
        "SELECT name_product,conservation_date, quantity
                        FROM annonce 
                        INNER JOIN annonce_products ON annonce.id_notice = annonce_products.id_annonce 
                        INNER JOIN products ON annonce_products.id_product = products.id_product 
                        WHERE id_annonce = ".$id_announcement
    );

    $data_products = [];
    while ($row = $statement->fetch()) {
        $data_product = ['name_product' => $row['name_product'],
            'conserv' => $row['conservation_date'],
            'quantity' => $row['quantity']
        ];
        $data_products[] = $data_product;
    }
    return $data_products;
}
//echo '<img src="data:image/png;base64,'. base64_encode($tab_announcement[$i]["profilpic"]).'" height=50px width=50px/>';





