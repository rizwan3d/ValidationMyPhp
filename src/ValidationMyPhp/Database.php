<?php

namespace Rizwan3D\ValidationMyPhp;

use PDO;

class Database
{
    /**
     * Connect to the database and returns an instance of PDO class
     * or false if the connection fails.
     *
     * @return PDO
     */
    public static function db(): PDO
    {
        static $pdo;
        // if the connection is not initialized
        // connect to the database
        if (!$pdo) {
            $pdo = new PDO(
                sprintf('mysql:host=%s;dbname=%s;charset=UTF8', Validation::$DB_HOST, Validation::$DB_NAME),
                Validation::$DB_USER,
                Validation::$DB_PASSWORD,
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
        }

        return $pdo;
    }
}
