<?php
// Start session
session_start();

// Debug before logout
if (isset($_SESSION['username'])) {
    echo "Before logout: User is logged in as " . $_SESSION['username'] . "<br>";
} else {
    echo "Before logout: No user is currently logged in.<br>";
}

// Unset all session variables

session_unset();

// Destroy the session
session_destroy();

// Debug after logout
if (isset($_SESSION['username'])) {
    echo "After logout: User is still logged in as " . $_SESSION['username'];
} else {
    echo "After logout: No user is currently logged in.<br>";
}

// Optionally clear cookies for "Remember Me" if used
if (isset($_COOKIE['username'])) {
    setcookie("username", "", time() - 3600, "/"); // Set cookie expiration time in the past
    echo "Username cookie cleared.<br>";
}

// Redirect 
header("Location: login.html");
exit();
?>
