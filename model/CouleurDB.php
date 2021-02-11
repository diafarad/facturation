<?php

    function addCouleur($libelle)
    {
        $sql = "INSERT INTO couleur VALUES (NULL, '$libelle')";
        return executeSQL($sql);
    }

    function deleteCouleur($id)
    {
        $sql = "DELETE FROM couleur WHERE id = $id";
        return executeSQL($sql);
    }

    function updateCouleur($id,$libelle)
    {
        $sql = "UPDATE couleur SET libelle = '$libelle' WHERE id = $id";
        return executeSQL($sql);
    }

    function listeCouleur()
    {
        $sql = "SELECT * FROM couleur";
        return executeSQL($sql);
    }

    function getCouleurById($id)
    {
        $sql = "SELECT * FROM couleur WHERE id= $id";
        return executeSQL($sql);
    }

    function getLibelleCouleurById($id)
    {
        $sql = "SELECT libelle FROM couleur WHERE id= $id";
        return executeSQL($sql);
    }

?>
