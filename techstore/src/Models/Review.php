<?php

namespace Src\Models;

use Src\Core\Database;
use PDO;

class Review
{
    public static function create(
        int $productId,
        string $author,
        string $text
    ): void {

        $db = Database::getConnection();

        $sql = "
            INSERT INTO reviews
            (product_id, author, text, created_at)

            VALUES
            (:product_id, :author, :text, datetime())
        ";

        $stmt = $db->prepare($sql);

        $stmt->execute([
            ':product_id' => $productId,
            ':author' => $author,
            ':text' => $text
        ]);
    }

    public static function getByProductId(
        int $productId
    ): array {

        $db = Database::getConnection();

        $sql = "
            SELECT * FROM reviews
            WHERE product_id = :product_id
            ORDER BY id DESC
        ";

        $stmt = $db->prepare($sql);

        $stmt->execute([
            ':product_id' => $productId
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function deleteByProductId(
    int $productId
): void {

    $db = Database::getConnection();

    $sql = "
        DELETE FROM reviews
        WHERE product_id = :product_id
    ";

    $stmt = $db->prepare($sql);

    $stmt->execute([
        ':product_id' => $productId
    ]);
}
}