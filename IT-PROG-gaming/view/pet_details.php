<?php
// Start session
session_start();

// Include database credentials
include '../models/dbcredentials.php';

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

// Fetch pet info
$sql = "SELECT * FROM pet_info WHERE id = ?";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Error preparing statement: " . $conn->error);
}

$stmt->bind_param("i", $pet_id);
$stmt->execute();
$pet_result = $stmt->get_result();
$pet = $pet_result->fetch_assoc();

// Check if pet exists
if (!$pet) {
    die("Pet not found.");
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Details - <?php echo htmlspecialchars($pet['name']); ?></title>
    <link rel="stylesheet" href="../public/css/pet_details.css">
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
            <button onclick="document.location='user.php'" class="user">
                <img src="../public/images/user.png" alt="User"/>
            </button>
        </div>
    </div>

    <div class="pet-details">
        <img src="<?php echo htmlspecialchars($pet['image_url']); ?>" alt="Pet Image" style="width: 300px; height: 300px;">
        <h2><?php echo htmlspecialchars($pet['name']); ?></h2>
        <p><strong>Type:</strong> <?php echo htmlspecialchars($pet['type']); ?></p>
        <p><strong>Breed:</strong> <?php echo htmlspecialchars($pet['breed']); ?></p>
        <p><strong>Age:</strong> <?php echo htmlspecialchars($pet['age']); ?> years</p>
        <p><strong>Gender:</strong> <?php echo htmlspecialchars($pet['gender'] === 'M' ? 'Male' : 'Female'); ?></p>
        <p><strong>Personality:</strong> <?php echo htmlspecialchars($pet['personality']); ?></p>
        <p><strong>Coat:</strong> <?php echo htmlspecialchars($pet['coat']); ?></p>
        <p><strong>Eyes:</strong> <?php echo htmlspecialchars($pet['eyes']); ?></p>

        <!-- Back Button -->
        <a href="javascript:history.back()" class="back-button">Back</a>

        <!-- Conditionally Render Adopt Button -->
        <?php if ($pet['availability'] == 1): ?>
            <a href="adopt_check.php?pet_id=<?php echo htmlspecialchars($pet['id']); ?>" class="adopt-button">Adopt</a>
        <?php else: ?>
            <p class="not-eligible">This pet is not eligible for adoption.</p>
        <?php endif; ?>
    </div>
</body>
</html>
