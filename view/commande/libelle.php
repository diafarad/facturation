<?php

require_once "../../public/web/rooting.php";
require_once "../../model/DB.php";
require_once "../../model/ArticleDB.php";
require_once "../../model/CouleurDB.php";

    if(isset($_POST['ref'])){
        extract($_POST);
        $ref = $_POST['ref'];
        $des = getDesignationArticleByRef($ref);
        $des = mysqli_fetch_row($des);
        echo ''.$des[0];
    }

    if(isset($_POST['id'])){
        extract($_POST);
        $id = $_POST['id'];
        $lib = getLibelleCouleurById($id);
        $lib = mysqli_fetch_row($lib);
        echo ''.$lib[0];
    }

?>