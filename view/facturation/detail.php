<?php
    require('./html_table.php');
    include_once '../../model/DB.php';
    include_once '../../model/FactureDB.php';

    if(isset($_GET['num'])){
    $f = @getFactureByNum($_GET['num']);
    $f = mysqli_fetch_row($f);
    $fac = @getAllArticlesFactureByNum($_GET['num']);

        if($f[4] == 1){
            $htmlTable='<table>
                            <tr>
                                <td><strong>'.utf8_decode("Désignation").'</strong></td>
                                <td><strong>'.utf8_decode("Quantité").'</strong></td>
                                <td><strong>PU HTVA</strong></td>
                                <td><strong>Prix Total HTVA</strong></td>
                            </tr>';
            $total = 0;
            while($result=mysqli_fetch_row($fac))
            {
                $pu = $result[8];
                $qte = $result[7];
                $puTotal = $result[7]*$result[8];
                $des = utf8_decode($result[6]);
                $htmlTable = $htmlTable.'<tr>
                                            <td>'.$des.'</td>
                                            <td>'.$qte.'</td>
                                            <td>'.number_format($pu, 0, ',', ' ').'</td>
                                            <td>'.number_format($puTotal, 0, ',',' ').'</td>
                                        </tr>';
                $total = $total + $puTotal;
            }
            $totalTTC = $total + $total * 0.18;
            $num = $_GET['num'];

            $htmlTable = $htmlTable.'<tr>
                                        <td colspan="3"><strong>Prix Total HTVA</strong></td>
                                        <td><strong>'.number_format($total, 0, ',',' ').' FCFA</strong></td>
                                    </tr>';
            $htmlTable = $htmlTable.'<tr>
                                        <td colspan="3"><strong>TVA(18%)</strong></td>
                                        <td><strong>'.number_format($total*0.18, 0, ',',' ').' FCFA</strong></td>
                                    </tr>';
            $htmlTable = $htmlTable.'<tr>
                                        <td colspan="3"><strong>Prix TTC</strong></td>
                                        <td><strong>'.number_format($totalTTC, 0, ',',' ').' FCFA</strong></td>
                                    </tr>';
            $htmlTable = $htmlTable.'</table>';
                
            $pdf=new PDF_HTML_Table();
            $d = explode('-',$f[1]);
            $annee = $d[0];
            $mois = $d[1];
            $jour = $d[2];
            $date = $jour.'/'.$mois.'/'.$annee;
            $pdf->setDate($date);
            $pdf->setExistTVA(1);
            $pdf->setCodeClient($f[3]);
            $pdf->setTotalHT($total);
            $pdf->setNum($num);
            $pdf->setTotalTTC($totalTTC);
            $pdf->setTVA($total * 0.18);
            $pdf->AddPage();
            $pdf->WriteHTML("$htmlTable<br>");
            $pdf->Output();
        }
        else{
            $htmlTable='<table>
                            <tr>
                                <td><strong>'.utf8_decode("Désignation").'</strong></td>
                                <td><strong>'.utf8_decode("Quantité").'</strong></td>
                                <td><strong>PU</strong></td>
                                <td><strong>Prix Total</strong></td>
                            </tr>';
            $total = 0;
            while($result=mysqli_fetch_row($fac))
            {
                $pu = $result[8];
                $qte = $result[7];
                $puTotal = $result[7]*$result[8];
                $des = utf8_decode($result[6]);
                $htmlTable = $htmlTable.'<tr>
                                            <td>'.$des.'</td>
                                            <td>'.$qte.'</td>
                                            <td>'.number_format($pu, 0, ',', ' ').'</td>
                                            <td>'.number_format($puTotal, 0, ',',' ').'</td>
                                        </tr>';
                $total = $total + $puTotal;
            }
            $num = $_GET['num'];
            $htmlTable = $htmlTable.'<tr>
                                        <td colspan="3"><strong>Prix Total</strong></td>
                                        <td><strong>'.number_format($total, 0, ',',' ').' FCFA</strong></td>
                                    </tr>';
            $htmlTable = $htmlTable.'</table>';

            $pdf=new PDF_HTML_Table();
            $d = explode('-',$f[1]);
            $annee = $d[0];
            $mois = $d[1];
            $jour = $d[2];
            $date = $jour.'/'.$mois.'/'.$annee;
            $pdf->setDate($date);
            $pdf->setExistTVA(0);
            $pdf->setCodeClient($f[3]);
            $pdf->setTotalHT($total);
            $pdf->setNum($num);
            $pdf->AddPage();
            $pdf->WriteHTML("$htmlTable<br>");
            $pdf->Output();
        }
    }
?>