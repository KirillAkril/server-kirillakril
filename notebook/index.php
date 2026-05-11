<?php

include "menu.php";

// текущая страница

$page = $_GET['page'] ?? 'view';
?>

<!DOCTYPE html>

<html lang="ru">

<head>

    <meta charset="UTF-8">

    <title>Notebook</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<header>

    <img
        src="Logo_Polytech_rus_main.jpg"
        class="logo"
    >

    <h1>Записная книжка</h1>

</header>

<main>

<?php

// вывод меню

echo showMenu();

// подключение модулей

if ($page == 'add') {

    include "add.php";
}
elseif ($page == 'edit') {

    include "edit.php";
}
elseif ($page == 'delete') {

    include "delete.php";
}
else {

    include "viewer.php";

    $sort = $_GET['sort'] ?? 'created';

    $p = $_GET['p'] ?? 1;

    echo showViewer($sort, $p);
}
?>

</main>

<footer>

    Задание для самостоятельной работы

</footer>

</body>
</html>