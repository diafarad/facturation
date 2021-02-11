<?php

include_once '../model/DB.php';
include_once '../model/UserRoleDB.php';

    if(isset($_POST['valider']))
    {
        $ok = addUserRole($_POST['idU'],$_POST['idR'],$_POST['etat']);
        header("location:..?page=user/liste&resultAR=$ok");

        if(isset($_POST['role']))
        {
            $search = getRoleById($_POST['role']);
            $rol = $_POST['role'];
            header("location:../view/user_roles.php?resultSearch=$rol");
        }
    }

    if(isset($_POST['envoyer']))
    {
        $ok = updateRole($_POST['idR'],$_POST['libR']);
        header("location:..?page=role/liste&resultE=$ok");
    }

    if(isset($_GET['idU']))
    {
        $ok = deleteRole($_GET['idR']);
        header("location:../view/role/liste.php?resultD=$ok");
    }

    if(isset($_GET['idU']) && isset($_GET['idR']))
    {
        $ok = deleteUserRole($_GET['idU'],$_GET['idR']);
        header("location:..?page=userRole/liste&resultD=$ok");
    }

    if(isset($_POST['soumettre']))
    {
        if(isset($_POST['idU']) && isset($_POST['idR']))
        {
            if(isset($_POST['valEtat']))
            {
                if($_POST['valEtat'] == 1)
                {
                    $ok = updateUserRole($_POST['idU'],$_POST['idR'],0);
                    header("location:..?page=user/liste&resultUR=$ok");
                }
                else
                {
                    $ok = addUserRole($_POST['idU'],$_POST['idR'],1);
                    header("location:..?page=user/liste&resultAR=$ok");
                }
            }
        }
    }

?>