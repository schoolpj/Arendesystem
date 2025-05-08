<?php
include 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['roll'] !== 'admin') {
    header('Location: login.php');
    exit();
}

$query = "SELECT m.*, u.namn, u.email FROM messages m JOIN users u ON m.user_id = u.id ORDER BY m.datum DESC";
$result = mysqli_query($conn, $query);

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_query = "DELETE FROM messages WHERE id = ?";
    $stmt = mysqli_prepare($conn, $delete_query);
    mysqli_stmt_bind_param($stmt, "i", $delete_id);
    mysqli_stmt_execute($stmt);
    header('Location: admin.php');
    exit();
}

if (isset($_POST['update_priority'])) {
    $priority = $_POST['priority'];
    $message_id = $_POST['message_id'];
    $update_query = "UPDATE messages SET priority = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $update_query);
    mysqli_stmt_bind_param($stmt, "si", $priority, $message_id);
    mysqli_stmt_execute($stmt);
    header('Location: admin.php');
    exit();
}
?>
<link rel="stylesheet" href="style-admin.css">
<h2>Adminpanel</h2>
<p>Välkommen, <?php echo $_SESSION['namn']; ?> (Admin)</p>
<a href="logout.php">Logga ut</a>

<h3>Inkomna ärenden</h3>
<table class="message-table">
    <tr>
        <th>Namn</th>
        <th>Email</th>
        <th>Meddelande</th>
        <th>Datum</th>
        <th>Prioritet</th>
        <th>Åtgärder</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['namn']); ?></td>
            <td><?php echo htmlspecialchars($row['email']); ?></td>
            <td><?php echo nl2br(htmlspecialchars($row['meddelande'])); ?></td>
            <td><?php echo $row['datum']; ?></td>
            <td>
                <form method="POST" action="admin.php">
                    <select name="priority">
                        <option value="Hög" <?php echo $row['priority'] == 'Hög' ? 'selected' : ''; ?>>Hög</option>
                        <option value="Mellan" <?php echo $row['priority'] == 'Mellan' ? 'selected' : ''; ?>>Mellan</option>
                        <option value="Låg" <?php echo $row['priority'] == 'Låg' ? 'selected' : ''; ?>>Låg</option>
                    </select>
                    <input type="hidden" name="message_id" value="<?php echo $row['id']; ?>">
                    <button type="submit" name="update_priority">Uppdatera Prioritet</button>
                </form>
            </td>
            <td>
                <a href="admin.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('Är du säker på att du vill ta bort detta ärende?');">Ta bort</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>
