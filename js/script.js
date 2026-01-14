let currentStep = 1; // begin bij vraag 1
const steps = document.querySelectorAll('.quiz-step'); // alle quizvragen ophalen
const totalSteps = steps.length; //totaal aantal vragen
const questionCountElem = document.getElementById('questionCount');
const progressFillElem = document.getElementById('progressFill');
 
let answers={};//slaat alle antwoorden op

console.log(steps); // testen of alles goed is ingeladen

// functie om een stap zichtbaar te maken
function showStep(stepNumber){
    steps.forEach(step => { 
        step.classList.remove('active'); // maak alles onzichtbaar
    });

    const current = document.getElementById(`step-${stepNumber}`); // juiste stap ophalen
    current.classList.add('active'); // zichtbaar maken

    updateProgress(stepNumber); //update progress bar
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
        alert("Kies een antwoord");
        return;
    }

    //antwoord opslaan
    const stepElement = document.getElementById(`step-${step}`);
    const checkedInput = stepElement.querySelector('input[type="radio"]:checked')

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
    const genre = document.querySelector('input[name="genre"]:checked').value;

    // Deze regel stuurt je naar de nieuwe pagina met het genre in de URL
    window.location.href = 'resultaat.php?genre=' + encodeURIComponent(genre);
}

// start met eerste vraag zichtbaar
showStep(currentStep);

function updateProgress(stepNumber){
    //update tekst: vraag X van Y
    questionCountElem.innerText = `Vraag ${stepNumber} van ${totalSteps}`;
    //update de breedte van de progress bar
    const progressPercentage = (stepNumber / totalSteps) * 100;
    progressFillElem.style.width = progressPercentage + '%';
}
