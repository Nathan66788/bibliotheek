<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boekzoeker.nl - Vind jouw perfecte boek</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<?php include '../includes/header.php'; ?>
    <header class="hero">
        <h1>Vind jouw perfecte boek!</h1>
        <p>Doe de test welke bij jou past! Met onze slimme vragenlijst vinden we het ideale boek dat perfect aansluit bij jouw voorkeuren.</p>
        
        <div class="steps-container">
            <h3>Hoe werkt het?</h3>
            <div class="step">
                <div class="step-number">1</div>
                <div class="step-text">
                    <strong>Doe de test</strong>
                    <p>Beantwoord een paar vragen over je leesvoorkeuren</p>
                </div>
            </div>
            <div class="step">
                <div class="step-number">2</div>
                <div class="step-text">
                    <strong>Krijg aanbevelingen</strong>
                    <p>Zie boeken die perfect bij jou passen</p>
                </div>
            </div>
            <div class="step">
                <div class="step-number">3</div>
                <div class="step-text">
                    <strong>Vind je boek</strong>
                    <p>Zie direct waar het boek in de bibliotheek ligt (Zoetermeer)</p>
                </div>
            </div>
        </div>

        <a href="quiz.php" class="btn-primary">Start de vragenlijst <i class="fas fa-arrow-right"></i></a>
    </header>

    <section class="features">
        <div class="feature-card">
            <i class="fas fa-book-open"></i>
            <h3>Grote collectie</h3>
            <p>Duizenden boeken in verschillende genres.</p>
        </div>
        <div class="feature-card">
            <i class="far fa-star"></i>
            <h3>Persoonlijke match</h3>
            <p>Op basis van jouw antwoorden.</p>
        </div>
        <div class="feature-card">
            <i class="fas fa-map-marker-alt"></i>
            <h3>Makkelijk te vinden</h3>
            <p>Directe route in Forum Zoetermeer.</p>
        </div>
    </section>

    <?php include '../includes/footer.php'; ?>

</body>
</html>