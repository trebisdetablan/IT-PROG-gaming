<?php include '../models/dbcredentials.php'; 
$conn = new mysqli($servername, $username, $password, $database);

// connects to user information 
$sql = "SELECT * FROM user_info";
$result = $conn->query($sql);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully <br>";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user info
$sql = "SELECT * FROM user_info WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user_result = $stmt->get_result();
$user = $user_result->fetch_assoc();

// Fetch user's favorite pets
/*
$favorites_sql = "";
$favorites_stmt = $conn->prepare($favorites_sql);
$favorites_stmt->bind_param("i", $user_id);
$favorites_stmt->execute();
$favorites_result = $favorites_stmt->get_result(); */ 
?>




<html>
<head>
    <title>Bini's Buddies</title>
    <link rel="stylesheet" href="../public/css/user.css">
</head>
<body>
    <div class="topbar">
        <div class="storename">
            <h2>store name</h2>
        </div>
        <div class="navbar">
            <button onclick="document.location='home.php'">Home</button>
            <button onclick="document.location='about.php'">About</button>
            <button onclick="document.location='pets.php'">Pets</button>
            <button onclick="document.location='faq.php'">FAQs</button>
            <button onclick="document.location='user.php'" class="user">
                <img src="../public/images/user.png"/>
            </button>
        </div>
    </div>
    <div class="sections">
        <div class="user-section">
            <img src="../public/images/user.png"/>
        </div>
        <div class="details-section">
            <h2 class="name-section"><?php echo htmlspecialchars($user['username']); ?></h2>
            <div class="favorites-section">
                <h2>favorites</h2>
                <div class="imgcont">
                <?php while ($favorite = $favorites_result->fetch_assoc()) { ?>
                    <a href= "pet_details.php?pet_id=<?php echo $favorite['id']; ?>" class="polaroid">
                        <div class="image">
                            <img src="../public/images/pets/<?php echo htmlspecialchars($favorite['image']); ?>" alt="Pet Image">
                        </div>
                        <p class="pet-name"><?php echo htmlspecialchars($favorite['name']); ?></p>
                    </a>
                    <?php } ?> 
                   
                </div>
            </div>
            <div class="adoptions-section">
                <h2>past adoptions</h2>
                <div class="imgcont">
                <?php while ($adoption = $adoptions_result->fetch_assoc()) { ?>
                    <a href= "pet_details.php?pet_id=<?php echo $adoption['id']; ?>" class="polaroid">
                        <div class="image">
                            <img src="../public/images/pets/<?php echo htmlspecialchars($adoption['image']); ?>" alt="Pet Image">
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
// Close the database connections
$stmt->close();
$favorites_stmt->close();
$adoptions_stmt->close();
$conn->close();
?>