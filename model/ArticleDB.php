<?php
    function addArticle($ref,$des,$prixU,$stockmin)
    {
        $sql = "INSERT INTO article VALUES ('$ref' , '$des', '$prixU', '$stockmin',0)";
        return executeSQL($sql);
    }

    function deleteArticle($ref)
    {
        $sql = "DELETE FROM article WHERE ref = $ref";
        return executeSQL($sql);
    }

    function updateArticle($ref,$des,$prixU,$stockmin,$stocktotal)
    {
        $sql = "UPDATE article SET designation = '$des',
                                                  prixU = '$prixU',
                                                  stockmin = '$stockmin',
                                                  stocktotal = '$stocktotal'
                                                  WHERE ref = '$ref'";
        return executeSQL($sql);
    }

    function listeArticle()
    {
        $sql = "SELECT * FROM article";
        return executeSQL($sql);
    }

    function getArticleByRef($ref)
    {
        $sql = "SELECT * FROM article WHERE ref= '$ref'";
        return executeSQL($sql);
    }

    function getDesignationArticleByRef($ref)
    {
        $sql = "SELECT designation FROM article WHERE ref= '$ref'";
        return executeSQL($sql);
    }

    function getCouleurArticleByRef($ref)
    {
        $sql = "SELECT * FROM article a, couleur c, article_couleur ac WHERE a.ref=ac.article_id AND c.id=ac.couleur_id AND a.ref='$ref'";
        return executeSQL($sql);
    }

?>
