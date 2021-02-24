<?php
    require('./html_table.php');
    include_once '../../model/DB.php';
    include_once '../../model/FactureDB.php';
    if(isset($_POST['commander'])){
        if(isset($_POST['tva'])){
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
            date_default_timezone_set('Africa/Dakar');         
            $date = date('Y-m-d');
            $totalTTC = $total + $total * 0.18;            
            $d = date('dmYHi');
            $num = 'DK/CTC/A0'.$d;

            $connect = new PDO("mysql:host=sql7.freemysqlhosting.net;dbname=sql7390853;charset=utf8","sql7390853","bmf4QPEGZx");
            $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            try{
                $connect->beginTransaction();
                $code = $_POST['codeClient'];
                $query = "INSERT INTO facture (num,date,montant,client,tva) VALUES ('$num','$date','$totalTTC','$code',1)";
                $connect->exec($query);
        
                $sql = "INSERT INTO article_facture (numFac, des, qte, pu)
                      VALUES (:num,:des,:qte,:pu)";
                
                for($count = 0; $count < count($_POST['hidden_des']);$count++){
                    $data = array(
                        ':num'   =>  $num,
                        ':des'  =>  utf8_decode($_POST['hidden_des'][$count]),
                        ':qte'  =>  $_POST['hidden_qte'][$count],
                        ':pu' =>  $_POST['hidden_pu'][$count]
                    );
            
                    $statement = $connect->prepare($sql);
                    $statement->execute($data);
                }
        
                $connect->commit();
            }catch (PDOException $e ) {
                // Failed to insert the order into the database so we rollback any changes
                $connect->rollback();
                throw $e;
            }

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
            $pdf->setDate(date('d/m/Y'));
            $pdf->setExistTVA(1);
            $pdf->setCodeClient($_POST['codeClient']);
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
            date_default_timezone_set('Africa/Dakar');
            $date = date('Y-m-d');
            $d = date('dmYHi');
            $num = 'DK/CTC/A0'.$d;

            $connect = new PDO("mysql:host=sql7.freemysqlhosting.net;dbname=sql7390853;charset=utf8","sql7390853","bmf4QPEGZx");
            $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            try{
                $connect->beginTransaction();
                $code = $_POST['codeClient'];
                $query = "INSERT INTO facture (num,date,montant,client,tva) VALUES ('$num','$date','$total','$code',0)";
                $connect->exec($query);
        
                $sql = "INSERT INTO article_facture (numFac, des, qte, pu)
                      VALUES (:num,:des,:qte,:pu)";
                
                for($count = 0; $count < count($_POST['hidden_des']);$count++){
                    $data = array(
                        ':num'   =>  $num,
                        ':des'  =>  utf8_decode($_POST['hidden_des'][$count]),
                        ':qte'  =>  $_POST['hidden_qte'][$count],
                        ':pu' =>  $_POST['hidden_pu'][$count]
                    );
            
                    $statement = $connect->prepare($sql);
                    $statement->execute($data);
                }
        
                $connect->commit();
            }catch (PDOException $e ) {
                // Failed to insert the order into the database so we rollback any changes
                $connect->rollback();
                throw $e;
            }

            $htmlTable = $htmlTable.'<tr>
                                        <td colspan="3"><strong>Prix Total</strong></td>
                                        <td><strong>'.number_format($total, 0, ',',' ').' FCFA</strong></td>
                                    </tr>';
            $htmlTable = $htmlTable.'</table>';

            $pdf=new PDF_HTML_Table();
            $pdf->setDate(date('d/m/Y'));
            $pdf->setExistTVA(0);
            $pdf->setCodeClient($_POST['codeClient']);
            $pdf->setTotalHT($total);
            $pdf->setNum($num);
            $pdf->AddPage();
            $pdf->WriteHTML("$htmlTable<br>");
            $pdf->Output();
        }
    }
?>