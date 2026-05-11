<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>

    <?php

    // если title передан

    if (isset($title)) {

        echo $title;
    }
    else {

        // title по умолчанию

        echo 'Мой блог';
    }

    ?>

</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>

<table class="layout">
    <tr>
        <td colspan="2" class="header">
            Мой блог
        </td>
    </tr>
    <tr>
        <td>
            <?php

                // выводим контент страницы

                echo $content;

                ?>
        </td>

        <td width="300px" class="sidebar">
            <div class="sidebarHeader">Меню</div>
            <ul>
                <li>
    <a href="?route=">
        Главная страница
    </a>
</li>

<li>
    <a href="?route=about-me">
        Обо мне
    </a>
</li>
            </ul>
        </td>
    </tr>
    <tr>
        <td class="footer" colspan="2">Все права защищены (c) Мой блог</td>
    </tr>
</table>

</body>
</html>