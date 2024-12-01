<?php

namespace App\Database\Migrations;

use App\Database\Connection;
use PDOException;

class MigrationRunner
{
    private $connection;

    public function __construct()
    {
        $this->connection = Connection::connect();
    }

    public function runMigrations()
    {
        $migrationsDir = __DIR__ ;
        $files         = scandir($migrationsDir, SCANDIR_SORT_ASCENDING);

        foreach ($files as $file) {
            if (pathinfo($file, PATHINFO_EXTENSION) === 'sql') {
                $sql = file_get_contents($migrationsDir .'/'. $file);
                try {
                    $this->connection->exec($sql);
                    echo "Executed: $file\n";
                } catch (PDOException $e) {
                    echo "Error executing $file: " . $e->getMessage() . "\n";
                }
            }
        }
    }
}
