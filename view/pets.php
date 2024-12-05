<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pets | Bini's Buddies</title>
    <link rel="stylesheet" href="../public/css/pets.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"></link>
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
            <div class="imgcont flex space-x-4">
                <div class="bg-gray-200 border border-gray-300 shadow-md p-4 w-48">
                    <img alt="Picture of Peekaboo" class="h-48 w-full object-cover mb-4" src="../public/images/Peekaboo.png"/>
                    <div class="text-center font-bold">Peekaboo</div>
                </div>
                <div class="bg-gray-200 border border-gray-300 shadow-md p-4 w-48">
                    <img alt="Picture of Hansolo" class="h-48 w-full object-cover mb-4" src="../public/images/hansolo.png"/>
                    <div class="text-center font-bold">Hansolo</div>
                </div>
                <div class="bg-gray-200 border border-gray-300 shadow-md p-4 w-48">
                    <img alt="Picture of Periwinkle" class="h-48 w-full object-cover mb-4" src="../public/images/periwinkle.png"/>
                    <div class="text-center font-bold">Periwinkle</div>
                </div>
                <div class="bg-gray-200 border border-gray-300 shadow-md p-4 w-48">
                    <img alt="Picture of Gustav" class="h-48 w-full object-cover mb-4" src="../public/images/gustavo.png"/>
                    <div class="text-center font-bold">Gustav</div>
                </div>
                <div class="bg-gray-200 border border-gray-300 shadow-md p-4 w-48">
                    <img alt="Picture of Chanel" class="h-48 w-full object-cover mb-4" src="../public/images/chanel.png"/>
                    <div class="text-center font-bold">Chanel</div>
                </div>
            </div>
        </div>
    </div>

    <div class="back-button-container">
        <button onclick="resetGallery()" class="back-button">Return to Main Menu</button> 
    </div>

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

    <div id="pet-modal" class="modal">
        <div class="modal-content bg-white rounded-lg shadow-lg p-6 w-96 relative">
            <button class="absolute top-2 left-2 text-xl font-bold" id="close-modal">&times;</button>
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-2xl font-bold" id="pet-name"></h1>
                <div class="availability-badge" id="availability-badge"></div>
            </div>
            <p><strong>Type:</strong> <span id="pet-type"></span></p>
            <p><strong>Breed:</strong> <span id="pet-breed"></span></p>
            <p><strong>Availability:</strong> <span id="pet-availability"></span></p>
            <p><strong>Age:</strong> <span id="pet-age"></span></p>
            <p><strong>Gender:</strong> <span id="pet-gender"></span></p>
            <p><strong>Personality:</strong> <span id="pet-personality"></span></p>
            <p><strong>Coat:</strong> <span id="pet-coat"></span></p>
            <p><strong>Eyes:</strong> <span id="pet-eyes"></span></p>
            <button id="adopt-button" class="adopt-button" style="display:none;">Adopt</button>
        </div>
    </div> 

    <script>
        window.onload = function () {
            const pets = [
                { name: 'Peekaboo', type: 'Cat', breed: 'Domestic Cat', availability: 'Eligible', age: 3, gender: 'Male', personality: 'Friendly', coat: 'Gray, black, and white with black stripes and white paws', eyes: 'Bright yellow-green.', image: 'public/images/Peekaboo.png'},
                { name: 'Hansolo', type: 'Cat', breed: 'Domestic Cat', availability: 'Adopted', age: 2, gender: 'Male', personality: 'Extraverted', coat: 'Gray, black, and white with black stripes and white paws', eyes: 'Green', image: 'public/images/hansolo.png'},
                { name: 'Periwinkle', type: 'Cat', breed: 'Domestic Cat', availability: 'Eligible', age: 3, gender: 'Female', personality: 'Playful', coat: 'White with black markings on the head and tail', eyes: 'Bright yellow', image: 'public/images/periwinkle.png'},
                { name: 'Gustav', type: 'Dog', breed: 'Bichon Frise', availability: 'Adopted', age: 12, gender: 'Male', personality: 'Playful', coat: 'White', eyes: 'Brown', image: 'public/images/gustavo.png'},
                { name: 'Chanel', type: 'Dog', breed: 'Bichon Frise', availability: 'Eligible', age: 15, gender: 'Female', personality: 'Relaxed', coat: 'White', eyes: 'Brown', image: 'public/images/chanel.png'}
            ];

            const gallery = document.querySelector('.gallery .imgcont');
            const petModal = document.getElementById('pet-modal');
            const closeModal = document.getElementById('close-modal');
            const resetButton = document.querySelector('.back-button');
            const filterButton = document.getElementById('filter-button');
            const filterModal = document.getElementById('filter-modal');
            const applyFiltersButton = document.getElementById('apply-filters');
            const searchForm = document.getElementById('search-form');
            const searchInput = document.getElementById('search-input');

            function updateGallery(pets) {
                gallery.innerHTML = '';
                pets.forEach(pet => {
                    const polaroid = document.createElement('button');
                    polaroid.classList.add('polaroid');
                    polaroid.onclick = () => showPetDetails(pet);

                    const image = document.createElement('div');
                    image.classList.add('image');
                    if (pet.image) {
                        image.style.backgroundImage = `url('${pet.image}')`;
                    }

                    const petName = document.createElement('p');
                    petName.classList.add('pet-name');
                    petName.textContent = pet.name;

                    polaroid.appendChild(image);
                    polaroid.appendChild(petName);
                    gallery.appendChild(polaroid);
                });
            }

            const searchPets = (event) => {
                event.preventDefault();
                const query = searchInput.value.toLowerCase();
                const filteredPets = pets.filter(pet => {
                    return pet.name.toLowerCase().includes(query) ||
                           pet.breed.toLowerCase().includes(query) ||
                           pet.type.toLowerCase().includes(query) ||
                           pet.gender.toLowerCase().includes(query);
                });
                updateGallery(filteredPets);
            };

            searchForm.addEventListener('submit', searchPets);

            function resetGallery() {
                searchInput.value = ''; 
                updateGallery(pets);
            }

            resetButton.addEventListener('click', resetGallery);

            filterButton.addEventListener('click', () => {
                filterModal.style.display = 'block';
            });

            closeModal.addEventListener('click', () => {
                filterModal.style.display = 'none';
            });

            const applyFilters = () => {
                const selectedType = document.getElementById('filter-type').value;
                const breedInput = document.getElementById('filter-breed').value.toLowerCase();
                const maxAge = document.getElementById('filter-age').value;
                const selectedGender = document.getElementById('filter-gender').value;

                const filteredPets = pets.filter(pet => {
                    const matchesType = selectedType === 'all' || pet.type === selectedType;
                    const matchesBreed = breedInput === '' || pet.breed.toLowerCase().includes(breedInput);
                    const matchesAge = maxAge === '' || pet.age <= maxAge;
                    const matchesGender = selectedGender === 'all' || pet.gender.toLowerCase() === selectedGender;

                    return matchesType && matchesBreed && matchesAge && matchesGender;
                });

                updateGallery(filteredPets);
                filterModal.style.display = 'none';
            };

            applyFiltersButton.addEventListener('click', applyFilters);

            const inputs = document.querySelectorAll('#filter-breed, #filter-age');
            inputs.forEach(input => {
                input.addEventListener('keypress', (event) => {
                    if (event.key === 'Enter') {
                        event.preventDefault();
                        applyFilters();
                    }
                });
            });

            const showPetDetails = (pet) => {
                document.getElementById('pet-name').textContent = pet.name;
                document.getElementById('pet-type').textContent = pet.type;
                document.getElementById('pet-breed').textContent = pet.breed;
                document.getElementById('pet-availability').textContent = pet.availability;
                document.getElementById('pet-age').textContent = `${pet.age} years`;
                document.getElementById('pet-gender').textContent = pet.gender;
                document.getElementById('pet-personality').textContent = pet.personality;
                document.getElementById('pet-coat').textContent = pet.coat;
                document.getElementById('pet-eyes').textContent = pet.eyes;
                
                const availabilityBadge = document.getElementById('availability-badge');
                const adoptButton = document.getElementById('adopt-button');
                if (pet.availability.toLowerCase() === 'eligible') {
                    availabilityBadge.textContent = 'Eligible';
                    availabilityBadge.className = 'availability-badge adopt-button';
                    adoptButton.style.display = 'block';
                    adoptButton.onclick = () => {
                        window.location.href = 'adoption.php';
                    };
                } else {
                    availabilityBadge.textContent = 'Adopted';
                    availabilityBadge.className = 'availability-badge taken-label';
                    adoptButton.style.display = 'none';
                }
                
                petModal.style.display = 'block';
            };

            closeModal.onclick = () => {
                petModal.style.display = 'none';
            };

            window.onclick = function(event) {
                if (event.target === petModal) {
                    petModal.style.display = 'none';
                } else if (event.target === filterModal) {
                    filterModal.style.display = 'none';
                }
            };

            updateGallery(pets);
        };
    </script>
</body>
</html>


