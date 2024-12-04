<?php
// Start the session
session_start();

// Check if a session is not already set, but there's a username cookie
if (!isset($_SESSION['username']) && isset($_COOKIE['username'])) {
    $_SESSION['username'] = $_COOKIE['username'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../public/css/home.css">
</head>
<body>
    <div class="topbar">
        <div class="storename">
            <h2>Bini's Buddies</h2>
        </div>
        <div class="navbar">
            <button onclick="document.location='home.php'">Home</button>
            <button onclick="document.location='about.php'">About</button>
            <button onclick="document.location='pets.php'">Pets</button>
            <button onclick="document.location='faq.php'">FAQs</button>

            <!-- Check if the user is logged in -->
            <?php if (isset($_SESSION['username'])): ?>
                <!-- If logged in, show profile button -->
                <button onclick="document.location='user.php'" class="user">  <?php echo $_SESSION['username'] ?>
                    <img src="../public/images/user.png" alt="User"/> 
                </button>
            <?php else: ?>
                <!-- If not logged in, show login button -->
                <button onclick="document.location='login.php'" class="user"> login
                    <img src="../public/images/user.png" alt="User"/> 
                </button>
            <?php endif; ?>
        </div>
    </div>

    <div class="body">
        <div class="text">
            <h1>HOME</h1>
            <p>Lorem ipsum odor amet, consectetuer adipiscing elit. Eros ante donec porta eu pretium bibendum mauris.</p>
        </div>
        <div class="imgcont">
            <div class="polaroid">
                <!-- Placeholder for image -->
                <div class="image">
                    <p>Image</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>