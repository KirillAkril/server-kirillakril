<?php

include "db.php";

// получаем список записей

$list = $db->query("
    SELECT *
    FROM notebook
    ORDER BY surname ASC, name ASC
");

// текущая запись

$current_id = $_GET['id'] ?? 0;

// если запись не выбрана

if ($current_id == 0) {

    $first = $db->query("
        SELECT id
        FROM notebook
        ORDER BY surname ASC, name ASC
        LIMIT 1
    ");

    $first_row = $first->fetchArray(SQLITE3_ASSOC);

    if ($first_row) {

        $current_id = $first_row['id'];
    }
}

// сохранение изменений

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST'
    && isset($_POST['edit_record'])) {

    $id = $_POST['id'];

    $surname = $_POST['surname'];

    $name = $_POST['name'];

    $patronymic = $_POST['patronymic'];

    $gender = $_POST['gender'];

    $birthdate = $_POST['birthdate'];

    $phone = $_POST['phone'];

    $address = $_POST['address'];

    $email = $_POST['email'];

    $comment = $_POST['comment'];

    // обновление записи

    $query = "
    UPDATE notebook

    SET

        surname = '$surname',

        name = '$name',

        patronymic = '$patronymic',

        gender = '$gender',

        birthdate = '$birthdate',

        phone = '$phone',

        address = '$address',

        email = '$email',

        comment = '$comment'

    WHERE id = '$id'
    ";

    $result = $db->exec($query);

    if ($result) {

        $message = "
        <p class='success'>
            Запись обновлена
        </p>
        ";
    }
    else {

        $message = "
        <p class='error'>
            Ошибка обновления
        </p>
        ";
    }

    $current_id = $id;
}

// вывод сообщений

echo $message;

// список записей

echo "<div style='margin-bottom:30px;'>";

while ($row = $list->fetchArray(SQLITE3_ASSOC)) {

    $class = "";

    if ($row['id'] == $current_id) {

        $class = "selected";
    }

    echo "

<div
    class='$class'
    style='
        margin-bottom:10px;
        padding:10px;
        border-radius:6px;
    '
>

    <a

        href='index.php?page=edit&id={$row['id']}'

        style='
            text-decoration:none;
            color:black;
            font-weight:bold;
        '
    >

        {$row['surname']} {$row['name']}

    </a>

</div>
";
}

echo "</div>";

// текущая запись

$current = $db->query("
    SELECT *
    FROM notebook
    WHERE id = '$current_id'
");

$data = $current->fetchArray(SQLITE3_ASSOC);

// если записей нет

if (!$data) {

    echo "
    <p>
        Нет записей для редактирования
    </p>
    ";

    return;
}
?>

<form method="POST">

    <input
        type="hidden"
        name="id"
        value="<?= $data['id'] ?>"
    >

    <label>Фамилия</label>

    <input
        type="text"
        name="surname"
        value="<?= $data['surname'] ?>"
        required
    >

    <label>Имя</label>

    <input
        type="text"
        name="name"
        value="<?= $data['name'] ?>"
        required
    >

    <label>Отчество</label>

    <input
        type="text"
        name="patronymic"
        value="<?= $data['patronymic'] ?>"
    >

    <label>Пол</label>

    <select name="gender">

        <option
            <?= ($data['gender'] == 'Мужской')
            ? 'selected'
            : '' ?>
        >
            Мужской
        </option>

        <option
            <?= ($data['gender'] == 'Женский')
            ? 'selected'
            : '' ?>
        >
            Женский
        </option>

    </select>

    <label>Дата рождения</label>

    <input
        type="date"
        name="birthdate"
        value="<?= $data['birthdate'] ?>"
    >

    <label>Телефон</label>

    <input
        type="text"
        name="phone"
        value="<?= $data['phone'] ?>"
    >

    <label>Адрес</label>

    <input
        type="text"
        name="address"
        value="<?= $data['address'] ?>"
    >

    <label>Email</label>

    <input
        type="email"
        name="email"
        value="<?= $data['email'] ?>"
    >

    <label>Комментарий</label>

    <textarea
        name="comment"
    ><?= $data['comment'] ?></textarea>

    <button
        type="submit"
        name="edit_record"
    >
        Сохранить изменения
    </button>

</form>