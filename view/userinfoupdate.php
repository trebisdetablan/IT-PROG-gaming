<?php
session_start();

// Include database credentials
include '../models/dbcredentials.php';

// Get pet_id from query string if it exists
$pet_id = isset($_GET['pet_id']) ? $_GET['pet_id'] : null;

// Redirect to login page if the user is not logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

// Connect to the database
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user information
$username = $_SESSION['username'];

$sql = "SELECT * FROM user_info WHERE username = ?";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Error preparing statement: " . $conn->error);
}

$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Info Update</title>
    <link rel="stylesheet" href="../public/css/userinfoupdate.css">
  
</head>
<body>
    <div class="container">

        <!-- Update Form Section -->
        <div class="update-form">
            <h2>Update Information</h2>
            <form class="detail_form" action="update_user_info.php" method="POST">
                <input type="hidden" name="pet_id" value="<?php echo htmlspecialchars($pet_id); ?>">
                <input type="text" class="input" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" placeholder="Username" readonly><br>
                <input type="email" class="input" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" placeholder="Email" readonly><br>
                <input type="text" class="input" name="phone_number" value="<?php echo htmlspecialchars($user['phone_number']); ?>" placeholder="Phone Number" required><br>
                <input type="text" class="input" name="address" value="<?php echo htmlspecialchars($user['address']); ?>" placeholder="Address" required><br>
                <input type="text" class="input" name="zip_code" value="<?php echo htmlspecialchars($user['zip_code']); ?>" placeholder="Zip Code" required><br>
                <input type="text" class="input" name="city" value="<?php echo htmlspecialchars($user['city']); ?>" placeholder="City" required><br>
                <br>
                <button class="register_button" type="submit">Confirm Update</button>
            </form>
        </div>
    </div>
</body>
</html>
