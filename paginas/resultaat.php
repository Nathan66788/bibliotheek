<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jouw resultaat - Boekzoeker.nl</title>

    <link rel="stylesheet" href="../css/style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <main class="result-container">
        <a href="quiz.php" class="back-link"><i class="fas fa-arrow-left"></i> Terug naar vragen</a>

        <div class="book-detail-card" id="resultContent">
            <p>Laden...</p>
        </div>

        <div class="tabs">
            <button class="tab active">Informatie</button>
            <button class="tab">Reviews (12)</button>
            <button class="tab">Beschikbaarheid</button>
        </div>

        <div class="info-box">
            <h3>Over dit boek</h3>
            <p id="bookDescription">Een korte beschrijving van het boek...</p>
        </div>
    </main>
<?php include '../includes/footer.php'; ?>

    <script src="/js/script.js"></script>
    <script>
        // Start de functie om het resultaat te tonen zodra de pagina laadt
        window.onload = showResult;
    </script>
</body>
</html>