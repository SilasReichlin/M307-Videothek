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

    //constructors
    public function __construct()
    {
        $this->db = db('videothek');
    }

    //functions
    public function getAllBorrows() : array
    {
        $statement = $this->db->prepare("SELECT * FROM $this->table");
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
