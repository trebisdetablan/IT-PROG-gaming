<?php
// Start session
session_start();

// Include database credentials
include '../models/dbcredentials.php';

// Redirect to login page if the user is not logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

// Check if the form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Connect to the database
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get username from session (which should not be changed)
    $username = $_SESSION['username'];

    // Get user inputs from POST request
    $phone_number = trim($_POST['phone_number']);
    $address = trim($_POST['address']);
    $zip_code = trim($_POST['zip_code']);
    $city = trim($_POST['city']);
    
    // Get pet_id from POST data if it exists
    $pet_id = isset($_POST['pet_id']) ? $_POST['pet_id'] : null;

    // Update user information in the database
    $sql = "UPDATE user_info SET phone_number = ?, address = ?, zip_code = ?, city = ? WHERE username = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("sssss", $phone_number, $address, $zip_code, $city, $username);

    if ($stmt->execute()) {
        // Redirect to adoption page with pet_id if the update is successful
        if ($pet_id) {
            header("Location: adoption.php?pet_id=" . urlencode($pet_id));
        } else {
            // Redirect to a default page if pet_id is not available
            header("Location: user.php");
        }
        exit();
    } else {
        echo "Error updating information: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
