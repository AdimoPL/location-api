<?php

namespace Src\System;

use PDO;
use PDOException;

class DatabaseConnector
{
    private $dbConnection = null;

    public function __construct()
    {
        $host = getenv('DB_HOST');
        $port = getenv('DB_PORT');
        $db = getenv('DB_DATABASE');
        $user = getenv('DB_USERNAME');
        $pass = getenv('DB_PASSWORD');
        $env = getenv('ENV');

        try {

            //create new PDO connection
            $this->dbConnection = new PDO(
                "mysql:host=$host;port=$port;charset=utf8mb4;dbname=$db",
                $user,
                $pass
            );

        } catch (PDOException $e) {
            exit($e->getMessage());
        }

        //if running in dev environment set error reporting
        if($env == 'DEV') {
            $this->dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
    }

    public function getConnection()
    {
        return $this->dbConnection;
    }
}
