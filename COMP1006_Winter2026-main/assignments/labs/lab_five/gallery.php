<?php
require "connect.php";  // database connection

// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Fetch all images from the database
$result = $conn->query("SELECT * FROM images ORDER BY uploaded_at DESC");
$images = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $images[] = $row;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Image Gallery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">

    <div class="text-center mb-4">
        <h1 class="display-5">Gallery</h1>
        <p class="text-muted">All uploaded images are shown below</p>
        <a href="index.html" class="btn btn-primary">Upload New Image</a>
    </div>

    <?php if (empty($images)): ?>
        <div class="alert alert-info text-center">No images uploaded yet.</div>
    <?php else: ?>
        <div class="row">
            <?php foreach($images as $img): ?>
                <div class="col-md-4 mb-4">
                    <div class="card shadow">
                        <img src="<?php echo $img['file_path']; ?>" class="card-img-top img-fluid" style="max-height:250px; object-fit:cover;">
                        <div class="card-body text-center">
                            <p class="text-muted"><?php echo $img['file_name']; ?></p>
                            <small class="text-secondary"><?php echo date("F j, Y H:i", strtotime($img['uploaded_at'])); ?></small>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

</div>

</body>
</html>