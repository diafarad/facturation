<?php

    function addClient($code,$nom,$adresse,$tel)
    {
        $sql = "INSERT INTO client VALUES ('$code', '$nom' , '$adresse', '$tel')";
        return executeSQL($sql);
    }

    function deleteClient($code)
    {
        $sql = "DELETE FROM client WHERE code = '$code'";
        return executeSQL($sql);
    }

    function updateClient($code,$nom,$adresse,$tel)
    {
        $sql = "UPDATE client SET nomComplet = '$nom',
                                    adresse = '$adresse',
                                    tel = '$tel'
                                    WHERE code = '$code'";
        return executeSQL($sql);
    }

    function listeClient()
    {
        $sql = "SELECT * FROM client";
        return executeSQL($sql);
    }

    function getClientByCode($code)
    {
        $sql = "SELECT * FROM client WHERE code= '$code'";
        return executeSQL($sql);
    }

?>
