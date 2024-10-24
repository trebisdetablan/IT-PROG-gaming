<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Waitlist</title>
    <link rel="stylesheet" href="../public/css/waitlist.css">
</head>
<body>
    <div class="topbar">
        <div class="storename">
            <h2>Store Name</h2>
        </div>
        <div class="navbar">
            <button onclick="document.location='home.php'">Home</button>
            <button onclick="document.location='about.php'">About</button>
            <button onclick="document.location='pets.php'">Pets</button>
            <button onclick="document.location='faq.php'">FAQs</button>
            <button onclick="document.location='user.php'" class="user"><img src="../public/images/user.png" alt="User Profile"/></button>
        </div>
    </div>

    <div class="waitlist-container">
        <div class="text">
            <h1>Your Pending Orders</h1>
            <p>The following orders are still awaiting approval. We will notify you when the order is confirmed or rejected.</p>
        </div>

        <div class="order">
            <h2>Order #12345</h2>
            <p>Pet: Periwinkle</p>
            <p>Type: Pick-up</p>
            <p>Status: <span class="status">Pending Admin Approval</span></p>
        </div>

        <div class="order">
            <h2>Order #12346</h2>
            <p>Pet: Gustav</p>
            <p>Type: Delivery</p>
            <p>Status: <span class="status">Pending Admin Approval</span></p>
        </div>

        <div class="imgcont">
            <div class="polaroid">
                <div class="image">
                    <p>Image</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
