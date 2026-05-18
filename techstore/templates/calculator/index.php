<?php

$title = 'Калькулятор';

ob_start();

?>

<h1>

    Калькулятор скидки

</h1>

<form
    method="POST"
    class="calculator-form"
>

    <label>

        Цена товара

    </label>

    <input
        type="number"
        name="price"
        id="price"
        required
    >

    <br><br>

    <label>

        Скидка (%)

    </label>

    <input
        type="number"
        name="discount"
        id="discount"
        required
    >

    <br><br>

    <button type="submit">

        Рассчитать

    </button>

</form>

<div class="calculator-preview">

    Итоговая цена:

    <span id="preview-result">

        0 ₽

    </span>

</div>

<?php if (isset($result)): ?>

    <div class="calculator-result">

        Итоговая цена со скидкой:

        <strong>

            <?= $result ?> ₽

        </strong>

    </div>

<?php endif; ?>

<script src="/js/calculator.js"></script>

<?php

$content = ob_get_clean();

require __DIR__ . '/../layout/main.php';