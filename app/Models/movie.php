<?php

class Movie
{
    public int $id = 0;
    public string $title = '';
    public PDO $db;

    public function __construct()
    {
        $this->db = db('videothek');
    }

    public function getMovie(string $title): array
    {
        $statement = $this->db->prepare('SELECT * FROM movies WHERE title = :title');
        $statement->bindParam(':title', $title);
        $statement->execute();

        return $statement->fetchAll();
    }
}
