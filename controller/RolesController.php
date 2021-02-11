<?php

include_once '../model/DB.php';
include_once '../model/RolesDB.php';

    if(isset($_POST['valider']))
    {
        $ok = addRole($_POST['libR']);
        header("location:..?page=role/liste&resultA=$ok");
    }

    if(isset($_POST['envoyer']))
    {
        $ok = updateRole($_POST['idR'],$_POST['libR']);
        header("location:..?page=role/liste&resultE=$ok");
    }

    if(isset($_GET['idR']))
    {
        $ok = deleteRole($_GET['idR']);
        header("location:..?page=role/liste&resultD=$ok");
    }

?>