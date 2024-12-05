<html>
<head>
    <title>FAQs | Bini's Buddies</title>
    <link rel="stylesheet" href="../public/css/faq.css">
    <script>
        function toggleAnswer(questionElement) {
            const answer = questionElement.nextElementSibling;

            if (answer.style.display === "none" || answer.style.display === "") {
                answer.style.display = "block";
            } else {
                answer.style.display = "none";
            }
        }
    </script>
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
            <button onclick="document.location='user.php'" class="user"><img src="../public/images/user.png"/></button>
        </div>
    </div>
    <div class="body">
        <div class="imgcont">
            <div class="polaroid">
                <!-- placeholder for image -->
                <div class="image">
                    <p><img src="../public/images/chanel.png"/></p>
                </div>
            </div>
        </div>
        <div class="text">
            <h1>Frequently Asked Questions</h1>
            <div class="faq-item">
                <p class="question" onclick="toggleAnswer(this)">How do I make an adoption on your website?</p>
                <p class="answer">Placing an order with Bini's Buddies is very simple. Just use the "Pets" option in the navigation bar at 
                    the top to find the pet you'd like to adopt. Click on the pet you want, then click the "Adopt" button, fill out the details, and submit!</p>
            </div>
            <div class="faq-item">
                <p class="question" onclick="toggleAnswer(this)">Are the pets vaccinated and spayed/neutered?</p>
                <p class="answer">Yes, all pets available for adoption are up-to-date on vaccinations and have been spayed or neutered unless they are too young. 
                    If the pet is not yet of age, we will provide guidance on scheduling these procedures.</p>
            </div>
            <div class="faq-item">
                <p class="question" onclick="toggleAnswer(this)">How do I know which pet is right for me?</p>
                <p class="answer">Each pet profile includes details about their personality, age, gender, etc. Consider your lifestyle, 
                    living space, and experience with pets. Our team is happy to assist you in finding the perfect match!</p>
            </div>
        </div>
    </div>
    <script src="faq.js"></script>
</body>
</html>
