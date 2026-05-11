<?php


abstract class HumanAbstract
{
    // имя человека

    private $name;

    // конструктор

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    // получение имени

    public function getName(): string
    {
        return $this->name;
    }

    // приветствие

    abstract public function getGreetings(): string;

    abstract public function getMyNameIs(): string;

    public function introduceYourself(): string
    {
        return $this->getGreetings() .
            '! ' .
            $this->getMyNameIs() .
            ' ' .
            $this->getName() .
            '.';
    }
}

// русский человек

class RussianHuman extends HumanAbstract
{

    public function getGreetings(): string
    {
        return "Привет";
    }

    public function getMyNameIs(): string
    {
        return "Меня зовут";
    }
}

// английский человек

class EnglishHuman extends HumanAbstract
{

    public function getGreetings(): string
    {
        return "Hello";
    }

    public function getMyNameIs(): string
    {
        return "My name is";
    }
}

// создаем объекты

$russian = new RussianHuman("Кирилл");

$english = new EnglishHuman("Kirill");

// выводим приветствия

echo $russian->introduceYourself();

echo "<br>";

echo $english->introduceYourself();

?>