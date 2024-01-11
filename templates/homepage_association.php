<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Walim</title>
        <link rel="stylesheet" href="/templates/style/reset_style.css">
        <link rel="stylesheet" href="/templates/style/style_basic.css">
        <link rel="stylesheet" href="/templates/style/homepage_association.css">
        <link rel="stylesheet" href="/templates/style/header_asso.css">
    </head>
    <body>
        <?php
        require("header_asso.php");
        ?>
        <div class="content">
            <main>
                <?php
                for($i = 0; $i < sizeof(recovery_announcement_data()); $i ++){
                    echo "<div class = 'bloc'>";
                    echo "<section>";
                    echo "<h2>".recovery_announcement_data()[$i]["name"]."</h2>";
                    echo "<h4>@".recovery_announcement_data()[$i]["productor"]."</h4>";
                    echo "<p>".recovery_announcement_data()[$i]["date"]."</p>";
                    $table_product = recovery_announcement_products_data(recovery_announcement_data()[$i]["id_notice"]);
                    for($k = 0; $k < sizeof($table_product); $k ++){
                        echo "<div class='produits'> <span>".$table_product[$k]["name_product"]."</span> </div>";
                        echo "<br>";
                    }
                    echo "<form method='get' action='announcement_page.php'>
                                <button name='id_announcement' value='".recovery_announcement_data()[$i]["id_notice"]."'>Voir l'offre</button>
                          </form>";
                    echo "</section>";
                    echo "</div>";
                }
                ?>
            </main>
        </div>
    </body>
</html>