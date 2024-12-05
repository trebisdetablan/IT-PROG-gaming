<?php
session_start();
include '../models/dbcredentials.php';


if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== 1) {
    header("Location: login.php");
    exit();
}


$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$stmt = $conn->prepare("
    SELECT 
        a.id AS adoption_id,
        u.username,
        u.phone_number,
        u.address,
        u.city,
        p.name AS pet_name,
        p.type AS pet_type
    FROM adoptions a
    JOIN user_info u ON a.username = u.username
    JOIN pet_info p ON a.pet_id = p.id
    WHERE a.accepted = 0
");
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Waitlist</title>
    <link rel="stylesheet" href="../public/css/waitlist.css">
</head>
<body>
    <h1>Pending Adoption Requests</h1>
    <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div>
                <h2>Adoption ID: <?php echo htmlspecialchars($row['adoption_id']); ?></h2>
                <p>Pet: <?php echo htmlspecialchars($row['pet_name']); ?> (<?php echo htmlspecialchars($row['pet_type']); ?>)</p>
                <p>User: <?php echo htmlspecialchars($row['username']); ?></p>
                <p>Phone: <?php echo htmlspecialchars($row['phone_number']); ?></p>
                <p>Address: <?php echo htmlspecialchars($row['address'] . ', ' . $row['city']); ?></p>
                <form action="update_adoption.php" method="POST">
                    <input type="hidden" name="adoption_id" value="<?php echo $row['adoption_id']; ?>">
                    <button type="submit" name="action" value="approve">Approve</button>
                    <button type="submit" name="action" value="reject">Reject</button>
                </form>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No pending adoption requests.</p>
    <?php endif; ?>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
