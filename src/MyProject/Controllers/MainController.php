<?php

namespace MyProject\Controllers;

use MyProject\Services\Db;
// главный контроллер

class MainController
{
    private $db;
    public function __construct()
{
    // подключаем базу данных

    $this->db = new Db();
}
    // главная страница

    public function main()
{
    // получаем статьи из базы

    $articles = $this->db->query(
        'SELECT * FROM articles'
    );

    // title страницы

    $title = 'Мой блог';

    // сюда будем складывать html статей

    $content = '';

    // перебираем все статьи

    foreach ($articles as $article) {

        $content .= '

            <h2>' . $article['name'] . '</h2>

            <p>' . $article['text'] . '</p>

            <a href="?route=article/' . $article['id'] . '">
                Читать статью
            </a>

            <br><br>

            <a href="?route=article/' . $article['id'] . '/edit">
                Редактировать статью
            </a>

            <hr>
        ';
    }

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