<?php
session_start();
include '../models/dbcredentials.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $adoption_id = intval($_POST['adoption_id']);
    $action = $_POST['action'];

    $conn = new mysqli($servername, $username, $password, $database);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $status = ($action === 'approve') ? 1 : -1;

    $stmt = $conn->prepare("UPDATE adoptions SET accepted = ? WHERE id = ?");
    $stmt->bind_param("ii", $status, $adoption_id);

    if ($stmt->execute()) {
        
        $stmt = $conn->prepare("
            SELECT a.username, a.type, u.email, p.name AS pet_name
            FROM adoptions a
            JOIN user_info u ON a.username = u.username
            JOIN pet_info p ON a.pet_id = p.id
            WHERE a.id = ?
        ");
        $stmt->bind_param("i", $adoption_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $adoption = $result->fetch_assoc();

        
        $user_email = $adoption['email'];
        $pet_name = $adoption['pet_name'];
        $adoption_type = $adoption['type'];
        $center_address = "2401 Taft Malate Ave, Manila, Metro Manila, 0922"; 

        // Email subject and message
        $subject = ($status === 1) ? "Adoption Approved for $pet_name" : "Adoption Rejected for $pet_name";
        $message = ($status === 1)
            ? "Congratulations! Your adoption request for $pet_name has been approved."
            : "We're sorry, but your adoption request for $pet_name has been rejected.";

        if ($status === 1 && $adoption_type === 'pickup') {
            $message .= "\n\nPlease pick up your pet from the following address:\n$center_address";
        }
        
        $message .= "\n\nThank you for choosing Bini's Buddies.";

        $headers = "From: admin@binisbuddies.com\r\n";
        if (mail($user_email, $subject, $message, $headers)) {
            $_SESSION['message'] = "Adoption request updated and email sent to the user.";
        } else {
            $_SESSION['error'] = "Adoption request updated, but email notification failed.";
        }
    } else {
        $_SESSION['error'] = "Failed to update adoption request.";
    }

    $stmt->close();
    $conn->close();

    header("Location: admin_waitlist.php");
    exit();
}
?>
