<?php
include 'db_config.php';
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="lemons.csv"');

$output = fopen('php://output', 'w');
fputcsv($output, ['Lemon ID', 'Quality']);

$result = $db->query("SELECT lemon_id, quality FROM lemons");
while ($row = $result->fetchArray()) {
    fputcsv($output, [$row['lemon_id'], $row['quality']]);
}
fclose($output);
exit();
?>
