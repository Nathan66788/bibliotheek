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

// verzamel de antwoorden en stuur door naar PHP
function finishQuiz() {
    // haal de waardes op van de geselecteerde buttons
    const genre = document.querySelector('input[name="genre"]:checked')?.value;
    const age = document.querySelector('input[name="age"]:checked')?.value;
    const mood = document.querySelector('input[name="mood"]:checked')?.value;

    // check of alles is ingevuld
    if (!genre || !age || !mood) {
        alert("Beantwoord alsjeblieft alle vragen!");
        return;
    }

    // stuur gebruiker naar resultaat.php
    window.location.href = `resultaat.php?genre=${genre}&age=${age}&mood=${mood}`;
}