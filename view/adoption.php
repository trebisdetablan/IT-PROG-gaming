<?php
session_start(); // Ensure the session is started to get the username

// Include database credentials
include '../models/dbcredentials.php';

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from the form
    $method = $_POST['method'];
    $date = isset($_POST['date']) ? htmlspecialchars($_POST['date']) : null;
    $time = isset($_POST['time']) ? htmlspecialchars($_POST['time']) : null;
    $pet_id = isset($_POST['pet_id']) ? htmlspecialchars($_POST['pet_id']) : null;

    // Retrieve username from session
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username']; // Assuming username is stored in session after login
    } else {
        echo "User not logged in.";
        exit;
    }

    // Insert adoption request into adoption_requests table
    $status = 0; // Set status to 0 (pending)
    $stmt = $conn->prepare("INSERT INTO adoptions (pet_id, username, accepted, method, date, time) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isisss", $pet_id, $username, $status, $method, $date, $time);


    if ($stmt->execute()) {

    } else {
        echo "<p>Error: " . $stmt->error . "</p>";
    }

    $stmt->close();

    // Proceed with rendering the confirmation page
    $storeDetails = $method === "Pick Up" ? "
        <p>Store Address: 1234 Adoption Street, Quezon City</p>
        <p>Contact Number: (02) 1234-5678</p>
        <p>Assigned Employee: Ms. Bini Lopez</p>
    " : "";

    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Thank You | Bini's Buddies</title>
        <style>
            @font-face {
            font-family: 'Genty Sans';
            src: url('/LOL/public/css/GentySans-Regular.ttf') format('truetype')
            }
            
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            body {
                font-family: 'Genty Sans', Arial, sans-serif;
                background-color: #f8f8f8;
                color: #black;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                flex-direction: column;
                text-align: center;
            }
            .topbar {
                position: absolute;
                top: 20px;
                left: 20px;
                font-size: 24px;
                font-weight: bold;
            }
            .confirmation {
                padding: 20px;
                margin-top: 50px;
                background-color: #f4f4f4;
                border-radius: 8px;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
                width: 100%;
                max-width: 600px;
            }
            .confirmation h1 {
                font-size: 30px;
                color: black;
            }
            .confirmation p {
                font-size: 18px;
                color: #666;
            }
            .main-menu-btn {
                margin-top: 20px;
                padding: 10px 20px;
                background-color: black;
                color: white;
                border: none;
                border-radius: 5px;
                font-size: 16px;
                cursor: pointer;
                font-family: 'Genty Sans', Arial, sans-serif;
            }
        </style>
    </head>
    <body>
        <div class='topbar'>Bini's Buddies</div>
        <div class='confirmation'>
    <h1>Thank you for adopting!</h1>
    <p>You have chosen to receive your buddy via: " . htmlspecialchars($method) . "</p>
    <p>Date: $date</p>
    <p>Time: $time</p>
    $storeDetails
    <p>Thank you for your adoption request! You are currently on the waitlist, and our team will review your application. Kindly wait for the admin to accept or decline your request. You will be notified once a decision has been made.</p>
    <button class='main-menu-btn' onclick=\"location.href='pets.php';\">Return to Main Menu</button>
</div>
    </body>
    </html>";
} else {
    // Retrieve the pet_id from the URL parameter
    $pet_id = isset($_GET['pet_id']) ? htmlspecialchars($_GET['pet_id']) : null;

    // Render the adoption form
    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Adoption Form | Bini's Buddies</title>
        <style>
            @font-face {
            font-family: 'Genty Sans';
            src: url('/LOL/public/css/GentySans-Regular.ttf') format('truetype')
            }

            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            body {
                font-family: 'Genty Sans', Arial, sans-serif;
                background-color: #f8f8f8;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                flex-direction: column;
            }
            .topbar {
                position: absolute;
                top: 20px;
                left: 20px;
                font-size: 24px;
                font-weight: bold;
                color: black;
            }
            .body {
                width: 100%;
                max-width: 600px;
                padding: 40px;
                background-color: #fff;
                border-radius: 8px;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
                text-align: center;
            }
            h1 {
                font-size: 28px;
                margin-bottom: 30px;
            }
            .option-box {
                display: inline-flex;
                justify-content: center;
                align-items: center;
                text-align: center;
                background-color: white;
                padding: 15px;
                width: 150px;
                height: 60px;
                border: 3px solid #333;
                margin: 20px;
                border-radius: 12px;
                cursor: pointer;
                transition: 0.3s;
            }
            .option-box:hover {
                background-color: #f1f1f1;
            }
            input[type='radio'] {
                display: none;
            }
            input[type='radio']:checked + .option-box {
                border-color: #4CAF50;
                background-color: #e8f5e9;
            }
            .schedule {
                margin-top: 10px;
            }
            button {
                font-family: 'Genty Sans', Arial, sans-serif;
                margin-top: 20px;
                padding: 12px 30px;
                background-color: black;
                color: white;
                border: none;
                border-radius: 25px;
                font-size: 16px;
                cursor: pointer;
            }
        </style>
    </head>
    <body>
        <div class='topbar'>Bini's Buddies</div>
        <div class='body'>
            <h1>How would you like to receive your buddy?</h1>
            <form action='' method='POST'>
                <input type='hidden' name='pet_id' value='$pet_id'>
                <label>
                    <input type='radio' name='method' value='Delivery' required>
                    <div class='option-box'>Delivery</div>
                </label>
                <label>
                    <input type='radio' name='method' value='Pick Up' required>
                    <div class='option-box'>Pick Up</div>
                </label>
                <div class='schedule'>
                    <label>
                        <p>Select Date:</p>
                        <input type='date' name='date' required>
                    </label>
                    <label>
                        <p>Select Time:</p>
                        <input type='time' name='time' required>
                    </label>
                </div>
                <button type='submit'>Submit</button>
            </form>
        </div>
    </body>
    </html>";
}

$conn->close();
?>
