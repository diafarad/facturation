<?php
require_once '../model/DB.php';
require_once '../model/BordereauDB.php';

if(isset($_POST['supprimer']))
{
    $ok = deleteBordereau($_POST['id']);
    if($ok == 1){
        header("location:../view/bordereau/index.php");
    }
    else{
        echo 'Une petite erreur est survenue';
    }
}