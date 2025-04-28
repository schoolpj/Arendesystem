<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    $stmt = $conn->prepare("DELETE FROM messages WHERE id = ?");
    $stmt->execute([$id]);

    header("Location: manage_messages.php");
    exit();
}
?>
