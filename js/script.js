let currentStep = 1; // begin bij vraag 1
const steps = document.querySelectorAll('.quiz-step'); // alle quizvragen ophalen
const totalSteps = steps.length; //totaal aantal vragen
const questionCountElem = document.getElementById('questionCount');
const progressFillElem = document.getElementById('progressFill');
 
let answers={};//slaat alle antwoorden op

// functie om een stap zichtbaar te maken
function showStep(stepNumber){
    steps.forEach(step => { 
        step.classList.remove('active'); // maak alles onzichtbaar
    });

    const current = document.getElementById(`step-${stepNumber}`); // juiste stap ophalen
    if(current) {
        current.classList.add('active'); // zichtbaar maken
        updateProgress(stepNumber); //update progress bar
    }
}

// check of een vraag beantwoord is
function isAnswered(step){
    const stepElement = document.getElementById(`step-${step}`);
    const checked = stepElement.querySelector('input[type="radio"]:checked');
    return checked !== null; 
}

// ga naar volgende vraag
function nextQuestion(step){
    if(!isAnswered(step)){ 
        alert("Selecteer alstublieft een antwoord voordat u verder gaat.");
        return;
    }

    currentStep = step + 1;
    showStep(currentStep);
}

// ga naar vorige vraag
function prevQuestion(step){
    currentStep = step - 1;
    showStep(currentStep);
}

function finishQuiz() {
    // We pakken de waarde van het gekozen genre uit de quiz
    const genreInput = document.querySelector('input[name="genre"]:checked');
    if(!genreInput) {
        alert("Maak de test af om een resultaat te zien.");
        return;
    }
    const genre = genreInput.value;

    // Deze regel stuurt je naar de nieuwe pagina met het genre in de URL
    window.location.href = 'resultaat.php?genre=' + encodeURIComponent(genre);
}

function updateProgress(stepNumber){
    if(questionCountElem) {
        questionCountElem.innerText = `Vraag ${stepNumber} van ${totalSteps}`;
    }
    if(progressFillElem) {
        const progressPercentage = (stepNumber / totalSteps) * 100;
        progressFillElem.style.width = progressPercentage + '%';
    }
}

// Start met eerste vraag zichtbaar als we op de quiz pagina zijn
if(steps.length > 0) {
    showStep(currentStep);
}

// boekenpagina modal logica
const cards = document.querySelectorAll(".book-card");
const modal = document.getElementById("modal");
const closeModal = document.getElementById("closeModal");
const reserveBtn = document.getElementById("reserveBtn");
 
cards.forEach(card => {
    card.addEventListener("click", () => {
        document.getElementById("modalTitle").textContent = card.dataset.title;
        document.getElementById("modalAuthor").textContent = card.dataset.author;
        document.getElementById("modalYear").textContent = card.dataset.year;
        document.getElementById("modalGenre").textContent = card.dataset.genre;
        document.getElementById("modalDescription").textContent = card.dataset.description;
        document.getElementById("modalImage").src = card.querySelector('img').src;
 
        if (card.dataset.available === "1") {
            reserveBtn.textContent = "Reserveren";
            reserveBtn.disabled = false;
            reserveBtn.style.backgroundColor = ""; // reset
 
            reserveBtn.onclick = () => {
                alert("Boek succesvol gereserveerd!");
                reserveBtn.textContent = "Gereserveerd";
                reserveBtn.disabled = true;
                reserveBtn.style.backgroundColor = "#94a3b8";
            };
        } else {
            reserveBtn.textContent = "Niet beschikbaar";
            reserveBtn.disabled = true;
            reserveBtn.style.backgroundColor = "#ef4444";
        }
 
        modal.classList.remove("hidden");
    });
});
 
if(closeModal) {
    closeModal.onclick = () => {
        modal.classList.add("hidden");
    };
}
 
window.onclick = e => {
    if (e.target === modal) modal.classList.add("hidden");
};