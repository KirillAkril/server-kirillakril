<?php

// класс поста

class Post
{
    // заголовок

    private $title;

    // текст

    private $text;

    // конструктор

    public function __construct(
        string $title,
        string $text
    )
    {
        $this->title = $title;

        $this->text = $text;
    }

    // геттер заголовка

    public function getTitle(): string
    {
        return $this->title;
    }

    // сеттер заголовка

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    // геттер текста

    public function getText(): string
    {
        return $this->text;
    }

    // сеттер текста

    public function setText(string $text): void
    {
        $this->text = $text;
    }
}

// класс урока

class Lesson extends Post
{
    // домашка

    private $homework;

    // конструктор

    public function __construct(
        string $title,
        string $text,
        string $homework
    )
    {
        // вызываем конструктор родителя

        parent::__construct(
            $title,
            $text
        );

        $this->homework = $homework;
    }

    // геттер домашки

    public function getHomework(): string
    {
        return $this->homework;
    }

    // сеттер домашки

    public function setHomework(
        string $homework
    ): void
    {
        $this->homework = $homework;
    }
}

// платный урок

class PaidLesson extends Lesson
{
    // цена урока

    private $price;

    // конструктор

    public function __construct(
        string $title,
        string $text,
        string $homework,
        float $price
    )
    {
        // вызываем конструктор Lesson

        parent::__construct(
            $title,
            $text,
            $homework
        );

        $this->price = $price;
    }

    // геттер цены

    public function getPrice(): float
    {
        return $this->price;
    }

    // сеттер цены

    public function setPrice(
        float $price
    ): void
    {
        $this->price = $price;
    }
}

// создаем объект

$paidLesson = new PaidLesson(

    'Урок о наследовании в PHP',

    'Лол, кек, чебурек',

    'Ложитесь спать, утро вечера мудренее',

    99.90
);

// выводим объект

var_dump($paidLesson);

?>