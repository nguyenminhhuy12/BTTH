<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THEM</title>
</head>
<body>
<form action="submit.php" method="post" enctype="multipart/form-data">
        <label for="">Tên hoa</label>
        <input type="text" name="name-flower">
        <label for="">Mô tả</label>
        <input class="textarea" type="text" id="" name="detail-flower"></textarea>
        <label for="textarea">Ảnh</label>
        <input type="file" name="upload">
        <input class="btn-add" type="submit" value="Luu">
    </form>
</body>
</html>
