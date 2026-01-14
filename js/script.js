let currentStep = 1;
const totalSteps = 5;

// update de tekst en de voortgangsbalk
function updateProgressBar() {
    const countElem = document.getElementById('questionCount');
    const fillElem = document.getElementById('progressFill');
    
    if (countElem && fillElem) {
        countElem.innerText = `Vraag ${currentStep} van ${totalSteps}`;
        const percentage = (currentStep / totalSteps) * 100;
        fillElem.style.width = `${percentage}%`;
    }
}

// ga naar de volgende vraag
function nextQuestion(stepNumber) {
    const currentStepDiv = document.getElementById(`step-${stepNumber}`);
    const checkedInput = currentStepDiv.querySelector('input[type="radio"]:checked');

    // Validatie: is er iets gekozen?
    if (!checkedInput) {
        alert("Maak eerst een keuze voordat je verder gaat!");
        return;
    }

    // Wissel van zichtbare div
    currentStepDiv.classList.remove('active');
    currentStep++;
    
    const nextStepDiv = document.getElementById(`step-${currentStep}`);
    if (nextStepDiv) {
        nextStepDiv.classList.add('active');
        updateProgressBar();
    }
}

// Ga terug naar de vorige vraag
function prevQuestion(stepNumber) {
    document.getElementById(`step-${stepNumber}`).classList.remove('active');
    currentStep--;
    document.getElementById(`step-${currentStep}`).classList.add('active');
    updateProgressBar();
}

function finishQuiz() {
    // Zoek het geselecteerde genre op
    const selectedGenre = document.querySelector('input[name="genre"]:checked').value;
    
    // Stuur de gebruiker door met het genre in de URL
    window.location.href = 'resultaat.php?genre=' + encodeURIComponent(selectedGenre);
}