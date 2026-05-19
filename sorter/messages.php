<?php

session_start();

include "db.php";

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    exit();
}

$stmt = $db->prepare("

SELECT DISTINCT

SMS.id,
SMS.description,
SMS.created_at,
SMS.save,

Users.name AS author,

Channel.name AS channel_name,

Field.name AS field_name

FROM SMS

LEFT JOIN Users
ON SMS.user_id = Users.id

LEFT JOIN Channel
ON SMS.channel_id = Channel.id

LEFT JOIN SMS_Hashtag
ON SMS.id = SMS_Hashtag.sms_id

LEFT JOIN Hashtags
ON SMS_Hashtag.hashtag_id = Hashtags.id

LEFT JOIN Hashtag_Field
ON Hashtags.id = Hashtag_Field.hashtag_id

LEFT JOIN Field
ON Hashtag_Field.field_id = Field.id

WHERE SMS.user_id = ?

ORDER BY SMS.id DESC

");

$stmt->execute([
    $_SESSION["user_id"]
]);

$messages = $stmt->fetchAll();
$channels = $db->query("
    SELECT * FROM Channel
")->fetchAll();
include "partials/header.php";
?>

<div class="d-flex justify-content-between mb-4">

    <h2>
        Привет,
        <?= $_SESSION["user_name"] ?>
    </h2>

    <a href="logout.php"
       class="btn btn-danger">
       Выйти
    </a>

</div>

<div class="card p-4 shadow mb-4">

    <form method="POST"
          action="add_message.php">
        <select class="form-select mb-3"
                name="channel_id">

            <?php foreach($channels as $channel): ?>

                <option value="<?= $channel["id"] ?>">

                    <?= $channel["name"] ?>

                    <?php if($channel["like_flag"]): ?>
                        ⭐
                    <?php endif; ?>

                </option>

            <?php endforeach; ?>

        </select>
        <textarea class="form-control mb-3"
                  name="text"
                  placeholder="Введите сообщение"
                  required></textarea>

        <div class="form-check mb-3">

            <input class="form-check-input"
                   type="checkbox"
                   name="save">

            <label class="form-check-label">
                Приватное сообщение
            </label>

        </div>

        <button class="btn btn-primary">
            Отправить
        </button>

    </form>

</div>

<?php foreach($messages as $msg): ?>

<div class="card p-3 shadow-sm mb-3">

    <div class="d-flex justify-content-between">

        <b>
            <?= htmlspecialchars($msg["author"]) ?>
        </b>

        <small>
            <?= $msg["created_at"] ?>
        </small>

    </div>

    <p class="mt-2">

        <?= htmlspecialchars($msg["description"]) ?>

    </p>

    <p>

        <b>Канал:</b>
        <?= $msg["channel_name"] ?>

    </p>

    <p>

        <b>Область знаний:</b>

        <?= $msg["field_name"] ?? "Не определена" ?>

    </p>
    <a href="delete_message.php?id=<?= $msg["id"] ?>"
   class="btn btn-sm btn-danger mt-2">

    Удалить

</a>

    <?php if($msg["save"]): ?>

        <span class="badge bg-danger">
            Приватное
        </span>

    <?php endif; ?>

</div>

<?php endforeach; ?>

<?php include "partials/footer.php"; ?>