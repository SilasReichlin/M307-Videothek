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
        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['telefon']) && isset($_POST['fk_video']))
            {
                $this->borrow->createBorrow();
            }
        }
    }
}
