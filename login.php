<?php include 'db_config.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="text-primary">Login</h2>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" name="login" class="btn btn-primary">Login</button>
    </form>

    <?php
    if (isset($_POST['login'])) {
        $user = $_POST['username'];
        $pass = $_POST['password'];
        $result = $db->query("SELECT * FROM users WHERE username = '$user'");
        $row = $result->fetchArray();
        if ($row && password_verify($pass, $row['password'])) {
            $_SESSION['user'] = $user;
            echo "<script>location.href='index.php';</script>";
        } else {
            echo "<div class='alert alert-danger mt-3'>Invalid credentials!</div>";
        }
    }
    ?>
</div>
</body>
</html>
