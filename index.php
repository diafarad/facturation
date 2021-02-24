<?php
include_once './public/web/menu.php';
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil</title>
    <link type="text/css" rel="stylesheet" href="./public/css/bootstrap.min.css"/>
    <script src="./public/js/jquery-3.4.1.min.js"></script>
    <script src="./public/js/bootstrap-3.4.0.min.js"></script>
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
    <div style="margin-top:260px; margin-left: 160px;" class="row">
        <a href="./view/facturation/index.php">
        <div class="column" style="margin-right:10px; background-color:#002060; color:#fff"><img style="float: right; margin-right: 7px; margin-top: 7px" src="./public/image/icons8-facture-d'achat-85.png"><?php echo '<h4 style=" margin-top: 30px; font-weight: bold; font-family: Calibri; font-size: 28px">Facturation</h4>'; ?></div>
        </a>
        <a href="./view/bon/index.php">
        <div class="column" style="margin-right:10px; background-color:#bf9000; color:#fff"><img style="float: right; margin-right: 7px; margin-top: 7px" src="./public/image/icons8-historique-des-commandes-85.png"><?php echo '<h4 style=" margin-top: 30px; font-weight: bold; font-family: Calibri; font-size: 28px">Commande</h4>'; ?></div>
        </a>
        <a href="./view/bordereau/index.php">
        <div class="column" style="background-color:#843c0b; color: #fff"><img style="float: right; margin-right: 7px; margin-top: 7px" src="./public/image/icons8-bordereau-de-paiement-85.png"><?php echo '<h4 style=" margin-top: 30px; font-weight: bold; font-family: Calibri; font-size: 28px">Bordereau</h4>'; ?></div>
        </a>
    </div>
    <div style="margin-left: 160px;" class="row">
        <a href="./view/facturation/index.php">
        <div class="column" style="margin-right:10px; height: 45px; background-color: #0036a2; color:#fff"><h4 style="margin-top: 2px">Facture</h4></div>
        </a>
        <a href="./view/bon/index.php">
        <div class="column" style="margin-right:10px; height: 45px; background-color: #ffc91d; color:#fff"><h4 style="margin-top: 2px">Commande</h4></div>
        </a>
        <a href="./view/bordereau/index.php">
        <div class="column" style="margin-right:10px; height: 45px; background-color: #c45a11; color: #fff"><h4 style="margin-top: 2px">Bordereau de livraison</h4></div>
        </a>
    </div>
</body>
</html>
