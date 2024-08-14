<?php
include 'db.php';

header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename=images_ranking.csv');

$output = fopen('php://output', 'w');
fputcsv($output, array('Image ID', 'Fetch Count', 'Elo Rating'));

$sql = "SELECT id, fetch_count, elo_rating FROM updated_csv_file ORDER BY elo_rating DESC";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    fputcsv($output, $row);
}

fclose($output);
?>
