<?php
session_start();
if(isset($_POST['reset_form']))
{
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
    $_SESSION['products'] = $products;
}

// Đọc dữ liệu sản phẩm hiện tại từ session (nếu có)
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

// Kiểm tra nếu form được gửi
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_name = $_POST['product_name'];
    $new_price = $_POST['product_price'];
    $new_id = end($products)['id'] + 1; // Tạo ID mới (ID cuối + 1)

    // Thêm sản phẩm mới vào mảng
    $products[] = [
        'name' => $new_name,
        'price' => $new_price,
        'id' => $new_id
    ];

    // Lưu lại dữ liệu vào session
    $_SESSION['products'] = $products;

    // Quay lại trang chính
    header('Location: index.php');
    exit();
}
if(isset($_GET['delete']))
{
    $delete_id = $_GET['delete'];
    //loc dsach spham co id trung voi delete_id
    $products = array_filter($products, function($product) use ($delete_id){
    return $product['id'] != $delete_id;
    });
    //duyet tung phan tu trong mang neu co id khac vs delete id thi tra ve true sau khi duyet mang se mat phan du lieu co id = vs delete id
    $_SESSION['products'] = $products;
    //quay lai chuong trinh
    header('Location: index.php');
    exit();
}
