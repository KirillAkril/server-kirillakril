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
        // получаем комментарии статьи

        $comments = $this->db->query(

            'SELECT comments.*,
                    users.nickname

            FROM comments

            JOIN users
            ON users.id = comments.author_id

            WHERE article_id = :article_id

            ORDER BY comments.id DESC',

            [
                ':article_id' => $id
            ]
        );
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
        // выводим комментарии

        $content .= '

            <h2>Комментарии</h2>
        ';

        // если комментариев нет

        if ($comments === []) {

            $content .= '

                <p>
                    Комментариев пока нет
                </p>
            ';
        }

        // перебираем комментарии

        foreach ($comments as $comment) {

            $content .= '

                <div id="comment' . $comment['id'] . '">

                    <hr>

                    <p>

                        <b>' . $comment['nickname'] . '</b>

                    </p>

                    <p>

                        ' . $comment['text'] . '

                    </p>

                    <a href="?route=comment/' . $comment['id'] . '/edit">

                        Редактировать

                    </a>

                </div>
            ';
        }
        // форма добавления комментария

        $content .= '

            <hr>

            <h2>Добавить комментарий</h2>

            <form method="POST"

                action="?route=article/' . $article['id'] . '/comments">

                <p>

                    <textarea
                        name="text"
                        rows="5"
                        cols="60"
                        required
                    ></textarea>

                </p>

                <p>

                    <button type="submit">

                        Отправить комментарий

                    </button>

                </p>

            </form>
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
// добавление комментария

public function addComment(int $articleId)
{
    // текст комментария

    $text = $_POST['text'] ?? '';

    // если пусто

    if ($text === '') {

        echo 'Введите комментарий';

        return;
    }

    // добавляем комментарий

    $this->db->query(

        'INSERT INTO comments (

            author_id,
            article_id,
            text

        ) VALUES (

            :author_id,
            :article_id,
            :text
        )',
        
        [
            // пока автор всегда 1

            ':author_id' => 1,

            ':article_id' => $articleId,

            ':text' => $text
        ]
        
    );
    // получаем id нового комментария

    $result = $this->db->query(

        'SELECT last_insert_rowid() AS id'
    );

    // сохраняем id комментария

    $commentId = $result[0]['id'];

    // возвращаем пользователя к статье
    // и сразу к новому комментарию

    header(

        'Location: ?route=article/'
        . $articleId
        . '#comment'
        . $commentId
    );
    exit;
}
// редактирование комментария

public function editComment(int $commentId)
{
    // получаем комментарий

    $result = $this->db->query(

        'SELECT * FROM comments
         WHERE id = :id',

        [
            ':id' => $commentId
        ]
    );

    // если комментарий не найден

    if ($result === []) {

        echo 'Комментарий не найден';

        return;
    }

    // берем комментарий

    $comment = $result[0];

    // если форма отправлена

    if (!empty($_POST)) {

        // обновляем комментарий

        $this->db->query(

            'UPDATE comments

             SET text = :text

             WHERE id = :id',

            [
                ':text' => $_POST['text'],
                ':id' => $commentId
            ]
        );

        echo '

            <h2>Комментарий обновлен!</h2>

            <a href="?route=article/' . $comment['article_id'] . '">

                Вернуться к статье

            </a>
        ';

        return;
    }

    // title страницы

    $title = 'Редактирование комментария';

    // html страницы

    $content = '

        <h1>Редактирование комментария</h1>

        <form method="POST">

            <p>

                <textarea
                    name="text"
                    rows="5"
                    cols="60"
                    required
                >' . $comment['text'] . '</textarea>

            </p>

            <p>

                <button type="submit">

                    Сохранить

                </button>

            </p>

        </form>
    ';

    include 'main.php';
}
}