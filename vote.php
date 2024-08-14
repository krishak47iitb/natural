<?php
include 'db.php';

$image1_id = $_POST['image1_id'];
$image2_id = $_POST['image2_id'];
$winner_id = $_POST['winner_id'];

// Fetch current Elo ratings for both images
$sql = "SELECT id, elo_rating FROM updated_csv_file WHERE id IN ($image1_id, $image2_id)";
$result = $conn->query($sql);

$images = array();
while ($row = $result->fetch_assoc()) {
    $images[$row['id']] = $row['elo_rating'];
}

$rating1 = $images[$image1_id];
$rating2 = $images[$image2_id];

// Calculate expected scores
$expected_score1 = 1 / (1 + pow(10, ($rating2 - $rating1) / 400));
$expected_score2 = 1 - $expected_score1;

// Determine actual scores
$actual_score1 = ($winner_id == $image1_id) ? 1 : 0;
$actual_score2 = 1 - $actual_score1;

// Update Elo ratings
$k = 32; // K-factor
$new_rating1 = $rating1 + $k * ($actual_score1 - $expected_score1);
$new_rating2 = $rating2 + $k * ($actual_score2 - $expected_score2);

// Save new ratings to the database
$update_sql1 = "UPDATE updated_csv_file SET elo_rating = $new_rating1 WHERE id = $image1_id";
$update_sql2 = "UPDATE updated_csv_file SET elo_rating = $new_rating2 WHERE id = $image2_id";
$conn->query($update_sql1);
$conn->query($update_sql2);

echo "Vote counted and ratings updated!";
?>
