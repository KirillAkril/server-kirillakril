<!DOCTYPE html>
<html lang="ru">
<head>

    <meta charset="UTF-8">

    <title>
        <?= $title ?? 'TechStore' ?>
    </title>

    <link rel="stylesheet" href="/css/style.css">

</head>

<body>

<header class="header">

    <div class="logo">
        TechStore
    </div>

    <nav>

        <a href="/">
    Главная
        </a>

        <a href="/?route=products">
            Товары
        </a>

        <a href="/?route=calculator">
            Калькулятор
        </a>

        
        <?php if (!empty($_SESSION['admin'])): ?>

            <a href="/?route=products/create">

                Добавить товар

            </a>

        <?php endif; ?>
        <?php if (empty($_SESSION['admin'])): ?>

    <a href="/?route=login">

                Вход

            </a>

        <?php else: ?>

            <a href="/?route=logout">

                Выход

            </a>

        <?php endif; ?>
    </nav>

</header>

<main class="container">

    <?= $content ?>

</main>

<footer>

    <div class="footer-content">

        <div>

            © 2025 TechStore

        </div>

        <a href="/?route=feedback">

            Обратная связь

        </a>

    </div>

</footer>

</body>
</html>