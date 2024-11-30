<?php
$servername = "localhost";
$username = "root"; // Tên người dùng MySQL của bạn
$password = ""; // Mật khẩu của MySQL
$database = "flower_store";
$conn="";
$conn = mysqli_connect($servername,
                        $username,
                        $password,
                        $database);

// Kiểm tra kết nối
if($conn) {
    echo'ket noi thanh cong';
}
else{
    echo'ket noi that bai';
}
?>
