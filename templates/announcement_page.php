<?php
$announcement = new Announcement();
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
    </head>
    <body>
        <?php
        require("header_asso.php");
        ?>
        <main>
            <div class="profil">
                <?=$announcement->display_profilpic_announcement_page();?>
                <div class="info">
                    <h2><?=$announcement->display_name_announcement_page();?></h2>
                    <h4>@<?=$announcement->display_productor_announcement_page();?></h4>
                    <p><?=$announcement->display_details_announcement_page();?></p>
                    <p><?=$announcement->display_date_announcement_page();?></p>
                </div>
                <div class="reserv">
                    <form action="reservation.php" method="POST">
                        <input type="hidden" name="annonce" value="<?php $announcement->get_announcement(); ?>">
                        <input type="submit"  value="Réserver" name='reserv'>
                    </form>
                </div>
            </div>
            <div class="contenu">
                <?=$announcement->display_dataproduct_page()?>
            </div>
        </main>
    </body>
</html>