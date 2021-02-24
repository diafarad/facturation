<?php

require_once '../model/DB.php';
require_once '../model/ClientDB.php';

    if(isset($_POST['valider']))
    {
        $ok = addClient($_POST['code'],$_POST['nom'],$_POST['adresse'],$_POST['tel']);
        header("location:../../view/client/liste.php?resultA=$ok");
    }

    if(isset($_POST['edit_code']) && isset($_POST['edit_nom']) && isset($_POST['edit_adr']) && isset($_POST['edit_tel']))
    {
        $ok = updateClient($_POST['edit_code'],$_POST['edit_nom'],$_POST['edit_adr'],$_POST['edit_tel']);
        if ($ok == 1)
            echo "<div class='alert alert-success'><center>Donnée(s) modifiée(s) avec succès.</center></div>";
        else
            echo "<div class='alert alert-danger'><center>Une petite erreur est survenue.</br>Réessayer plutard.</center></div>";
    }

    if(isset($_POST['supprimer']))
    {
        $ok = deleteClient($_POST['id']);
        if($ok == 1){
            header("location:../view/client/liste.php?resultD=$ok");
        }
        else{
            echo 'Une petite erreur est survenue';
        }
    }

?>
