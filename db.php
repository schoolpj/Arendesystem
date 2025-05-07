<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$host = 'localhost';
$dbname = 'arendesystem';
$username = 'root';
$password = '';

// MySQLi-anslutning
$conn = mysqli_connect($host, $username, $password, $dbname);

// Kontrollera anslutning
if (!$conn) {
    die("Anslutningsfel: " . mysqli_connect_error());
}
?>
