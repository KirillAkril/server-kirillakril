<?php

namespace MyProject\Controllers;

// главный контроллер

class MainController
{
    // главная страница

    public function main()
    {
        include 'main.php';
    }

    // страница "о себе"

    public function aboutMe()
    {
        echo 'Это страница обо мне';
    }

    // новый экшн

    public function sayBye(string $name)
    {
        echo 'Пока, ' . $name;
    }
}
?>