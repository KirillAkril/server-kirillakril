<?php

include "db.php";

$db->exec("

CREATE TABLE IF NOT EXISTS Users (

    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT,
    email TEXT UNIQUE,
    password TEXT

);

CREATE TABLE IF NOT EXISTS Field (

    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT,
    description TEXT

);

CREATE TABLE IF NOT EXISTS Hashtags (

    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT UNIQUE

);

CREATE TABLE IF NOT EXISTS Hashtag_Field (

    hashtag_id INTEGER,
    field_id INTEGER

);

CREATE TABLE IF NOT EXISTS SMS (

    id INTEGER PRIMARY KEY AUTOINCREMENT,

    user_id INTEGER,
    channel_id INTEGER,

    description TEXT,

    save INTEGER DEFAULT 0,

    created_at DATETIME DEFAULT CURRENT_TIMESTAMP

);
CREATE TABLE IF NOT EXISTS SMS_Hashtag (

    sms_id INTEGER,
    hashtag_id INTEGER

);
CREATE TABLE IF NOT EXISTS Channel (

    id INTEGER PRIMARY KEY AUTOINCREMENT,

    name TEXT,
    description TEXT,

    like_flag INTEGER DEFAULT 0

);
INSERT OR IGNORE INTO Channel(name,description,like_flag)
VALUES

('Cooking','Кулинарный канал',1),
('Programming','IT канал',1),
('Sport','Спортивный канал',0);
");

$db->exec("

INSERT OR IGNORE INTO Field(name, description)
VALUES
('Кулинария', 'Рецепты и еда'),
('Программирование', 'Разработка'),
('Спорт', 'Тренировки');

");

$db->exec("

INSERT OR IGNORE INTO Hashtags(name)
VALUES
('cake'),
('python'),
('gym');

");

$db->exec("

INSERT OR IGNORE INTO Hashtag_Field(hashtag_id, field_id)
VALUES
(1,1),
(2,2),
(3,3);

");

echo "База данных создана";