<?php

    /*function addEntree($ref,$des,$prixU,$stockmin)
    {
        $sql = "INSERT INTO article VALUES ('$ref' , '$des', '$prixU', '$stockmin')";
        return executeSQL($sql);
    }

    function deleteArticle($ref)
    {
        $sql = "DELETE FROM article WHERE ref = $ref";
        return executeSQL($sql);
    }

    function updateArticle($ref,$des,$prixU,$stockmin)
    {
        $sql = "UPDATE article SET designation = '$des',
                                                  prixU = '$prixU',
                                                  stock_min = '$stockmin',
                                                  passwordU = '$passwordU'
                                                  WHERE ref = $ref";
        return executeSQL($sql);
    }*/

    function listeEntree()
    {
        $sql = "SELECT * FROM entree";
        return executeSQL($sql);
    }

    function getEntreeById($id)
    {
        $sql = "SELECT * FROM entree WHERE id= '$id'";
        return executeSQL($sql);
    }

    function getAllInfosEntree()
    {
        $sql = "SELECT *
                FROM entree e, article a, couleur c, article_entree ae, commande com
                WHERE e.id=ae.entree_id AND a.ref=ae.article_id AND c.id=ae.couleur_id AND com.numero=e.numCom";
        return executeSQL($sql);
    }

    function getAllArticlesEntreeById($id)
    {
        $sql = "SELECT *
                        FROM entree e, article a, article_entree ae, couleur col
                        WHERE e.id=ae.entree_id AND a.ref=ae.article_id AND col.id=ae.couleur_id AND e.id='$id'";
        return executeSQL($sql);
    }

?>
