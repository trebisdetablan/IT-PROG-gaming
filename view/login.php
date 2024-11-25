<?php
include '../models/dbcredentials.php';

// Start session to manage user login
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connect to the database
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get user inputs
    $username = $conn->real_escape_string(trim($_POST['username']));
    $password = trim($_POST['password']);

    // Search for the user in the database
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // If user found, verify password
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username; // Store user info in session
            header("Location: home.php"); // Redirect to home page after successful login
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found with that username.";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>

<html></html>
<head>
    <title>Log In</title>
    <link rel="stylesheet" href="../public/css/input_form.css">
</head>
<body>
    <div class="form">
        <h1 class="title_card">LOGIN</h1>
        <form class="detail_form" action="welcome.php">
            <input type="text" class="input" name="username" placeholder="Username"><br>
            <input type="text" class="input" name="password" placeholder="Password"><br>
            <br>
            <button class="register_button" type="submit">Login</button>
        </form>
    </div>
</body>
</html>