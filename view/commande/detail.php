<?php
include_once '../../public/web/menu.php';
include_once '../../model/DB.php';
include_once '../../model/CommandeDB.php';
$c = @getCommandeByNumero($_GET['num']);
$c = mysqli_fetch_row($c);
$com = @getAllArticlesCommandeByNum($_GET['num']);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detail commande</title>
</head>
<body>

<div class="container col-lg-6 col-md-6" style="margin-top: 120px; margin-left: 350px">
    <div class="panel panel-success ">
        <div class="panel-heading" align="center">Détails Commande</div>
        <div class="form-group" style="margin-top: 15px;">
            <center>
                <label class="control-label" style="font-style: oblique">Commande N° <label class="badge" ><?php echo str_pad($c[0], 5, "0", STR_PAD_LEFT);?> </label> </label><br/>
                <label class="control-label" style="font-style: oblique">Du <label class="badge" ><?php echo $c[1];?> </label> </label>
            </center>
        </div>
        <div class="panel-body" style="padding-top: 2px">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th style="text-align: center">Référence</th>
                    <th style="text-align: center">Désignation</th>
                    <th style="text-align: center">Couleur</th>
                    <th style="text-align: center">Quantité</th>
                    <th style="text-align: center">Contrôle</th>
                    <th style="text-align: center">Restant</th>
                    <th style="text-align: center">Statut </th>
                </tr>
                </thead>
                <tbody>
                <?php
                while($result=mysqli_fetch_row($com))
                {
                    $col = 'text-align:center;';
                    $statut = '';
                    if($result[15]<=0){
                        $statut = 'fermée';
                    }else{
                        $statut = 'ouverte';
                    }
                    if ($statut=='ouverte'){
                        $col = 'text-align:center; background: #f17421; color:#fff';
                    }
                    echo "
                    <tr>
                        <td style='text-align: center'>$result[5]</td>
                        <td style='text-align: center'>$result[6]</td>
                        <td style='text-align: center'>$result[18]</td>
                        <td style='text-align: center'>$result[13]</td>
                        <td style='text-align: center'>$result[14]</td>
                        <td style='text-align: center'>$result[15]</td>
                        <td style='$col'>$statut</td>
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
