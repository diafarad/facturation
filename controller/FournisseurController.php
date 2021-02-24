<?php

require_once '../model/DB.php';
require_once '../model/FournisseurDB.php';

    if(isset($_POST['valider']))
    {
        $ok = addFournisseur($_POST['nom'],$_POST['adresse'],$_POST['tel']);
        header("location:../../view/fournisseur/liste.php?resultA=$ok");
    }

    if(isset($_POST['edit_id']) && isset($_POST['edit_nom']) && isset($_POST['edit_adr']) && isset($_POST['edit_tel']))
    {
        $ok = updateFournisseur($_POST['edit_id'],$_POST['edit_nom'],$_POST['edit_adr'],$_POST['edit_tel']);
        if ($ok == 1)
            echo "<div class='alert alert-success'><center>Donnée(s) modifiée(s) avec succès.</center></div>";
        else
            echo "<div class='alert alert-danger'><center>Une petite erreur est survenue.</br>Réessayer plutard.</center></div>";
    }

    if(isset($_POST['supprimer']))
    {
        $ok = deleteFournisseur($_POST['id']);
        if($ok == 1){
            header("location:../view/fournisseur/liste.php?resultD=$ok");
        }
        else{
            echo 'Une petite erreur est survenue';
        }
    }

?>
