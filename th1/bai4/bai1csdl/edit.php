<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
<?php
    include 'db.php';

    $id = $_GET['id'];
    $sql = "SELECT * FROM flower WHERE idflower=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $detail = $_POST['detail'];
        $image = $_POST['image'];

        $sql = "UPDATE flower SET name='$name', detail='$detail', image='$image' WHERE idflower=$id";

        if ($conn->query($sql) === TRUE) {
            echo "Flower updated successfully.";
        } else {
            echo "Error: " . $conn->error;
        }

        $conn->close();
        header('location:index.php');
    }
    ?>

    <form method="post">
        <input type="text" name="name" value="<?php echo $row['name']; ?>" required>
        <textarea name="detail" required><?php echo $row['detail']; ?></textarea>
        <input type="text" name="image" value="<?php echo $row['image']; ?>" required>
        <button type="submit">Update Flower</button>
</form>
</body>
</html>