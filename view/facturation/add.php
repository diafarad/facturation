<?php
include_once '../../public/web/menu.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Commande</title>
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

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="width:1005px;">
        <div class="modal-content" >
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel" align="center">Nouveau commande</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               <div class="row">
                    <div class="col-xs-4" title="Ajout commande">
                    <div class="panel-heading" align="center"><h5><b>Client</b></h5></div>
                        <div class="form-group">
                            <label class="control-label">Code Client</label>
                            <input class="form-control" type="text" name="code" id="code" placeholder="Entrer le code client"/>
                            <span id="err_code" class="text-danger"></span>
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
                    <form method="post" id="list_articles" action="./facture.php">
                        <div class="col-xs-8" title="Liste commande">
                        <div class="panel-heading" align="center"><h5><b>Les articles</b></h5></div>
                            <table class="table table-bordered table-striped" id="lesarticles">
                                <thead>
                                <tr>
                                    <th>Désignation</th>
                                    <th>Quantité</th>
                                    <th>PU HTVA</th>
                                    <th>Prix Total HTVA</th>
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
</body>
</html>

<script>
    $(document).ready(function(){
        var count = 0;

        $('#add').click(function () {
            var err_code = '';
            var err_des = '';
            var err_qte = '';
            var err_pu = '';
            var code = '';
            var des = '';
            var qte = '';
            var pu = '';
            var puTotal = '';

            if($('#code').val() == ''){
                err_code = 'Entrer le code du client';
                $('#err_code').text(err_code);
                $('#code').css('border-color', '#cc0000');
                code = '';
            }else {
                err_code = '';
                $('#err_code').text(err_code);
                $('#code').css('border-color', '');
                code = $('#code').val();
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
            if(err_code != '' || err_des != '' || err_pu != '' || err_qte != ''){
                return false;
            }else {
                if($('#add').text() == 'Ajouter'){
                    puTotal = pu*qte;
                    count = count + 1;
                    output = '<tr id="row_'+count+'">';
                    output += '<input type="hidden" name="codeClient" id="codeClient" value="'+code+'"/></td>';
                    output += '<input type="hidden" name="hidden_code[]" id="code'+count+'" value="'+code+'"/></td>';
                    output += '<td>'+des+' <input type="hidden" name="hidden_des[]" id="des'+count+'" class="des" value="'+des+'"/></td>';
                    output += '<td>'+qte+' <input type="hidden" name="hidden_qte[]" id="qte'+count+'" value="'+qte+'"/></td>';
                    output += '<td>'+pu+' <input type="hidden" name="hidden_pu[]" id="pu'+count+'" value="'+pu+'"/></td>';
                    output += '<td>'+puTotal+' <input type="hidden" name="hidden_puTotal[]" id="puTotal'+count+'" value="'+puTotal+'"/></td>';
                    output += '<td><center><button type="button" name="remove_details" class="btn btn-danger btn-xs remove_details" id="'+count+'">Supprimer</button></center></td>';
                    output += '</tr>';
                    designation = '';
                    libelle = '';
                    $('#lesarticles').append(output);
                    $('#action_alert').html('');
                    $('#des').val('');
                    $('#qte').val('');
                    $('#pu').val('');
                }
            }
        });

        $(document).on('click', '.remove_details', function () {
            var row_id = $(this).attr("id");
            if(confirm("Voulez-vous supprimer cet article de la commande?")){
                $('#row_'+row_id+'').remove();
            }else {
                return false;
            }
        });

        
    });
</script>
