<?php
include_once '../../public/web/menu.php';
include_once '../../model/DB.php';
include_once '../../model/BonDB.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Article</title>
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
        <div class="panel-heading" align="center"><h2>Mes bons</h2></div>
        <div class="panel-body">
            <button type="button" style="margin-bottom: 5px;" class="btn btn-primary" data-toggle="modal"
                    data-target="#exampleModal" data-whatever="@mdo">Ajouter
            </button>
            <table id="example" class="ui celled table" style="width:100%; margin-left: auto; ">
                <thead>
                <tr>
                    <th style='text-align:center;'>Numéro bon</th>
                    <th style='text-align:center;'>Date</th>
                    <th style='text-align:center;'>Fournisseur</th>
                    <th style="text-align: center">Action </th>
                    <th style="text-align: center">Action </th>
                </tr>
                </thead>
                <tbody>
                <?php
                $bons = listeBon();
                while($result=mysqli_fetch_row($bons))
                {
                    echo "
                    <tr>
                        <td style='text-align:center;'>$result[0]</td>
                        <td style='text-align:center;'>$result[1]</td>
                        <td style='text-align:center;'>$result[4]</td>
                        <td><center><a target='_blank' class='btn btn-info btn-xs' href='../../view/bon/detail.php?id=$result[0]'>Détails</a></center></td>
                        <td>
                        <center><button type='button' class='btn btn-warning btn-xs del_button' 
                        data-toggle='modal' data-target='#mydelModal'
                        data-id='$result[0]'>
                        Supprimer
                    </button>
                    </center></td>
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
                    <th style='text-align:center;'>Numéro bon</th>
                    <th style='text-align:center;'>Date</th>
                    <th style='text-align:center;'>Fournisseur</th>
                    <th style="text-align: center">Action </th>
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
                <h4 class="modal-title" id="exampleModalLabel" align="center">Bon de commande</h4>
                <button type="button" id="closemodal" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <div class="row">
                    <div class="col-xs-4" title="Ajout commande">
                    <div class="panel-heading" align="center"><h5><b>Fournisseur</b></h5></div>
                        <div class="form-group">
                            <label class="control-label">Fournisseur</label>
                            <select class='selectpicker show-menu-arrow form-control' type="text" name="idf" id="idf">
                                <option value="" > <?php echo "Sélectionner le fournisseur";?> </option>
                                <?php
                                include_once "../../model/DB.php";
                                include_once "../../model/FournisseurDB.php";
                                $list = listeFournisseur();
                                while($row = mysqli_fetch_row($list)){
                                    ?>
                                    <option value="<?php echo $row[0];?>"> <?php echo $row[1];?> </option>
                                <?php } ?>
                            </select>
                            <span id="err_idf" class="text-danger"></span>
                        </div>
                    <div class="panel-heading" align="center"><h5><b>Article</b></h5></div>
                        <div class="form-group">
                            <label class="control-label">Désignation</label>
                            <textarea class="form-control" type="text" name="des" id="des" placeholder="Entrer la désignation"></textarea>
                            <span id="err_des" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Quantité</label>
                            <input class="form-control" type="text" name="qte" id="qte" placeholder="Entrer la quantité"/>
                            <span id="err_qte" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Prix unitaire</label>
                            <input class="form-control" type="text" name="pu" id="pu" placeholder="Entrer la quantité"/>
                            <span id="err_pu" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <input class="btn btn-success" type="hidden" name="row_id" value="hidden_row_id"/>
                            <button class="btn btn-success" type="button" name="add" id="add">Ajouter</button>
                        </div>
                    </div>
                    <form method="post" target="_blank" id="list_articles" action="./bon.php">
                        <div class="col-xs-8" title="Liste commande">
                        <div class="panel-heading" align="center"><h5><b>Les articles</b></h5></div>
                            <table class="table table-bordered table-striped" id="lesarticles">
                                <thead>
                                <tr>
                                    <th>Désignation</th>
                                    <th>Quantité</th>
                                    <th>Prix Unitaire</th>
                                    <th>Prix Total</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <div id="action_alert"></div>
                            <div class="form-group">
                                <input class="btn btn-success" type="submit" name="commander" value="Valider" style="float:right;"/>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            </div>
        </div>
</div>

<div class="modal fade" id="mydelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Suppression bon de commande</h4>
            </div>
            <form method="post" action="../../controller/BonController.php">
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
    $(document).ready(function(){
        var count = 0;
        var nom = '';
        var adr = '';
        var tel = '';

        $('#add').click(function () {
            var err_idf = '';
            var err_des = '';
            var err_qte = '';
            var err_pu = '';
            var idf = '';
            var des = '';
            var qte = '';
            var pu = '';
            var puTotal = '';

            if($('#idf').val() == ''){
                err_idf = 'Sélectionner le fournisseur';
                $('#err_idf').text(err_idf);
                $('#idf').css('border-color', '#cc0000');
                idf = '';
            }else {
                err_idf = '';
                $('#err_idf').text(err_idf);
                $('#idf').css('border-color', '');
                idf = $('#idf').val();
            }
            if($('#des').val() == ''){
                err_des = 'Entrer la désignation';
                $('#err_des').text(err_des);
                $('#des').css('border-color', '#cc0000');
                des = '';
            }else {
                err_des = '';
                $('#err_des').text(err_des);
                $('#des').css('border-color', '');
                des = $('#des').val();
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
            if($('#pu').val() == ''){
                err_pu = 'Entrer le prix unitaire';
                $('#err_pu').text(err_pu);
                $('#pu').css('border-color', '#cc0000');
                pu = '';
            }else {
                err_pu = '';
                $('#err_pu').text(err_pu);
                $('#pu').css('border-color', '');
                pu = $('#pu').val();
            }
            if(err_idf != '' || err_des != '' || err_pu != '' || err_qte != ''){
                return false;
            }else {
                if($('#add').text() == 'Ajouter'){
                    puTotal = pu*qte;
                    count = count + 1;
                    output = '<tr id="row_'+count+'">';
                    output += '<input type="hidden" name="hidden_idf" id="idf'+count+'" value="'+idf+'"/></td>';
                    output += '<input type="hidden" name="hidden_nom" id="nom'+count+'" value="'+nom+'"/></td>';
                    output += '<input type="hidden" name="hidden_adr" id="adr'+count+'" value="'+adr+'"/></td>';
                    output += '<input type="hidden" name="hidden_tel" id="tel'+count+'" value="'+tel+'"/></td>';
                    output += '<td>'+des+' <input type="hidden" name="hidden_des[]" id="des'+count+'" class="des" value="'+des+'"/></td>';
                    output += '<td>'+qte+' <input type="hidden" name="hidden_qte[]" id="qte'+count+'" value="'+qte+'"/></td>';
                    output += '<td>'+pu+' <input type="hidden" name="hidden_pu[]" id="pu'+count+'" value="'+pu+'"/></td>';
                    output += '<td>'+puTotal+' <input type="hidden" name="hidden_puTotal[]" id="puTotal'+count+'" value="'+puTotal+'"/></td>';
                    output += '<td><center><button type="button" name="remove_details" class="btn btn-danger btn-xs remove_details" id="'+count+'">Supprimer</button></center></td>';
                    output += '</tr>';
                    $('#lesarticles').append(output);
                    $('#action_alert').html('');
                    $('#des').val('');
                    $('#qte').val('');
                    $('#pu').val('');
                }
            }
        });

        $('#idf').change(function(){
            var d = 'id='+$('#idf').val();
            $.ajax({
                type: "POST",
                url: "./fournisseur.php",
                dataType: "json",
                data: d,
                cache: false,
                success: function(data) {
                    nom = data[1];
                    adr = data[2];
                    tel = data[3];
                },
                error : function (e) {
                    alert(e);
                }
            });
        });

        $(document).on('click', '.remove_details', function () {
            var row_id = $(this).attr("id");
            if(confirm("Voulez-vous supprimer cet article de la commande?")){
                $('#row_'+row_id+'').remove();
            }else {
                return false;
            }
        });


        $(document).on( "click", '.del_button',function(e) {
        var id = $(this).data('id');

        $(".del_id").val(id);
        });
        
    });
</script>