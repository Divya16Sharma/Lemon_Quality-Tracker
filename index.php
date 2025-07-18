<?php
include 'db_config.php';
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Lemon Quality Tracker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center text-warning mb-4">🍋 Lemon Quality Tracker</h1>
        <div class="d-flex justify-content-center gap-3">
            <a href="add_lemon.php" class="btn btn-success">Add Lemon</a>
            <a href="view_quality.php" class="btn btn-primary">View Quality</a>
        </div>
    </div>
</body>
</html>

