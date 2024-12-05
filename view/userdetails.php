<html>
<head>
    <title>Details</title>
    <link rel="stylesheet" href="../public/css/userdetails.css">
</head>
<body>
    <div class="form">
        <h1 class="title_card">Shipping details & Adopter’s information</h1>
        <form class="detail_form" action="waitlist.php" method="POST">
            <input type="text" class="input" name="first_name" placeholder="Firstname"><br>
            <input type="text" class="input" name="last_name" placeholder="Lastname"><br>
            <input type="text" class="input" name="phone_number" placeholder="Phone Number"><br>
            <input type="text" class="input" name="address" placeholder="Address"><br>
            <input type="text" class="input" name="zip_code" placeholder="Zip Code"><br>
            <input type="text" class="input" name="city" placeholder="City"><br>
            <input type="text" class="input" name="email" placeholder="Email"><br>
            <br>
            <button class="next_button" type="submit">Next</button>
        </form>
    </div>
    <div class="order_list">
        <div class="summary">
            <h2>Order Summary</h2>
            <ul>
                <li>Pet</li>
            </ul>
        </div>
        <hr>
        <div class="costs">
            <p>Subtotal: </p>
            <p>Shipping: </p>
            <p>Total: </p>
        </div>
    </div>
</body>
</html>