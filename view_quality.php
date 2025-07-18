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
    <title>View Lemons</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-primary">🍋 Lemon Quality List</h2>

        <form method="GET" class="mb-4">
            <label for="quality" class="form-label">Filter by Quality:</label>
            <select name="quality" class="form-select w-25 d-inline-block">
                <option value="">-- All --</option>
                <option value="Fresh">Fresh</option>
                <option value="Bruised">Bruised</option>
                <option value="Rotten">Rotten</option>
            </select>
            <button type="submit" class="btn btn-outline-primary ms-2">Filter</button>
        </form>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr><th>ID</th><th>Quality</th><th>Action</th></tr>
            </thead>
            <tbody>
            <?php
            $filter = isset($_GET['quality']) ? $_GET['quality'] : '';
            $query = "SELECT rowid, * FROM lemons";
            if ($filter !== '') {
                $query .= " WHERE quality = '$filter'";
            }
            $result = $db->query($query);

            $counts = ['Fresh' => 0, 'Bruised' => 0, 'Rotten' => 0];

            while ($row = $result->fetchArray()) {
                $counts[$row['quality']]++;
                echo "<tr>
                        <td>{$row['lemon_id']}</td>
                        <td>{$row['quality']}</td>
                        <td>
                            <form method='POST' style='display:inline'>
                                <input type='hidden' name='delete_id' value='{$row['rowid']}'>
                                <button type='submit' class='btn btn-sm btn-danger'>Delete</button>
                            </form>
                        </td>
                      </tr>";
            }

            if (isset($_POST['delete_id'])) {
                $id = $_POST['delete_id'];
                $db->exec("DELETE FROM lemons WHERE rowid = $id");
                echo "<script>location.href='view_quality.php';</script>";
            }
            ?>
            </tbody>
        </table>

        <h4 class="mt-5">Quality Distribution</h4>
        <canvas id="qualityChart" width="400" height="200"></canvas>
        <script>
            const ctx = document.getElementById('qualityChart').getContext('2d');
            const chart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Fresh', 'Bruised', 'Rotten'],
                    datasets: [{
                        label: 'Lemon Quality',
                        data: [<?= $counts['Fresh'] ?>, <?= $counts['Bruised'] ?>, <?= $counts['Rotten'] ?>],
                        backgroundColor: ['#28a745', '#ffc107', '#dc3545'],
                    }]
                }
            });
        </script>
    </div>
</body>
</html>
