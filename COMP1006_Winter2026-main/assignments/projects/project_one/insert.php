<?php
include 'db.php';

// Server-side validation
$first = trim($_POST['first_name']);
$last = trim($_POST['last_name']);
$jersey = trim($_POST['jersey_number']);
$position = trim($_POST['position']);
$phone = trim($_POST['phone']);
$email = trim($_POST['email']);
$team = trim($_POST['team_name']);
$imageName = null;

// Validate required fields
if(empty($first) || empty($last) || empty($jersey) || empty($position) || empty($phone) || empty($email) || empty($team)){
    die("All fields are required.");
}

// Validate email
if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    die("Invalid email format.");
}

// Validate phone (10 digits)
if(!preg_match('/^[0-9]{10}$/', $phone)){
    die("Phone must be 10 digits.");
}

// Validate jersey number (positive integer)
if(!filter_var($jersey, FILTER_VALIDATE_INT) || $jersey < 1 || $jersey > 99){
    die("Jersey number must be between 1 and 99.");
}

// Handle file upload if image is provided
if(isset($_FILES['player_image']) && $_FILES['player_image']['error'] == 0){

    $fileTmp = $_FILES['player_image']['tmp_name'];
    $fileName = $_FILES['player_image']['name'];

    // Create unique filename
    $imageName = time() . "_" . basename($fileName);

    move_uploaded_file($fileTmp, "uploads/" . $imageName);
}

// reCAPTCHA verification
$secretKey = "6LdHbHIsAAAAALMOcS_TUh7u7jKLl6CzHtPhQdz1";
$responseKey = $_POST['g-recaptcha-response'];
$userIP = $_SERVER['REMOTE_ADDR'];

$url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIP";
$response = file_get_contents($url);
$response = json_decode($response);

if(!$response->success){
    die("reCAPTCHA verification failed. Please try again.");
}

// Insert into database using prepared statement
$stmt = $pdo->prepare("INSERT INTO members (first_name, last_name, jersey_number, position, phone, email, team_name, player_image) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->execute([$first, $last, $jersey, $position, $phone, $email, $team, $imageName]);

// Redirect to index.php
header("Location: index.php");
exit();
?>