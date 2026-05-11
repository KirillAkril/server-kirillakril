<?php

// подключаем sqlite базу
// если файла нет — sqlite создаст его автоматически

$pdo = new PDO('sqlite:blog.db');



// создаем таблицу пользователей

$pdo->exec('

    CREATE TABLE IF NOT EXISTS users (

        id INTEGER PRIMARY KEY AUTOINCREMENT,

        nickname TEXT

    )

');



// создаем таблицу статей

$pdo->exec('

    CREATE TABLE IF NOT EXISTS articles (

        id INTEGER PRIMARY KEY AUTOINCREMENT,

        author_id INTEGER,

        name TEXT,

        text TEXT

    )

');



// проверяем есть ли пользователи

$users = $pdo->query('SELECT * FROM users')->fetchAll();



// если база пустая — добавляем данные

if (count($users) === 0) {

    // добавляем пользователей

    $pdo->exec("

        INSERT INTO users (nickname)

        VALUES ('admin')

    ");

    $pdo->exec("

        INSERT INTO users (nickname)

        VALUES ('kirill')

    ");



    // добавляем статьи

    $pdo->exec("

        INSERT INTO articles (author_id, name, text)

        VALUES (

            1,

            'Статья №1',

            'Это текст первой статьи'

        )

    ");



    $pdo->exec("

        INSERT INTO articles (author_id, name, text)

        VALUES (

            2,

            'Статья №2',

            'Это текст второй статьи'

        )

    ");
}



// берем id статьи из url

$articleId = $_GET['id'] ?? 1;



// получаем статью

$statement = $pdo->prepare('

    SELECT * FROM articles

    WHERE id = :id

');

$statement->execute([

    ':id' => $articleId

]);

$article = $statement->fetch();



// если статьи нет

if (!$article) {

    echo 'Статья не найдена';

    exit;
}



// получаем автора статьи

$statement = $pdo->prepare('

    SELECT * FROM users

    WHERE id = :id

');

$statement->execute([

    ':id' => $article['author_id']

]);

$author = $statement->fetch();

?>

<!DOCTYPE html>
<html lang="ru">

<head>

    <meta charset="UTF-8">

    <title>
        <?= $article['name'] ?>
    </title>

</head>

<body>

    <!-- заголовок статьи -->

    <h1>
        <?= $article['name'] ?>
    </h1>



    <!-- текст статьи -->

    <p>
        <?= $article['text'] ?>
    </p>



    <!-- автор статьи -->

    <p>

        <b>Автор:</b>

        <?= $author['nickname'] ?>

    </p>

</body>

</html>