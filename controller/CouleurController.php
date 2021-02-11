<?php

require_once '../model/DB.php';
require_once '../model/CouleurDB.php';

    if(isset($_POST['valider']))
    {
        $ok = addCouleur($_POST['lib']);
        header("location:../../view/couleur/liste.php?resultA=$ok");
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
