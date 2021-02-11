<?php

    function getConnection()
    {
        define("HOST", "sql7.freemysqlhosting.net");
        define("USER", "sql7390853");
        define("PASSWORD", "bmf4QPEGZx");
        define("DBNAME","sql7390853");

        $conn = mysqli_connect(HOST,USER,PASSWORD,DBNAME);
        mysqli_set_charset($conn,"utf8");
        return $conn;
    }

    function executeSQL($sql)
    {
        return mysqli_query(getConnection(), $sql);
    }

    function closeConnexion($connexion)
    {
        mysqli_close($connexion);
    }

?>
