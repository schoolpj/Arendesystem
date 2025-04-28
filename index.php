<?php include 'db.php'; ?>

<h1>Skapa nytt ärende</h1>
<form action="create_ticket.php" method="POST">
    <input type="text" name="titel" placeholder="Titel" required><br><br>
    <textarea name="beskrivning" placeholder="Beskrivning" required></textarea><br><br>
    <select name="prioritet" required>
        <option value="låg">Låg</option>
        <option value="medel">Medel</option>
        <option value="hög">Hög</option>
    </select><br><br>
    <input type="text" name="rapportor" placeholder="vem är du" required><br><br>
    <button type="submit">Skapa ärende</button>
</form>

<h2>Alla ärenden</h2>

<?php
$stmt = $conn->query("SELECT * FROM tickets ORDER BY datum DESC");
$tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($tickets as $ticket) {
    echo "<div style='border:1px solid black; padding:10px; margin:10px;'>";
    echo "<strong>ID:</strong> " . $ticket['id'] . "<br>";
    echo "<strong>Titel:</strong> " . htmlspecialchars($ticket['titel']) . "<br>";
    echo "<strong>Beskrivning:</strong> " . nl2br(htmlspecialchars($ticket['beskrivning'])) . "<br>";
    echo "<strong>Status:</strong> " . $ticket['status'] . "<br>";
    echo "<strong>Prioritet:</strong> " . $ticket['prioritet'] . "<br>";
    echo "<strong>Rapportör:</strong> " . htmlspecialchars($ticket['rapportor']) . "<br>";
    echo "<strong>Datum:</strong> " . $ticket['datum'] . "<br>";
    echo "</div>";
}
?>
