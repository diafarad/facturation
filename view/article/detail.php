<?php
include_once '../../public/web/menu.php';
include_once '../../model/DB.php';
include_once '../../model/ArticleDB.php';
$art = getArticleByRef($_GET['ref']);
$art = mysqli_fetch_row($art);
$article = @getCouleurArticleByRef($_GET['ref']);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Article</title>
</head>
<body>

<div class="container" style="margin-top: 120px; width: 500px">
    <div class="panel panel-success ">
        <div class="panel-heading" align="center">Article</div>
        <div class="form-group" style="margin-top: 15px;">
            <center><label class="control-label" style="font-style: oblique">Article <label class="badge"><?php echo $art[0]." ".$art[1];?> </label> </label></center>
        </div>
        <div class="panel-body" style="padding-top: 2px">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th style='text-align:center;'>Couleur</th>
                    <th style='text-align:center;'>Stock</th>
                    <th style='text-align:center;'>Action </th>
                </tr>
                </thead>
                <tbody>
                <?php
                while($result=mysqli_fetch_row($article))
                {
                    echo "
                    <tr>
                        <td style='text-align:center;'>$result[6]</td>
                        <td style='text-align:center;'>$result[9]</td>
                        <td><center><a class='btn btn-primary btn-xs'>Faire une commande</a></center></td>
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
