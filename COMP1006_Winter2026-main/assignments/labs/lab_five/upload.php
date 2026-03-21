<?php
if (isset($_POST['submit'])) {

    $targetDir = "uploads/";

    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    $message = "";
    $imageTag = "";

    if ($_FILES['image']['error'] !== 0) {
        $message = "<div class='alert alert-danger'>Upload Error Code: " . $_FILES['image']['error'] . "</div>";
    } else {

        $allowedTypes = ["image/jpeg", "image/png", "image/gif"];

        if (!in_array($_FILES['image']['type'], $allowedTypes)) {
            $message = "<div class='alert alert-danger'>Only JPG, PNG, and GIF files are allowed.</div>";
        } 
        elseif ($_FILES['image']['size'] > 2000000) {
            $message = "<div class='alert alert-warning'>File too large (max 2MB).</div>";
        } 
        else {

            $fileName = time() . "_" . basename($_FILES["image"]["name"]);
            $targetFile = $targetDir . $fileName;

            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {

                $message = "<div class='alert alert-success'>Upload Successful!</div>";

                $imageTag = "
                    <div class='card mt-4 shadow'>
                        <div class='card-body text-center'>
                            <h5 class='card-title'>Uploaded Image</h5>
                            <img src='$targetFile' class='img-fluid rounded' style='max-height:300px;'>
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
    <?php if (isset($message)) echo $message; ?>

    <!-- Image Card -->
    <?php if (isset($imageTag)) echo $imageTag; ?>

    <!-- Back Button -->
    <div class="text-center mt-4">
        <a href="index.html" class="btn btn-primary">Upload Another Image</a>
    </div>

</div>

</body>
</html>