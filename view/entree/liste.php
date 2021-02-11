<?php
include_once '../../public/web/menu.php';
include_once '../../model/DB.php';
include_once '../../model/EntreeDB.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Liste</title>
    <link type="text/css" rel="stylesheet" href="../../public/css/bootstrap.min.css"/>
    <link type="text/css" rel="stylesheet" href="../../public/Semantic-UI-CSS-master/semantic.min.css"/>
    <link type="text/css" rel="stylesheet" href="../../public/DataTables/DataTables-1.10.20/css/dataTables.semanticui.min.css"/>
    <link type="text/css" rel="stylesheet" href="../../public/css/jquery-ui.css"/>

    <script src="../../public/js/jquery-3.3.1.js"></script>
    <script src="../../public/DataTables/DataTables-1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="../../public/DataTables/DataTables-1.10.20/js/dataTables.semanticui.min.js"></script>
    <script src="../../public/Semantic-UI-CSS-master/semantic.min.js"></script>
    <script src="../../public/js/jquery-ui.js"></script>


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

<div class="container" style="margin-top: 90px; ">
    <div class="panel panel-info ">
        <div class="panel-heading" align="center">Mes Entrées</div>
        <div class="panel-body">
            <button type="button" style="margin-bottom: 5px;" id="addnewent" class="btn btn-primary" data-toggle="modal"
                    data-target="#exampleModal" data-whatever="@mdo">Ajouter
            </button>
            <table class="ui celled table" id="example" style="width:100%; margin-left: auto;" >
                <thead>
                <tr>
                    <th style="text-align: center">Numéro entrée</th>
                    <th style="text-align: center">Date</th>
                    <th style="text-align: center">N° Facture</th>
                    <th style="text-align: center">N° commande</th>
                    <th style="text-align: center">Action </th>
                </tr>
                </thead>
                <tbody>
                <?php
                $infosEntrees = listeEntree();
                while($result=mysqli_fetch_row($infosEntrees))
                {
                    $nument = str_pad($result[0], 5, "0", STR_PAD_LEFT);
                    $numfact = str_pad($result[3], 5, "0", STR_PAD_LEFT);
                    echo "
                    <tr>
                        <td style='text-align: center'>$nument</td>
                        <td style='text-align: center'>$result[1]</td>
                        <td style='text-align: center'>$result[2]</td>
                        <td style='text-align: center'>$numfact</td>
                        <td><center><a class='btn btn-info btn-xs' href='../../view/entree/detail.php?num=$result[0]'>Détail</a></center></td>
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
                    <th style="text-align: center">Numéro entrée</th>
                    <th style="text-align: center">Date</th>
                    <th style="text-align: center">N° Facture</th>
                    <th style="text-align: center">N° commande</th>
                    <th style="text-align: center">Action </th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="width:1005px;">
        <div class="modal-content" >
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel" align="center">Nouvelle entrée</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-4" title="Nouvelle entrée">
                        <div class="panel-heading" align="center"><h5><b>Entrée</b></h5></div>
                        <div class="form-group">
                            <label class="control-label">Numéro facture</label>
                            <input class="form-control" type="text" name="numfac" id="numfac" placeholder="Entrer le numéro de la facture"/>
                            <span id="err_numfac" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Numéro commande</label>
                            <select class='selectpicker show-menu-arrow form-control' type="text" name="numcom" id="numcom">
                                <option value="" > <?php echo "Sélectionner la commande";?> </option>
                                <?php
                                include_once "../../model/DB.php";
                                include_once "../../model/CommandeDB.php";
                                $list = listeCommande();
                                while($row = mysqli_fetch_row($list)){
                                    ?>
                                    <option value="<?php echo $row[0];?>"> <?php echo str_pad($row[0], 5, "0", STR_PAD_LEFT);?> </option>
                                <?php } ?>
                            </select>
                            <span id="err_numcom" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Article</label>
                            <select class='selectpicker show-menu-arrow form-control' type="text" name="article" id="article">
                                <option value="" > <?php echo "Choisir l'article";?> </option>
                                <?php
                                include_once "../../model/DB.php";
                                include_once "../../model/ArticleDB.php";
                                $list = listeArticle();
                                while($row = mysqli_fetch_row($list)){
                                    ?>
                                    <option value="<?php echo $row[0];?>"> <?php echo $row[0].' '.$row[1];?> </option>
                                <?php } ?>
                            </select>
                            <span id="err_article" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Couleur</label>
                            <select class='selectpicker show-menu-arrow form-control' type="text" name="couleur" id="couleur">
                                <option value="" > <?php echo "Choisir la couleur";?> </option>
                                <?php
                                include_once "../../model/DB.php";
                                include_once "../../model/CouleurDB.php";
                                $list = listeCouleur();
                                while($row = mysqli_fetch_row($list)){
                                    ?>
                                    <option value="<?php echo $row[0];?>"> <?php echo $row[1];?> </option>
                                <?php } ?>
                            </select>
                            <span id="err_couleur" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Quantité</label>
                            <input class="form-control" type="text" name="qte" id="qte" placeholder="Entrer la quantité"/>
                            <span id="err_qte" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <input class="btn btn-success" type="hidden" name="row_id" value="hidden_row_id"/>
                            <button class="btn btn-success" type="button" name="add" id="add">Ajouter</button>
                        </div>
                    </div>
                    <form method="post" id="list_articles">
                        <div class="col-xs-8" title="Liste entrées">
                            <div class="panel-heading" align="center"><h5><b>Article(s) sélectionné(s)</b></h5></div>
                            <table class="table table-bordered table-striped" id="lesarticles">
                                <thead>
                                <tr>
                                    <th>Référence</th>
                                    <th>Désignation</th>
                                    <th>Couleur</th>
                                    <th>Quantité</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <div id="action_alert"></div>
                            <div class="form-group">
                                <input class="btn btn-success" type="submit" name="enregistrer" value="Enregistrer" style="float:right;"/>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

<script>
    $(document).ready(function(){
        var count = 0;

        $('#addnewent').click(function () {
            $('#numfac').val('');
            $('#numcom').val('');
            $('#article').val('');
            $('#couleur').val('');
            $('#qte').val('');
            $('#err_numfac').text('');
            $('#err_numcom').text('');
            $('#err_article').text('');
            $('#err_couleur').text('');
            $('#err_qte').text('');
            $('#numfac').css('border-color', '');
            $('#numcom').css('border-color', '');
            $('#article').css('border-color', '');
            $('#couleur').css('border-color', '');
            $('#qte').css('border-color', '');
            $('#add').text('Ajouter');
        });

        var numfac = '';
        var numcom = '';

        $('#add').click(function () {
            var err_numfac = '';
            var err_numcom = '';
            var err_article = '';
            var err_couleur = '';
            var err_qte = '';
            var article = '';
            var couleur = '';
            var qte = '';
            var designation = '';
            var libelle = '';

            if($('#numfac').val() == ''){
                err_numfac = 'Entrer le numéro de la facture';
                $('#err_numfac').text(err_numfac);
                $('#numfac').css('border-color', '#cc0000');
                numfac = '';
            }else {
                err_numfac = '';
                $('#err_numfac').text(err_numfac);
                $('#numfac').css('border-color', '');
                numfac = $('#numfac').val();
            }
            if($('#numcom').val() == ''){
                err_numcom = 'Sélectionner une commande';
                $('#err_numcom').text(err_numcom);
                $('#numcom').css('border-color', '#cc0000');
                numcom = '';
            }else {
                err_numcom = '';
                $('#err_numcom').text(err_numcom);
                $('#numcom').css('border-color', '');
                numcom = $('#numcom').val();
            }
            if($('#article').val() == ''){
                err_article = 'Choisir un article';
                $('#err_article').text(err_article);
                $('#article').css('border-color', '#cc0000');
                article = '';
            }else {
                err_article = '';
                $('#err_article').text(err_article);
                $('#article').css('border-color', '');
                article = $('#article').val();
                var d = 'ref='+article;
                $.ajax({
                    type: "POST",
                    url: "../../view/commande/libelle.php",
                    dataType: "text",
                    data: d,
                    cache: false,
                    success: function(data) {
                        designation = data;
                        desc = '<td>'+designation+' <input type="hidden" name="hidden_designation[]" id="designation'+count+'" value="'+designation+'"/></td>';
                        $('#des'+count).append(desc);
                    },
                    error : function (e) {
                        alert(e);
                    }
                });
            }
            if($('#couleur').val() == ''){
                err_couleur = 'Choisir une couleur';
                $('#err_couleur').text(err_couleur);
                $('#couleur').css('border-color', '#cc0000');
                couleur = '';
            }else {
                err_couleur = '';
                $('#err_couleur').text(err_couleur);
                $('#couleur').css('border-color', '');
                couleur = $('#couleur').val();
                var l = 'id='+couleur;
                $.ajax({
                    type: "POST",
                    url: "../../view/commande/libelle.php",
                    dataType: "text",
                    data: l,
                    cache: false,
                    success: function(data) {
                        libelle = data;
                        lib = '<td>'+libelle+' <input type="hidden" name="hidden_libelle[]" id="libelle'+count+'" value="'+libelle+'"/></td>';
                        $('#lib'+count).append(lib);
                    },
                    error : function (e) {
                        alert(e);
                    }
                });
            }
            if($('#qte').val() == ''){
                err_qte = 'Entrer la quantité';
                $('#err_qte').text(err_qte);
                $('#qte').css('border-color', '#cc0000');
                qte = '';
            }else {
                err_qte = '';
                $('#err_qte').text(err_qte);
                $('#qte').css('border-color', '');
                qte = $('#qte').val();
            }
            if(err_article != '' || err_couleur != '' || err_qte != ''){
                return false;
            }else {
                if($('#add').text() == 'Ajouter'){
                    count = count + 1;
                    output = '<tr id="row_'+count+'">';
                    output += '<input type="hidden" name="hidden_numfac[]" id="numfac'+count+'" value="'+numfac+'"/></td>';
                    output += '<input type="hidden" name="hidden_numcom[]" id="numcom'+count+'" value="'+numcom+'"/></td>';
                    output += '<td>'+article+' <input type="hidden" name="hidden_article[]" id="article'+count+'" class="article" value="'+article+'"/></td>';
                    output += '<td id="des'+count+'">'+designation+' <input type="hidden" name="hidden_designation[]" id="designation'+count+'" value="'+designation+'"/></td>';
                    output += '<td id="lib'+count+'">'+libelle+' <input type="hidden" name="hidden_couleur[]" id="couleur'+count+'" value="'+couleur+'"/></td>';
                    output += '<td>'+qte+' <input type="hidden" name="hidden_qte[]" id="qte'+count+'" value="'+qte+'"/></td>';
                    output += '<td><center><button type="button" name="remove_details" class="btn btn-danger btn-xs remove_details" id="'+count+'">Supprimer</button></center></td>';
                    output += '</tr>';
                    designation = '';
                    libelle = '';
                    $('#lesarticles').append(output);
                    $('#action_alert').html('');
                }
            }
        });

        $(document).on('click', '.remove_details', function () {
            var row_id = $(this).attr("id");
            if(confirm("Voulez-vous supprimer cet article?")){
                $('#row_'+row_id+'').remove();
            }else {
                return false;
            }
        });

        $('#list_articles').on('submit', function () {
            event.preventDefault();
            var count_data = 0;
            $('.article').each(function () {
                count_data = count_data + 1;
            });
            if(count_data > 0){
                var form_data = $(this).serialize();
                $.ajax({
                    url: "../../controller/EntreeController.php",
                    method: "POST",
                    data: form_data,
                    success: function(data) {
                        $('#lesarticles').find("tr:gt(0)").remove();
                        $('#action_alert').html('<center><p style="color: green">Commande effectuée avec succes</p></center>');
                        $('#action_alert').dialog('open');
                    }
                });
            }else {
                $('#action_alert').html('<center><p style="color: orange">Ajouter un article au minimum</p></center>');
                $('#action_alert').dialog('open');
            }
        });
    });
</script>
