<?php
    require('./bon_html_table.php');
    if(isset($_POST['commander'])){
    $htmlTable='<table>
    <tr>
    <td><strong>'.utf8_decode("Désignation").'</strong></td>
    <td><strong>'.utf8_decode("Quantité").'</strong></td>
    <td><strong>Prix Unitaire</strong></td>
    <td><strong>Prix Total</strong></td>
    </tr>';

    $total = 0;
    $nbreProduits=0;
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
        $nbreProduits++;
    }
    $totalTTC = $total;
    date_default_timezone_set('Africa/Dakar');         
    $date = date('Y-m-d');

    $connect = new PDO("mysql:host=sql7.freemysqlhosting.net;dbname=sql7390853;charset=utf8","sql7390853","bmf4QPEGZx");
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    try{
        $connect->beginTransaction();
        $idf = $_POST['hidden_idf'];
        $query = "INSERT INTO bon (id,date,idf) VALUES ('NULL','$date','$idf')";
        $connect->exec($query);
        $last_id = $connect->lastInsertId();

        $sql = "INSERT INTO article_commande (idB, des, qte, pu)
              VALUES (:idb,:des,:qte,:pu)";
        
        for($count = 0; $count < count($_POST['hidden_des']);$count++){
            $data = array(
                ':idb'   =>  $last_id,
                ':des'  =>  $_POST['hidden_des'][$count],
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
                                <th colspan="3"><strong>Nombre de produits</strong></td>
                                <th><strong>'.number_format($nbreProduits, 0, ',',' ').'</strong></td>
                            </tr>';
    $htmlTable = $htmlTable.'<tr>
                                <th colspan="3"><strong>'.utf8_decode("Total à payer").'</strong></td>
                                <th><strong>'.number_format($totalTTC, 0, ',',' ').' FCFA</strong></td>
                            </tr>';
    $htmlTable = $htmlTable.'</table>';

        
    $pdf=new PDF_HTML_Table();
    $pdf->setDate(date('d/m/Y'));
    $pdf->setNom($_POST['hidden_nom']);
    $pdf->setAdresse($_POST['hidden_adr']);
    $pdf->setTel($_POST['hidden_tel']);
    $pdf->setTotalHT($total);
    $pdf->setTotalTTC($totalTTC);
    $pdf->AddPage();
    $pdf->WriteHTML("$htmlTable<br>");
    $pdf->Output();
    }
?>