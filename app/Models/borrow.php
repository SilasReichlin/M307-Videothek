<?php 

class Borrow
{
    //private members
    private string $table = 'ausleihe';

    //properties
    public PDO $db;
    public string $name = '';
    public string $email = '';
    public string $telefon = '';
    public int $video = 0;

    //constructors
    public function __construct()
    {
        $this->db = db('videothek');
    }

    //functions
    public function getAllBorrows() : array
    {
        $statement = $this->db->prepare("SELECT ausleihe.name, ausleihe.email, ausleihe.telefon, ausleihe.ausleihstatus, ausleihe.fk_video, mitgliedstatus.mitgliedschaft, mitgliedstatus.gesamtausleihtage, movies.title as 'title' FROM ausleihe, movies, mitgliedstatus WHERE ausleihe.fk_video = movies.id AND ausleihe.fk_mitgliedstatus = mitgliedstatus.id;");
        $statement->execute();

        return $statement->fetchAll();
    }

    public function createBorrow() : void
    {
        $statement = $this->db->prepare("INSERT INTO $this->table (name, email, telefon) VALUES (:name :email :telefon;)");
        $statement->bindParam(':name', $this->name);
        $statement->bindParam(':email', $this->email);
        $statement->bindParam(':telefon', $this->telefon);
        $statement->execute();
    }
}
