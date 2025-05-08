<?php
include 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['roll'] !== 'kund') {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $meddelande = trim($_POST['meddelande']);

    if (!empty($meddelande)) {
        $stmt = mysqli_prepare($conn, "INSERT INTO messages (user_id, meddelande, datum) VALUES (?, ?, NOW())");
        mysqli_stmt_bind_param($stmt, "is", $user_id, $meddelande);
        mysqli_stmt_execute($stmt);
        $success = "Ditt ärende har skickats!";
    } else {
        $error = "Fältet får inte vara tomt.";
    }
}
?>

<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <title>Kundpanel</title>
    <link rel="stylesheet" href="style-kund.css">
</head>
<body>
    <p>Välkommen, <?php echo htmlspecialchars($_SESSION['namn']); ?>!</p>
    <a href="logout.php">Logga ut</a>

    <h3>Skicka ditt bekymmer</h3>

    <?php if (isset($success)) echo "<p style='color: green;'>$success</p>"; ?>
    <?php if (isset($error)) echo "<p style='color: red;'>$error</p>"; ?>

    <form method="POST">
        <textarea name="meddelande" rows="5" cols="50" placeholder="Skriv ditt problem här..." required></textarea><br><br>
        <button type="submit">Skicka</button>
    </form>
</body>
</html>
