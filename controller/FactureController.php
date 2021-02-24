<?php
require_once '../model/DB.php';
require_once '../model/FactureDB.php';

if(isset($_POST['supprimer']))
{
    $ok = deleteFacture($_POST['id']);
    if($ok == 1){
        header("location:../view/facturation/index.php");
    }
    else{
        echo 'Une petite erreur est survenue';
    }
}