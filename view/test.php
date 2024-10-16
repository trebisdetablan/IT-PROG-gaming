<?php 
include "../models/dbcredentials.php";

$conn = new mysqli($servername, $username, $password, $database);

$sql = "SELECT * FROM adoptions";
$result = $conn->query($sql);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully <br>";

// Assuming $result is your query result from an earlier mysqli query
if (mysqli_num_rows($result) > 0) {
    // If there are rows in the result, loop through them
    echo "Using mysqli_fetch_array():<br>";
    while ($row = mysqli_fetch_array($result)) {
        echo 
        "ID: " . $row['id'] . 
        ", pet ID: " . $row['pet_id'] . 
        ", Adoptee: " . $row['username'] . 
        ", Accepted: " . $row['accepted'] . "<br>";
    }
} else {
    // If no rows are found, display a message
    
    echo "No records found.";
}

$conn->close();
?>