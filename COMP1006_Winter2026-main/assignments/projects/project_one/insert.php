$secretKey = 6LfoaXIsAAAAAKpf0UgEvFS3njX9vnOdUancruez;
$responseKey = $_POST['g-recaptcha-response'];
$userIP = $_SERVER['REMOTE_ADDR'];

$url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIP";

$response = file_get_contents($url);
$response = json_decode($response);

if(!$response->success){
    die("reCAPTCHA verification failed. Please try again.");
}