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

    public function getBorrowById($id): Borrow
    {
        $borrows = $this->borrow->getAllBorrows();
        $searchedborrow = new Borrow;
        foreach ($borrows as $b) {
            if ($b['id'] == $id) {
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

    public function create(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->borrow->name = trim(htmlspecialchars($_POST['name']));
            $this->borrow->email = trim(htmlspecialchars($_POST['email']));
            $this->borrow->telefon = htmlspecialchars($_POST['telefon']);
            $this->borrow->videoid = htmlspecialchars($_POST['fk_video']);
            $errors = [];
            $errors = $this->ValidateBorrow();

            if (count($errors) == 0) {
                $this->borrow->createBorrow();
            } else
            {
                require '';
            }
        }
    }

    public function edit(): void
    {
    }

    public function update(): void
    {
    }
    public function postBorrow(): void
    {
        try {
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
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }

    public function aBorrow(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'PUT')
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

    private function ValidateBorrow(): array
    {
        $errors = [];

        if (strlen($this->borrow->name) < 1) {
            $errors[] = "Name muss mindestens zwei Zeichen beinhalten.";
        }
        if (preg_replace("/[^\+\-(\)\  0-9]/", '', $this->borrow->telefon) != $this->borrow->telefon) {
            $errors[] = "Invalide Telefonnummer";
        }
        if (!filter_var($this->borrow->email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalide Email";
        }
        if (!is_numeric($this->borrow->movieid < 1)) {
            $errors[] = "Invalider Film";
        }

        return $errors;
    }
}
