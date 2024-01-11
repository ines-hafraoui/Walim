<?php
$res = new Reserve();
$res_data = $res->recovery_reservation_data();
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Walim</title>
    <link rel="stylesheet" href="/templates/style/reset_style.css">
    <link rel="stylesheet" href="/templates/style/style_basic.css">
    <link rel="stylesheet" href="/templates/style/announcement_page.css">
    <link rel="stylesheet" href="/templates/style/header_asso.css">
    <link rel="stylesheet" href="/templates/style/homepage_association.css">
</head>
<body>
<?php
require("header_asso.php");
?>
<main>
    <?php
    if($res_data == []){
        echo "<h1 class='noreserv'>Vous n'avez pas encore de réservations</h1>";
    }
    for($i = 0; $i < sizeof($res_data); $i ++){
        echo "<div class = 'bloc'>";
        echo "<section>";
        echo "<h2>".$res_data[$i]["name"]."</h2>";
        echo "<h4>@".$res_data[$i]["productor"]."</h4>";
        echo "<p>".$res_data[$i]["date"]."</p>";
        $table_product = $res->recovery_reservation_products_data($res_data[$i]["id_notice"]);
        echo "<div class='contain'>";
        for($k = 0; $k < sizeof($table_product); $k ++){
            echo "<div class='produits'> <span>".$table_product[$k]["name_product"]."</span> </div>";
            echo "<br>";
        }
        echo "</div>";
        echo "</section>";
        echo "<form id='prendre' method='post' action='myreservation.php'>
                                    <button  name='annonce' value='".$res_data[$i]["id_notice"]."'>C'est récupéré</button>
                              </form>";
        echo "<form id='laisser' method='post' action='myreservation.php'>
                                    <button  name='leaveit' value='".$res_data[$i]["id_notice"]."'>Je préfère le laisser</button>
                              </form>";
        echo "</section>";
        echo "</div>";
    }
    ?>
</main>
</body>
</html>