<?php

session_start();

include "db.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    $stmt = $db->prepare("
        SELECT * FROM Users
        WHERE email = ?
    ");

    $stmt->execute([$email]);

    $user = $stmt->fetch();

    if ($user && password_verify($password, $user["password"])) {

        $_SESSION["user_id"] = $user["id"];
        $_SESSION["user_name"] = $user["name"];

        header("Location: messages.php");
        exit();

    } else {

        $error = "Неверный логин или пароль";
    }
}

include "partials/header.php";
?>

<div class="card p-4 shadow mx-auto"
     style="max-width:500px;">

    <h2 class="mb-4">
        Вход
    </h2>

    <?php if($error): ?>

        <div class="alert alert-danger">
            <?= $error ?>
        </div>

    <?php endif; ?>

    <form method="POST">

        <input class="form-control mb-3"
               type="email"
               name="email"
               placeholder="Email"
               required>

        <input class="form-control mb-3"
               type="password"
               name="password"
               placeholder="Пароль"
               required>

        <button class="btn btn-primary w-100">
            Войти
        </button>

    </form>
<div class="mt-3 text-center">

    <a href="register.php">
        Нет аккаунта? Зарегистрироваться
    </a>

</div>
</div>

<?php include "partials/footer.php"; ?>