<?php

session_start();

include "db.php";

if (!isset($_SESSION["user_id"])) {
    exit();
}

$text = trim($_POST["text"]);

$save = isset($_POST["save"])
    ? 1
    : 0;

$user_id = $_SESSION["user_id"];

$channel_id = $_POST["channel_id"];

$stmt = $db->prepare("

INSERT INTO SMS(

    user_id,
    channel_id,
    description,
    save

)

VALUES(?,?,?,?)

");

$stmt->execute([

    $user_id,
    $channel_id,
    $text,
    $save

]);

$sms_id = $db->lastInsertId();

preg_match_all('/#(\w+)/', $text, $matches);

$hashtags = $matches[1];

foreach ($hashtags as $hashtag) {

    $stmt = $db->prepare("
        SELECT id
        FROM Hashtags
        WHERE name = ?
    ");

    $stmt->execute([$hashtag]);

    $tag = $stmt->fetch();

    if ($tag) {

        $hashtag_id = $tag["id"];

    } else {

        $stmt = $db->prepare("
            INSERT INTO Hashtags(name)
            VALUES(?)
        ");

        $stmt->execute([$hashtag]);

        $hashtag_id = $db->lastInsertId();
    }

    $stmt = $db->prepare("

        INSERT INTO SMS_Hashtag(
            sms_id,
            hashtag_id
        )

        VALUES(?,?)

    ");

    $stmt->execute([
        $sms_id,
        $hashtag_id
    ]);
}

header("Location: messages.php");