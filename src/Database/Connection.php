<?php

namespace App\Database;

use PDO;

class Connection
{
    private static $pdo;

    public static function connect()
    {
        if (self::$pdo === null) {
            $config = include __DIR__ . '/../../config/database.php';

            $dsn       = "mysql:host={$config['host']};dbname={$config['database']};charset={$config['charset']}";
            self::$pdo = new PDO($dsn, $config['username'], $config['password'], [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
        }

        return self::$pdo;
    }
}
