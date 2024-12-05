<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $method = $_POST['method'];
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
                src: url('GentySans-Regular.ttf');
            }
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            body {
                font-family: 'Genty Sans', Arial, sans-serif;
                background-color: #f8f8f8;
                color: #333;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                overflow-x: hidden;
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
                text-align: center;
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
                color: #333;
            }
            .confirmation p {
                font-size: 18px;
                color: #666;
            }
        </style>
    </head>
    <body>
        <div class='topbar'>Bini's Buddies</div>
        <div class='confirmation'>
            <h1>Thank you for adopting!</h1>
            <p>You have chosen to receive your buddy via: " . htmlspecialchars($method) . "</p>
            $storeDetails
        </div>
    </body>
    </html>";
} else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adoption Method | Bini's Buddies</title>
    <style>
        @font-face {
            font-family: 'Genty Sans';
            src: url('GentySans-Regular.ttf');
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Genty Sans', Arial, sans-serif;
            background-color: #f8f8f8;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow-x: hidden;
            flex-direction: column;
            text-align: center;
        }
        .topbar {
            position: absolute;
            top: 20px;
            left: 20px;
            font-family: 'Genty Sans', Arial, sans-serif;
            font-size: 24px;
            font-weight: bold;
            color: #333;
            text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.2);
}

        .body {
            width: 100%;
            max-width: 600px;
            padding: 40px;
            background-color: #fff;
            border-radius: 8px;
            border: 1px solid #ddd;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h1 {
            font-size: 28px;
            margin-bottom: 30px;
            color: #333;
        }
        .option-box {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background-color: white;
            padding: 15px; 
            width: 180px; 
            height: 120px; 
            border: 3px solid #333;
            margin: 20px;
            border-radius: 12px;
            position: relative;
            cursor: pointer;
            transition: 0.3s ease;
        }
        .option-box:hover {
            background-color: #f1f1f1;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .option-box p {
            font-size: 18px;
            color: #333;
            font-weight: bold;
        }
        input[type="radio"] {
            display: none;
        }
        input[type="radio"]:checked + .option-box {
            border-color: #4CAF50;
            background-color: #e8f5e9;
        }
        button {
            padding: 12px 30px;
            font-size: 16px;
            border: none;
            border-radius: 25px;
            background-color: black;
            color: white;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="topbar">Bini's Buddies</div>
    <div class="body">
        <h1>How would you like to receive your buddy?</h1>
        <form action="adoption.php" method="POST">
            <label>
                <input type="radio" name="method" value="Delivery" required>
                <div class="option-box">
                    <p>Delivery</p>
                </div>
            </label>
            <label>
                <input type="radio" name="method" value="Pick Up" required>
                <div class="option-box">
                    <p>Pick Up</p>
                </div>
            </label>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
<?php
}
?>