<?php

$title = 'Добавление товара';

ob_start();

?>

<h1>Добавить товар</h1>

<form method="POST" enctype="multipart/form-data">

    <input
        type="text"
        name="title"
        placeholder="Название товара"
        required
    >

    <br><br>

    <textarea
        name="description"
        placeholder="Описание"
        required
    ></textarea>

    <br><br>

    <input
        type="number"
        name="price"
        placeholder="Цена"
        required
    >

    <br><br>
    <input
    type="file"
    name="image"
    accept="image/*"
    >

    <br><br>
    <button type="submit">

        Добавить

    </button>

</form>

<?php if (!empty($message)): ?>

    <p>

        <?= $message ?>

    </p>

<?php endif; ?>

<?php

$content = ob_get_clean();

require __DIR__ . '/../layout/main.php';