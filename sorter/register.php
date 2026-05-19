<?php

include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);

    $password = password_hash(
        $_POST["password"],
        PASSWORD_DEFAULT
    );

    $stmt = $db->prepare("
        INSERT INTO Users(name,email,password)
        VALUES(?,?,?)
    ");

    $stmt->execute([
        $name,
        $email,
        $password
    ]);

    header("Location: login.php");
    exit();
}

include "partials/header.php";
?>

<div class="card p-4 shadow mx-auto"
     style="max-width:500px;">

    <h2 class="mb-4">
        Регистрация
    </h2>

    <form method="POST">

        <input class="form-control mb-3"
               name="name"
               placeholder="Имя"
               required>

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

        <button class="btn btn-success w-100">
            Зарегистрироваться
        </button>

    </form>

    <a href="login.php"
       class="mt-3">
       Уже есть аккаунт?
    </a>

</div>

<?php include "partials/footer.php"; ?>