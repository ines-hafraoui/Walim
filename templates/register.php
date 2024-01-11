<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Walim</title>
    <link rel="stylesheet" href="/templates/style/reset_style.css"/>
    <link rel="stylesheet" href="/templates/style/style_basic.css"/>
    <link rel="stylesheet" href="/templates/style/connexion-register.css"/>
    <link rel="stylesheet" href="/templates/style/getlocationfromaddress.css"/>
</head>
<body>
<main class="register">
    <h1>Inscription</h1>
    <!--<img src="" logo>-->
    <form method="post" action="register.php">
        <input type="text" name="login" id="login-form-register" required placeholder="Nom d'utilisateur">
        <input type="password" name="password" id="password-form-register" required placeholder="Mot de passe">
        <input type="text" name="name" id="name-form-register" required placeholder="Nom">
        <input type="text" name="email" id="email-form-register" required placeholder="Adresse mail">
        <div class="autocomplete-container" id="autocomplete-container"></div>
        <div id="location"></div>
        <div class="btn-container">
            <label class="switch btn-color-mode-switch">
                <input type="checkbox" name="role" id="role_switch" value="1">
                <label for="role_switch" data-off="Association" data-on="Producteur"
                       class="btn-color-mode-switch-inner"></label>
            </label>
        </div>
        <input class="creer" type="submit" value="Créer un compte">
    </form>
    <p>Tu as déja un compte ?<a href="index.php">connecte-toi</a></p>
    <br>
</main>
<script src="../js/getlocationfromaddress.js"></script>
</body>
</html>