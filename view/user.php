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
?>

<html>
<head>
    <title>User | Store Name</title>
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
            <h2 class="name-section">name/username</h2>
            <div class="favorites-section">
                <h2>favorites</h2>
                <div class="imgcont">
                    <a href= "" class="polaroid">
                        <div class="image">
                            <p>image</p>
                        </div>
                        <p class="pet-name">[name]</p>
                    </a>
                    <a href= "" class="polaroid">
                        <div class="image">
                            <p>image</p>
                        </div>
                        <p class="pet-name">[name]</p>
                    </a>
                    <a href= "" class="polaroid">
                        <div class="image">
                            <p>image</p>
                        </div>
                        <p class="pet-name">[name]</p>
                    </a>
                    <a href= "" class="polaroid">
                        <div class="image">
                            <p>image</p>
                        </div>
                        <p class="pet-name">[name]</p>
                    </a>
                </div>
            </div>
            <div class="adoptions-section">
                <h2>past adoptions</h2>
                <div class="imgcont">
                    <a href= "" class="polaroid">
                        <div class="image">
                            <p>image</p>
                        </div>
                        <p class="pet-name">[name]</p>
                    </a>
                    <a href= "" class="polaroid">
                        <div class="image">
                            <p>image</p>
                        </div>
                        <p class="pet-name">[name]</p>
                    </a>
                    <a href= "" class="polaroid">
                        <div class="image">
                            <p>image</p>
                        </div>
                        <p class="pet-name">[name]</p>
                    </a>
                    <a href= "" class="polaroid">
                        <div class="image">
                            <p>image</p>
                        </div>
                        <p class="pet-name">[name]</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>