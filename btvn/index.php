<?php
session_start();

// Đọc dữ liệu sản phẩm từ session (nếu có)
if (isset($_SESSION['products'])) {
    $products = $_SESSION['products'];
} else {
    // Dữ liệu mặc định ban đầu
    $products = [
        [
            'name' => 'Sản phẩm 1',
            'price' => '100 VND',
            'id' => 1
        ],
        [
            'name' => 'Sản phẩm 2',
            'price' => '200 VND',
            'id' => 2
        ],
        [
            'name' => 'Sản phẩm 3',
            'price' => '300 VND',
            'id' => 3
        ],
    ];
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.0/css/all.min.css"
        integrity="sha512-9xKTRVabjVeZmc+GUW8GgSmcREDunMM+Dt/GrzchfN8tkwHizc5RP4Ok/MXFFy5rIjJjzhndFScTceq5e6GvVQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><img src="logo.png" alt="Logo" style="height: 40px;"></li>
                <li><a href="trangchu.php">Trang chủ</a></li>
                <li><a href="trangngoai.php">Trang ngoài</a></li>
                <li><a href="theloai.php" class="active">Thể loại</a></li>
                <li><a href="tacgia.php">Tác giả</a></li>
                <li><a href="baiviet.php">Bài viết</a></li>
            </ul>
        </nav>
    </header>

    <main>
    <section class="admin-panel">
        <!-- Form nhập sản phẩm mới -->
        <form method="POST" action="skien.php">
            <input type="text" name="product_name" placeholder="Tên sản phẩm" required>
            <input type="text" name="product_price" placeholder="Giá thành (VD: 1000 VND)" required>
            <button type="submit" class="btn-add">Thêm sản phẩm</button>
        </form>

        <!-- Bảng danh sách sản phẩm -->
        <table>
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Giá thành</th>
                    <th>Sửa</th>
                    <th>Xóa</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?= $product['name'] ?></td>
                        <td><?= $product['price'] ?></td>
                        <td><a href="edit.php?id=<?= $product['id'] ?>" class="edit-link"><i class="fa-solid fa-pen-to-square"></i></a></td>
                        <td><a href="skien.php?delete=<?= $product['id'] ?>" class="delete-link"><i class="fa-solid fa-trash"></i></a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</main>

    <footer>
        <p>TLU'S MUSIC GARDEN</p>
        <form action="skien.php" method="post">
            <button type="submit" name="action" value="reset">Reset</button>
            <input type="hidden" name="reset_form" value="1">
        </form>
    </footer>
</body>
</html>
