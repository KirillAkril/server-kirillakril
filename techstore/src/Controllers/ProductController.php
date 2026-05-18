<?php

namespace Src\Controllers;

use Src\Models\Product;
use Src\Models\Review;
class ProductController
{
public function index(): void
{
    $search = $_GET['search'] ?? '';

    $sort = $_GET['sort'] ?? 'newest';

    $page = (int) ($_GET['page'] ?? 1);

    $limit = 5;

    $offset = ($page - 1) * $limit;

    if (!empty($search)) {

        $products = Product::search($search);

        $totalProducts = count($products);

    } else {

        $products = Product::sort(
            $sort,
            $limit,
            $offset
        );

        $totalProducts = Product::count();
    }

    $totalPages = ceil(
        $totalProducts / $limit
    );

    require __DIR__ .
        '/../../templates/products/index.php';
}

    public function create(): void
    {
        if (empty($_SESSION['admin'])) {

    header('Location: /?route=login');

    exit;
}
        $message = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $imagePath = '';

if (!empty($_FILES['image']['name'])) {

    $fileName = time() . '_' . $_FILES['image']['name'];

    $uploadPath =
        __DIR__ .
        '/../../public/uploads/' .
        $fileName;

    move_uploaded_file(
        $_FILES['image']['tmp_name'],
        $uploadPath
    );

    $imagePath = '/uploads/' . $fileName;
}

Product::create(
    $_POST['title'],
    $_POST['description'],
    $_POST['price'],
    $imagePath
);

            $message = 'Товар успешно добавлен';
        }

        require __DIR__ . '/../../templates/products/create.php';
    }
   public function show(): void
{
    $id = (int) $_GET['id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        Review::create(
            $id,
            $_POST['author'],
            $_POST['text']
        );
    }

    $product = Product::getById($id);

    $reviews = Review::getByProductId($id);

    require __DIR__ . '/../../templates/products/show.php';
}
public function edit(): void
{
    if (empty($_SESSION['admin'])) {

    header('Location: /?route=login');

    exit;
}
    $id = (int) $_GET['id'];

    $product = Product::getById($id);

    $error = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $title = trim($_POST['title']);
        $description = trim($_POST['description']);
        $price = trim($_POST['price']);

        if (
            empty($title) ||
            empty($description) ||
            empty($price)
        ) {

            $error = 'Все поля должны быть заполнены';

        } else {

            $imagePath = $product['image'];

            if (!empty($_FILES['image']['name'])) {

                $fileName =
                    time() .
                    '_' .
                    $_FILES['image']['name'];

                $uploadPath =
                    __DIR__ .
                    '/../../public/uploads/' .
                    $fileName;

                move_uploaded_file(
                    $_FILES['image']['tmp_name'],
                    $uploadPath
                );

                $imagePath =
                    '/uploads/' .
                    $fileName;
            }

            Product::update(
                $id,
                $title,
                $description,
                (float)$price,
                $imagePath
            );

            header(
                'Location: /?route=product&id=' . $id
            );

            exit;
        }
    }

    require __DIR__ . '/../../templates/products/edit.php';
}
public function delete(): void
{
    if (empty($_SESSION['admin'])) {

    header('Location: /?route=login');

    exit;
}
    $id = (int) $_GET['id'];

    $product = Product::getById($id);

    if (!empty($product['image'])) {

        $imagePath =
            __DIR__ .
            '/../../public' .
            $product['image'];

        if (file_exists($imagePath)) {

            unlink($imagePath);
        }
    }

    Review::deleteByProductId($id);

    Product::delete($id);

    header('Location: /?route=products');

    exit;
}
}