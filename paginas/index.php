<?php
session_start();
if (isset($_SESSION["id"])){
    echo"user logged in";
    
}

$books = [
    [
        "id" => 1,
        "title" => "De Hobbit",
        "author" => "J.R.R. Tolkien",
        "year" => 1937,
        "genre" => "Fantasy",
        "description" => "Een avontuurlijk fantasyverhaal over Bilbo Balings.",
        "available" => true,
        "image" => "./images/hobbit.jpg"
    ],
    [
        "id" => 2,
        "title" => "Snor",
        "author" => "George Orwell",
        "year" => 1949,
        "genre" => "Dystopie",
        "description" => "Een beklemmende toekomstvisie over een totalitaire staat.",
        "available" => false,
        "image" => "./images/hobbit.jpg"
    ],
    [
        "id" => 3,
        "title" => "Snor",
        "author" => "George Orwell",
        "year" => 1949,
        "genre" => "Dystopie",
        "description" => "Een beklemmende toekomstvisie over een totalitaire staat.",
        "available" => false,
        "image" => "./images/hobbit.jpg"
    ],
];
?>

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

      <header class="boekheader">
        <h1>📚 Collectie</h1>
        <input type="text" id="searchInput" placeholder="Zoek op titel of auteur...">
    </header>
 
    <main class="boekmain">
 
        <div id="bookList">
    <?php foreach ($books as $book): ?>
        <div class="book-card"
             data-title="<?= htmlspecialchars($book['title']) ?>"
             data-author="<?= htmlspecialchars($book['author']) ?>"
             data-year="<?= $book['year'] ?>"
             data-genre="<?= htmlspecialchars($book['genre']) ?>"
             data-description="<?= htmlspecialchars($book['description']) ?>"
             data-available="<?= $book['available'] ? '1' : '0' ?>"
        >
            <img src="<?= htmlspecialchars($book['image']) ?>" alt="<?= htmlspecialchars($book['title']) ?>">
            <h2><?= htmlspecialchars($book['title']) ?></h2>
            <p><?= htmlspecialchars($book['author']) ?></p>
            <span class="<?= $book['available'] ? 'available' : 'unavailable' ?>">
                <?= $book['available'] ? 'Beschikbaar' : 'Niet beschikbaar' ?>
            </span>
        </div>
    <?php endforeach; ?>
        </div>
 
    </main>
 
    <div id="modal" class="modal hidden">
        <div class="modal-content">
            <span id="closeModal">&times;</span>
            <h2 id="modalTitle"></h2>
 
            <img id="modalImage" src="" alt="" class="modal-image">
 
            <p><strong>Auteur:</strong> <span id="modalAuthor"></span></p>
            <p><strong>Jaar:</strong> <span id="modalYear"></span></p>
            <p><strong>Genre:</strong> <span id="modalGenre"></span></p>
            <p id="modalDescription"></p>
            <button id="reserveBtn"></button>
        </div>
    </div>
    <?php include '../includes/footer.php'; ?>

</body>
</html>