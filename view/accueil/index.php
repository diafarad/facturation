<?php
include_once '../../public/web/menu.php';
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil</title>
    <link type="text/css" rel="stylesheet" href="../../public/css/bootstrap.min.css"/>
    <script src="../../public/js/jquery-3.4.1.min.js"></script>
    <script src="../../public/js/bootstrap-3.4.0.min.js"></script>
    <style>
        * {
            box-sizing: border-box;
        }

        /* Create two equal columns that floats next to each other */
        .column {
            float: left;
            width: 28%;
            padding: 10px;
            height: 120px; /* Should be removed. Only for demonstration */
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }
    </style>
</head>
<body>
    <div style="margin-top:160px; margin-left: 160px;" class="row">
        <div class="column" style="margin-right:10px; background-color:#002060; color:#fff"><img style="float: right; margin-right: 7px; margin-top: 7px" src="../../public/image/icons8-pièces-de-monnaie-85.png"><?php echo '<h4 style=" margin-top: 30px; font-weight: bold; font-family: Calibri; font-size: 28px">1500 FCFA</h4>'; ?></div>
        <div class="column" style="margin-right:10px; background-color:#bf9000; color:#fff"><img style="float: right; margin-right: 7px; margin-top: 7px" src="../../public/image/icons8-historique-des-commandes-85.png"><?php echo '<h4 style=" margin-top: 30px; font-weight: bold; font-family: Calibri; font-size: 28px">10</h4>'; ?></div>
        <div class="column" style="background-color:#843c0b; color: #fff"><img style="float: right; margin-right: 7px; margin-top: 7px" src="../../public/image/icons8-erreur-85.png"><?php echo '<h4 style=" margin-top: 30px; font-weight: bold; font-family: Calibri; font-size: 28px">15</h4>'; ?></div>
    </div>
    <div style="margin-left: 160px;" class="row">
        <div class="column" style="margin-right:10px; height: 45px; background-color: #0036a2; color:#fff"><h4 style="margin-top: 2px">Valeur Stock</h4></div>
        <div class="column" style="margin-right:10px; height: 45px; background-color: #ffc91d; color:#fff"><h4 style="margin-top: 2px">Article en commande</h4></div>
        <div class="column" style="margin-right:10px; height: 45px; background-color: #c45a11; color: #fff"><h4 style="margin-top: 2px">Article(s) critique(s)</h4></div>
    </div>
    <div class="row" style="margin-top:15px; margin-left: 160px;">
        <div class="column" style="margin-right:10px; background-color:#385723; color: #fff"><img style="float: right; margin-right: 7px; margin-top: 7px" src="../../public/image/icons8-le-cube-rubik-85.png"><?php echo '<h4 style=" margin-top: 30px; font-weight: bold; font-family: Calibri; font-size: 28px">20</h4>'; ?></div>
        <div class="column" style="margin-right:10px; background-color:#6f2fa0; color: #fff"><img style="float: right; margin-right: 7px; margin-top: 7px" src="../../public/image/icons8-haussier-85.png"><?php echo '<h4 style=" margin-top: 30px; font-weight: bold; font-family: Calibri; font-size: 28px">34</h4>'; ?></div>
        <div class="column" style="background-color:#1c83a3; color: #fff"><img style="float: right;" src="../../public/image/top.PNG"><?php echo '<h4 style=" margin-top: 10px; font-weight: bold; font-family: Calibri; font-size: 22px">41</h4>'; ?><?php echo '<h4 style=" margin-top: 35px; font-weight: bold; font-family: Calibri; font-size: 22px">23</h4>'; ?></div>
    </div>
    <div style="margin-left: 160px;" class="row">
        <div class="column" style="margin-right:10px; height: 45px; background-color: #60943b; color: #fff"><h4 style="margin-top: 2px">Nombre d&apos;articles en stock</h4></div>
        <div class="column" style="margin-right:10px; height: 45px; background-color: #a162d0; color: #fff"><h4 style="margin-top: 2px">Volume stock</h4></div>
        <div class="column" style="margin-right:10px; height: 45px; background-color: #26add7; color: #fff"><h4 style="margin-top: 2px">Article(plus vendu / moins vendu)</h4></div>
    </div>
</body>
</html>
