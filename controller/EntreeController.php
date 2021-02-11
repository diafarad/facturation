<?php

$connect = new PDO("mysql:host=sql7.freemysqlhosting.net;dbname=sql7390853;charset=utf8","sql7390853","bmf4QPEGZx");
$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$dt = new DateTime();
$la_time = new DateTimeZone('Africa/Dakar');
$dt->setTimezone($la_time);
$dt = $dt->format('Y-m-d H:i:s');

try{
    $connect->beginTransaction();

    $numfac = $_POST['hidden_numfac'][0];
    $numcom = $_POST['hidden_numcom'][0];

    $query = "INSERT INTO entree (id,date,numeroFac,numCom) VALUES (NULL,'$dt','$numfac','$numcom')";
    $connect->exec($query);
    $last_id = $connect->lastInsertId();

    $sql = "INSERT INTO article_entree (article_id, entree_id, couleur_id, qte)
              VALUES (:ai,:ei,:coul,:qte)";

    for($count = 0; $count < count($_POST['hidden_article']);$count++){
        $data = array(
            ':ai'   =>  $_POST['hidden_article'][$count],
            ':ei'   =>  $last_id,
            ':coul' =>  $_POST['hidden_couleur'][$count],
            ':qte'  =>  $_POST['hidden_qte'][$count]
        );

        $statement = $connect->prepare($sql);
        $statement->execute($data);
    }

    $updateCom = "UPDATE article_commande ac, commande c, entree e, article_entree ae 
                    SET ac.controle=ae.qte
                    WHERE ac.numCom=c.numero AND c.numero=e.numCom AND e.id=ae.entree_id AND e.id='$last_id' AND ae.article_id=ac.articlecom AND ae.couleur_id=ac.couleurcom AND ac.articlecom=:artcom AND ac.couleurcom=:coulcom";

    for($count = 0; $count < count($_POST['hidden_article']);$count++){
        $data = array(
            ':artcom'   =>  $_POST['hidden_article'][$count],
            ':coulcom'  =>  $_POST['hidden_couleur'][$count]
        );

        $statement = $connect->prepare($updateCom);
        $statement->execute($data);
    }

    $updateCom3 = "UPDATE article_commande ac, commande c, entree e, article_entree ae 
                    SET ac.restant=ac.qte-ac.controle
                    WHERE ac.numCom=c.numero AND c.numero=e.numCom AND e.id=ae.entree_id AND e.id='$last_id' AND ae.article_id=ac.articlecom AND ae.couleur_id=ac.couleurcom AND ac.articlecom=:artcom AND ac.couleurcom=:coulcom";

    for($count = 0; $count < count($_POST['hidden_article']);$count++){
        $data = array(
            ':artcom'   =>  $_POST['hidden_article'][$count],
            ':coulcom'  =>  $_POST['hidden_couleur'][$count]
        );

        $statement = $connect->prepare($updateCom3);
        $statement->execute($data);
    }

    $updateCom1 = "UPDATE article_commande ac, commande c, entree e, article_entree ae 
                    SET ac.etat='ouverte'
                    WHERE ac.restant>0 AND ac.numCom=c.numero AND c.numero=e.numCom AND e.id=ae.entree_id AND e.id='$last_id' AND ae.article_id=ac.articlecom AND ae.couleur_id=ac.couleurcom AND ac.articlecom=:artcom AND ac.couleurcom=:coulcom";

    for($count = 0; $count < count($_POST['hidden_article']);$count++){
        $data = array(
            ':artcom'   =>  $_POST['hidden_article'][$count],
            ':coulcom'  =>  $_POST['hidden_couleur'][$count]
        );

        $statement = $connect->prepare($updateCom1);
        $statement->execute($data);
    }

    $updateCom2 = "UPDATE article_commande ac, commande c, entree e, article_entree ae 
                    SET ac.etat='fermée'
                    WHERE ac.restant<=0 AND ac.numCom=c.numero AND c.numero=e.numCom AND e.id=ae.entree_id AND e.id='$last_id' AND ae.article_id=ac.articlecom AND ae.couleur_id=ac.couleurcom AND ac.articlecom=:artcom AND ac.couleurcom=:coulcom";

    for($count = 0; $count < count($_POST['hidden_article']);$count++){
        $data = array(
            ':artcom'   =>  $_POST['hidden_article'][$count],
            ':coulcom'  =>  $_POST['hidden_couleur'][$count]
        );

        $statement = $connect->prepare($updateCom2);
        $statement->execute($data);
    }

    $sqlverif = "SELECT a.article_id
                    FROM article_couleur a
                    WHERE a.article_id=:ai AND a.couleur_id=:ci";

    for($count = 0; $count < count($_POST['hidden_article']);$count++){
        $data = array(
            ':ai'   =>  $_POST['hidden_article'][$count],
            ':ci'   =>  $_POST['hidden_couleur'][$count]
        );

        $statement = $connect->prepare($sqlverif);
        $statement->execute($data);
        $donnees_exist = $statement->fetch();

        if($donnees_exist == FALSE){
            $q = "INSERT INTO article_couleur (article_id, couleur_id, qtestock)
                  VALUES (:ai,:coul,:qte)";

            $data = array(
                ':ai'   =>  $_POST['hidden_article'][$count],
                ':coul' =>  $_POST['hidden_couleur'][$count],
                ':qte'  =>  $_POST['hidden_qte'][$count]
            );
            $statement = $connect->prepare($q);
            $statement->execute($data);
        }
        else{
            $q = "UPDATE article_couleur
                    SET qtestock=qtestock+:q
                    WHERE article_id=:ai AND couleur_id=:coul";

            $data = array(
                ':q'    =>  $_POST['hidden_qte'][$count],
                ':ai'   =>  $_POST['hidden_article'][$count],
                ':coul' =>  $_POST['hidden_couleur'][$count]
            );
            $statement = $connect->prepare($q);
            $statement->execute($data);
        }
    }

    $updatestocktotal = "UPDATE article a, ( SELECT article_id, SUM(qtestock)  as mysum
                                                                  FROM article_couleur GROUP BY article_id) as s
                          SET a.stocktotal=s.mysum
                          WHERE a.ref=s.article_id";

    $connect->exec($updatestocktotal);

    $updatecontrolecommande = "UPDATE commande c, (SELECT numCom, SUM(controle)  as mysum
                                                    FROM article_commande GROUP BY numCom) as s
                                SET c.controle=s.mysum
                                WHERE c.numero=s.numCom";

    $connect->exec($updatecontrolecommande);

    $updaterestantcommande = "UPDATE commande c, (SELECT numCom, SUM(restant)  as mysum
                                                    FROM article_commande GROUP BY numCom) as s
                                SET c.restant=s.mysum
                                WHERE c.numero=s.numCom";

    $connect->exec($updaterestantcommande);

    $connect->commit();
}catch (PDOException $e ) {
    // Failed to insert the order into the database so we rollback any changes
    $connect->rollback();
    throw $e;
}

?>
