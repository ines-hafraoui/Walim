<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Walim - Carte </title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
          integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI="
          crossorigin=""/>
    <link rel="stylesheet" href="./templates/style/map.css">
    <link rel="stylesheet" href="/templates/style/reset_style.css">
    <link rel="stylesheet" href="/templates/style/style_basic.css">
    <link rel="stylesheet" href="/templates/style/header_asso.css">
</head>
<body>
    <?php
    require("header_asso.php");
    ?>

    <?php
        $user_loc = new Userloc();
        $user_long = $user_loc->get_long();
        $user_lat = $user_loc->get_lat();

        $a= new Prodloc;
        $a->prod_coords();
        $a_data = $a->annonce_prod();
        $lata = $a->get_lat();
        $longa = $a->get_long();
        $productor_name = $a->get_productor();
    ?>
    <div class="hidden" id="information"></div>
    <div class="map-space">
        <div id="map" style="height:80em">
        </div>
    </div>
    <!--la carte leaflet-->
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
            integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM="
            crossorigin=""></script>
    <script type="text/javascript">
        var user_lat = <?php echo $user_lat ?>;
        var user_long = <?php echo $user_long ?>;

        var annonce_lat =<?php echo json_encode($lata); ?>;
        var annonce_long =<?php echo json_encode($longa); ?>;
        var annonce_productor = <?php echo json_encode($productor_name); ?>;
        var annonce_content =<?php echo json_encode($a_data); ?>;

    </script>
    <script src="../js/map.js"></script>
</body>
</html>