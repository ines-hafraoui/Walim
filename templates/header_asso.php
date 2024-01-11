 <div class="header_asso">
        <header>
            <a href="homepage_association.php" class="pagetitle">Walim</a>
        </header>
        <nav class="menu">
            <a href="myreservation.php" id="mesreservation">Mes réservations</a>
            <a href="map.php" id="carte">Carte</a>
            <a href="#" id="favoris">Favoris</a>
            <div class="dropdown">
                <button class="dropbtn">Compte</button>
                <div class="dropdown-content">
                    <a href="#">Consulter mon compte</a>
                    <a href="session_destroy.php">Se déconnecter</a>
                    <?php
                    if($_SESSION['role']==0){
                        echo "<a href='homepage_admin.php'>Retourner à la page d'accueil administrateur</a>";
                    }
                    ?>
                </div>
            </div>
        </nav>
 </div>
