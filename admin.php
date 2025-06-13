<?php
include("db.php");
include("auth.php");
echo "<h2>Welcome Admin: " . $_SESSION['user'] . "</h2>";

$messages = mysqli_query($conn, "SELECT * FROM chat ORDER BY id DESC");
while ($row = mysqli_fetch_assoc($messages)) {
    echo "<p><strong>{$row['name']}</strong>: {$row['message']} 
    <a href='delete.php?id={$row['id']}'>[Delete]</a></p>";
}
?>
