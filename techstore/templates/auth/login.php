<?php

$title = 'Вход';

ob_start();

?>

<h1>

    Вход администратора

</h1>

<form method="POST">

    <?php if (!empty($error)): ?>

        <div class="error-message">

            <?= $error ?>

        </div>

    <?php endif; ?>

    <input
        type="text"
        name="login"
        placeholder="Логин"
        required
    >

    <br><br>

    <input
        type="password"
        name="password"
        placeholder="Пароль"
        required
    >

    <br><br>

    <button type="submit">

        Войти

    </button>

</form>

<?php

$content = ob_get_clean();

require __DIR__ . '/../layout/main.php';