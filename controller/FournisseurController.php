<?php

require_once '../model/DB.php';
require_once '../model/FournisseurDB.php';

    if(isset($_POST['valider']))
    {
        $ok = addFournisseur($_POST['nom'],$_POST['adresse'],$_POST['ville'],$_POST['pays'],$_POST['tel'],$_POST['mail'],$_POST['bp']);
        header("location:..?page=fournisseur/liste&resultA=$ok");
    }

    if(isset($_POST['envoyer']))
    {
        $ok = updateFournisseur($_POST['idF'],$_POST['nomF'],$_POST['adresseF'],$_POST['villeF'],$_POST['paysF'],$_POST['telF'],$_POST['mailF'],$_POST['bpF']);
        header("location:..?page=user/liste&resultE=$ok");
    }

    if(isset($_GET['idF']))
    {
        $ok = deleteFournisseur($_GET['idF']);
        header("location:../view/user/liste.php?resultD=$ok");
    }

?>
