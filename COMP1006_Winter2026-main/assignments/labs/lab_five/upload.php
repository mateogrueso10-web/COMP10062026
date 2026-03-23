<?php
require "connect.php";  // database connection file

// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

$message = "";
$imageTag = "";

if (isset($_POST['submit'])) {

    // Absolute server path to uploads folder
    $targetDir = __DIR__ . "/uploads/";

    // Create folder if it doesn't exist
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    // Check for upload errors
    if ($_FILES['image']['error'] !== 0) {
        $message = "<div class='alert alert-danger'>Upload Error Code: " . $_FILES['image']['error'] . "</div>";
    } else {

        // Allowed MIME types
        $allowedTypes = ["image/jpeg", "image/png", "image/gif"];

        if (!in_array($_FILES['image']['type'], $allowedTypes)) {
            $message = "<div class='alert alert-danger'>Only JPG, PNG, and GIF files are allowed.</div>";
        } elseif ($_FILES['image']['size'] > 2000000) {
            $message = "<div class='alert alert-warning'>File too large (max 2MB).</div>";
        } else {

            // Create a unique filename
            $fileName = time() . "_" . basename($_FILES["image"]["name"]);
            $targetFile = $targetDir . $fileName;

            // Move uploaded file
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {

                // Web path for the browser
                $webPath = "uploads/" . $fileName;

                // Insert into database
                $stmt = $conn->prepare("INSERT INTO images (file_name, file_path) VALUES (?, ?)");
                $stmt->bind_param("ss", $fileName, $webPath);
                $stmt->execute();
                $stmt->close();

                $message = "<div class='alert alert-success'>Upload Successful!</div>";

                $imageTag = "
                    <div class='card mt-4 shadow'>
                        <div class='card-body text-center'>
                            <h5 class='card-title'>Uploaded Image</h5>
                            <img src='$webPath' class='img-fluid rounded' style='max-height:300px;'>
                            <p class='mt-3 text-muted'>$fileName</p>
                        </div>
                    </div>
                ";

            } else {
                $message = "<div class='alert alert-danger'>Upload failed. Check folder permissions.</div>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload Result</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">

    <div class="text-center mb-4">
        <h1 class="display-5">Image Upload</h1>
        <p class="text-muted">Your upload result is shown below</p>
    </div>

    <!-- Message -->
    <?php if ($message) echo $message; ?>

    <!-- Image Card -->
    <?php if ($imageTag) echo $imageTag; ?>

    <!-- Back Button -->
    <div class="text-center mt-4">
        <a href="index.html" class="btn btn-primary">Upload Another Image</a>
        <a href="gallery.php" class="btn btn-secondary ms-2">Go to Gallery</a>
    </div>

</div>

</body>
</html>