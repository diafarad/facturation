<?php

require_once '../model/DB.php';
require_once '../model/ClientDB.php';

    if(isset($_POST['valider']))
    {
        $ok = addClient($_POST['code'],$_POST['nom'],$_POST['adresse'],$_POST['tel']);
        header("location:../../view/client/liste.php?resultA=$ok");
    }

    if(isset($_POST['envoyer']))
    {
        $ok = updateClient($_POST['code'],$_POST['nom'],$_POST['adresse'],$_POST['tel']);
        header("location:../../view/client/liste.php?resultE=$ok");
    }

    if(isset($_GET['code']))
    {
        $ok = deleteClient($_GET['code']);
        header("location:../../view/client/liste.php?resultD=$ok");
    }

?>
