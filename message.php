<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $namn = $_POST['namn'];
    $email = $_POST['email'];
    $meddelande = $_POST['meddelande'];

    $stmt = $conn->prepare("INSERT INTO messages (namn, email, meddelande) VALUES (?, ?, ?)");
    $stmt->execute([$namn, $email, $meddelande]);

    echo "Tack! Ditt meddelande har skickats.";
}
?>

<h1>Kontakta Support</h1>
<form action="message.php" method="POST">
    <input type="text" name="namn" placeholder="Ditt namn" required><br><br>
    <input type="email" name="email" placeholder="Din e-post" required><br><br>
    <textarea name="meddelande" placeholder="Beskriv ditt problem..." required></textarea><br><br>
    <button type="submit">Skicka meddelande</button>
</form>
