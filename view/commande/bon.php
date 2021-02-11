<?php
require_once 'PDF_MySQL_Table.php';
require_once '../../model/DB.php';
require_once '../../model/CommandeDB.php';

$numcom  = $_GET['num'];


// Connexion à la base
//$link = mysqli_connect('localhost','root','','gestionstockdb');

$pdf = new PDF_MySQL_Table();
$pdf->AddPage();

$reference = utf8_decode("Référence");
$des = utf8_decode("Désignation");
$couleur = utf8_decode("Couleur");
$quant = utf8_decode("Quantité");

$pdf->Table(getConnection(),'SELECT a.ref AS Reference, a.designation as Designation, col.libelle as Couleur, ac.qte as Quantite
                                    FROM commande c, article a, article_commande ac, couleur col
                                    WHERE c.numero=ac.numCom AND ac.articlecom=a.ref AND ac.couleurcom=col.id AND c.numero='."$numcom");
$pdf->Output();

?>