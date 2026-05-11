<?php

// функция меню

function showMenu()
{
    // текущая страница

    $page = $_GET['page'] ?? 'view';

    $html = '<div class="menu">';

    // основные пункты меню

    $items = [
        'view' => 'Просмотр',
        'add' => 'Добавление записи',
        'edit' => 'Редактирование записи',
        'delete' => 'Удаление записи'
    ];

    foreach ($items as $key => $value) {

        $class = ($page == $key) ? 'active' : '';

        $html .= "
        <a class='$class'
        href='index.php?page=$key'>
            $value
        </a>
        ";
    }

    $html .= "</div>";

    // дополнительное меню сортировки

    if ($page == 'view') {

        $sort = $_GET['sort'] ?? 'created';

        $html .= '<div class="submenu">';

        $sorts = [
            'created' => 'По добавлению',
            'surname' => 'По фамилии',
            'birthdate' => 'По дате рождения'
        ];

        foreach ($sorts as $key => $value) {

            $class = ($sort == $key) ? 'active' : '';

            $html .= "
            <a class='$class'
            href='index.php?page=view&sort=$key'>
                $value
            </a>
            ";
        }

        $html .= "</div>";
    }

    return $html;
}
?>