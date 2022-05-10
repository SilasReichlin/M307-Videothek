<?php 

class borrow
{
    //private members
    private string $table = 'ausleihe';

    //properties
    public PDO $db;
    public string $name = '';
    public string $email = '';
    public string $telefon = '';

    //constructors
    public function __construct(string $name, string $email, string $telefon)
    {
        $this->db = db($this->table);
        $this->name = $name;
        $this->email = $email;
        $this->telefon = $telefon;
    }

    //functions
    public function getAllBorrows() : array
    {
        $statement = $this->db->prepare('SELECT * FROM ausleihe');
        $statement->execute();

        return $statement->fetchAll();
    }

    public function createBorrow() : void
    {
        $statement = $this->db->prepare('INSERT INTO ausleihe (name, email, telefon) VALUES (:name :email :telefon;)');
        $statement->bindParam(':name', $this->name);
        $statement->bindParam(':email', $this->email);
        $statement->bindParam(':telefon', $this->telefon);
        $statement->execute();
    }
}
