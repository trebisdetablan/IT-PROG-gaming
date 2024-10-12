<html>
<head>
    <title>Pets | Store Name</title>
    <link rel="stylesheet" href="pets.css">
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
        <div class="search-bar">
            <form action="search.php" method="GET">
                <input type="text" placeholder="Search pets..." name="query">
                <button type="submit" class="search-button">Search</button>
            </form>
            <div class="filter-dropdown">
                <button type="button" class="filter-button">
                    Filter
                </button>
                <div class="filter-options">
                    <label for="filter">Sort by:</label>
                    <select id="filter" name="filter">
                        <option value="name">Name</option>
                        <option value="age">Age</option>
                        <option value="breed">Breed</option>
                        <option value="type">Type</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="gallery">
            <div class="imgcont">
                <!-- Dynamic content will be added here -->
            </div>
        </div>
    </div>

    <script>
        window.onload = function () {
            const pets = [
                { name: 'Peekaboo', age: 2, breed: 'Domestic Cat', type: 'Cat' },
                { name: 'Hansolo', age: 5, breed: 'Domestic Cat', type: 'Cat' },
                { name: 'Periwinkle', age: 1, breed: 'Domestic Cat', type: 'Cat' },
                { name: 'Gustav', age: 3, breed: 'Bichon Frise', type: 'Dog' },
            ];

            const filterSelect = document.getElementById('filter');
            const gallery = document.querySelector('.gallery .imgcont');

            function updateGallery(pets) {
                gallery.innerHTML = '';
                pets.forEach(pet => {
                    const polaroid = document.createElement('a');
                    polaroid.classList.add('polaroid');
                    polaroid.href = '#';

                    const image = document.createElement('div');
                    image.classList.add('image');
                    image.innerHTML = '<p>image</p>';

                    const petName = document.createElement('p');
                    petName.classList.add('pet-name');
                    petName.textContent = pet.name;

                    polaroid.appendChild(image);
                    polaroid.appendChild(petName);
                    gallery.appendChild(polaroid);
                });
            }

            function sortPets(criteria) {
                let sortedPets;
                if (criteria === 'name') {
                    sortedPets = pets.slice().sort((a, b) => a.name.localeCompare(b.name));
                } else if (criteria === 'age') {
                    sortedPets = pets.slice().sort((a, b) => a.age - b.age);
                } else if (criteria === 'breed') {
                    sortedPets = pets.slice().sort((a, b) => a.breed.localeCompare(b.breed));
                } else if (criteria === 'type') {
                    sortedPets = pets.slice().sort((a, b) => a.type.localeCompare(b.type));
                }
                updateGallery(sortedPets);
            }

            filterSelect.addEventListener('change', function () {
                const selectedFilter = filterSelect.value;
                sortPets(selectedFilter);
            });

            // Initial gallery display
            updateGallery(pets);
        };
    </script>
</body>
</html>
