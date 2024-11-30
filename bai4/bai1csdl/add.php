<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $detail = $_POST['detail'];
    $image = $_POST['image'];

    $sql = "INSERT INTO flower (name, detail, image) VALUES ('$name', '$detail', '$image')";

    if ($conn->query($sql) === TRUE) {
        echo "New flower added successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    header('location:index.php');
}
?>

<form method="post">
    <input type="text" name="name" placeholder="Flower Name" required>
    <textarea name="detail" placeholder="Detail" required></textarea>
    <input type="text" name="image" placeholder="Image Path" required>
    <button type="submit">Add Flower</button>
</form>