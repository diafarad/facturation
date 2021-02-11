<?php

    function addFournisseur($nom,$adresse,$ville,$pays,$tel,$mail,$bp)
    {
        $sql = "INSERT INTO fournisseur VALUES (NULL, '$nom' , '$adresse', '$ville', '$pays', '$tel', '$mail', '$bp')";
        return executeSQL($sql);
    }

    function deleteFournisseur($id)
    {
        $sql = "DELETE FROM fournisseur WHERE id = $id";
        return executeSQL($sql);
    }

    function updateFournisseur($id,$nom,$adresse,$ville,$pays,$tel,$mail,$bp)
    {
        $sql = "UPDATE fournisseur SET nomComplet = '$nom',
                                                  adresse = '$adresse',
                                                  ville = '$ville',
                                                  pays = '$pays',
                                                  tel = '$tel',
                                                  mail = '$mail',
                                                  bp = '$bp'
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
        $sql = "SELECT * FROM fournisseur WHERE id= '$id'";
        return executeSQL($sql);
    }

?>
