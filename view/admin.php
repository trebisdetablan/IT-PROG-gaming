<?php
session_start();  

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order_id = $_POST['order_id'];
    $action = $_POST['action'];  

    
    foreach ($_SESSION['waitlist'] as &$order) {
        if ($order['order_id'] == $order_id) {
            $order['status'] = ($action == 'confirm') ? 'Confirmed' : 'Rejected';

            
            $user_email = 'user@localhost';  // Simulate user email for testing on localhost
            $adoption_center_address = '2401 Taft Ave, Malate, Manila';  

            
            $subject = ($action == 'confirm') ? 'Adoption Confirmed' : 'Adoption Rejected';
            $message = "Dear user,\n\n";

            if ($action == 'confirm') {
                $message .= "Your adoption for Pet ID: " . $order['pet_id'] . " has been confirmed.\n";
                $message .= "If you selected pick-up, here is the address of the adoption center:\n";
                $message .= $adoption_center_address . "\n";
            } else {
                $message .= "Unfortunately, your adoption for Pet ID: " . $order['pet_id'] . " has been rejected.\n";
            }

            $message .= "\nThank you,\nBini";

            
            $headers = 'From: no-reply@localhost' . "\r\n" .
                       'Reply-To: no-reply@localhost' . "\r\n" .
                       'X-Mailer: PHP/' . phpversion();

            
            if (mail($user_email, $subject, $message, $headers)) {
                echo "Notification email sent to the user.";
            } else {
                echo "Failed to send notification email.";
            }

            break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Manage Orders</title>
</head>
<body>
    <h1>Pending Orders (Admin)</h1>

    <?php
    // Display all pending orders
    if (isset($_SESSION['waitlist']) && count($_SESSION['waitlist']) > 0) {
        foreach ($_SESSION['waitlist'] as $order) {
            if ($order['status'] == 'Pending') {
                echo "Order #" . $order['order_id'] . "<br>";
                echo "Pet ID: " . $order['pet_id'] . "<br>";
                echo "Status: " . $order['status'] . "<br>";

                echo "<form method='POST' action=''>";
                echo "<input type='hidden' name='order_id' value='" . $order['order_id'] . "'>";
                echo "<button type='submit' name='action' value='confirm'>Confirm</button>";
                echo "<button type='submit' name='action' value='reject'>Reject</button>";
                echo "</form><br>";
            }
        }
    } else {
        echo "No pending orders.";
    }
    ?>
</body>
</html>
