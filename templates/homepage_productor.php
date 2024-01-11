<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Walim</title>
        <link rel="stylesheet" href="templates/style/reset_style.css">
        <link rel="stylesheet" href="templates/style/style_basic.css">
        <link rel="stylesheet" href="templates/style/header_productor.css">
        <link rel="stylesheet" href="templates/style/productor_page.css">
    </head>
    <body>
        <?php
        require("header_productor.php");
        ?>
        <main>

            <pre>
            <?php
            $data_productor->sort_table_donations();
            //$data_productor->display();
            for ($index = 0; $index < $data_productor->returnsizetab(); $index++){
                $data_productor->display();
            }
                /*echo "<section>";
                echo "<p>".$data_productor->display_date()."</p>";
                echo "<p>".$data_productor->display_details($index)."</p>";
                echo "<ul>";
                for ($l = 0; $l < $data_productor->returnsizetabproduct($index); $l++){
                    echo "<li>"."</li>";
                }
                echo "</ul>";
                echo "</section>";
            }*/
            //display_announcement_productor(recovery_announcement_productor($_SESSION['user']));
            ?>
            </pre>
        </main>
</body>
</html>