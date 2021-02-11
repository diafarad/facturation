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

    function listeSortie()
    {
        $sql = "SELECT s.id, s.date, COUNT(DISTINCT(aso.article_id)) 
                FROM sortie s, article_sortie aso
                WHERE s.id=aso.sortie_id
                GROUP BY s.id,s.date";
        return executeSQL($sql);
    }

    function getSortieById($id)
    {
        $sql = "SELECT * FROM sortie WHERE id= '$id'";
        return executeSQL($sql);
    }

    function getAllInfosSortie()
    {
        $sql = "SELECT *
                FROM sortie s, article a, couleur c, article_sortie asr
                WHERE s.id=asr.sortie_id AND a.ref=asr.article_id AND c.id=asr.couleur_id";
        return executeSQL($sql);
    }

    function getAllArticlesSortieById($id)
    {
        $sql = "SELECT *
                            FROM sortie s, article a, article_sortie aso, couleur col
                            WHERE s.id=aso.sortie_id AND a.ref=aso.article_id AND col.id=aso.couleur_id AND s.id='$id'";
        return executeSQL($sql);
    }

?>
