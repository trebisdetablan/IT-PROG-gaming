<html>
<head>
    <title>FAQs | Store Name</title>
    <link rel="stylesheet" href="faq.css">
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
            <h2>store name</h2>
        </div>
        <div class="navbar">
            <button onclick="document.location='home.php'">Home</button>
            <button onclick="document.location='about.php'">About</button>
            <button onclick="document.location='pets.php'">Pets</button>
            <button onclick="document.location='faq.php'">FAQs</button>
            <button onclick="document.location='user.php'" class="user"><img src="user.png"/></button>
        </div>
    </div>
    <div class="body">
        <div class="imgcont">
            <div class="polaroid">
                <!-- placeholder for image -->
                <div class="image">
                    <p>image</p>
                </div>
            </div>
        </div>
        <div class="text">
            <h1>Frequently Asked Questions</h1>
            <div class="faq-item">
                <p class="question" onclick="toggleAnswer(this)">Question 1</p>
                <p class="answer">Answer for Question 1.</p>
            </div>
            <div class="faq-item">
                <p class="question" onclick="toggleAnswer(this)">Question 2</p>
                <p class="answer">Answer for Question 2.</p>
            </div>
            <div class="faq-item">
                <p class="question" onclick="toggleAnswer(this)">Question 3</p>
                <p class="answer">Answer for Question 3.</p>
            </div>
        </div>
    </div>
    <script src="faq.js"></script>
</body>
</html>
