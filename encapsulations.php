<?php

// класс кошки

class Cat
{
    // имя кошки

    public $name;

    // цвет делаем приватным

    private $color;

    // вес кошки

    public $weight;

    // конструктор

    public function __construct(
        string $name,
        string $color
    )
    {
        $this->name = $name;

        $this->color = $color;
    }

    // приветствие кошки

    public function sayHello()
    {
        echo
            'Привет! Меня зовут '
            . $this->name
            . '. Я '
            . $this->color
            . ' цвета.';
    }

    // геттер для цвета

    public function getColor(): string
    {
        return $this->color;
    }
}

// создаем объект

$cat1 = new Cat(
    'Мурка',
    'белого'
);

// выводим приветствие

$cat1->sayHello();

echo '<br>';

// получаем цвет через геттер

echo 'Цвет кошки: '
    . $cat1->getColor();

?>