<?php

    function addFournisseur($nom,$adresse,$tel)
    {
        $sql = "INSERT INTO fournisseur VALUES (NULL, '$nom' , '$adresse', '$tel')";
        return executeSQL($sql);
    }

    function deleteFournisseur($id)
    {
        $sql = "DELETE FROM fournisseur WHERE id = '$id'";
        return executeSQL($sql);
    }

    function updateFournisseur($id,$nom,$adresse,$tel)
    {
        $sql = "UPDATE fournisseur SET nomComplet = '$nom',
                                                  adresse = '$adresse',
                                                  tel = '$tel'
                                                  WHERE id = '$id'";
        return executeSQL($sql);
    }

    function listeFournisseur()
    {
        $sql = "SELECT * FROM fournisseur";
        return executeSQL($sql);
    }

    function getFournisseurById($id)
    {
        $sql = "SELECT * FROM fournisseur WHERE id='$id'";
        return executeSQL($sql);
    }

?>
