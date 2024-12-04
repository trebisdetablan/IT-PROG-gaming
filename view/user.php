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

// Fetch user's favorite pets
$favorites_sql = "SELECT pet_info.* FROM pet_info 
                  INNER JOIN hearts ON pet_info.id = hearts.pet_id
                  WHERE hearts.username = ?";
$favorites_stmt = $conn->prepare($favorites_sql);
if ($favorites_stmt === false) {
    die("Error preparing statement: " . $conn->error);
}
$favorites_stmt->bind_param("s", $username);
$favorites_stmt->execute();
$favorites_result = $favorites_stmt->get_result();

// Fetch user's past adoptions
$adoptions_sql = "SELECT pet_info.* FROM pet_info 
                  INNER JOIN adoptions ON pet_info.id = adoptions.pet_id
                  WHERE adoptions.username = ?";
$adoptions_stmt = $conn->prepare($adoptions_sql);
if ($adoptions_stmt === false) {
    die("Error preparing statement: " . $conn->error);
}
$adoptions_stmt->bind_param("s", $username);
$adoptions_stmt->execute();
$adoptions_result = $adoptions_stmt->get_result();

// Close the statement for user info
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bini's Buddies - User Profile</title>
    <link rel="stylesheet" href="../public/css/user.css">
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

    <div class="sections">
    <div class="user-section">
        <img src="../public/images/user.png" alt="User Image"/>
    </div>
    <div class="details-section">
        <h2 class="name-section"><?php echo htmlspecialchars($user['username']); ?></h2>
        <div class="favorites-section">
            <h2>Favorites</h2>
            <div class="imgcont">
                <?php while ($favorite = $favorites_result->fetch_assoc()) { ?>
                    <a href="pet_details.php?pet_id=<?php echo htmlspecialchars($favorite['id']); ?>" class="polaroid">
                        <div class="image">
                            <img src="<?php echo htmlspecialchars($favorite['image_url']); ?>"  style="width: 260px; height: 260px;" alt="Pet Image">
                        </div>
                        <p class="pet-name"><?php echo htmlspecialchars($favorite['name']); ?></p>
                    </a>
                <?php } ?>
            </div>
        </div>
        <div class="adoptions-section">
            <h2>Past Adoptions</h2>
            <div class="imgcont">
                <?php while ($adoption = $adoptions_result->fetch_assoc()) { ?>
                    <a href="pet_details.php?pet_id=<?php echo htmlspecialchars($adoption['id']); ?>" class="polaroid">
                        <div class="image">
                            <img src="<?php echo htmlspecialchars($adoption['image_url']); ?>"  style="width: 260px; height: 260px;" alt="Pet Image">
                        </div>
                        <p class="pet-name"><?php echo htmlspecialchars($adoption['name']); ?></p>
                    </a>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

</body>
</html>

<?php
// Close the statement for favorites and adoptions
$favorites_stmt->close();
$adoptions_stmt->close();

// Close the database connection
$conn->close();
?>
