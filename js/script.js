
let currentStep = 1;
const totalSteps = 4;


function updateProgressBar() {
    const countElem = document.getElementById('questionCount');
    const fillElem = document.getElementById('progressFill');
    
    if (countElem && fillElem) {
        countElem.innerText = `Vraag ${currentStep} van ${totalSteps}`;
        const percentage = (currentStep / totalSteps) * 100;
        fillElem.style.width = `${percentage}%`;
    }
}

function nextQuestion(stepNumber) {
    const currentStepDiv = document.getElementById(`step-${stepNumber}`);
    const inputs = currentStepDiv.querySelectorAll('input[type="radio"]');
    let checked = false;

    // Check of er een optie is gekozen
    inputs.forEach(input => { if (input.checked) checked = true; });

    if (!checked) {
        alert("Maak eerst een keuze voordat je verder gaat!");
        return;
    }

    // Wissel naar de volgende stap
    currentStepDiv.classList.remove('active');
    currentStep++;
    const nextStepDiv = document.getElementById(`step-${currentStep}`);
    if (nextStepDiv) {
        nextStepDiv.classList.add('active');
        updateProgressBar();
    }
}

function prevQuestion(stepNumber) {
    document.getElementById(`step-${stepNumber}`).classList.remove('active');
    currentStep--;
    document.getElementById(`step-${currentStep}`).classList.add('active');
    updateProgressBar();
}

function finishQuiz() {
    const moodInput = document.querySelector('input[name="mood"]:checked');
    const genreInput = document.querySelector('input[name="genre"]:checked');
    const ageInput = document.querySelector('input[name="age"]:checked');

    if (!moodInput) {
        alert("Beantwoord de laatste vraag!");
        return;
    }

    // Sla de keuzes op om later te matchen
    localStorage.setItem('selectedGenre', genreInput.value);
    localStorage.setItem('selectedAge', ageInput.value);
    
    // Stuur de gebruiker naar de resultatenpagina
    window.location.href = 'resultaat.php';
}


function showResult() {
    const resultContainer = document.getElementById('resultContent');
    const descContainer = document.getElementById('bookDescription');
    
    // Haal voorkeuren op uit het geheugen
    const userGenre = localStorage.getItem('selectedGenre');
    const userAge = localStorage.getItem('selectedAge');

    if (!resultContainer) return;

    // Zoek een match in de database
    // We proberen eerst op Genre én Leeftijd te matchen, anders alleen op Genre
    let match = booksDatabase.find(b => b.genre === userGenre && b.ageGroup === userAge);
    if (!match) {
        match = booksDatabase.find(b => b.genre === userGenre);
    }
    // Als er echt niks is, pak het eerste boek
    if (!match) match = booksDatabase[0];

    // Bouw de HTML voor het resultaat
    resultContainer.innerHTML = `
        <img src="${match.image}" alt="${match.title}" class="book-cover-img">
        
        <div class="book-info">
            <h1>${match.title}</h1>
            <p style="color: #666; font-size: 1.1rem; margin: 5px 0;">door ${match.author}</p>
            
            <div style="color: #f39c12; margin: 10px 0;">
                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i> 
                <span style="color: #999; font-size: 0.9rem; margin-left: 5px;">(4.8 / 5)</span>
            </div>

            <div style="margin-bottom: 20px;">
                <span class="tag">${match.genre}</span>
                <span class="tag">${match.ageGroup}</span>
            </div>

            <div class="location-box">
                <div class="location-header">
                    <i class="fas fa-map-marker-alt"></i> Locatie in Forum Zoetermeer
                </div>
                <div class="location-details">
                    <p><strong>Verdieping:</strong> ${match.location.floor}</p>
                    <p><strong>Afdeling:</strong> ${match.location.section}</p>
                    <p><strong>Kast/Plank:</strong> <span style="color: #4a6cf7; font-weight: bold;">${match.location.shelf}</span></p>
                </div>
                <button class="route-btn" onclick="alert('Navigatie start... Loop naar de ${match.location.floor}')">
                    <i class="fas fa-walking"></i> Breng me naar dit boek
                </button>
            </div>
        </div>
    `;

    if (descContainer) {
        descContainer.innerText = match.description;
    }
}

const booksDatabase = [
    {
        title: "Oorsprong",
        author: "Dan Brown",
        genre: "Spanning",
        ageGroup: "Volwassenen",
        image: "https://m.media-amazon.com/images/I/41D9K367XHL.jpg",
        description: "Robert Langdon, hoogleraar kunstgeschiedenis en symboliek, arriveert in het hypermoderne Guggenheim Museum in Bilbao.",
        location: { floor: "2e Etage", section: "Thrillers", shelf: "Kast 12, Rij B" }
    },
    {
        title: "Brief voor de Koning",
        author: "Tonke Dragt",
        genre: "Avontuur",
        ageGroup: "Jeugd",
        image: "https://m.media-amazon.com/images/I/51Y7F-zAn8L._AC_UF1000,1000_QL80_.jpg",
        description: "Tiuri moet een uiterst geheime brief bezorgen bij de koning aan de andere kant van de bergen.",
        location: { floor: "Begane grond", section: "Jeugd 10-12", shelf: "Kast 'Klassiekers'" }
    },
    {
        title: "De IJsprinses",
        author: "Camilla Läckberg",
        genre: "Spanning",
        ageGroup: "Volwassenen",
        image: "https://m.media-amazon.com/images/I/81k7f11M9kL.jpg",
        description: "In het Zweedse kustplaatsje Fjällbacka wordt een jonge vrouw dood aangetroffen in haar badkuip.",
        location: { floor: "2e Etage", section: "Scandinavische Thrillers", shelf: "Kast 05, Rij A" }
    },
    {
        title: "Hof van Doorns en Rozen",
        author: "Sarah J. Maas",
        genre: "Fantasy",
        ageGroup: "Young Adult",
        image: "https://m.media-amazon.com/images/I/81p39U-nS+L._AC_UF1000,1000_QL80_.jpg",
        description: "Het leven van Feyre verandert voorgoed wanneer ze een wolf doodt in het bos.",
        location: { floor: "1e Etage", section: "Young Adult Fantasy", shelf: "Eiland 2" }
    },
    {
        title: "Zeven zussen",
        author: "Lucinda Riley",
        genre: "Romance",
        ageGroup: "Volwassenen",
        image: "https://m.media-amazon.com/images/I/718t-M1X8rL.jpg",
        description: "Na de dood van hun vader komen de zussen bij elkaar in hun ouderlijk huis aan het Meer van Genève.",
        location: { floor: "1e Etage", section: "Romans", shelf: "Kast 08 - Ril" }
    }
];