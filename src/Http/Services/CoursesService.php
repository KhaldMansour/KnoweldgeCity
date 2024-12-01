<?php

namespace App\Http\Services;

use App\Database\Connection;
use PDO;
use PDOException;

class CoursesService
{
    private $connection;
    public function __construct()
    {
        $this->connection = Connection::connect();
    }
    public function find()
    {
        $sql = "SELECT * from courses";

        try {
            $statement  = $this->connection->query($sql);
            $categories = $statement->fetchAll(PDO::FETCH_ASSOC);

            return $categories;
            $this->connection->exec($sql);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
    }

    public function findOne($id)
    {
        $sql = "
            SELECT 
                c.id,
                c.name,
                c.parent,
                COUNT(co.id) AS count_of_courses
            FROM 
                categories c
            LEFT JOIN 
                courses co ON c.id = co.category_id
            WHERE 
                c.id = :id
            GROUP BY 
                c.id
        ";

        try {
            $statement = $this->connection->prepare($sql);
            $statement->bindParam(':id', $id);
            $statement->execute();
            $category = $statement->fetch(PDO::FETCH_ASSOC);

            return $category ?: null;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
    }
}
