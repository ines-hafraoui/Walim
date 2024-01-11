<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Walim</title>
        <link rel="stylesheet" href="templates/style/reset_style.css">
        <link rel="stylesheet" href="templates/style/style_basic.css">
        <link rel="stylesheet" href="templates/style/header_productor.css">
        <link rel="stylesheet" href="templates/style/productor_page.css">
        <link rel="stylesheet" href="templates/style/edit_productor.css">
    </head>
    <body>
    <?php
    require("header_productor.php");
    ?>
    <main>
            <form method="post" action="edit_productor.php"  enctype="multipart/form-data">
                <input type="hidden" value="recu" name="envoie">
                <div class="image-upload">
                    <img src="data:image/png;base64,<?=base64_encode($productor_account->display_data_productor()['profilpic']);?>"/>
                    <label for="file-input">
                        <img src="templates/icon/icon-addpictures.svg" id="icon_addpictures-profil"/>
                    </label>
                    <input id="file-input" type="file" name="profilpic"/>
                </div>
                <input type="text" name="name" value="<?= $productor_account->display_data_productor()['name']; ?>">

                <input type="text" name="id" value="<?= $productor_account->display_data_productor()['id']; ?>">

                <label>Description</label>
                <textarea name="description" ><?= $productor_account->display_data_productor()['description']; ?></textarea>

                <h1>Modifier votre compte</h1>
                <label>Mot de Passe</label>
                <input type="text" name="password" value="<?= $productor_account->display_data_productor()['password']; ?>">

                <label>Email</label>
                <input type="text" name="mail" value="<?= $productor_account->display_data_productor()['mail']; ?>">

                <label>Adresse</label>
                <input type="text" name="adresse" value=" ">

                <input type="submit" value="Sauvegarder" name="send_data">
            </form>
        <?="test";?>
    </main>
    </body>
</html>