<?php

class CalculatorController
{
    public function index(): void
    {
        $result = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $price = (float) $_POST['price'];

            $discount = (float) $_POST['discount'];

            $result =
                $price -
                ($price * $discount / 100);
        }

        require __DIR__ .
            '/../../templates/calculator/index.php';
    }
}