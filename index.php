<?php

$result = "";

// получаем выражение из post запроса
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $expression = $_POST["expression"];

    // разрешенные символы
    if (
        preg_match(
            '/^[0-9+\-*\/().,!^ elogpinsqrt]+$/',
            $expression
        )
    ) {

        // проверки ошибок
        if (

            // два оператора подряд
            preg_match('/[\+\-\*\/\^]{2,}/', $expression)

            ||

            // выражение заканчивается оператором
            preg_match('/[\+\*\/\^]$/', $expression)

            ||

            // разное количество скобок
            substr_count($expression, "(")
            !=
            substr_count($expression, ")")

            ||

            // пустые скобки
            preg_match('/\(\)/', $expression)

            ||

            // число перед скобкой
            preg_match('/\d+\(/', $expression)

            ||

            // скобка перед числом
            preg_match('/\)\d+/', $expression)

            ||

            // ln без числа
            preg_match('/ln\(\)/', $expression)

            ||

            // log без числа
            preg_match('/log\(\)/', $expression)

            ||

            // sqrt без числа
            preg_match('/sqrt\(\)/', $expression)

            ||
            // число после факториала
            preg_match('/!\d+/', $expression)

            ||

            // факториал перед числом
            preg_match('/\d+!\d+/', $expression)
            ||

            // число рядом с e
            preg_match('/\d+e\d*/', $expression)

            ||

            // число рядом с pi
            preg_match('/\d+pi\d*/', $expression)

            ||

            // e рядом с числом
            preg_match('/e\d+/', $expression)

            ||

            // pi рядом с числом
            preg_match('/pi\d+/', $expression)

            ||

            // e рядом с pi
            preg_match('/(epi|pie)/', $expression)

            ||

            // две точки в одном числе
            preg_match('/\d+\.\d+\./', $expression)

            ||

            // оператор сразу после (
            preg_match('/\([\*\/\^\+]/', $expression)

            ||

            // оператор перед )
            preg_match('/[\+\-\*\/\^]\)/', $expression)

        ) {

            $result = "ошибка выражения";

        } else {

            // заменяем константы
            $expression = str_replace(
                "pi",
                pi(),
                $expression
            );

            $expression = str_replace(
                "e",
                exp(1),
                $expression
            );

            // вычисляем выражение
            $result = calculate($expression);

        }

    } else {

        $result = "ошибка ввода";

    }

}

// функция сложения
function add($a, $b) {

    return $a + $b;

}

// функция вычитания
function subtract($a, $b) {

    return $a - $b;

}

// функция умножения
function multiply($a, $b) {

    return $a * $b;

}

// функция деления
function divide($a, $b) {

    // проверка деления на ноль
    if ($b == 0) {

        return "деление на ноль";

    }

    return $a / $b;

}

// степень
function powerNumber($a, $b) {

    return pow($a, $b);

}

// корень
function sqrtNumber($a) {

    return sqrt($a);

}

// натуральный логарифм
function lnNumber($a) {

    return log($a);

}

// логарифм по основанию 10
function logNumber($a) {

    return log10($a);

}

// рекурсивный факториал
function factorial($n) {

    if ($n <= 1) {

        return 1;

    }

    return $n * factorial($n - 1);

}

// главная функция вычисления
function calculate($expression) {

    // убираем пробелы
    $expression = str_replace(
        " ",
        "",
        $expression
    );

    // факториал
    $expression = preg_replace_callback(
        '/(\d+)!/',
        function($matches) {

            return factorial($matches[1]);

        },
        $expression
    );

    // sqrt
    $expression = preg_replace_callback(
        '/sqrt\(([^()]+)\)/',
        function($matches) {

            return sqrtNumber($matches[1]);

        },
        $expression
    );

    // ln
    $expression = preg_replace_callback(
        '/ln\(([^()]+)\)/',
        function($matches) {

            return lnNumber($matches[1]);

        },
        $expression
    );

    // log
    $expression = preg_replace_callback(
        '/log\(([^()]+)\)/',
        function($matches) {

            return logNumber($matches[1]);

        },
        $expression
    );

    // степень
    $expression = preg_replace_callback(
        '/(-?\d+\.?\d*)\^(-?\d+\.?\d*)/',
        function($matches) {

            return powerNumber(
                $matches[1],
                $matches[2]
            );

        },
        $expression
    );

    // рекурсивно вычисляем скобки
    while (
        preg_match(
            '/\(([^()]+)\)/',
            $expression,
            $matches
        )
    ) {

        $inside = calculate($matches[1]);

        $expression = str_replace(
            "(" . $matches[1] . ")",
            $inside,
            $expression
        );

    }

    // умножение и деление
    while (
        preg_match(
            '/(-?\d+\.?\d*)([\*\/])(-?\d+\.?\d*)/',
            $expression,
            $matches
        )
    ) {

        $a = $matches[1];
        $op = $matches[2];
        $b = $matches[3];

        if ($op == "*") {

            $value = multiply($a, $b);

        } else {

            $value = divide($a, $b);

        }

        $expression = preg_replace(
            '/(-?\d+\.?\d*)([\*\/])(-?\d+\.?\d*)/',
            $value,
            $expression,
            1
        );

    }

    // сложение и вычитание
    while (
        preg_match(
            '/(-?\d+\.?\d*)([\+\-])(-?\d+\.?\d*)/',
            $expression,
            $matches
        )
    ) {

        $a = $matches[1];
        $op = $matches[2];
        $b = $matches[3];

        if ($op == "+") {

            $value = add($a, $b);

        } else {

            $value = subtract($a, $b);

        }

        $expression = preg_replace(
            '/(-?\d+\.?\d*)([\+\-])(-?\d+\.?\d*)/',
            $value,
            $expression,
            1
        );

    }

    // если осталось не число — ошибка
if (
    !preg_match(
        '/^-?\d+\.?\d*$/',
        $expression
    )
) {

    return "ошибка выражения";

}

return $expression;

}

?>

<!DOCTYPE html>
<html lang="ru">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Калькулятор Демченко Кирилл 251-3210
    </title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<header>

    <img
        src="Logo_Polytech_rus_main.jpg"
        alt="Логотип"
        class="logo"
    >

    <h1>
        Калькулятор
    </h1>

</header>

<main>

    <div class="calculator">

        <form method="POST">

            <input
                type="text"
                id="display"
                name="expression"
                value="<?php echo isset($_POST['expression']) ? $_POST['expression'] : ''; ?>"
                readonly
            >

            <div class="result">

                <?php

                if ($result !== "") {

                    echo "Результат: " . $result;

                }

                ?>

            </div>

            <div class="buttons">

                <button
                    type="button"
                    onclick="addValue('1')"
                >
                    1
                </button>

                <button
                    type="button"
                    onclick="addValue('2')"
                >
                    2
                </button>

                <button
                    type="button"
                    onclick="addValue('3')"
                >
                    3
                </button>

                <button
                    type="button"
                    onclick="addValue('/')"
                >
                    /
                </button>

                <button
                    type="button"
                    onclick="addValue('4')"
                >
                    4
                </button>

                <button
                    type="button"
                    onclick="addValue('5')"
                >
                    5
                </button>

                <button
                    type="button"
                    onclick="addValue('6')"
                >
                    6
                </button>

                <button
                    type="button"
                    onclick="addValue('*')"
                >
                    *
                </button>

                <button
                    type="button"
                    onclick="addValue('7')"
                >
                    7
                </button>

                <button
                    type="button"
                    onclick="addValue('8')"
                >
                    8
                </button>

                <button
                    type="button"
                    onclick="addValue('9')"
                >
                    9
                </button>

                <button
                    type="button"
                    onclick="addValue('-')"
                >
                    -
                </button>

                <button
                    type="button"
                    onclick="addValue('0')"
                >
                    0
                </button>

                <button
                    type="button"
                    onclick="addValue('.')"
                >
                    .
                </button>

                <button
                    type="button"
                    onclick="addValue('+')"
                >
                    +
                </button>

                <button
                    type="button"
                    onclick="addValue('^')"
                >
                    ^
                </button>

                <button
                    type="button"
                    onclick="addValue('(')"
                >
                    (
                </button>

                <button
                    type="button"
                    onclick="addValue(')')"
                >
                    )
                </button>

                <button
                    type="button"
                    onclick="addValue('sqrt(')"
                >
                    √
                </button>

                <button
                    type="button"
                    onclick="addValue('ln(')"
                >
                    ln
                </button>

                <button
                    type="button"
                    onclick="addValue('log(')"
                >
                    log
                </button>

                <button
                    type="button"
                    onclick="addValue('pi')"
                >
                    π
                </button>

                <button
                    type="button"
                    onclick="addValue('e')"
                >
                    e
                </button>

                <button
                    type="button"
                    onclick="addValue('!')"
                >
                    !
                </button>

                <button
                    type="button"
                    onclick="clearDisplay()"
                >
                    C
                </button>

                <button type="submit">
                    =
                </button>

            </div>

        </form>

    </div>

</main>

<footer>
    Задание для самостоятельной работы
</footer>

<script src="script.js"></script>

</body>
</html>