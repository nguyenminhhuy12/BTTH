<?php
    include 'db.php';
    $sql = "SELECT idflower,name,detail,image FROM flower";
    $result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<h1>Manage Flowers</h1>";
    echo "<table border='1'>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>".$row['name']."</td>
                <td>".$row['detail']."</td>
                <td><img src='".$row['image']."' width='100'></td>
                <td>
                    <a href='edit.php?id=".$row['idflower']."'>Edit</a> |
                    <a href='delete.php?id=".$row['idflower']."'>Delete</a>
                </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No flowers found.";
}
?>
<div>
    <a href="add.php" class="btn btn-primary">Add Flower</a>
</div>
<?php
$conn->close();
?>