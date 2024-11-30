<?php
session_start();

// Kiểm tra nếu không có danh sách sản phẩm trong session
if (!isset($_SESSION['products'])) {
    header('Location: index.php'); // Quay lại trang chính nếu không có sản phẩm
    exit();
}

// Lấy danh sách sản phẩm từ session
$products = $_SESSION['products'];

// Lấy ID sản phẩm từ URL
if (isset($_GET['id'])) {
    $edit_id = $_GET['id'];

    // Tìm sản phẩm cần sửa
    foreach ($products as $product) {
        if ($product['id'] == $edit_id) {
            $current_product = $product;
            break;
        }
    }

    // Nếu không tìm thấy sản phẩm, quay lại trang chính
    if (!isset($current_product)) {
        header('Location: index.php');
        exit();
    }
}

// Xử lý khi người dùng nhấn nút Sửa
if (isset($_POST['edit_product'])) {
    $new_name = $_POST['product_name'];
    $new_price = $_POST['product_price'];

    // Cập nhật sản phẩm trong danh sách
    foreach ($products as &$product) {
        if ($product['id'] == $edit_id) {
            $product['name'] = $new_name;
            $product['price'] = $new_price;
            break;
        }
    }

    // Lưu lại danh sách sản phẩm vào session
    $_SESSION['products'] = $products;

    // Chuyển hướng về trang chính
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa sản phẩm</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Sửa thông tin sản phẩm</h1>
    </header>

    <main>
        <form action="edit.php?id=<?= $edit_id ?>" method="post">
            <label for="product_name">Tên sản phẩm:</label>
            <input type="text" name="product_name" id="product_name" value="<?= $current_product['name'] ?>" required>

            <label for="product_price">Giá thành:</label>
            <input type="text" name="product_price" id="product_price" value="<?= $current_product['price'] ?>" required>

            <button type="submit" name="edit_product">Sửa</button>
        </form>
    </main>

    <footer>
        <p>TLU'S MUSIC GARDEN</p>
    </footer>
</body>
</html>
