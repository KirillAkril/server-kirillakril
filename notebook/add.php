<?php

include "db.php";

// сообщение после добавления

$message = "";

// добавление записи

if ($_SERVER['REQUEST_METHOD'] == 'POST'
    && isset($_POST['add_record'])) {

    // получаем данные из формы

    $surname = $_POST['surname'];

    $name = $_POST['name'];

    $patronymic = $_POST['patronymic'];

    $gender = $_POST['gender'];

    $birthdate = $_POST['birthdate'];

    $phone = $_POST['phone'];

    $address = $_POST['address'];

    $email = $_POST['email'];

    $comment = $_POST['comment'];

    // запрос на добавление

    $query = "
    INSERT INTO notebook (

        surname,
        name,
        patronymic,
        gender,
        birthdate,
        phone,
        address,
        email,
        comment

    )

    VALUES (

        '$surname',
        '$name',
        '$patronymic',
        '$gender',
        '$birthdate',
        '$phone',
        '$address',
        '$email',
        '$comment'
    )
    ";

    $result = $db->exec($query);

    // сообщение об успехе

    if ($result) {

        $message = "
        <p class='success'>
            Запись добавлена
        </p>
        ";
    }
    else {

        $message = "
        <p class='error'>
            Ошибка: запись не добавлена
        </p>
        ";
    }
}
?>

<?php echo $message; ?>

<form method="POST">

    <label>Фамилия</label>

    <input
        type="text"
        name="surname"
        required
    >

    <label>Имя</label>

    <input
        type="text"
        name="name"
        required
    >

    <label>Отчество</label>

    <input
        type="text"
        name="patronymic"
    >

    <label>Пол</label>

    <select name="gender">

        <option>Мужской</option>

        <option>Женский</option>

    </select>

    <label>Дата рождения</label>

    <input
        type="date"
        name="birthdate"
    >

    <label>Телефон</label>

    <input
        type="text"
        name="phone"
    >

    <label>Адрес</label>

    <input
        type="text"
        name="address"
    >

    <label>Email</label>

    <input
        type="email"
        name="email"
    >

    <label>Комментарий</label>

    <textarea
        name="comment"
    ></textarea>

    <button
        type="submit"
        name="add_record"
    >
        Добавить запись
    </button>

</form>