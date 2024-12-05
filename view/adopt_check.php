<?php
// Start session
session_start();

// Include database credentials
include '../models/dbcredentials.php';

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

// Get pet_id from query string
if (!isset($_GET['pet_id'])) {
    die("Pet ID not specified.");
}
$pet_id = $_GET['pet_id'];

// Connect to the database
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get username from session
$username = $_SESSION['username'];

// Fetch user info
$sql = "SELECT * FROM user_info WHERE username = ?";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Error preparing statement: " . $conn->error);
}

$stmt->bind_param("s", $username);
$stmt->execute();
$user_result = $stmt->get_result();
$user = $user_result->fetch_assoc();

// Debugging output to verify user data
/*if (!$user) {
    die("User data not found in the database.");
}

echo "<pre>";
print_r($user);
echo "</pre>";
exit(); */ 

// Check if user info is complete (you can add more fields as required)
if (empty(trim($user['address'])) || empty(trim($user['phone_number'])) || empty(trim($user['city'])) || empty(trim($user['zip_code']))) {
    // Redirect to user info update page
    header("Location: userinfoupdate.php");
} else {
    // Redirect to adoption summary page
    header("Location: adoption.php");
}

$stmt->close();
$conn->close();
?>
