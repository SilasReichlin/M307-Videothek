<?php

class Membership
{
    public int $extraborrowdays = 0;
    public int $id = 0;
    public int $fullbyorrowdays = 0;
    public string $membership = '';
    public PDO $db;

       public function __construct()
    {
        $this->db = db('videothek');
    }

    public function getMemberShip(string $membership) : array
    {
        $statement = $this->db->prepare('SELECT * FROM mitgliedstatus WHERE mitgliedschaft = :mitgliedschaft');
        $statement->bindParam(':mitgliedschaft', $membership);
        $statement->execute();

        return $statement->fetchAll();
    }
}

?>