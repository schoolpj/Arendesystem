<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $namn = $_POST['namn'];
    $email = $_POST['email'];
    $losenord = password_hash($_POST['lösenord'], PASSWORD_DEFAULT);
    $roll = 'kund'; // Alla nya användare får rollen kund

    $stmt = mysqli_prepare($conn, "INSERT INTO users (namn, email, losenord, roll) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssss", $namn, $email, $losenord, $roll);

    if (mysqli_stmt_execute($stmt)) {
        echo "Registreringen lyckades! <a href='login.php'>Logga in här</a>";
    } else {
        echo "Fel vid registrering: " . mysqli_error($conn);
    }
}
?>

<form method="POST">
    <h2>Skapa konto</h2>
    <input type="text" name="namn" placeholder="Namn" required><br>
    <input type="email" name="email" placeholder="E-post" required><br>
    <input type="password" name="lösenord" placeholder="Lösenord" required><br>
    <button type="submit">Registrera</button>
</form>
