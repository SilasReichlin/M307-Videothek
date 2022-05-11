<?php
include 'app/Models/Borrow.php';
include 'app/Models/movie.php';
include 'app/Models/membership.php';

class BorrowController
{
    private Borrow $borrow;
    private Movie $movie;
    private Membership $membership;

    public function __construct()
    {
        $this->borrow = new Borrow();
        $this->movie = new Movie();
        $this->membership = new Membership();
    }

    public function index()
    {
        $this->borrow = new Borrow();
        $this->movie = new Movie();
        $this->membership = new Membership();
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
            $this->borrow->membership = trim(htmlspecialchars($_POST['status']));
            $this->borrow->borrowdate = htmlspecialchars($_POST['date']);
            $this->borrow->borrowstate = false;
            $errors = $this->ValidateBorrow();

            if (empty($errors) == 0) {
                $this->borrow->createBorrow();
            } else {
                require 'app/Views/createborrow.view.php';
            }
        }

        header('Location: borrow');
    }

    public function edit(): void
    {
        $borrow = new Borrow();
        $borrow = $borrow->getBorrowById($_GET['id']);
        require 'app/Views/createborrow.view.php';
    }


    public function upsert(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($_POST['id'] != '') {
                $this->borrow->name = trim(htmlspecialchars($_POST['name']));
                $this->borrow->email = trim(htmlspecialchars($_POST['email']));
                $this->borrow->phone = htmlspecialchars($_POST['telefon']);
                $this->borrow->video = htmlspecialchars($_POST['video']);
                $this->borrow->membership = trim(htmlspecialchars($_POST['status']));
                $this->borrow->borrowdate = htmlspecialchars($_POST['date']);
                $errors = $this->ValidateBorrow();

                if (count($errors) == 0) {
                    $this->borrow->updateBorrow();
                } else {
                    require 'app/Views/borrow.view.php';
                }
            } else {
                $this->borrow->name = trim(htmlspecialchars($_POST['name']));
                $this->borrow->email = trim(htmlspecialchars($_POST['email']));
                $this->borrow->phone = htmlspecialchars($_POST['telefon']);
                $this->borrow->video = htmlspecialchars($_POST['video']);
                $this->borrow->membership = trim(htmlspecialchars($_POST['status']));
                $this->borrow->borrowdate = htmlspecialchars($_POST['date']);
                $this->borrow->borrowstate = false;
                $errors = $this->ValidateBorrow();

                if (empty($errors) == 0) {
                    $this->borrow->createBorrow();
                } else {
                    require 'app/Views/createborrow.view.php';
                }
            }
        }

        header('Location: borrow');
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

        if (strlen($this->borrow->name) > 1) {
            array_push($errors, "Name muss mindestens zwei Zeichen beinhalten.");
        }

        if (!filter_var($this->borrow->email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "Invalide Email");
        }

        $movie = $this->movie->getMovie($this->borrow->video);

        if (empty($movie)) {
            array_push($errors, "Film existiert nicht.");
        } else {
            $this->borrow->videoid = reset($this->movie->getMovie($this->borrow->video))['id'];
        }

        $membership = $this->membership->getMemberShip($this->borrow->membership);

        if (empty($membership)) {
            array_push($errors, "Membership existiert nicht.");
        } else {
            $this->borrow->membershipid = reset($this->membership->getMemberShip($this->borrow->membership))['id'];
        }

        return $errors;
    }
}
