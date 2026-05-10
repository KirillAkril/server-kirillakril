<?php

$equation = "10 + X = 33";

$operator = "+";
$position = "X находится справа от оператора";

$number = 10;
$result = 33;

$x = $result - $number;

?>

<!DOCTYPE html>
<html lang="ru">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Решение уравнения Демченко Кирилл 251-3210
    </title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<header>

    <img
        src="Logo_Polytech_rus_main.jpg"
        alt="Логотип"
        class="logo"
    >

    <h1>
        Решение уравнения
    </h1>

</header>

<main>

    <form>

        <label>
            Заданное уравнение
        </label>

        <textarea rows="3" readonly>
10 + X = 33
        </textarea>

        <label>
            Оператор
        </label>

        <textarea rows="2" readonly>
<?= $operator ?>
        </textarea>

        <label>
            Расположение неизвестной переменной
        </label>

        <textarea rows="2" readonly>
<?= $position ?>
        </textarea>

        <label>
            Решение
        </label>

        <textarea rows="3" readonly>
X = <?= $result ?> - <?= $number ?>
        </textarea>

        <label>
            Ответ
        </label>

        <textarea rows="2" readonly>
X = <?= $x ?>
        </textarea>

    </form>

</main>

<footer>
    Задание для самостоятельной работы
</footer>

</body>
</html>