<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $status = $_POST['status'];

    $stmt = $conn->prepare("UPDATE tickets SET status = ? WHERE id = ?");
    $stmt->execute([$status, $id]);

    header("Location: admin.php");
    exit();
}
?>
