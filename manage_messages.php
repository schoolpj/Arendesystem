<?php
include 'db.php';
?>

<h1>Inkommande Kundmeddelanden</h1>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Namn</th>
        <th>Email</th>
        <th>Meddelande</th>
        <th>Datum</th>
        <th>Skapa Ärende</th>
        <th>Ta bort</th>
    </tr>

<?php
$stmt = $conn->query("SELECT * FROM messages ORDER BY datum DESC");
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($messages as $msg) {
    echo "<tr>";
    echo "<td>" . $msg['id'] . "</td>";
    echo "<td>" . htmlspecialchars($msg['namn']) . "</td>";
    echo "<td>" . htmlspecialchars($msg['email']) . "</td>";
    echo "<td>" . nl2br(htmlspecialchars($msg['meddelande'])) . "</td>";
    echo "<td>" . $msg['datum'] . "</td>";


    echo "<td>
        <form action='create_ticket_from_message.php' method='POST'>
            <input type='hidden' name='namn' value='" . htmlspecialchars($msg['namn'], ENT_QUOTES) . "'>
            <input type='hidden' name='meddelande' value='" . htmlspecialchars($msg['meddelande'], ENT_QUOTES) . "'>
            <button type='submit'>Skapa Ärende</button>
        </form>
    </td>";

    echo "<td>
        <form action='delete_message.php' method='POST' onsubmit='return confirm(\"Ta bort detta meddelande?\")'>
            <input type='hidden' name='id' value='" . $msg['id'] . "'>
            <button type='submit' style='color:red;'>Ta bort</button>
        </form>
    </td>";

    echo "</tr>";
}
?>
</table>
