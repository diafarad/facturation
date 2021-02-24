<?php
require_once "../../model/DB.php";
require_once "../../model/FactureDB.php";

    if(isset($_POST['num'])){
        extract($_POST);
        $num = $_POST['num'];
        $json = array();
        $fac = getFactureByNum($num);
        $fac = mysqli_fetch_row($fac);
        $json = array($fac[0],$fac[1],$fac[2],$fac[3]);
        echo json_encode($json);
    }

?>