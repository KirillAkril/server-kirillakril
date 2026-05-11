<?php

namespace MyProject\Services;

// класс для работы с бд

class Db
{
    private $pdo;

    public function __construct()
    {
        // подключаем sqlite

        $this->pdo = new \PDO(
            'sqlite:' . __DIR__ . '/../../../blog.db'
        );

        // создаем таблицу users

        $this->pdo->exec('

            CREATE TABLE IF NOT EXISTS users (

                id INTEGER PRIMARY KEY AUTOINCREMENT,

                nickname TEXT

            )

        ');

        // создаем таблицу articles

        $this->pdo->exec('

            CREATE TABLE IF NOT EXISTS articles (

                id INTEGER PRIMARY KEY AUTOINCREMENT,

                author_id INTEGER,

                name TEXT,

                text TEXT

            )

        ');

        // проверяем есть ли данные

        $users = $this->pdo
            ->query('SELECT * FROM users')
            ->fetchAll();

        // если база пустая

        if (count($users) === 0) {

            // добавляем пользователей

            $this->pdo->exec("

                INSERT INTO users (nickname)

                VALUES ('test author')

            ");

            $this->pdo->exec("

                INSERT INTO users (nickname)

                VALUES ('kirill')

            ");

            // добавляем статьи

            $this->pdo->exec("

                INSERT INTO articles
                (author_id, name, text)

                VALUES (

                    1,

                    'Статья №1',

                    'Текст первой статьи'

                )

            ");

            $this->pdo->exec("

                INSERT INTO articles
                (author_id, name, text)

                VALUES (

                    2,

                    'Статья №2',

                    'Текст второй статьи'

                )

            ");
        }
    }

    // метод запроса

    public function query(
        string $sql,
        array $params = []
    )
    {
        $statement =
            $this->pdo->prepare($sql);

        $statement->execute($params);

        return $statement->fetchAll(
            \PDO::FETCH_ASSOC
        );
    }
}