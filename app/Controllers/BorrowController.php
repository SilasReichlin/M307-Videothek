<?php
class BorrowController
{
    private Borrow $borrow = new Borrow();

    public function index()
    {
        $borrows = $this->borrow->getAllBorrows();

        require '';
    }
}
