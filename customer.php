<?php
include 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['roll'] != 'kund') {
    header('Location: login.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $namn = $_SESSION['namn'];
    $email = $_POST['email'];
    $meddelande = $_POST['meddelande'];

    $stmt = $conn->prepare("INSERT INTO messages (namn, email, meddelande) VALUES (?, ?, ?)");
    $stmt->execute([$namn, $email, $meddelande]);

    echo "Ditt meddelande har skickats!";
}
?>

<h1>Välkommen, <?php echo $_SESSION['namn']; ?>!</h1>
<a href="logout.php">Logga ut</a>

<h2>Skicka Meddelande till Support</h2>
<form method="POST" action="customer.php">
    <input type="email" name="email" placeholder="Din e-post" required><br><br>
    <textarea name="meddelande" placeholder="Beskriv ditt problem..." required></textarea><br><br>
    <button type="submit">Skicka</button>
</form>
