<?php

namespace App\Database\Seeders;

use App\Database\Connection;

class CategoriesSeeder
{
    private $connection;

    public function __construct()
    {
        $this->connection = Connection::connect();
    }

    public function run()
    {
        $categoriesFile = __DIR__ . '/../../../data/categories.json' ;

        $categories = json_decode(file_get_contents($categoriesFile), true);

        $sql       = "INSERT INTO categories (id, name, parent) VALUES (:id, :name, :parent)";
        $statement = $this->connection->prepare($sql);

        foreach ($categories as $category) {
            $statement->execute([
                'id'     => $category['id'],
                'name'   => $category['name'],
                'parent' => $category['parent'],
            ]);
        }

        echo "Categories seeded successfully.\n";
    }
}
