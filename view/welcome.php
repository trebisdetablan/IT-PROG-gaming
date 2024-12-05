<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

$username = htmlspecialchars($_SESSION['username']); // Sanitize username for display
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>

    <script>
        // Redirect to home page after 3 seconds
        setTimeout(() => {
            window.location.href = "home.php";
        }, 3000);
    </script>
</head>
<body>
    <h1>Welcome, <?php echo $username; ?>!</h1>
    <p>You will be redirected to the home page shortly.</p>
</body>
</html>
