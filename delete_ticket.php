<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    $stmt = $conn->prepare("DELETE FROM tickets WHERE id = ?");
    $stmt->execute([$id]);

    header("Location: admin.php");
    exit();
}
?>
