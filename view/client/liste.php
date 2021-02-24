<?php
include_once '../../public/web/menu.php';
include_once '../../model/DB.php';
include_once '../../model/ClientDB.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Client</title>
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
    <div id="info"></div>
        <div class="panel-heading" align="center">Mes Clients</div>
        <div class="panel-body">
            <button type="button" style="margin-bottom: 5px;" class="btn btn-primary" data-toggle="modal"
                    data-target="#exampleModal" data-whatever="@mdo">Ajouter
            </button>
            <table id="example" class="ui celled table" style="width:100%; margin-left: auto; ">
                <thead>
                <tr>
                    <th style='text-align:center;'>Code</th>
                    <th style='text-align:center;'>Nom</th>
                    <th style='text-align:center;'>Adresse</th>
                    <th style='text-align:center;'>Téléphone </th>
                    <th style='text-align:center;'>Action </th>
                    <th style='text-align:center;'>Action </th>
                </tr>
                </thead>
                <tbody>
                <?php
                $client = listeClient();
                while($result=mysqli_fetch_row($client))
                {
                    echo "
                    <tr>
                        <td style='text-align:center;'>$result[0]</td>
                        <td style='text-align:center;'>$result[1]</td>
                        <td style='text-align:center;'>$result[2]</td>
                        <td style='text-align:center;'>$result[3]</td>
                        <td>
                        <center><button type='button' class='btn btn-info btn-xs edit_button' 
                            data-toggle='modal' data-target='#myeditModal'
                            data-nom='$result[1]'
                            data-adr='$result[2]'
                            data-tel='$result[3]'
                            data-code='$result[0]'>
                            Éditer
                        </button>
                        </center>
                        </td>
                        <td>
                        <center><button type='button' class='btn btn-warning btn-xs del_button' 
                        data-toggle='modal' data-target='#mydelModal'
                        data-id='$result[0]'>
                        Supprimer
                        </button>
                        </center>
                        </td>
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
                    <th style='text-align:center;'>Code</th>
                    <th style='text-align:center;'>Nom</th>
                    <th style='text-align:center;'>Adresse</th>
                    <th style='text-align:center;'>Téléphone </th>
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
                <h4 class="modal-title" id="exampleModalLabel" align="center">Nouveau Client</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="../../controller/ClientController.php">
                    <div class="form-group">
                        <label class="control-label">Code Client</label>
                        <input class="form-control" type="text" name="code" id="code" placeholder="Code Client"/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Nom Client</label>
                        <input class="form-control" type="text" name="nom" id="nom" placeholder="Nom Client"/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Adresse</label>
                        <input class="form-control" type="text" name="adresse" id="adresse" placeholder="Entrer l'adresse du client"/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Téléphone</label>
                        <input class="form-control" type="text" name="tel" id="tel" placeholder="Entrer le numéro de téléphone"/>
                    </div>
                    <div class="form-group">
                        <input class="btn btn-success" type="submit" name="valider" value="Ajouter"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myeditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" id="edok" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Édition client</h4>
            </div>
            <form method="post" id="editClient">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label">Code</label>
                        <input readonly class="form-control client_code" name="edit_code" placeholder="Entrer le code du client" required>
                    </div>
                    <div class="form-group">
                        <label for="heading">Nom</label>
                        <input class="form-control client_nom" type="text" name="edit_nom" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Adresse</label>
                        <input class="form-control client_adr" type="text" name="edit_adr" placeholder="Entrer le nom du client" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Téléphone</label>
                        <input class="form-control client_tel" type="text" name="edit_tel" placeholder="Entrer le téléphone" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="enregistrer">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="mydelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Suppression client</h4>
            </div>
            <form method="post" action="../../controller/ClientController.php">
                <div class="modal-body">
                    <div class="form-group">
                        <h3>Voulez-vous vraiment supprimer?</h3>
                        <input class="form-control del_id" type="hidden" name="id" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning" name="supprimer">Confirmer</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>

<script>
document.getElementById('info').style.display = 'none';
 $(document).ready(function(){
    $(document).on( "click", '.edit_button',function(e) {
        var code = $(this).data('code');
        var nom = $(this).data('nom');
        var adr = $(this).data('adr');
        var tel = $(this).data('tel');

        $(".client_code").val(code);
        $(".client_nom").val(nom);
        $(".client_adr").val(adr);
        $(".client_tel").val(tel);
        //tinyMCE.get('business_skill_content').setContent(content);
    });

    $('#editClient').on('submit', function () {
        event.preventDefault();
        //var count_data = 0;
        //alert($('#lib').val());
        var form_data = $(this).serialize();
        $.ajax({
            url: "../../controller/ClientController.php",
            method: "POST",
            data: form_data,
            success: function(data) {
                $('#editClient')[0].reset();
                $('#edok').click();
                //$('body').removeClass('modal-open');
                //$('.modal-backdrop').remove();
                document.getElementById('info').style.display = 'block';
                $('#info').html(data);
                window.setTimeout(function() {
                    $(".alert").fadeTo(700, 0).slideUp(700, function(){
                        $(this).remove();
                    });
                }, 2000);
            },
            error: function(data){
                console.log('ERREUR : ' + data);
            }
        });
    });

    $(document).on( "click", '.del_button',function(e) {
        var id = $(this).data('id');

        $(".del_id").val(id);
        });     
 });
</script>