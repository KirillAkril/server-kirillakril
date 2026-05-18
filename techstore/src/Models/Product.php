<?php

namespace Src\Models;

use Src\Core\Database;
use PDO;

class Product
{
    public static function getAll(): array
    {
        $db = Database::getConnection();

        $stmt = $db->query(
            "SELECT * FROM products ORDER BY id DESC"
        );

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create(
    string $title,
    string $description,
    float $price,
    string $image
    ): void {

        $db = Database::getConnection();

        $sql = "
            INSERT INTO products
            (title, description, price, image, created_at)

            VALUES
            (:title, :description, :price, :image, datetime())
        ";

        $stmt = $db->prepare($sql);

        $stmt->execute([
    ':title' => $title,
    ':description' => $description,
    ':price' => $price,
    ':image' => $image
]);
    }
    public static function getById(int $id): array|false
    {
        $db = Database::getConnection();

        $sql = "
            SELECT * FROM products
            WHERE id = :id
        ";

        $stmt = $db->prepare($sql);

        $stmt->execute([
            ':id' => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public static function update(
    int $id,
    string $title,
    string $description,
    float $price,
    string $image
): void {

    $db = Database::getConnection();

    $sql = "
        UPDATE products

        SET
            title = :title,
            description = :description,
            price = :price,
            image = :image

        WHERE id = :id
    ";

    $stmt = $db->prepare($sql);

    $stmt->execute([
        ':id' => $id,
        ':title' => $title,
        ':description' => $description,
        ':price' => $price,
        ':image' => $image
    ]);
}
public static function delete(int $id): void
{
    $db = Database::getConnection();

    $sql = "
        DELETE FROM products
        WHERE id = :id
    ";

    $stmt = $db->prepare($sql);

    $stmt->execute([
        ':id' => $id
    ]);
}
public static function search(
    string $query
): array {

    $db = Database::getConnection();

    $sql = "
        SELECT * FROM products
        ORDER BY id DESC
    ";

    $stmt = $db->query($sql);

    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $filteredProducts = [];

    foreach ($products as $product) {

        if (
            mb_stripos(
                $product['title'],
                $query
            ) !== false
        ) {

            $filteredProducts[] = $product;
        }
    }

    return $filteredProducts;
}
public static function sort(
    string $sort,
    int $limit,
    int $offset
): array {

    $db = Database::getConnection();

    $allowedSorts = [

        'newest' => 'id DESC',

        'oldest' => 'id ASC',

        'price_asc' => 'price ASC',

        'price_desc' => 'price DESC',

        'title' => 'title ASC'
    ];

    $orderBy =
        $allowedSorts[$sort]
        ??
        'id DESC';

    $sql = "
        SELECT * FROM products
        ORDER BY $orderBy
        LIMIT :limit
        OFFSET :offset
    ";

    $stmt = $db->prepare($sql);

    $stmt->bindValue(
        ':limit',
        $limit,
        PDO::PARAM_INT
    );

    $stmt->bindValue(
        ':offset',
        $offset,
        PDO::PARAM_INT
    );

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
public static function count(): int
{
    $db = Database::getConnection();

    $sql = "
        SELECT COUNT(*) as count
        FROM products
    ";

    $stmt = $db->query($sql);

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return (int) $result['count'];
}
}