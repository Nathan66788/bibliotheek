<?php
//verbinding met database
$db = mysqli_connect("localhost", "root", "", "boekzoeker");

// De keuzes ophalen die vanuit de quiz zijn meegestuurd in de URL
$genre = $_GET['genre'] ?? '';
$leeftijd = $_GET['age'] ?? '';

// zoek in de database naar een boek dat past bij het genre en de leeftijd
$sql = "SELECT * FROM boeken WHERE genre = '$genre' AND leeftijd = '$leeftijd' LIMIT 1";
$query = mysqli_query($db, $sql);
$boek = mysqli_fetch_assoc($query);

// als er geen exacte match is,pak het eerst boek uit die genre
if (!$boek) {
    $sql = "SELECT * FROM boeken WHERE genre = '$genre' LIMIT 1";
    $query = mysqli_query($db, $sql);
    $boek = mysqli_fetch_assoc($query);
}

// als er niks is gevonden (database is leeg) maken we een fallbackboek aan
if (!$boek) {
    $boek = [
        'titel' => 'Geen match gevonden',
        'auteur' => 'Onbekend',
        'beschrijving' => 'We konden helaas geen boek vinden.',
        'image_url' => 'https://via.placeholder.com/200x300?text=Geen+Boek',
        'verdieping' => '-',
        'sectie' => '-',
        'kast' => '-'
    ];
}
?>
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

        <div class="book-detail-card">
            <img src="<?php echo $boek['image_url']; ?>" alt="Boek cover" class="book-cover-img">
            
            <div class="book-info">
                <h1><?php echo $boek['titel']; ?></h1>
                <p style="color: #666; font-size: 1.1rem; margin: 5px 0;">door <?php echo $boek['auteur']; ?></p>

                <div class="location-box">
                    <div class="location-header">
                        <i class="fas fa-map-marker-alt"></i> Locatie in Forum Zoetermeer
                    </div>
                    <div class="location-details">
                        <p><strong>Verdieping:</strong> <?php echo $boek['verdieping']; ?></p>
                        <p><strong>Afdeling:</strong> <?php echo $boek['sectie']; ?></p>
                        <p><strong>Kast/Plank:</strong> <span style="color: #4a6cf7; font-weight: bold;"><?php echo $boek['kast']; ?></span></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="tabs">
            <button class="tab active">Informatie</button>
            <button class="tab">Reviews (12)</button>
            <button class="tab">Beschikbaarheid</button>
        </div>

        <div class="info-box">
            <h3>Over dit boek</h3>
            <p><?php echo $boek['beschrijving']; ?></p>
        </div>
    </main>

    <?php include '../includes/footer.php'; ?>

    <script src="script.js"></script>
    <script>
        // resultaat laten zien wanneer de pagina laad
        window.onload = showResult;
    </script>
</body>
</html>