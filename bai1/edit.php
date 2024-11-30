<?php
    session_start();
    if(isset($_GET['index']))
    {
        echo'chao cac con';
        $index = $_GET['index'];
        $name = $_SESSION['flo'][$index]['name'];
        $detail = $_SESSION['flo'][$index]['detail'];
        $image = $_SESSION['flo'][$index]['image'];
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit</title>
    </head>
    <body>
        <h1>Form sửa dữ liệu</h1>
        <form action="submit.php?index=<?= $_GET['index'] ?>" method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <td><label>Tên hoa</label></td>
                    <td><input type="text" name="name-flower" value="<?=$name?>"style="width: 500px; padding: 10px;"></td>
                </tr>
                <tr>
                    <td><label>Mô tả</label></td>
                    <td><textarea name="detail-flower" style="width: 500px; height: 100px; padding: 10px;" ><?= $detail?></textarea></td>
                </tr>
                <tr>
                    <td><label>Ảnh</label></td>
                    <td><img src="<?=$image?>" alt=""></td>
                </tr>
            </table>
            <input type="file" name="upload" value="<?= $image?>"><br>
            <input class="btn-add" type="submit" value="Lưu thay đổi">
    </form>
       
    </body>
</html>
