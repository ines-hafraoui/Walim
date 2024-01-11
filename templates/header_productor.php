<header id="header-productor">
    <?php
    require_once('src/header_productor.php');
    $data = new Header();
    $data->recovery_data_productor_header();
    ?>
    <div class="profile">
        <?=$data->display_profilpic_productor_header();?>
        <p id="login_productor_header"><?=$data->display_name_productor_header();?></p>
    </div>
    <nav>
        <ul>
            <li class="icon-header-productor"><a href="/edit_productor.php"><img src="templates/icon/icon-account.svg">Modifier mon compte</a></li>
            <li class="icon-header-productor"><a href="add_annonce.php"><img src="templates/icon/icon-add-annonce.svg">Ajouter un annonce</a></li>
            <li class="icon-header-productor"><a href="/homepage_productor.php"><img src="templates/icon/icon-donnations.svg">Mes Dons</a></li>
            <li class="icon-header-productor"><a href="/session_destroy.php"><img src="templates/icon/icon-disconnect.svg">Se déconnecter</a></li>
        </ul>
    </nav>
</header>