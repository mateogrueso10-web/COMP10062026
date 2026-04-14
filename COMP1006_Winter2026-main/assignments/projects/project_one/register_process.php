<?php
include 'db.php';

// Get form data
$username = trim($_POST['username']);
$email = trim($_POST['email']);
$password = $_POST['password'];

// Validate
if(empty($username) || empty($email) || empty($password)){
    die("All fields are required.");
}

if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    die("Invalid email.");
}

if(strlen($password) < 6){
    die("Password must be at least 6 characters.");
}

// reCAPTCHA
$secretKey = "6LdJs7csAAAAAMpvE0PFBevIMsVk0L0pQRBtcwNu";
$responseKey = $_POST['g-recaptcha-response'];
$userIP = $_SERVER['REMOTE_ADDR'];

$url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIP";
$response = file_get_contents($url);
$response = json_decode($response);

if(!$response->success){
    die("reCAPTCHA failed.");
}

// Hash password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Insert user
$stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
$stmt->execute([$username, $email, $hashedPassword]);

// Redirect to login
header("Location: login.php");
exit();
?>