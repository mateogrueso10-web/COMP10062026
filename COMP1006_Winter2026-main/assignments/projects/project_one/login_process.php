<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include 'db.php';

$email = trim($_POST['email']);
$password = $_POST['password'];

if(empty($email) || empty($password)){
    die("All fields are required.");
}

// Find user
$stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch();

// Verify user + password
if($user && password_verify($password, $user['password'])){

    // Store session
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];

    header("Location: index.php");
    exit();

} else {
    die("Invalid email or password.");
}
?>