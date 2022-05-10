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

    public function postBorrow()
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
            }
        }
    }
}
