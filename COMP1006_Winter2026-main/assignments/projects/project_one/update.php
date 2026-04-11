<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'db.php';

// Get POST data
$id = $_POST['id'];
$stmt = $pdo->prepare("SELECT * FROM members WHERE id = ?");
$stmt->execute([$id]);
$member = $stmt->fetch();
$first = trim($_POST['first_name']);
$last = trim($_POST['last_name']);
$jersey_number = trim($_POST['jersey_number']);
$position = trim($_POST['position']);
$phone = trim($_POST['phone']);
$email = trim($_POST['email']);
$team = trim($_POST['team_name']);
$imageName = $member['player_image']; // keep old image

// Validate
if (empty($first) || empty($last) || empty($jersey_number) || empty($position) || empty($phone) || empty($email) || empty($team)) {
    die("All fields are required.");
}

// Validate email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email format.");
}

// Validate phone (10 digits)
if (!preg_match('/^[0-9]{10}$/', $phone)) {
    die("Phone must be 10 digits.");
}


// Validate jersey number (positive integer)
if (!filter_var($jersey_number, FILTER_VALIDATE_INT) || $jersey_number < 1 || $jersey_number > 99) {
    die("Jersey number must be between 1 and 99.");
}

// Handle file upload if image is provided
if(isset($_FILES['player_image']) && $_FILES['player_image']['error'] == 0){
    $fileTmp = $_FILES['player_image']['tmp_name'];
    $fileName = $_FILES['player_image']['name'];

    $imageName = time() . "_" . basename($fileName);

    move_uploaded_file($fileTmp, "uploads/" . $imageName);
}

// Update using prepared statement
$stmt = $pdo->prepare("
    UPDATE members
    SET first_name = ?, last_name = ?, jersey_number = ?, position = ?, phone = ?, email = ?, team_name = ?, player_image = ?
    WHERE id = ?
");

$stmt->execute([$first, $last, $jersey_number, $position, $phone, $email, $team, $imageName, $id]);

header("Location: index.php");
exit();
?>