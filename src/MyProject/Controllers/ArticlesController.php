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
            <p>

            <a href="?route=article/' . $article['id'] . '/edit">

                Редактировать статью

            </a>

            </p>
        ';

        include 'main.php';
    }
    // редактирование статьи

public function edit(int $id)
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

    // если форма отправлена

    if (!empty($_POST)) {

        // обновляем статью

        $this->db->query(

            'UPDATE articles
             SET name = :name,
                 text = :text
             WHERE id = :id',

            [
                ':name' => $_POST['name'],
                ':text' => $_POST['text'],
                ':id' => $id
            ]
        );

        // обновляем данные статьи
        // чтобы сразу показать новые

        $article['name'] = $_POST['name'];

        $article['text'] = $_POST['text'];

        echo '

    <h2>Статья обновлена!</h2>

    <p>
        Изменения успешно сохранены.
    </p>

    <a href="?route=">
        Вернуться на главную
    </a>

    <br><br>

    <a href="?route=article/' . $id . '">
        Вернуться к статье
    </a>
';
return;
    }

    // title страницы

    $title = 'Редактирование статьи';

    // подключаем html

    include 'edit.php';
}
}