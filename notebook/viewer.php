<?php

include "db.php";

// функция просмотра записей

function showViewer($sort, $page_num)
{
    global $db;

    // количество записей на странице

    $limit = 10;

    // смещение

    $offset = ($page_num - 1) * $limit;

    // сортировка

    if ($sort == 'surname') {

        $order = "surname ASC";
    }
    elseif ($sort == 'birthdate') {

        $order = "birthdate ASC";
    }
    else {

        $order = "created_at ASC";
    }

    // получаем записи

    $result = $db->query("
        SELECT *
        FROM notebook
        ORDER BY $order
        LIMIT $limit
        OFFSET $offset
    ");

    $html = "";

    // таблица

    $html .= "

    <table>

        <tr>

            <th>Фамилия</th>
            <th>Имя</th>
            <th>Отчество</th>
            <th>Пол</th>
            <th>Дата рождения</th>
            <th>Телефон</th>
            <th>Адрес</th>
            <th>Email</th>
            <th>Комментарий</th>

        </tr>
    ";

    // вывод строк

    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {

        $html .= "

        <tr>

            <td>{$row['surname']}</td>

            <td>{$row['name']}</td>

            <td>{$row['patronymic']}</td>

            <td>{$row['gender']}</td>

            <td>{$row['birthdate']}</td>

            <td>{$row['phone']}</td>

            <td>{$row['address']}</td>

            <td>{$row['email']}</td>

            <td>{$row['comment']}</td>

        </tr>
        ";
    }

    $html .= "</table>";

    // считаем количество записей

    $count_result = $db->query("
        SELECT COUNT(*) as total
        FROM notebook
    ");

    $count_row = $count_result->fetchArray(SQLITE3_ASSOC);

    $total = $count_row['total'];

    // количество страниц

    $pages = ceil($total / $limit);

    // пагинация

    if ($pages > 1) {

        $html .= "<div class='pagination'>";

        for ($i = 1; $i <= $pages; $i++) {

            $active = "";

            if ($i == $page_num) {

                $active = "
                style='background-color:#d5001c'
                ";
            }

            $html .= "

            <a

                $active

                href='index.php?page=view&sort=$sort&p=$i'
            >
                $i
            </a>
            ";
        }

        $html .= "</div>";
    }

    return $html;
}
?>