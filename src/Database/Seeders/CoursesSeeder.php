<?php

namespace App\Database\Seeders;

use App\Database\Connection;

class CoursesSeeder
{
    private $connection;

    public function __construct()
    {
        $this->connection = Connection::connect();
    }

    public function run()
    {
        $coursesFile = __DIR__ . '/../../../data/course_list.json' ;

        $courses = json_decode(file_get_contents($coursesFile), true);

        $sql       = "INSERT INTO courses (title, description, category_id , image_preview) VALUES (:title, :description, :category_id , :image_preview)";
        $statement = $this->connection->prepare($sql);

        foreach ($courses as $course) {
            $statement->execute([
                'title'         => $course['title'],
                'description'   => $course['description'],
                'category_id'   => $course['category_id'],
                'image_preview' => $course['image_preview'],
            ]);
        }

        echo "Courses seeded successfully.\n";
    }
}
