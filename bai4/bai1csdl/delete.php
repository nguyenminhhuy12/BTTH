<?php
include 'db.php';

$id = $_GET['id'];
$sql = "DELETE FROM flower WHERE idflower=$id";

if ($conn->query($sql) === TRUE) {
    echo "Flower deleted successfully.";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
header('location:index.php');
?>