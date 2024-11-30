<?php
include 'db.php'; 

$sql = "SELECT * FROM flower";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h1>List of Flowers</h1>";
    while($row = $result->fetch_assoc()) {
        echo "<div class='flower-card'>
                <img src='".$row['image']."' alt='".$row['name']."' width='200'/>
                <h2>".$row['name']."</h2>
                <p>".$row['detail']."</p>
              </div>";
    }
} else {
    echo "Not found.";
}

$conn->close();
?>