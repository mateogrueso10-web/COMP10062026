if(empty($_POST['first_name'])) {
    die("First name is required.");
}

if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    die("Invalid email format.");
}