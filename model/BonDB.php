<?php
    function addBon($date,$idf)
    {
        $sql = "INSERT INTO bon VALUES (NULL, '$date' , '$idf')";
        return executeSQL($sql);
    }

    function addArticleCommande($idB,$des,$qte,$pu)
    {
        $sql = "INSERT INTO article_commande VALUES ('$idB' , '$des', '$qte', '$pu')";
        return executeSQL($sql);
    }

    function deleteBon($idB)
    {
        $sql = "DELETE FROM bon WHERE id = '$idB'";
        return executeSQL($sql);
    }

    function updateBon($id,$date,$idF)
    {
        $sql = "UPDATE bon SET date = '$date',
                                    idf = '$idF'
                                    WHERE id = '$id'";
        return executeSQL($sql);
    }

    function listeBon()
    {
        $sql = "SELECT * FROM bon b, fournisseur f where b.idf=f.id";
        return executeSQL($sql);
    }

    function getBonById($id)
    {
        $sql = "SELECT * FROM bon b, fournisseur f where b.idf=f.id AND b.id='$id'";
        return executeSQL($sql);
    }

    function getAllArticlesBonById($id)
    {
        $sql = "SELECT *
                    FROM bon b, article_commande ac
                    WHERE b.id=ac.idB AND b.id='$id'";
        return executeSQL($sql);
    }

?>
