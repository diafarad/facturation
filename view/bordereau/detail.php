<?php
    require('./bordereau_html_table.php');
    include_once '../../model/DB.php';
    include_once '../../model/BordereauDB.php';

    if(isset($_GET['num'])){
    $b = @getBordereauByNum($_GET['num']);
    $b = mysqli_fetch_row($b);
    $bordereau = @getAllArticlesBordereauBNum($_GET['num']);

            $htmlTable='<table>
                            <tr>
                                <td><strong>'.utf8_decode("Désignation").'</strong></td>
                                <td><strong>'.utf8_decode("Quantité").'</strong></td>
                            </tr>';
            $nbreProduits=0;
            while($result=mysqli_fetch_row($bordereau))
            {
                $des = utf8_decode($result[5]);
                $qte = $result[6];
                $htmlTable = $htmlTable.'<tr>
                                            <td>'.$des.'</td>
                                            <td>'.$qte.'</td>
                                        </tr>';
                $nbreProduits++;
            }
            $htmlTable = $htmlTable.'</table>';
                
            $pdf=new PDF_HTML_Table();
            $d = explode('-',$b[1]);
            $annee = $d[0];
            $mois = $d[1];
            $jour = $d[2];
            $date = $jour.'/'.$mois.'/'.$annee;
            $pdf->setDate($date);
            $pdf->setNum($b[0]);
            $pdf->setFacture($b[2]);
            $pdf->setCode($b[3]);
            $pdf->AddPage();
            $pdf->WriteHTML("$htmlTable<br>");
            $pdf->Output();
        
    }
?>