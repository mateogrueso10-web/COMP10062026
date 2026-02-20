<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'db.php';

// Check if ID exists
if (!isset($_GET['id'])) {
    die("No member selected.");
}

$id = $_GET['id'];

// Delete using prepared statement
$stmt = $pdo->prepare("DELETE FROM members WHERE id = ?");
$stmt->execute([$id]);

// Redirect back to index
header("Location: index.php");
exit();
?>