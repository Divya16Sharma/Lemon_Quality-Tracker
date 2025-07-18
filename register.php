<?php include 'db_config.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="text-info">Register</h2>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" name="register" class="btn btn-info">Register</button>
    </form>

    <?php
    if (isset($_POST['register'])) {
        $user = $_POST['username'];
        $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $db->exec("INSERT INTO users (username, password) VALUES ('$user', '$pass')");
        echo "<div class='alert alert-success mt-3'>User registered!</div>";
    }
    ?>
</div>
</body>
</html>
