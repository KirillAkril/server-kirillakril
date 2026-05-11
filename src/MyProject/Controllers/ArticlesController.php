<?php

namespace MyProject\Controllers;

use MyProject\Services\Db;

// контроллер статей

class ArticlesController
{
    private $db;

    public function __construct()
    {
        $this->db = new Db();
    }

    // страница статьи

    public function show(int $id)
    {
        // получаем статью

        $result = $this->db->query(

            'SELECT * FROM articles
             WHERE id = :id',

            [
                ':id' => $id
            ]
        );

        // если статьи нет

        if ($result === []) {

            echo 'Статья не найдена';

            return;
        }

        // берем статью

        $article = $result[0];

        // получаем автора статьи

        $result = $this->db->query(

            'SELECT * FROM users
             WHERE id = :id',

            [
                ':id' => $article['author_id']
            ]
        );

        // берем автора

        $author = $result[0];

        // title страницы

        $title = $article['name'];

        // html статьи

        $content = '

            <h1>' . $article['name'] . '</h1>

            <p>' . $article['text'] . '</p>

            <hr>

            <p>

                <b>Автор:</b>

                ' . $author['nickname'] . '

            </p>
        ';

        include 'main.php';
    }
}