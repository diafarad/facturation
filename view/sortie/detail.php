<?php
include_once '../../public/web/menu.php';
include_once '../../model/DB.php';
include_once '../../model/SortieDB.php';
$s = @getSortieById($_GET['num']);
$s = mysqli_fetch_row($s);
$sort = @getAllArticlesSortieById($_GET['num']);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detail Sortie</title>
    <style>
        .box2 {
            display: inline-block;
        }
    </style>
</head>
<body>

<div class="container" style="margin-top: 120px; width: 550px">
    <div class="panel panel-success ">
        <div class="panel-heading" align="center">Détails Sortie</div>
        <div class="form-group" style="margin-top: 15px;">
            <center>
                <label class="control-label" style="font-style: oblique">Sortie N° <label class="badge" ><?php echo str_pad($s[0], 5, "0", STR_PAD_LEFT);?> </label> </label><br/>
                <label class="control-label" style="font-style: oblique">Du <label class="badge" ><?php echo $s[1];?> </label> </label>
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
                </tr>
                </thead>
                <tbody>
                <?php
                while($result=mysqli_fetch_row($sort))
                {
                    echo "
                    <tr>
                        <td style='text-align: center'>$result[2]</td>
                        <td style='text-align: center'>$result[3]</td>
                        <td style='text-align: center'>$result[13]</td>
                        <td style='text-align: center'>$result[10]</td>
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
