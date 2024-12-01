<?php

require_once 'vendor/autoload.php';

use App\Database\Seeders\CategoriesSeeder;
use App\Database\Seeders\CoursesSeeder;

try {
    $CategoriesSeeder = new CategoriesSeeder();
    $CategoriesSeeder->run();

    $coursesSeeder = new CoursesSeeder();
    $coursesSeeder->run();

} catch (Exception $e) {
    echo "Seeding failed: " . $e->getMessage() . "\n";
}
