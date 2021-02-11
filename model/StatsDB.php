<?php
/**
 * Created by PhpStorm.
 * User: diafara
 * Date: 31/03/2020
 * Time: 23:35
 */

    function getValeurStock()
    {
        $sql = "SELECT SUM(prixU*stocktotal) FROM article ";
        return executeSQL($sql);
    }

    function getNbArticleEnCommande()
    {
        $sql = "SELECT COUNT(articlecom) FROM article_commande WHERE restant>0";
        return executeSQL($sql);
    }

    function getNbArticleCritique()
    {
        $sql = "SELECT COUNT(ref) FROM article WHERE stockmin>stocktotal";
        return executeSQL($sql);
    }

    function getNbArticle()
    {
        $sql = "SELECT COUNT(ref) FROM article";
        return executeSQL($sql);
    }

    function getVolumeStock()
    {
        $sql = "SELECT SUM(stocktotal) FROM article";
        return executeSQL($sql);
    }

    function getArticlePlusVendu()
    {
        $sql = "SELECT a.designation, aso.somme
                FROM article a, article_sortie aso, (SELECT article_id, MAX(somme) as mymax FROM article_sortie) as m
                WHERE aso.somme=m.mymax AND a.ref=aso.article_id";
        return executeSQL($sql);
    }

    function getArticleMoinsVendu()
    {
        $sql = "SELECT a.designation, aso.somme
                FROM article a, article_sortie aso, (SELECT article_id, MIN(somme) as mymin FROM article_sortie) as m
                WHERE aso.somme=m.mymin AND a.ref=aso.article_id";
        return executeSQL($sql);
    }

?>