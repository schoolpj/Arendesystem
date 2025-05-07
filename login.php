<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $input_losenord = $_POST['lösenord'];

    $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE email = ?");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($input_losenord, $user['losenord'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['namn'] = $user['namn'];
        $_SESSION['roll'] = $user['roll'];

        if ($user['roll'] === 'admin') {
            header('Location: admin.php');
        } else {
            header('Location: customer.php');
        }
        exit();
    } else {
        echo "Fel e-post eller lösenord.";
    }
}
?>

<form method="POST">
    <h2>Logga in</h2>
    <input type="email" name="email" placeholder="E-post" required><br>
    <input type="password" name="lösenord" placeholder="Lösenord" required><br>
    <button type="submit">Logga in</button>
</form>
