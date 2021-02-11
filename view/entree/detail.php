<?php
include_once '../../public/web/menu.php';
include_once '../../model/DB.php';
include_once '../../model/EntreeDB.php';
$e = @getEntreeById($_GET['num']);
$e = mysqli_fetch_row($e);
$ent = @getAllArticlesEntreeById($_GET['num']);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detail entree</title>
    <style>
        .box2 {
            display: inline-block;
        }
    </style>
</head>
<body>

<div class="container col-lg-6 col-md-6" style="margin-top: 120px; margin-left: 350px">
    <div class="panel panel-success ">
        <div class="panel-heading" align="center">Détails Entrée</div>
        <div class="box2" style="margin-top: 15px; margin-left: 15px;">
            <label class="control-label" style="font-style: oblique">Entrée N° <label class="badge" ><?php echo str_pad($e[0], 5, "0", STR_PAD_LEFT);?> </label> </label><br/>
            <label class="control-label" style="font-style: oblique">Du <label class="badge" ><?php echo $e[1];?> </label> </label>
        </div>
        <div class="box2" style="margin-top: 15px; margin-right: 15px; float: right">
            <label class="control-label" style="font-style: oblique; text-align: right;">Pour la commande N° <label class="badge" ><?php echo str_pad($e[3], 5, "0", STR_PAD_LEFT);?> </label> </label>
        </div>
            <div class="panel-body" style="padding-top: 2px">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th style="text-align: center">Référence</th>
                    <th style="text-align: center">Désignation</th>
                    <th style="text-align: center">Couleur</th>
                    <th style="text-align: center">Quantité</th>
                </tr>
                </thead>
                <tbody>
                <?php
                while($result=mysqli_fetch_row($ent))
                {
                    echo "
                    <tr>
                        <td style='text-align: center'>$result[5]</td>
                        <td style='text-align: center'>$result[6]</td>
                        <td style='text-align: center'>$result[14]</td>
                        <td style='text-align: center'>$result[12]</td>
                    </tr>
                    ";
                }
                if(isset($_GET['resultA']))
                {
                    if($_GET['resultA'] == 1)
                    {
                        echo "<div class='alert alert-success'> Données ajoutées</div>";
                    }
                    else
                    {
                        echo "<div class='alert alert-warning'> Erreur de code</div>";
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
