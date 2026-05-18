<?php

$title = 'Каталог товаров';

ob_start();

?>

<h1>Каталог товаров</h1>
<form
    method="GET"
    class="search-form"
>

    <input
        type="hidden"
        name="route"
        value="products"
    >

    <input
    type="text"
    name="search"
    placeholder="Поиск товаров..."
    value="<?= htmlspecialchars($search ?? '') ?>"
    >

    <select name="sort">

        <option
            value="newest"
            <?= ($_GET['sort'] ?? '') === 'newest' ? 'selected' : '' ?>
        >
            Сначала новые
        </option>

        <option
            value="oldest"
            <?= ($_GET['sort'] ?? '') === 'oldest' ? 'selected' : '' ?>
        >
            Сначала старые
        </option>

        <option
            value="price_asc"
            <?= ($_GET['sort'] ?? '') === 'price_asc' ? 'selected' : '' ?>
        >
            Цена ↑
        </option>

        <option
            value="price_desc"
            <?= ($_GET['sort'] ?? '') === 'price_desc' ? 'selected' : '' ?>
        >
            Цена ↓
        </option>

        <option
            value="title"
            <?= ($_GET['sort'] ?? '') === 'title' ? 'selected' : '' ?>
        >
            По названию
        </option>

    </select>

    <button type="submit">

        Найти

    </button>

</form>
<?php foreach ($products as $product): ?>

            <a
    class="product-link"
    href="/?route=product&id=<?= $product['id'] ?>"
>

    <div class="product-card">

        <?php if (!empty($product['image'])): ?>

            <div class="product-image-wrapper">

                <img
                    src="<?= $product['image'] ?>"
                    class="product-image"
                >

            </div>

        <?php endif; ?>

        <div class="product-info">

            <h2>

                <?= $product['title'] ?>

            </h2>

            <p>

                <?= $product['description'] ?>

            </p>

            <div class="price">

                <?= $product['price'] ?> ₽

            </div>

        </div>

    </div>

</a>


<?php endforeach; ?>
<div class="pagination">

    <?php for ($i = 1; $i <= $totalPages; $i++): ?>

        <a
            href="/?route=products&page=<?= $i ?>&sort=<?= $sort ?>"
            class="
                pagination-link

                <?= $page == $i ? 'active-page' : '' ?>
            "
        >

            <?= $i ?>

        </a>

    <?php endfor; ?>

</div>
<?php

$content = ob_get_clean();

require __DIR__ . '/../layout/main.php';
