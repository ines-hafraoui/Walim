<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Walim</title>
    <link rel="stylesheet" href="/templates/style/reset_style.css">
    <link rel="stylesheet" href="/templates/style/style_basic.css">
    <link rel="stylesheet" href="/templates/style/connexion-register.css">
</head>
<body>
    <main class="connexion">
                <img src="/templates/img/logo_orange.png">
                <form method="post" action="/index.php">
                    <input type="text" name="login" id="login-form-connexion" required placeholder="Nom d'utilisateur" class="quoi">
                    <input type="password" name="password" id="password-form-connexion" required placeholder="Mot de passe" class="quoi">
                    <input class="creer" type="submit" value="Se connecter">
                </form>
                <p>Pas de compte ? <a href="register.php">inscris-toi</a></p>
                <p><a href="presentation.html">En apprendre plus sur Walim </a></p>
    </main>
</body>
</html>