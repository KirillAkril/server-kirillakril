<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">

    <title><?= $title ?></title>
</head>

<body>

<h1>Редактирование статьи</h1>

<form method="post">

    <p>
        Название статьи
    </p>

    <input
        type="text"
        name="name"
        value="<?= $article['name'] ?>"
    >

    <br><br>

    <p>
        Текст статьи
    </p>

    <textarea
        name="text"
        rows="10"
        cols="60"
    ><?= $article['text'] ?></textarea>

    <br><br>

    <button type="submit">
        Сохранить
    </button>

</form>

</body>
</html>