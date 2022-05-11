<?php
include 'app/Models/borrow.php';
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
        $borrow = new Borrow();
        require 'app/Views/createborrow.view.php';
    }


    public function edit(): void
    {
        $borrow = new Borrow();
        $borrow = $borrow->getBorrowById($_GET['id']);
        $borrow->borrowdate = date_create($borrow->borrowdate)->format('Y-m-d');
        require 'app/Views/createborrow.view.php';
    }


    public function upsert(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($_GET['id'] != '' && $_GET['id'] != '0') {
                $this->borrow->id = $_GET['id'];
                $this->borrow->name = trim(htmlspecialchars($_POST['name']));
                $this->borrow->email = trim(htmlspecialchars($_POST['email']));
                $this->borrow->video = htmlspecialchars($_POST['video']);
                $this->borrow->membership = trim(htmlspecialchars($_POST['status']));
                $this->borrow->borrowdate = htmlspecialchars($_POST['date']);
                $errors = $this->ValidateBorrow();

                if (count($errors) == 0) {
                    $this->borrow->updateBorrow();
                    header('Location: borrow');
                } else {
                    $borrow = $this->borrow;
                    require 'app/Views/createborrow.view.php';
                }
            } else {
                $this->borrow->name = trim(htmlspecialchars($_POST['name']));
                $this->borrow->email = trim(htmlspecialchars($_POST['email']));
                $this->borrow->video = htmlspecialchars($_POST['video']);
                $this->borrow->membership = trim(htmlspecialchars($_POST['status']));
                $this->borrow->borrowdate = htmlspecialchars($_POST['date']);
                $this->borrow->borrowstate = false;
                $errors = $this->ValidateBorrow();

                if (count($errors) == 0) {
                    $this->borrow->createBorrow();
                    header('Location: borrow');
                } else {
                    $borrow = $this->borrow;
                    require 'app/Views/createborrow.view.php';
                }
            }
        }
    }

    private function ValidateBorrow(): array
    {
        $errors = [];

        if (strlen($this->borrow->name) < 1) {
            array_push($errors, "Name muss mindestens 1 Zeichen beinhalten.");
        }

        if (!filter_var($this->borrow->email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "Invalide Email");
        }

        $movie = $this->movie->getMovie($this->borrow->video);

        if (empty($movie)) {
            array_push($errors, "Film existiert nicht.");
        } else {
            $videos = $this->movie->getMovie($this->borrow->video);
            $this->borrow->videoid = reset($videos)['id'];
        }

        $membership = $this->membership->getMemberShip($this->borrow->membership);

        if (empty($membership)) {
            array_push($errors, "Membership existiert nicht.");
        } else {
            $memberships = $this->membership->getMemberShip($this->borrow->membership);
            $this->borrow->membershipid = reset($memberships)['id'];
        }

        return $errors;
    }
}
