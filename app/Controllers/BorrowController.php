<?php
include 'app/Models/Borrow.php';

class BorrowController
{
    private Borrow $borrow;

    public function __construct()
    {
        $this->borrow = new Borrow();
    }

    public function index()
    {
        $borrows = $this->borrow->getAllBorrows();
        require 'app/Views/borrow.view.php';
    }

    public function getBorrowById($id) : Borrow
    {
        $borrows = $this->borrow->getAllBorrows();
        $searchedborrow = new Borrow;
        foreach($borrows as $b)
        {
            if ($b['id'] == $id)
            {
                $searchedborrow->id = $b['id'];
                $searchedborrow->name = $b['name'] ?? '';
                $searchedborrow->email = $b['email'] ?? '';
                $searchedborrow->telefon = $b['telefon'] ?? '';
                $searchedborrow->video = $b['title'] ?? '';
                $searchedborrow->mitgliedstatus = $b['mitgliedstatus'] ?? '';
                $searchedborrow->ausleihstatus = $b['ausleihstatus'] ?? '';
                $searchedborrow->videoid = $b['fk_video'] ?? '';
                break;
            }
        }

        return $searchedborrow;
    }

    public function postBorrow() : void
    {
        try
        {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['telefon']) && isset($_POST['fk_video'])) {
                    $this->borrow->name = trim(htmlspecialchars($_POST['name']));
                    $this->borrow->email = trim(htmlspecialchars($_POST['email']));
                    $this->borrow->video = $_POST['fk_video'];
    
                    if (is_numeric($_POST['telefon'])) {
                        $this->borrow->telefon = trim(htmlspecialchars($_POST['telefon']));
                    }
    
                    $this->borrow->createBorrow();
                    require 'app/Views/borrow.view.php';
                }
            }
        }
        catch(Exception $ex)
        {
            throw new Exception($ex->getMessage());
        }
    }

    public function putBorrow() : void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['telefon']) && isset($_POST['fk_video'])) {
                $this->borrow->name = trim(htmlspecialchars($_POST['name']));
                $this->borrow->email = trim(htmlspecialchars($_POST['email']));
                $this->borrow->video = $_POST['fk_video'];

                if (is_numeric($_POST['telefon'])) {
                    $this->borrow->telefon = trim(htmlspecialchars($_POST['telefon']));
                }

                $this->borrow->updateBorrow();
            }
        }
    }

    public function updateBorrow() : void 
    {
        require 'app/Views/addborrow.view.php';
    }
}
