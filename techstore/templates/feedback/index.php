<?php

$title = 'Обратная связь';

ob_start();

?>

<h1>

    Обратная связь

</h1>

<?php if (!empty($success)): ?>

    <div class="success-message">

        Сообщение успешно отправлено

    </div>

<?php endif; ?>

<form
    method="POST"
    class="feedback-form"
>

    <label>

        Ваше имя

    </label>

    <input
        type="text"
        name="name"
        required
    >

    <br><br>

    <label>

        Email

    </label>

    <input
        type="email"
        name="email"
        required
    >

    <br><br>

    <label>

        Тип обращения

    </label>

    <select name="type">

        <option>

            Жалоба

        </option>

        <option>

            Предложение

        </option>

        <option>

            Благодарность

        </option>

    </select>

    <br><br>

    <label>

        Сообщение

    </label>

    <textarea
        name="message"
        required
    ></textarea>

    <br><br>

    <label>

        Способ ответа

    </label>

    <div class="checkbox-group">

        <label>

            <input
                type="checkbox"
                name="reply[]"
                value="Email"
            >

            Email

        </label>

        <label>

            <input
                type="checkbox"
                name="reply[]"
                value="SMS"
            >

            SMS

        </label>

    </div>

    <br>

    <button type="submit">

        Отправить

    </button>

</form>

<?php

$content = ob_get_clean();

require __DIR__ . '/../layout/main.php';