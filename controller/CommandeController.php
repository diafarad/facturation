<?php

$connect = new PDO("mysql:host=sql7.freemysqlhosting.net;dbname=sql7390853;charset=utf8","sql7390853","bmf4QPEGZx");
$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$dt = new DateTime();
$la_time = new DateTimeZone('Africa/Dakar');
$dt->setTimezone($la_time);
$dt = $dt->format('Y-m-d H:i:s');

try{
    $connect->beginTransaction();

    $fournisseur = $_POST['hidden_fournisseur'][0];

    $query = "INSERT INTO commande (date,controle,restant,fournisseur_id) VALUES ('$dt',0,0,'$fournisseur')";
    $connect->exec($query);
    $last_id = $connect->lastInsertId();

    $sql = "INSERT INTO article_commande (numCom, articleCom, couleurCom, qte, controle, restant, etat)
              VALUES (:nc,:ref,:coul,:qte,:ctrl,:rest,:et)";

    for($count = 0; $count < count($_POST['hidden_article']);$count++){
        $data = array(
            ':nc'   =>  $last_id,
            ':ref'  =>  $_POST['hidden_article'][$count],
            ':coul' =>  $_POST['hidden_couleur'][$count],
            ':qte'  =>  $_POST['hidden_qte'][$count],
            ':ctrl' =>  0,
            ':rest' =>  $_POST['hidden_qte'][$count],
            ':et'   =>  'ouvert'
        );

        $statement = $connect->prepare($sql);
        $statement->execute($data);
    }

    $updatecommandectrl = "UPDATE commande c, (SELECT numCom, SUM(controle)  as mysum
                                                    FROM article_commande GROUP BY numCom) as s
                                SET c.controle=s.mysum
                                WHERE c.numero=s.numCom";

    $connect->exec($updatecommandectrl);

    $updatecommanderest = "UPDATE commande c, (SELECT numCom, SUM(restant)  as mysum
                                                    FROM article_commande GROUP BY numCom) as s
                                SET c.restant=s.mysum
                                WHERE c.numero=s.numCom";

    $connect->exec($updatecommanderest);

    $connect->commit();
}catch (PDOException $e ) {
    // Failed to insert the order into the database so we rollback any changes
    $connect->rollback();
    throw $e;
}

?>
