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

//functie om quiz te eindigen en naar resultaat.php te sturen
function finishQuiz(){
    //laatste antwoord opslaan
    if(!isAnswered(currentStep)){
        alert("kies een antwoord");
        return;
    }

   quizForm.submit();
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
