<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require("connexion_database.php");

function recovery_favourite_data($login_user){
    $statement = connexion_database()->query(
        "Select id, name, localisation, profilpic from user Inner Join favorites on user.id = favorites.productor where association= '".$login_user."' and role=2"
    );

    $data_favorites = [];
    while (($row = $statement->fetch())) {
        $data_favorite = ['id' => $row['id'],
            'name' => $row['name'],
            'localisation' => $row['localisation'],
            'profilpic' => $row['profilpic'],
        ];
        $data_favorites[] = $data_favorite;
    }
    echo"<pre>";
    var_dump($data_favorites);
    echo "</pre>";
}
