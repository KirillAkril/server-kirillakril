<?php

$title = 'Редактирование товара';

ob_start();

?>

<h1>Редактирование товара</h1>

<?php if (!empty($error)): ?>

    <div class="error-message">

        <?= $error ?>

    </div>

<?php endif; ?>

<form
    method="POST"
    enctype="multipart/form-data"
>

    <label>

        Название товара

    </label>

    <input
        type="text"
        name="title"
        value="<?= htmlspecialchars($product['title']) ?>"
    >

    <br><br>

    <label>

        Описание товара

    </label>

    <textarea
        name="description"
    ><?= htmlspecialchars($product['description']) ?></textarea>

    <br><br>

    <label>

        Цена товара

    </label>

    <input
        type="number"
        name="price"
        value="<?= $product['price'] ?>"
    >

    <br><br>

    <?php if (!empty($product['image'])): ?>

        <label>

            Текущая картинка

        </label>

        <br><br>

        <img
            src="<?= $product['image'] ?>"
            class="edit-product-image"
        >

        <br><br>

    <?php endif; ?>

    <label>

        Загрузить новую картинку

    </label>

    <input
        type="file"
        name="image"
        accept="image/*"
    >

    <br><br>

    <button type="submit">

        Сохранить

    </button>

</form>

<?php

$content = ob_get_clean();

require __DIR__ . '/../layout/main.php';