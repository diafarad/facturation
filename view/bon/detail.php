<?php
    require('./bon_html_table.php');
    include_once '../../model/DB.php';
    include_once '../../model/BonDB.php';

    if(isset($_GET['id'])){
    $b = @getBonById($_GET['id']);
    $b = mysqli_fetch_row($b);
    $bon = @getAllArticlesBonById($_GET['id']);

            $htmlTable='<table>
                            <tr>
                                <td><strong>'.utf8_decode("Désignation").'</strong></td>
                                <td><strong>'.utf8_decode("Quantité").'</strong></td>
                                <td><strong>Prix Unitaire</strong></td>
                                <td><strong>Prix Total</strong></td>
                            </tr>';
            $total = 0;
            $nbreProduits=0;
            while($result=mysqli_fetch_row($bon))
            {
                $pu = $result[6];
                $qte = $result[5];
                $puTotal = $result[5]*$result[6];
                $des = utf8_decode($result[4]);
                $htmlTable = $htmlTable.'<tr>
                                            <td>'.$des.'</td>
                                            <td>'.$qte.'</td>
                                            <td>'.number_format($pu, 0, ',', ' ').'</td>
                                            <td>'.number_format($puTotal, 0, ',',' ').'</td>
                                        </tr>';
                $total = $total + $puTotal;
                $nbreProduits++;
            }
            $totalTTC = $total;
            $id = $_GET['id'];

            $htmlTable = $htmlTable.'<tr>
                                        <th colspan="3"><strong>Nombre de produits</strong></td>
                                        <th><strong>'.number_format($nbreProduits, 0, ',',' ').'</strong></td>
                                    </tr>';
            $htmlTable = $htmlTable.'<tr>
                                        <th colspan="3"><strong>'.utf8_decode("Total à payer").'</strong></td>
                                        <th><strong>'.number_format($totalTTC, 0, ',',' ').' FCFA</strong></td>
                                    </tr>';
            $htmlTable = $htmlTable.'</table>';
                
            $pdf=new PDF_HTML_Table();
            $d = explode('-',$b[1]);
            $annee = $d[0];
            $mois = $d[1];
            $jour = $d[2];
            $date = $jour.'/'.$mois.'/'.$annee;
            $pdf->setDate($date);
            $pdf->setNom($b[4]);
            $pdf->setAdresse($b[5]);
            $pdf->setTel($b[6]);
            $pdf->setTotalHT($total);
            $pdf->setTotalTTC($totalTTC);
            $pdf->AddPage();
            $pdf->WriteHTML("$htmlTable<br>");
            $pdf->Output();
        
    }
?>