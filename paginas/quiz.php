<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vragenlijst - Boekzoeker.nl</title>

    <link rel="stylesheet" href="../css/style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
 <?php include '../includes/header.php'; ?>
    <main class="quiz-container">
        <a href="index.php" class="back-link"><i class="fas fa-arrow-left"></i> Terug naar home</a>
        
        <div class="progress-container">
            <span id="questionCount">Vraag 1 van 5</span>
            <div class="progress-bar">
                <div class="progress-line"><div class="fill" id="progressFill" style="width: 20%"></div></div>
            </div>
        </div>

        <form id="quizForm">
            
            <div class="card quiz-card quiz-step active" id="step-1">
                <h2>1. Wat voor thema vind je het leukst?</h2>
                
                <label class="option">
                    <input type="radio" name="genre" value="Avontuur">
                    <span><i class="fas fa-mountain"></i> Avontuur</span>
                </label>
                <label class="option">
                    <input type="radio" name="genre" value="Romance">
                    <span><i class="fas fa-heart"></i> Romance</span>
                </label>
                <label class="option">
                    <input type="radio" name="genre" value="Spanning">
                    <span><i class="fas fa-user-secret"></i> Spanning & Thriller</span>
                </label>
                <label class="option">
                    <input type="radio" name="genre" value="Fantasy">
                    <span><i class="fas fa-dragon"></i> Fantasy</span>
                </label>
                <label class="option">
                    <input type="radio" name="genre" value="Science Fiction">
                    <span><i class="fas fa-rocket"></i> Science Fiction</span>
                </label>
                <label class="option">
                    <input type="radio" name="genre" value="Historisch">
                    <span><i class="fas fa-landmark"></i> Historisch</span>
                </label>

                <div class="quiz-actions">
                    <button type="button" class="btn-secondary" onclick="history.back()">Terug</button>
                    <button type="button" class="btn-primary" onclick="nextQuestion(1)">Volgende <i class="fas fa-arrow-right"></i></button>
                </div>
            </div>

            <div class="card quiz-card quiz-step" id="step-2">
                <h2>2. Voor welke leeftijd zoek je?</h2>
                
                <label class="option">
                    <input type="radio" name="age" value="Jeugd">
                    <span>Jeugd (tot 12 jaar)</span>
                </label>
                <label class="option">
                    <input type="radio" name="age" value="Young Adult">
                    <span>Young Adult (12 - 18 jaar)</span>
                </label>
                <label class="option">
                    <input type="radio" name="age" value="Volwassenen">
                    <span>Volwassenen</span>
                </label>

                <div class="quiz-actions">
                    <button type="button" class="btn-secondary" onclick="prevQuestion(2)">Vorige</button>
                    <button type="button" class="btn-primary" onclick="nextQuestion(2)">Volgende <i class="fas fa-arrow-right"></i></button>
                </div>
            </div>

            <div class="card quiz-card quiz-step" id="step-3">
                <h2>3. Hoe dik mag het boek zijn?</h2>
                
                <label class="option">
                    <input type="radio" name="length" value="Kort">
                    <span>Lekker kort (onder 200 paginas)</span>
                </label>
                <label class="option">
                    <input type="radio" name="length" value="Gemiddeld">
                    <span>Gemiddeld (200 - 400 paginas)</span>
                </label>
                <label class="option">
                    <input type="radio" name="length" value="Dik">
                    <span>Een dikke pil (400+ paginas)</span>
                </label>

                <div class="quiz-actions">
                    <button type="button" class="btn-secondary" onclick="prevQuestion(3)">Vorige</button>
                    <button type="button" class="btn-primary" onclick="nextQuestion(3)">Volgende <i class="fas fa-arrow-right"></i></button>
                </div>
            </div>

            <div class="card quiz-card quiz-step" id="step-4">
                <h2>4. Waar heb je vandaag zin in?</h2>
                
                <label class="option">
                    <input type="radio" name="mood" value="Vrolijk">
                    <span>Iets vrolijks en lichts</span>
                </label>
                <label class="option">
                    <input type="radio" name="mood" value="Serieus">
                    <span>Iets serieus om over na te denken</span>
                </label>
                <label class="option">
                    <input type="radio" name="mood" value="Spannend">
                    <span>Iets spannends (op het puntje van je stoel)</span>
                </label>

                <div class="quiz-actions">
                    <button type="button" class="btn-secondary" onclick="prevQuestion(4)">Vorige</button>
                    <button type="button" class="btn-primary" onclick="nextQuestion(4)">Volgende <i class="fas fa-arrow-right"></i></button>
                </div>
            </div>
            <div class="card quiz-card quiz-step" id="step-5">
                <h2>5. Hoeveel lees je normaal?</h2>

                <label class="option">
                    <input type="radio" name="reading_frequency" value="Nooit">
                    <span>Ik lees bijna nooit</span>
                </label>
                <label class="option">
                    <input type="radio" name="reading_frequency" value="Soms">
                    <span>Af en toe</span>
                </label>
                <label class="option">
                    <input type="radio" name="reading_frequency" value="Regelmatig">
                    <span>Regelmatig</span>
                </label>
                <label class="option">
                    <input type="radio" name="reading_frequency" value="vaak">
                    <span>Vaak</span>
                </label>

                <div class="quiz-actions">
                    <button type="button" class="btn-secondary" onclick="prevQuestion(5)">Vorige</button>
                    <button type="button" class="btn-primary" onclick="finishQuiz()">Toon resultaat <i class="fas fa-check"></i></button>
                </div>
            </div>

        </form>
    </main>

 <?php include '../includes/footer.php'; ?>
     <script src="../js/script.js"></script>
</body>
</html>