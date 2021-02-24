<?php
require_once "../../model/DB.php";
require_once "../../model/FournisseurDB.php";

    if(isset($_POST['id'])){
        extract($_POST);
        $id = $_POST['id'];
        $json = array();
        $four = getFournisseurById($id);
        $four = mysqli_fetch_row($four);
        $json = array($four[0],$four[1],$four[2],$four[3]);
        echo json_encode($json);
    }

?>