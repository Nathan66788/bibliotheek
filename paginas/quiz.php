<?php 
session_start();
include "../php/database.php"; 
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vragenlijst - Boekzoeker.nl</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@400;700&family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body class="quiz-page-bg">
 <?php include '../includes/header.php'; ?>
    <main class="quiz-container">
        <a href="index.php" class="back-link"><i class="fas fa-arrow-left"></i> Terug naar home</a>
        
        <div class="progress-container">
            <span id="questionCount">Vraag 1 van 5</span>
            <div class="progress-bar">
                <div class="progress-line"><div class="fill" id="progressFill" style="width: 20%"></div></div>
            </div>
        </div>

       <form id="quizForm" action="resultaat.php" method="POST">
            
            <div class="card quiz-card quiz-step active" id="step-1">
                <h2>1. Wat voor thema vind je het leukst?</h2>
                <div class="options-wrapper">
                    <?php
                    
                    // haalt alleen de bestaande genres uit de database op
                    $sql = "SELECT DISTINCT genre FROM boeken WHERE genre IS NOT NULL AND genre != '' ORDER BY genre ASC";
                    $stmt = $conn->query($sql);

                    // maakt voor elke gevonden genre een button
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $genre = $row['genre'];
                        ?>
                        <label class="option">
                            <input type="radio" name="genre" value="<?php echo htmlspecialchars($genre); ?>">
                            <span><?php echo htmlspecialchars($genre); ?></span>
                        </label>
                    <?php } ?>
                </div>
                <div class="quiz-actions">
                    <button type="button" class="btn-secondary" onclick="history.back()">Terug</button>
                    <button type="button" class="btn-primary" onclick="nextQuestion(1)">Volgende <i class="fas fa-arrow-right"></i></button>
                </div>
            </div>

            <div class="card quiz-card quiz-step" id="step-2">
                <h2>2. Voor welke leeftijd zoek je?</h2>
                <div class="options-wrapper">
                    <?php
                    // leeftijdsgroepen uit de kolom halen
                    $sql_age = "SELECT DISTINCT leeftijdsgroep FROM boeken WHERE leeftijdsgroep IS NOT NULL AND leeftijdsgroep != '' ORDER BY leeftijdsgroep ASC";
                    $stmt_age = $conn->query($sql_age);
                    while ($row_age = $stmt_age->fetch(PDO::FETCH_ASSOC)) {
                        $leeftijd = $row_age['leeftijdsgroep'];
                        ?>
                        <label class="option">
                            <input type="radio" name="age" value="<?php echo htmlspecialchars($leeftijd); ?>">
                            <span><?php echo htmlspecialchars($leeftijd); ?></span>
                        </label>
                    <?php } ?>
                </div>
                <div class="quiz-actions">
                    <button type="button" class="btn-secondary" onclick="prevQuestion(2)">Vorige</button>
                    <button type="button" class="btn-primary" onclick="nextQuestion(2)">Volgende <i class="fas fa-arrow-right"></i></button>
                </div>
            </div>

            <div class="card quiz-card quiz-step" id="step-3">
                <h2>3. Hoe dik mag het boek zijn?</h2>
                <div class="options-wrapper">
                    <label class="option">
                        <input type="radio" name="length" value="Kort">
                        <span>Lekker kort (onder 200 pagina's)</span>
                    </label>
                    <label class="option">
                        <input type="radio" name="length" value="Gemiddeld">
                        <span>Gemiddeld (200 - 400 pagina's)</span>
                    </label>
                    <label class="option">
                        <input type="radio" name="length" value="Dik">
                        <span>Een dikke pil (400+ pagina's)</span>
                    </label>
                </div>
                <div class="quiz-actions">
                    <button type="button" class="btn-secondary" onclick="prevQuestion(3)">Vorige</button>
                    <button type="button" class="btn-primary" onclick="nextQuestion(3)">Volgende <i class="fas fa-arrow-right"></i></button>
                </div>
            </div>

            <div class="card quiz-card quiz-step" id="step-4">
                <h2>4. Waar heb je vandaag zin in?</h2>
                <div class="options-wrapper">
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
                        <span>Iets spannends</span>
                    </label>
                </div>
                <div class="quiz-actions">
                    <button type="button" class="btn-secondary" onclick="prevQuestion(4)">Vorige</button>
                    <button type="button" class="btn-primary" onclick="nextQuestion(4)">Volgende <i class="fas fa-arrow-right"></i></button>
                </div>
            </div>

            <div class="card quiz-card quiz-step" id="step-5">
                <h2>5. Hoeveel lees je normaal?</h2>
                <div class="options-wrapper">
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
                </div>
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