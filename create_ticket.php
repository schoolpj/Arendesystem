<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titel = $_POST['titel'];
    $beskrivning = $_POST['beskrivning'];
    $prioritet = $_POST['prioritet'];
    $rapportor = $_POST['rapportor'];

    $stmt = $conn->prepare("INSERT INTO tickets (titel, beskrivning, prioritet, rapportor) VALUES (?, ?, ?, ?)");
    $stmt->execute([$titel, $beskrivning, $prioritet, $rapportor]);

    header("Location: index.php"); 
    exit();
}
?>
