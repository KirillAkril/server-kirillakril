<?php

$url = "https://httpbin.org/post";

$headers = get_headers($url);

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Headers</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header>

        <img src="Logo_Polytech_rus_main.jpg" alt="Логотип" class="logo">

        <h1>
            Результат get_headers
        </h1>

    </header>

    <main>

        <textarea rows="15" cols="100">

<?php

foreach ($headers as $header) {

    echo $header . "\n";

}

?>

        </textarea>

    </main>

    <footer>
        Задание для самостоятельной работы
    </footer>

</body>
</html>