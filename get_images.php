<?php
include 'db.php';

// Fetch two images with the lowest fetch count
$sql = "SELECT * FROM updated_csv_file ORDER BY fetch_count ASC LIMIT 2";
$result = $conn->query($sql);

$images = array();
while ($row = $result->fetch_assoc()) {
    // Update fetch count for each image
    $update_sql = "UPDATE updated_csv_file SET fetch_count = fetch_count + 1 WHERE id = " . $row['id'];
    $conn->query($update_sql);
    $images[] = $row;
}



echo json_encode($images);
?>
