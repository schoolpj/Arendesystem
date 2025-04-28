<?php
include 'db.php';
?>

<h1>Admin - Hantera Ärenden</h1>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Titel</th>
        <th>Beskrivning</th>
        <th>Status</th>
        <th>Prioritet</th>
        <th>Rapportör</th>
        <th>Datum</th>
        <th>Ändra Status</th>
        <th>Ta bort</th>
    </tr>

<?php
$stmt = $conn->query("SELECT * FROM tickets ORDER BY datum DESC");
$tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($tickets as $ticket) {
    echo "<tr>";
    echo "<td>" . $ticket['id'] . "</td>";
    echo "<td>" . htmlspecialchars($ticket['titel']) . "</td>";
    echo "<td>" . nl2br(htmlspecialchars($ticket['beskrivning'])) . "</td>";
    echo "<td>" . $ticket['status'] . "</td>";
    echo "<td>" . $ticket['prioritet'] . "</td>";
    echo "<td>" . htmlspecialchars($ticket['rapportor']) . "</td>";
    echo "<td>" . $ticket['datum'] . "</td>";

    echo "<td>
        <form action='update_status.php' method='POST'>
            <input type='hidden' name='id' value='" . $ticket['id'] . "'>
            <select name='status'>
                <option value='öppen' " . ($ticket['status'] == 'öppen' ? 'selected' : '') . ">Öppen</option>
                <option value='pågående' " . ($ticket['status'] == 'pågående' ? 'selected' : '') . ">Pågående</option>
                <option value='stängd' " . ($ticket['status'] == 'stängd' ? 'selected' : '') . ">Stängd</option>
            </select>
            <button type='submit'>Uppdatera</button>
        </form>
    </td>";

    echo "<td>
        <form action='delete_ticket.php' method='POST' onsubmit='return confirm(\"Är du säker på att du vill ta bort detta ärende?\")'>
            <input type='hidden' name='id' value='" . $ticket['id'] . "'>
            <button type='submit' style='color:red;'>Ta bort</button>
        </form>
    </td>";

    echo "</tr>";
}
?>

</table>
