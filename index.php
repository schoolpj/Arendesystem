<?php
include 'db.php';
?>

<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <title>Ärendesystem</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h1>Välkommen till Ärendesystemet</h1>

    <?php if (isset($_SESSION['user_id'])): ?>
        <p>Du är inloggad som <?php echo $_SESSION['namn']; ?> (<?php echo $_SESSION['roll']; ?>)</p>
        <a href="logout.php">Logga ut</a>
        <?php if ($_SESSION['roll'] == 'admin'): ?>
            <a href="admin.php">Gå till Adminsida</a>
        <?php else: ?>
            <a href="customer.php">Gå till Kundsida</a>
        <?php endif; ?>
    <?php else: ?>
        <a href="login.php">Logga in</a>
        <a href="signup.php">Registrera</a>
    <?php endif; ?>

</body>
</html>
