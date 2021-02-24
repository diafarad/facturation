<?php
    function addFacture($num,$date,$montant,$code,$tva)
    {
        $sql = "INSERT INTO facture VALUES ('$num' , '$date', '$montant', '$code','$tva')";
        return executeSQL($sql);
    }

    function addArticleFacture($num,$des,$qu,$montant)
    {
        $sql = "INSERT INTO article_facture VALUES ('$num' , '$des', '$qu', '$montant')";
        return executeSQL($sql);
    }

    function deleteFacture($num)
    {
        $sql = "DELETE FROM facture WHERE num = '$num'";
        return executeSQL($sql);
    }

    function updateFacture($num,$date,$montant,$code)
    {
        $sql = "UPDATE article SET date = '$date',
                                                  montant = '$montant',
                                                  code = '$code'
                                                  WHERE ref = '$num'";
        return executeSQL($sql);
    }

    function listeFacture()
    {
        $sql = "SELECT * FROM facture";
        return executeSQL($sql);
    }

    function getFactureByNum($num)
    {
        $sql = "SELECT * FROM facture WHERE num='$num'";
        return executeSQL($sql);
    }

    function getAllArticlesFactureByNum($num)
    {
        $sql = "SELECT *
                    FROM facture f, article_facture af
                    WHERE f.num=af.numFac AND f.num='$num'";
        return executeSQL($sql);
    }

?>
