<?php
include 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['roll'] !== 'admin') {
    header('Location: login.php');
    exit();
}

// Hämta alla meddelanden
$query = "SELECT m.*, u.namn, u.email FROM messages m JOIN users u ON m.user_id = u.id ORDER BY m.created_at DESC";
$result = mysqli_query($conn, $query);
?>

<h2>Adminpanel</h2>
<p>Välkommen, <?php echo $_SESSION['namn']; ?> (Admin)</p>
<a href="logout.php">Logga ut</a>

<h3>Inkomna ärenden</h3>
<table border="1" cellpadding="5">
    <tr>
        <th>Namn</th>
        <th>Email</th>
        <th>Meddelande</th>
        <th>Datum</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['namn']); ?></td>
            <td><?php echo htmlspecialchars($row['email']); ?></td>
            <td><?php echo nl2br(htmlspecialchars($row['message'])); ?></td>
            <td><?php echo $row['created_at']; ?></td>
        </tr>
    <?php endwhile; ?>
</table>
