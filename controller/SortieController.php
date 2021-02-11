<?php

$connect = new PDO("mysql:host=sql7.freemysqlhosting.net;dbname=sql7390853;charset=utf8","sql7390853","bmf4QPEGZx");
$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$dt = new DateTime();
$la_time = new DateTimeZone('Africa/Dakar');
$dt->setTimezone($la_time);
$dt = $dt->format('Y-m-d H:i:s');

try{
    $connect->beginTransaction();

    $query = "INSERT INTO sortie (id,date) VALUES (NULL,'$dt')";
    $connect->exec($query);
    $last_id = $connect->lastInsertId();

    $sql = "INSERT INTO article_sortie (article_id, sortie_id, couleur_id, qte)
              VALUES (:ai,:si,:coul,:qte)";

    for($count = 0; $count < count($_POST['hidden_article']);$count++){
        $data = array(
            ':ai'   =>  $_POST['hidden_article'][$count],
            ':si'   =>  $last_id,
            ':coul' =>  $_POST['hidden_couleur'][$count],
            ':qte'  =>  $_POST['hidden_qte'][$count]
        );

        $statement = $connect->prepare($sql);
        $statement->execute($data);
    }

    $updateASor = "UPDATE article_sortie a1, (SELECT article_id, couleur_id, SUM(qte)  as mysum
                                                                  FROM article_sortie GROUP BY article_id,couleur_id) as s
                    SET a1.somme=s.mysum
                    WHERE a1.article_id=s.article_id AND a1.couleur_id=s.couleur_id";

    $connect->exec($updateASor);

    $updateQteStock = "UPDATE article_couleur ac, article_sortie ars
                        SET ac.qtestock=ac.qtestock-:q
                        WHERE ac.article_id=ars.article_id AND ac.couleur_id=ars.couleur_id AND ac.article_id=:ai AND ac.couleur_id=:coul";

    for($count = 0; $count < count($_POST['hidden_article']);$count++){
        $data = array(
            ':q'  =>  $_POST['hidden_qte'][$count],
            ':ai'   =>  $_POST['hidden_article'][$count],
            ':coul' =>  $_POST['hidden_couleur'][$count]

        );

        $statement = $connect->prepare($updateQteStock);
        $statement->execute($data);
    }

    $updatestocktotal = "UPDATE article a, (SELECT article_id, SUM(qtestock)  as mysum
                                            FROM article_couleur GROUP BY article_id) as s
                          SET a.stocktotal=s.mysum
                          WHERE a.ref=s.article_id";

    $connect->exec($updatestocktotal);

    $connect->commit();
}catch (PDOException $e ) {
    // Failed to insert the order into the database so we rollback any changes
    $connect->rollback();
    throw $e;
}

?>
