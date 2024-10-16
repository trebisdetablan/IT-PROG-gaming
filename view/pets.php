<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pets | Store Name</title>
    <link rel="stylesheet" href="../public/css/pets.css">
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
            <button onclick="document.location='user.php'" class="user"><img src="../public/images/user.png" alt="User"/></button>
        </div>
    </div>

    <div class="body">
        <div class="search-bar">
            <form id="search-form" action="search.php" method="GET">
                <input type="text" placeholder="Search pets..." name="query" id="search-input">
                <button type="submit" class="search-button">Search</button>
            </form>
            <div class="filter">
                <button type="button" class="filter-button" id="filter-button">
                    Filter
                </button>
            </div>
        </div>

        <div class="gallery">
            <div class="imgcont">
                <!-- Dynamic content will be added here -->
            </div>
        </div>
    </div>

    <!-- Filter Modal -->
    <div id="filter-modal" class="modal">
        <div class="modal-content">
            <span class="close-button" id="close-modal">&times;</span>
            <h2>Filter Pets</h2>
            <label for="filter-type">Type:</label>
            <select id="filter-type" class="filter-type">
                <option value="all">All</option>
                <option value="Cat">Cat</option>
                <option value="Dog">Dog</option>
            </select>
            <label for="filter-breed">Breed:</label>
            <input type="text" id="filter-breed" placeholder="Enter breed...">
            <label for="filter-age">Age:</label>
            <input type="number" id="filter-age" placeholder="Enter max age">
            <label for="filter-gender">Gender:</label>
            <select id="filter-gender" class="filter-gender">
                <option value="all">All</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
            <button id="apply-filters" class="apply-filters">Apply Filters</button>
        </div>
    </div>

    <script>
        window.onload = function () {
            const pets = [
                { name: 'Peekaboo', age: 3, breed: 'Domestic Cat', type: 'Cat', gender: 'male' },
                { name: 'Hansolo', age: 2, breed: 'Domestic Cat', type: 'Cat', gender: 'male' },
                { name: 'Periwinkle', age: 1, breed: 'Domestic Cat', type: 'Cat', gender: 'female' },
                { name: 'Gustav', age: 12, breed: 'Bichon Frise', type: 'Dog', gender: 'male' },
                { name: 'Chanel', age: 15, breed: 'Bichon Frise', type: 'Dog', gender: 'female' }
            ];

            const filterButton = document.getElementById('filter-button');
            const filterModal = document.getElementById('filter-modal');
            const closeModal = document.getElementById('close-modal');
            const applyFiltersButton = document.getElementById('apply-filters');
            const gallery = document.querySelector('.gallery .imgcont');
            const searchForm = document.getElementById('search-form');
            const searchInput = document.getElementById('search-input');

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

            // Search for pets based on input
            const searchPets = (event) => {
                event.preventDefault(); // Prevent form submission
                const query = searchInput.value.toLowerCase();

                const filteredPets = pets.filter(pet => {
                    return pet.name.toLowerCase().includes(query) ||
                           pet.breed.toLowerCase().includes(query) ||
                           pet.type.toLowerCase().includes(query) ||
                           pet.gender.toLowerCase().includes(query);
                });

                updateGallery(filteredPets);
            };

            // Open modal
            filterButton.addEventListener('click', () => {
                filterModal.style.display = 'block';
            });

            // Close modal
            closeModal.addEventListener('click', () => {
                filterModal.style.display = 'none';
            });

            // Apply filters
            const applyFilters = () => {
                const selectedType = document.getElementById('filter-type').value;
                const breedInput = document.getElementById('filter-breed').value.toLowerCase();
                const maxAge = document.getElementById('filter-age').value;
                const selectedGender = document.getElementById('filter-gender').value;

                const filteredPets = pets.filter(pet => {
                    const matchesType = selectedType === 'all' || pet.type === selectedType;
                    const matchesBreed = breedInput === '' || pet.breed.toLowerCase().includes(breedInput);
                    const matchesAge = maxAge === '' || pet.age <= maxAge;
                    const matchesGender = selectedGender === 'all' || pet.gender === selectedGender;

                    return matchesType && matchesBreed && matchesAge && matchesGender;
                });

                updateGallery(filteredPets);
                filterModal.style.display = 'none';
            };

            // Event listener for search form
            searchForm.addEventListener('submit', searchPets);

            applyFiltersButton.addEventListener('click', applyFilters);

            // Add event listeners to inputs for Enter key
            const inputs = document.querySelectorAll('#filter-breed, #filter-age');
            inputs.forEach(input => {
                input.addEventListener('keypress', (event) => {
                    if (event.key === 'Enter') {
                        event.preventDefault(); // Prevent form submission if inside a form
                        applyFilters();
                    }
                });
            });

            window.onclick = function (event) {
                if (event.target === filterModal) {
                    filterModal.style.display = 'none';
                }
            };

            updateGallery(pets);
        };
    </script>
</body>
</html>
