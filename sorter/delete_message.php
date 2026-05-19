<?php

session_start();

include "db.php";

$id = $_GET["id"];

$stmt = $db->prepare("

DELETE FROM SMS

WHERE id = ?
AND user_id = ?

");

$stmt->execute([
    $id,
    $_SESSION["user_id"]
]);

header("Location: messages.php");