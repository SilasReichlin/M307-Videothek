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
        $borrow = $this->borrow;
        require 'app/Views/borrow.view.php';
    }

    public function new(): void
    {
        require 'app/Views/createborrow.view.php';
    }

    public function create(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->borrow->name = trim(htmlspecialchars($_POST['name']));
            $this->borrow->email = trim(htmlspecialchars($_POST['email']));
            $this->borrow->phone = htmlspecialchars($_POST['telefon']);
            $this->borrow->video = htmlspecialchars($_POST['video']);
            $this->borrow->membership = htmlspecialchars($_POST['status']);

            $errors = [];
            $errors = $this->ValidateBorrow();

            if (count($errors) == 0) {
                $this->borrow->createBorrow();
            } else {
                require 'app/Views/createborrow.view.php';
            }
        }

        require 'app/Views/borrow.view.php';
    }

    public function edit(): void
    {
        $borrow = new Borrow();
        $borrow = $borrow->getBorrowById($_GET['id']);
        require 'app/Views/borrow.view.php';
    }

    public function update(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['id'] != '') {
            $this->borrow->name = trim(htmlspecialchars($_POST['name']));
            $this->borrow->email = trim(htmlspecialchars($_POST['email']));
            $this->borrow->phone = htmlspecialchars($_POST['telefon']);
            $this->borrow->video = htmlspecialchars($_POST['video']);
            $errors = [];
            $errors = $this->ValidateBorrow();

            if (count($errors) == 0) {
                $this->borrow->updateBorrow();
            } else {
                require 'app/Views/borrow.view.php';
            }
        }
    }

    private function ValidateBorrow(): array
    {
        $errors = [];

        if (strlen($this->borrow->name) < 1) {
            $errors[] = "Name muss mindestens zwei Zeichen beinhalten.";
        }
        if (preg_replace("/[^\+\-(\)\  0-9]/", '', $this->borrow->phone) != $this->borrow->phone) {
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
