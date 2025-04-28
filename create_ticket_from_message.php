<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $namn = $_POST['namn'];
    $meddelande = $_POST['meddelande'];

    $stmt = $conn->prepare("INSERT INTO tickets (titel, beskrivning, prioritet, rapportor) VALUES (?, ?, ?, ?)");
    $stmt->execute(["Meddelande från kund", $meddelande, "medel", $namn]);

    header("Location: manage_messages.php");
    exit();
}
?>
