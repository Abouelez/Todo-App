<?php

namespace App\Models;

use PDO;
use Config\Database;

class Task
{
    private static $connection;

    public function __construct()
    {
        $this->connection = Database::getInstance()->getConnection();
    }

    public static function all()
    {
        $connection = Database::getInstance()->getConnection();
        $query = $connection->query('SELECT * FROM tasks');
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find($id)
    {
        $connection = Database::getInstance()->getConnection();
        $query = $connection->prepare('SELECT * FROM tasks WHERE id = :id');
        $query->bindParam(':id', $id);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function insert($data)
    {
        $connection = Database::getInstance()->getConnection();
        $query = $connection->prepare('INSERT INTO tasks (title, description) VALUES (:title, :description)');

        $query->bindParam(':title', $data['title']);
        $query->bindParam(':description', $data['description']);

        $query->execute();
    }

    public static function update($id, $data)
    {
        $connection = Database::getInstance()->getConnection();

        $query = $connection->prepare('UPDATE tasks SET title = :title, description = :description WHERE id = :id');

        $query->bindParam(':id', $id);
        $query->bindParam(':title', $data['title']);
        $query->bindParam(':description', $data['description']);

        $query->execute();
    }

    public static function delete($id)
    {
        $connection = Database::getInstance()->getConnection();

        $query = $connection->prepare('DELETE FROM tasks WHERE id = :id');
        $query->bindParam(':id', $id);
        $query->execute();
    }
}
