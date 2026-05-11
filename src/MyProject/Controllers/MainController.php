<?php

namespace MyProject\Controllers;

// главный контроллер

class MainController
{
    // главная страница

    public function main()
{
    // title страницы

    $title = 'Главная страница';

    // контент страницы

    $content = '
        <h2>Статья 1</h2>
        <p>Это текст первой статьи</p>
        <hr>

        <h2>Статья 2</h2>
        <p>Это текст второй статьи</p>
    ';

    include 'main.php';
}

    // страница "о себе"

    public function aboutMe()
{
    // title страницы

    $title = 'Обо мне';

    // контент страницы

    $content = '
        <h2>Обо мне</h2>

        <p>
            Меня зовут Кирилл
        </p>
    ';

    include 'main.php';
}

    // новый экшн

    public function sayBye(string $name)
    {
        echo 'Пока, ' . $name;
    }

    // страница приветствия

    public function hello(string $name)
    {
        // title страницы

        $title = 'Страница приветствия';

        // контент страницы

        $content = '
            <h2>Приветствие</h2>

            <p>
                Привет, ' . $name . '!
            </p>
        ';

        include 'main.php';
    }
}
?>