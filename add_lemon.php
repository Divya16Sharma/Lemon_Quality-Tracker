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
    <title>Add Lemon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-success">Add a Lemon 🍋</h2>
        <form method="POST" class="mt-3">
            <div class="mb-3">
                <label for="lemon_id" class="form-label">Lemon ID</label>
                <input type="text" name="lemon_id" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="quality" class="form-label">Quality</label>
                <select name="quality" class="form-select" required>
                    <option value="Fresh">Fresh</option>
                    <option value="Bruised">Bruised</option>
                    <option value="Rotten">Rotten</option>
                </select>
            </div>
            <button type="submit" name="submit" class="btn btn-success">Add Lemon</button>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            $db->exec("CREATE TABLE IF NOT EXISTS lemons (lemon_id TEXT, quality TEXT)");
            $id = $_POST['lemon_id'];
            $quality = $_POST['quality'];
            $db->exec("INSERT INTO lemons (lemon_id, quality) VALUES ('$id', '$quality')");
            echo "<div class='alert alert-success mt-3'>Lemon added!</div>";
        }
        ?>
    </div>
</body>
</html>

