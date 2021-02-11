<?php

require_once '../model/DB.php';
require_once '../model/UserDB.php';

    if(isset($_POST['valider']))
    {
        $ok = addUser($_POST['nomU'],$_POST['prenomU'],$_POST['loginU'],$_POST['passwordU']);
        header("location:..?page=user/liste&resultA=$ok");
    }

    if(isset($_POST['envoyer']))
    {
        $ok = updateUser($_POST['idU'],$_POST['nomU'],$_POST['prenomU'],$_POST['loginU'],$_POST['passwordU']);
        header("location:..?page=user/liste&resultE=$ok");
    }

    if(isset($_GET['idU']))
    {
        $ok = deleteUser($_GET['idU']);
        header("location:../view/user/liste.php?resultD=$ok");
    }

?>