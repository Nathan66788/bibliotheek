<?php
include("../php/database.php");

    // Haal het genre op uit de URL 
    $gekozenGenre = isset($_GET['genre']) ? $_GET['genre'] : 'Fantasy';

    $gekozenGenre = isset($_GET['genre']) ? $_GET['genre'] : 'Avontuur';

    $gekozenGenre = isset($_GET['genre']) ? $_GET['genre'] : 'Romance';

    $gekozenGenre = isset($_GET['genre']) ? $_GET['genre'] : 'Thriller';

    $gekozenGenre = isset($_GET['genre']) ? $_GET['genre'] : 'Science Fiction';

    $gekozenGenre = isset($_GET['genre']) ? $_GET['genre'] : 'Historisch';

    // Zoek in de tabel boeken
    $stmt = $conn->prepare("SELECT * FROM boeken WHERE genre LIKE :genre LIMIT 1");
    $stmt->execute(['genre' => "%$gekozenGenre%"]);

    // Maakt de variabele $boeken aan door de rij uit de database te fetchen
    $boeken = $stmt->fetch(PDO::FETCH_ASSOC);

    // Voorbeeld als database niks ziet
    if (!$boeken) {
        $boeken = [
            'titel' => 'Geen boek gevonden',
            'auteur' => 'Onbekend',
            'imglink' => '', 
            'verdieping' => '-',
            'sectie' => '-',
            'kast' => '-',
            'beschrijving' => 'Helaas hebben we geen match gevonden voor dit genre.'
        ];
    }
} catch(PDOException $e) {
    die("Database fout: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jouw resultaat - Boekzoeker.nl</title>
    <link rel="stylesheet" href="../css/style.css?v=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <main class="result-container">
        <a href="quiz.php" class="back-link"><i class="fas fa-arrow-left"></i> Terug naar vragen</a>

        <div class="book-detail-card">
            <img src="<?php echo $boeken['imglink']; ?>" alt="Boek cover" class="book-cover-img">
            
            <div class="book-info">
                <h1><?php echo $boeken['titel']; ?></h1>
                <p style="color: #665; font-size: 1.1rem; margin: 5px 0;">door <?php echo $boeken['auteur']; ?></p>

                <div class="location-box">
                    <div class="location-header">
                        <i class="fas fa-map-marker-alt"></i> Locatie in Forum Zoetermeer
                    </div>
                    <div class="location-details">
                        <p><strong>Verdieping:</strong> <?php echo $boeken['verdieping']; ?></p>
                        <p><strong>Afdeling:</strong> <?php echo $boeken['sectie']; ?></p>
                        <p><strong>Kast/Plank:</strong> <span style="color: #4a6cf7; font-weight: bold;"><?php echo $boeken['kast']; ?></span></p>
                    </div>
                </div>
            </div>
        </div>

      <div class="tabs">
    <button onclick="showTab(0)" class="tab active">Informatie</button>
    <button onclick="showTab(1)" class="tab">Reviews</button>
    <button onclick="showTab(2)" class="tab">Beschikbaarheid</button>
</div>

<div id="tab-0" class="tab-content info-box">
    <h3>Over dit boek</h3>
    <p><?php echo $boeken['beschrijving']; ?></p>
</div>

<div id="tab-1" class="tab-content info-box" style="display: none;">
    <h3>Reviews</h3>
    <p>Momenteel nog geen reviews.</p>
</div>

<div id="tab-2" class="tab-content info-box" style="display: none;">
    <h3>Beschikbaarheid</h3>
    <p>
        Status in Forum Zoetermeer: 
        <strong>
            <?php 
                // Word gekeken naar waarde in database
                if ($boeken['aanwezig'] == 0) {
                    echo "Aanwezig";
                } else {
                    echo "Uitgeleend";
                }
            ?>
        </strong>
    </p>
</div>

<script>
function showTab(index) {
    // 1. Verberg eerst alle tekstvakken
    const contents = document.querySelectorAll('.tab-content');
    contents.forEach(box => {
        box.style.display = 'none';
    });

    // 2. Toon alleen het vakje waar op geklikt is
    document.getElementById('tab-' + index).style.display = 'block';

    // 3. Zorg dat de knoppen de juiste kleur krijgen (active class)
    const buttons = document.querySelectorAll('.tab');
    buttons.forEach(btn => btn.classList.remove('active'));
    buttons[index].classList.add('active');
}
</script>   
    </main>

    <?php include '../includes/footer.php'; ?>


    <script>
        // resultaat laten zien wanneer de pagina laad
        window.onload = showResult;
    </script>
        <script src="../js/script.js"></script>
</body>
</html>