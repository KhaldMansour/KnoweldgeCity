<?php

require_once 'vendor/autoload.php';

use App\Database\Connection;
use App\Database\Migrations\MigrationRunner;

try {
    $connection = Connection::connect();
    echo "Database connection successful.\n";
    $migrationRunner = new MigrationRunner();
    $migrationRunner->runMigrations();
    exit(0);

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage() . "\n";
    exit(1);
}
