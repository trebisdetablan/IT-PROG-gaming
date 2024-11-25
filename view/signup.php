<?php
include '../models/dbcredentials.php';

// Start session to handle errors or success messages if needed
session_start();

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connect to the database
    $conn = new mysqli($servername, $username, $password, $database);

    // Check for connection errors
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get and sanitize user inputs
    $username = $conn->real_escape_string(trim($_POST['username']));
    $email = $conn->real_escape_string(trim($_POST['email']));
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Basic validation
    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        die("All fields are required.");
    }

    if ($password !== $confirm_password) {
        die("Passwords do not match.");
    }

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Insert user into the database
    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("sss", $username, $email, $hashed_password);

    // Execute the statement and check for success
    if ($stmt->execute()) {
        echo "Registration successful!";
        header("Location: home.php"); // Redirect to home page after successful signup
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>

<html>
<head>
    <title>Sign Up</title>
    <link rel="stylesheet" href="../public/css/input_form.css">
</head>
<body>
    <div class="form">
        <h1 class="title_card">SIGNUP</h1>
        <form class="detail_form" action="home.html">
            <input type="text" class="input" name="username" placeholder="Username" required><br>
            <input type="text" class="input" name="email" placeholder="Email" required><br>
            <input type="text" class="input" name="password" placeholder="Password" required><br>
            <input type="text" class="input" name="confirm_password" placeholder="Confirm Password" required><br>
            <br>
            <button class="register_button" type="submit">Register</button>
        </form>
    </div>
</body>
</html>