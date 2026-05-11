<?php

// интерфейс для объектов,
// которые умеют считать площадь

interface CalculateSquare
{
    public function calculateSquare(): float;
}

// класс круга

class Circle implements CalculateSquare
{
    // константа пи

    const PI = 3.1416;

    // радиус

    private $r;

    // конструктор

    public function __construct(float $r)
    {
        $this->r = $r;
    }

    // вычисление площади

    public function calculateSquare(): float
    {
        return self::PI * ($this->r ** 2);
    }
}

// класс прямоугольника

class Rectangle
{
    private $x;

    private $y;

    // конструктор

    public function __construct(
        float $x,
        float $y
    )
    {
        $this->x = $x;

        $this->y = $y;
    }

    // вычисление площади

    public function calculateSquare(): float
    {
        return $this->x * $this->y;
    }
}

// класс квадрата

class Square implements CalculateSquare
{
    private $x;

    // конструктор

    public function __construct(float $x)
    {
        $this->x = $x;
    }

    // вычисление площади

    public function calculateSquare(): float
    {
        return $this->x ** 2;
    }
}

// массив объектов

$objects = [

    new Square(5),

    new Rectangle(2, 4),

    new Circle(5)
];

// перебираем объекты

foreach ($objects as $object) {

    // получаем имя класса

    $className = get_class($object);

    // проверяем интерфейс

    if ($object instanceof CalculateSquare) {

        echo
            'Объект класса '
            . $className
            . ' реализует интерфейс CalculateSquare. '
            . 'Площадь: '
            . $object->calculateSquare();

        echo '<br>';
    }
    else {

        echo
            'Объект класса '
            . $className
            . ' не реализует интерфейс CalculateSquare.';

        echo '<br>';
    }
}

?>