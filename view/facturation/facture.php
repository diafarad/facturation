<?php
    require('./html_table.php');
    if(isset($_POST['commander'])){
    $htmlTable='<table>
    <tr>
    <td><strong>'.utf8_decode("Désignation").'</strong></td>
    <td><strong>'.utf8_decode("Quantité").'</strong></td>
    <td><strong>PU HTVA</strong></td>
    <td><strong>Prix Total HTVA</strong></td>
    </tr>';

    $total = 0;
    for($count = 0; $count < count($_POST['hidden_des']);$count++){
        $pu = (float) $_POST['hidden_pu'][$count];
        $puTotal = (float) $_POST['hidden_puTotal'][$count];
        $des = utf8_decode($_POST['hidden_des'][$count]);
        $htmlTable = $htmlTable.'<tr>
                        <td>'.$des.'</td>
                        <td>'.$_POST['hidden_qte'][$count].'</td>
                        <td>'.number_format($pu, 0, ',', ' ').'</td>
                        <td>'.number_format($puTotal, 0, ',',' ').'</td>
                      </tr>';
        $total = $total + $puTotal;
    }
    $totalTTC = $total + $total * 0.18;

    $htmlTable = $htmlTable.'<tr>
                                <th colspan="3"><strong>Prix Total HTVA</strong></td>
                                <th><strong>'.number_format($total, 0, ',',' ').' FCFA</strong></td>
                            </tr>';
    $htmlTable = $htmlTable.'<tr>
                                <th colspan="3"><strong>TVA(18%)</strong></td>
                                <th><strong>'.number_format($total*0.18, 0, ',',' ').' FCFA</strong></td>
                            </tr>';
    $htmlTable = $htmlTable.'<tr>
                                <th colspan="3"><strong>Prix TTC</strong></td>
                                <th><strong>'.number_format($totalTTC, 0, ',',' ').' FCFA</strong></td>
                            </tr>';
    $htmlTable = $htmlTable.'</table>';
        
    $pdf=new PDF_HTML_Table();
    $pdf->setCodeClient($_POST['codeClient']);
    $pdf->setTotalHT($total);
    
    $pdf->setTotalTTC($totalTTC);
    $pdf->setTVA($total * 0.18);
    $pdf->AddPage();
    $pdf->WriteHTML("$htmlTable<br>");
    $pdf->Output();
    }
?>