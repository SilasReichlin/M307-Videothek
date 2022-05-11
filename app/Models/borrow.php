<?php

class Borrow
{
    //private members
    private string $table = 'ausleihe';
    private Membership $member;
    //properties
    public PDO $db;
    public int $id = 0;
    public string $name = '';
    public string $email = '';
    public string $phone = '';
    public string $video = '';
    public int $videoid = 0;
    public string $membership = '';
    public int $membershipid = 0;
    public bool $borrowstate = false;
    public string $borrowdate = '';
    public string $returnborrowdate = '';

    //constructors
    public function __construct()
    {
        $this->db = db('videothek');
        $this->member = new Membership();
    }

    //functions
    public function getAllBorrows(): array
    {
        $statement = $this->db->prepare("SELECT ausleihe.id AS 'ausleihid', ausleihe.name, ausleihe.email, ausleihe.telefon, ausleihe.ausleihstatus, ausleihe.fk_video, mitgliedstatus.mitgliedschaft as 'mitgliedschaft', mitgliedstatus.gesamtausleihtage as 'gesamtausleihtage', ausleihe.rueckgabedatum as 'returnDate', movies.title as 'title', ausleihe.ausleihdatum as 'ausleihdatum', ausleihe.rueckgabedatum FROM ausleihe, movies, mitgliedstatus WHERE ausleihe.fk_video = movies.id AND ausleihe.fk_mitgliedstatus = mitgliedstatus.id;");
        $statement->execute();

        return $statement->fetchAll();
    }

    public function createBorrow(): void
    {
        $statement = $this->db->prepare("INSERT INTO ausleihe (name, email, telefon, fk_video, fk_mitgliedstatus, ausleihdatum, rueckgabedatum) VALUES (:name, :email, :telefon, :video, :mitgliedstatus, :ausleihdatum, :rueckgabedatum);");
        $this->membershipid = reset($this->member->getMemberShip($this->membership))['id'];
        $this->member->fullborrowdays = reset($this->member->getMemberShip($this->membership))['gesamtausleihtage'];
        $returndate = date_create($this->borrowdate);
        $returnDateCalculcated = date_add($returndate,  new DateInterval('P' . $this->member->fullborrowdays . 'D'));
        $statement->bindParam(':name', $this->name);
        $statement->bindParam(':email', $this->email);
        $statement->bindParam(':telefon', $this->phone);
        $statement->bindParam(':video', $this->videoid);
        $statement->bindParam(':mitgliedstatus', $this->membershipid);
        $statement->bindParam(':ausleihdatum', $this->borrowdate);
        $statement->bindParam(':rueckgabedatum', $returnDateCalculcated->format('Y-m-d H:i:s'));
        $statement->execute();
    }

    public function updateBorrow(): void
    {
        $statement = $this->db->prepare("UPDATE ausleihe SET name = :name, email = :email, telefon = :telefon, ausleihdatum = :ausleihdatum, fk_mitgliedstatus = :mitgliedstatus, fk_video = :video WHERE id = $this->id");
        $statement->bindParam(':name', $this->name);
        $statement->bindParam(':email', $this->email);
        $statement->bindParam(':telefon', $this->phone);
        $statement->bindParam(':ausleihdatum', $this->borrowdate);
        $statement->bindParam(':mitgliedstatus', $this->membershipid);
        $statement->bindParam(':video', $this->videoid);
        $statement->execute();
    }

    public function getBorrowById($id): Borrow
    {
        $borrows = $this->getAllBorrows();
        $borrow = new Borrow;

        foreach ($borrows as $b) {
            if ($b['ausleihid'] == $id) {
                $borrow->id = $b['ausleihid'];
                $borrow->name = $b['name'];
                $borrow->email = $b['email'];
                $borrow->phone = $b['telefon'];
                $borrow->video = $b['title'];
                $borrow->membership = $b['mitgliedschaft'];
                $borrow->borrowdate = date_create($b['ausleihdatum'])->format('y-m-d H:i:s');
            }
        }

        return $borrow;
    }
}
