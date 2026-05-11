<?php

include "db.php";

// сообщение

$message = "";

// удаление записи

if (isset($_GET['delete_id'])) {

    $delete_id = $_GET['delete_id'];

    // получаем запись

    $find = $db->query("
        SELECT *
        FROM notebook
        WHERE id = '$delete_id'
    ");

    $person = $find->fetchArray(SQLITE3_ASSOC);

    // если запись существует

    if ($person) {

        // удаляем запись

        $db->exec("
            DELETE FROM notebook
            WHERE id = '$delete_id'
        ");

        // сообщение

        $message = "
        <p class='success'>
            Запись с фамилией
            {$person['surname']}
            удалена
        </p>
        ";
    }
}

// вывод сообщения

echo $message;

// список записей

$list = $db->query("
    SELECT *
    FROM notebook
    ORDER BY surname ASC
");

// если записей нет

$has_records = false;

while ($row = $list->fetchArray(SQLITE3_ASSOC)) {

    $has_records = true;

    // первая буква имени

    $initial = mb_substr($row['name'], 0, 1);

    echo "

    <div style='margin-bottom:15px;'>

        <a

        class='delete-link'

        href='index.php?page=delete&delete_id={$row['id']}'
        >

            {$row['surname']} {$initial}.

        </a>

    </div>
    ";
}

// если записей нет

if (!$has_records) {

    echo "
    <p>
        Нет записей для удаления
    </p>
    ";
}
?>