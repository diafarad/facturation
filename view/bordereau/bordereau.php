<?php
    require('./bordereau_html_table.php');
    if(isset($_POST['commander'])){
    $htmlTable='<table>
    <tr>
    <td><strong>'.utf8_decode("Désignation").'</strong></td>
    <td><strong>'.utf8_decode("Quantité").'</strong></td>
    </tr>';

    $nbreProduits=0;
    for($count = 0; $count < count($_POST['hidden_des']);$count++){
        $des = utf8_decode($_POST['hidden_des'][$count]);
        $htmlTable = $htmlTable.'<tr>
                                    <td>'.$des.'</td>
                                    <td>'.$_POST['hidden_qte'][$count].'</td>
                                </tr>';
        $nbreProduits++;
    }

    date_default_timezone_set('Africa/Dakar');         
    $date = date('Y-m-d');
    $d = date('dmYHi');
    $num = 'DK/CTC/B0'.$d;

    $connect = new PDO("mysql:host=sql7.freemysqlhosting.net;dbname=sql7390853;charset=utf8","sql7390853","bmf4QPEGZx");
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    try{
        $connect->beginTransaction();
        $fac = $_POST['fac'];
        $code = $_POST['code'];
        $query = "INSERT INTO bordereau (num,date,numFac,codeC) VALUES ('$num','$date','$fac','$code')";
        $connect->exec($query);

        $sql = "INSERT INTO article_bordereau (numB, des, qte)
              VALUES (:numb,:des,:qte)";
        
        for($count = 0; $count < count($_POST['hidden_des']);$count++){
            $data = array(
                ':numb' =>  $num,
                ':des'  =>  $_POST['hidden_des'][$count],
                ':qte'  =>  $_POST['hidden_qte'][$count]
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

    $htmlTable = $htmlTable.'</table>';
        
    $pdf=new PDF_HTML_Table();
    $pdf->setNum($num);
    $pdf->setDate(date('d/m/Y'));
    $pdf->setFacture($_POST['fac']);
    $pdf->setCode($_POST['code']);
    $pdf->AddPage();
    $pdf->WriteHTML("$htmlTable<br>");
    $pdf->Output();
    }
?>