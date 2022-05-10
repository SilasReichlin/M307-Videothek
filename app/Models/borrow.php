<?php

class Borrow
{
    //private members
    private string $table = 'ausleihe';

    //properties
    public PDO $db;
    public int $id = 0;
    public string $name = '';
    public string $email = '';
    public string $phone = '';
    public string $video = '';
    public int $videoid = 0;
    public int $membership = 0;
    public bool $borrowstate = false;

    //constructors
    public function __construct()
    {
        $this->db = db('videothek');
    }

    //functions
    public function getAllBorrows(): array
    {
        $statement = $this->db->prepare("SELECT ausleihe.name, ausleihe.email, ausleihe.telefon, ausleihe.ausleihstatus, ausleihe.fk_video, mitgliedstatus.mitgliedschaft, mitgliedstatus.gesamtausleihtage, movies.title as 'title' FROM ausleihe, movies, mitgliedstatus WHERE ausleihe.fk_video = movies.id AND ausleihe.fk_mitgliedstatus = mitgliedstatus.id;");
        $statement->execute();

        return $statement->fetchAll();
    }

    public function createBorrow(): void
    {
        $statement = $this->db->prepare("INSERT INTO $this->table (name, email, telefon) VALUES (:name :email :telefon;)");
        $statement->bindParam(':name', $this->name);
        $statement->bindParam(':email', $this->email);
        $statement->bindParam(':telefon', $this->phone);
        $statement->execute();
    }

    public function updateBorrow(): void
    {
        $statement = $this->db->prepare("UPDATE $this->table SET name = :name, email = :email, telefon = :telefon, ausleihstatus = :ausleihstatus, fk_mitgliedstatus = :fk_mitgliedstatus, fk_video = :fk_video");
        $statement->bindParam(':name', $this->name);
        $statement->bindParam(':email', $this->email);
        $statement->bindParam(':telefon', $this->phone);
        $statement->bindParam(':ausleihstatus', $this->borrowstate);
        $statement->bindParam(':fk_mitgliedstatus', $this->membership);
        $statement->bindParam(':fk_video', $this->videoid);
        $statement->execute();
    }

    public function getBorrowById(int $id): Borrow
    {
        $borrows = $this->borrow->getAllBorrows();
        $searchedborrow = new Borrow;
        foreach ($borrows as $b) {
            if ($b['id'] == $id) {
                $searchedborrow->id = $b['id'];
                $searchedborrow->name = $b['name'] ?? '';
                $searchedborrow->email = $b['email'] ?? '';
                $searchedborrow->phone = $b['telefon'] ?? '';
                $searchedborrow->video = $b['title'] ?? '';
                $searchedborrow->membership = $b['mitgliedstatus'] ?? '';
                $searchedborrow->borrowstate = $b['ausleihstatus'] ?? '';
                $searchedborrow->videoid = $b['fk_video'] ?? '';
                break;
            }
        }

        return $searchedborrow;
    }
}
