<?php
include_once '../../public/web/menu.php';
include_once '../../model/DB.php';
include_once '../../model/FournisseurDB.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Founisseur</title>
    <link type="text/css" rel="stylesheet" href="../../public/css/bootstrap.min.css"/>
    <link type="text/css" rel="stylesheet" href="../../public/Semantic-UI-CSS-master/semantic.min.css"/>
    <link type="text/css" rel="stylesheet" href="../../public/DataTables/DataTables-1.10.20/css/dataTables.semanticui.min.css"/>
    <script src="../../public/js/jquery-3.3.1.js"></script>
    <script src="../../public/DataTables/DataTables-1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="../../public/DataTables/DataTables-1.10.20/js/dataTables.semanticui.min.js"></script>
    <script src="../../public/Semantic-UI-CSS-master/semantic.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable( {
                "language": {
                    "lengthMenu": "Afficher _MENU_ lignes",
                    "zeroRecords": "Pas de correspondance",
                    "info": "Page _PAGE_ sur _PAGES_",
                    "infoEmpty": "Aucun enregistrement disponible",
                    "infoFiltered": "",
                    "paginate": {
                        "first":      "First",
                        "last":       "Last",
                        "next":       "Suiv.",
                        "previous":   "Préc."
                    },
                    "search":         "Rechercher:"
                },
                "lengthMenu": [[5, 10, 20, -1], [5, 10, 20, "Tout"]]
            } );
        } );
    </script>
    <style>
        .ui.stackable.grid{
            margin-left: 20px !important;
        }
    </style>
</head>
<body>

<div class="container" style="margin-top: 90px">
    <div class="panel panel-info ">
        <div class="panel-heading" align="center">Mes Founisseurs</div>
        <div class="panel-body">
            <button type="button" style="margin-bottom: 5px;" class="btn btn-primary" data-toggle="modal"
                    data-target="#exampleModal" data-whatever="@mdo">Ajouter
            </button>
            <table id="example" class="ui celled table" style="width:100%; margin-left: auto; ">
                <thead>
                <tr>
                    <th style='text-align:center;'>Nom</th>
                    <th style='text-align:center;'>Adresse</th>
                    <th style='text-align:center;'>CP</th>
                    <th style='text-align:center;'>Ville </th>
                    <th style='text-align:center;'>Pays </th>
                    <th style='text-align:center;'>Téléphone </th>
                    <th style='text-align:center;'>Mail </th>
                    <th style='text-align:center;'>Action </th>
                    <th style='text-align:center;'>Action </th>
                </tr>
                </thead>
                <tbody>
                <?php
                $fournisseur = listeFournisseur();
                while($result=mysqli_fetch_row($fournisseur))
                {
                    echo "
                    <tr>
                        <td style='text-align:center;'>$result[1]</td>
                        <td style='text-align:center;'>$result[2]</td>
                        <td style='text-align:center;'>$result[7]</td>
                        <td style='text-align:center;'>$result[3]</td>
                        <td style='text-align:center;'>$result[4]</td>
                        <td style='text-align:center;'>$result[5]</td>
                        <td style='text-align:center;'>$result[6]</td>
                        <td><center><a class='btn btn-info btn-xs' href='#'>Éditer</a></center></td>
                        <td><center><a class='btn btn-danger btn-xs' href='#'>Supprimer</a></center></td>
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
                <tfoot>
                <tr>
                    <th style='text-align:center;'>Nom</th>
                    <th style='text-align:center;'>Adresse</th>
                    <th style='text-align:center;'>CP</th>
                    <th style='text-align:center;'>Ville </th>
                    <th style='text-align:center;'>Pays </th>
                    <th style='text-align:center;'>Téléphone </th>
                    <th style='text-align:center;'>Mail </th>
                    <th style='text-align:center;'>Action </th>
                    <th style='text-align:center;'>Action </th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel" align="center">Nouveau Founisseur</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="../../controller/FournisseurController.php">
                    <div class="form-group">
                        <label class="control-label">Prénom(s) & Nom</label>
                        <input class="form-control" type="text" name="nom" id="nom" placeholder="Prénom(s) et nom du fournisseur"/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Adresse</label>
                        <input class="form-control" type="text" name="adresse" id="adresse" placeholder="Entrer l'adresse du fournisseur'"/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Ville</label>
                        <input class="form-control" type="text" name="ville" id="ville" placeholder="Entrer la ville"/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Pays</label>
                        <input class="form-control" type="text" name="pays" id="pays" placeholder="Entrer le pays"/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Téléphone</label>
                        <input class="form-control" type="text" name="tel" id="tel" placeholder="Entrer le numéro de téléphone"/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Mail</label>
                        <input class="form-control" type="text" name="mail" id="mail" placeholder="Entrer le mail"/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Boîte postale</label>
                        <input class="form-control" type="text" name="bp" id="bp" placeholder="Entrer la boîte postale"/>
                    </div>
                    <div class="form-group">
                        <input class="btn btn-success" type="submit" name="valider" value="Ajouter"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>
