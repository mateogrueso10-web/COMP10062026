<?php
require "connect.php";

ini_set('display_errors', 1);
error_reporting(E_ALL);

$result = $conn->query("SELECT * FROM images ORDER BY uploaded_at DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gallery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="mb-4">Image Gallery</h2>

    <div class="row">
        <?php while($row = $result->fetch_assoc()): ?>
            <div class="col-md-4 mb-4">
                <div class="card shadow">
                    <img src="<?php echo $row['file_path']; ?>" class="card-img-top">
                    <div class="card-body">
                        <p class="text-muted"><?php echo $row['file_name']; ?></p>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

</div>

</body>
</html>