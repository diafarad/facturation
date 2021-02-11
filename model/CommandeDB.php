<?php

    /*function addCommande()
    {
        date_default_timezone_set("Africa/Dakar");
        $sql = "INSERT INTO commande VALUES (NULL, date("d:m:Y h:i") , 0, 0, 'ouverte')";
        return executeSQL($sql);
    }*/

    function deleteCommande($num)
    {
        $sql = "DELETE FROM commande WHERE numero = $num";
        return executeSQL($sql);
    }

    function updateCommande($num,$date,$controle,$restant,$etat)
    {
        $sql = "UPDATE commande SET date = '$date',
                                          controle = '$controle',
                                          restant = '$restant',
                                          $etat = '$etat'
                                          WHERE numero = $num";
        return executeSQL($sql);
    }

    function updateEtatCommande($num,$etat)
    {
        $sql = "UPDATE commande SET $etat = '$etat' WHERE numero = $num";
        return executeSQL($sql);
    }

    function listeCommande()
    {
        $sql = "SELECT * FROM commande";
        return executeSQL($sql);
    }

    function getCommandeByNumero($num)
    {
        $sql = "SELECT * FROM commande WHERE numero= '$num'";
        return executeSQL($sql);
    }

    function getInfosAllCommandes()
    {
        $sql = "SELECT *
                FROM commande c, article a, article_commande ac, couleur col
                WHERE c.numero=ac.numCom AND ac.articlecom=a.ref AND ac.couleurcom=col.id";
        return executeSQL($sql);
    }

    function getAllArticlesCommandeByNum($num)
    {
        $sql = "SELECT *
                    FROM commande c, article a, article_commande ac, couleur col
                    WHERE c.numero=ac.numCom AND ac.articlecom=a.ref AND ac.couleurcom=col.id AND c.numero='$num'";
        return executeSQL($sql);
    }

    function getFournisseurByNumCommande($num){
        $sql = "SELECT *
                    FROM fournisseur f, commande c
                    WHERE f.id=c.fournisseur_id AND c.numero='$num'";
        return executeSQL($sql);
    }

?>
