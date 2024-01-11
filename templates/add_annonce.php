<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un post</title>
    <head>
        <meta charset="utf-8">
        <title>Walim</title>
        <link rel="stylesheet" href="templates/style/reset_style.css">
        <link rel="stylesheet" href="templates/style/style_basic.css">
        <link rel="stylesheet" href="templates/style/productor_page.css">
        <link rel="stylesheet" href="templates/style/header_productor.css">
        <link rel="stylesheet" href="templates/style/add_annonce.css">
    </head>
</head>
<body>
    <?php require('./src/connexion_database.php');
    function printproducts() {
        $statement_type = connexion_database()->query(" SELECT id_type, name_type FROM product_types ORDER BY name_type ASC");
        $productypes = $statement_type->fetchAll();
        foreach ($productypes as $k => $productype) {
            echo '<optgroup label="' . $productype['name_type'] . '">';
            $statement_product = connexion_database()->query(
                "SELECT id_product, name_product AS prod
                        From products JOIN product_types ON products.product_type=product_types.id_type
                        WHERE product_type = " . $productype['id_type']  . "
                        ORDER BY name_product ASC;");
            $products = $statement_product->fetchAll();
            foreach ($products as $product) {
                $prod_name = $product['prod'];
                $prod_id = $product['id_product'];
                echo '<option value="' . $prod_id . '">' . $prod_name . '</option>';
            }
        }
        echo '</optgroup>';
    }
    ?>
    <?php
    require("header_productor.php");
    ?>
    <main>
        <form action="../add_annonce.php" method="POST">
            <div class="details">
                <label for="details">Détails:</label>
                <textarea id="details" name="annonce_details" placeholder="Décrivez ici les détails de votre annonce"></textarea>
            </div>
            <div class="products">
                <label for="products">Produits:</label>
                <select id='products' name="prod" >
                    <option selected >Séléctionnez un produit</option>
                    <?php
                        $a= printproducts();
                    ?>
                </select>
            </div>
            <div onclick="addSelected();" class="Add">Ajouter</div>
            <div id="added"></div>
            <input id="submit" type="submit"  value="Publier" name='ok'>
        </form>
    </main>
    <script src="../js/add_selected.js"></script>
</body>
</html>