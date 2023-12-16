<?php
// food_pairing_recommendations.php

// Establish a connection to the database
$host = 'localhost';
$username = 'root'; // Assuming you're using the default XAMPP configuration
$password = '';
$database = 'wine_cellar';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Get the wine ID from the URL parameter
$wineId = isset($_GET['wine_id']) ? $_GET['wine_id'] : null;

// Check if the wine ID is provided
if ($wineId) {
    // Fetch food pairing recommendations for the specified wine ID
    $sql = "SELECT food_item FROM food_pairing WHERE wine_id = $wineId";
    $result = $conn->query($sql);

    // Check if there are any food pairing recommendations
    if ($result) {
        if ($result->num_rows > 0) {
            echo '<h2>Food Pairing Recommendations</h2>';
            echo '<ul>';
            while ($row = $result->fetch_assoc()) {
                echo '<li>' . $row['food_item'] . '</li>';
            }
            echo '</ul>';
        } else {
            echo '<p>No food pairing recommendations available for this wine.</p>';
        }
    } else {
        echo '<p>Error fetching food pairing recommendations: ' . $conn->error . '</p>';
    }
} else {
    echo '<p>Invalid wine ID.</p>';
}

$conn->close();
?>
