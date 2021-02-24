<?php
    function addBordereau($num,$date,$numfac,$code)
    {
        $sql = "INSERT INTO bordereau VALUES ('$num', '$date' , '$numfac', '$code')";
        return executeSQL($sql);
    }

    function addArticleBordereau($numB,$des,$qte)
    {
        $sql = "INSERT INTO article_bordereau VALUES ('$numB' , '$des', '$qte')";
        return executeSQL($sql);
    }

    function deleteBordereau($num)
    {
        $sql = "DELETE FROM bordereau WHERE num = '$num'";
        return executeSQL($sql);
    }

    function updateBordereau($num,$date,$numfac,$code)
    {
        $sql = "UPDATE bordereau SET date = '$date',
                                    numFac = '$numfac',
                                    codeC = '$code'
                                    WHERE num = '$num'";
        return executeSQL($sql);
    }

    function listeBordereau()
    {
        $sql = "SELECT * FROM bordereau b, facture f, client c where b.numFac=f.num AND c.code=b.codeC";
        return executeSQL($sql);
    }

    function getBordereauByNum($num)
    {
        $sql = "SELECT * FROM bordereau b, facture f, client c where b.numFac=f.num AND c.code=b.codeC AND b.num='$num'";
        return executeSQL($sql);
    }

    function getAllArticlesBordereauBNum($num)
    {
        $sql = "SELECT *
                    FROM bordereau b, article_bordereau ab
                    WHERE b.num=ab.numB AND b.num='$num'";
        return executeSQL($sql);
    }

?>
