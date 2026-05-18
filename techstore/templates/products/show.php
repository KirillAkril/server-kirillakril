<?php

$title = $product['title'];

ob_start();

?>

<div class="single-product">

    <div class="single-product-image">

        <?php if (!empty($product['image'])): ?>

            <img
                src="<?= $product['image'] ?>"
                alt="<?= $product['title'] ?>"
            >

        <?php endif; ?>

    </div>

    <div class="single-product-info">

        <h1>

            <?= $product['title'] ?>

        </h1>

        <p class="single-product-description">

            <?= $product['description'] ?>

        </p>

        <div class="single-product-price">

            <?= $product['price'] ?> ₽

        </div>
        <?php if (!empty($_SESSION['admin'])): ?>
            <div class="single-product-buttons">

            <a
                class="edit-button"
                href="/?route=products/edit&id=<?= $product['id'] ?>"
            >

                Редактировать

            </a>
            <a
                class="delete-button"
                href="/?route=products/delete&id=<?= $product['id'] ?>"
                onclick="return confirm('Удалить товар?')"
            >

                Удалить

            </a>
        </div>
        <?php endif; ?>

    </div>

</div>

<h2 class="reviews-title">

    Отзывы

</h2>

<?php foreach ($reviews as $review): ?>

    <div class="review-card">

        <div class="review-header">

            <strong>

                <?= $review['author'] ?>

            </strong>

            <span>

                <?= $review['created_at'] ?>

            </span>

        </div>

        <p>

            <?= $review['text'] ?>

        </p>

    </div>

<?php endforeach; ?>

<form method="POST" class="review-form">

    <input
        type="text"
        name="author"
        placeholder="Ваше имя"
        required
    >

    <br><br>

    <textarea
        name="text"
        placeholder="Отзыв"
        required
    ></textarea>

    <br><br>

    <button type="submit">

        Отправить

    </button>

</form>

<?php

$content = ob_get_clean();

require __DIR__ . '/../layout/main.php';