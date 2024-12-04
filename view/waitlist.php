<?php
session_start();
include '../models/dbcredentials.php';

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch adoption requests for the logged-in user
$username = $_SESSION['username'];
$stmt = $conn->prepare("
    SELECT 
        a.id AS adoption_id,
        p.name AS pet_name,
        p.type AS pet_type,
        p.breed AS pet_breed,
        a.accepted
    FROM adoptions a
    JOIN pet_info p ON a.pet_id = p.id
    WHERE a.username = ?
");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Waitlist</title>
    <link rel="stylesheet" href="../public/css/waitlist.css">
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
                <img src="../public/images/user.png" alt="User Profile">
            </button>
        </div>
    </div>

    <div class="waitlist-container">
        <h1>Your Pending Requests</h1>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="order">
                    <h2>Adoption ID: <?php echo htmlspecialchars($row['adoption_id']); ?></h2>
                    <p>Pet: <?php echo htmlspecialchars($row['pet_name']); ?> (<?php echo htmlspecialchars($row['pet_type'] . ', ' . $row['pet_breed']); ?>)</p>
                    <p>Status: 
                        <span class="status <?php echo $row['accepted'] === 0 ? 'pending' : ($row['accepted'] === 1 ? 'approved' : 'rejected'); ?>">
                            <?php echo $row['accepted'] === 0 ? 'Pending' : ($row['accepted'] === 1 ? 'Approved' : 'Rejected'); ?>
                        </span>
                    </p>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>You have no adoption requests at the moment.</p>
        <?php endif; ?>
    </div>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
