<?php
session_start();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boekzoeker.nl - Vind jouw perfecte boek</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@400;700&family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        /* Basis grid voor de collectie */
        #bookList {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            padding: 20px 0;
            transition: all 0.5s ease;
        }

        .view-more-container {
            text-align: center;
            margin: 30px 0;
        }

        #loadMoreBtn {
            padding: 12px 30px;
            font-size: 16px;
            cursor: pointer;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            transition: background 0.3s, transform 0.2s;
        }

        #loadMoreBtn:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        /* Deze class verbergt de boeken na de eerste 8 */
        .hidden-book {
            display: none !important;
        }
    </style>
</head>
<body>

<?php 
if (isset($_SESSION["id"])){
    echo "<div style='padding:10px; background:#eef2ff; text-align:center;'>Gebruiker ingelogd</div>";
}
include '../includes/header.php'; 
?>

    <header class="hero" id="hero">
        <div class="hero-content">
            <h1>Vind jouw perfecte boek!</h1>
            <p>Ontdek onze uitgebreide collectie in Zoetermeer.</p>
            <a href="quiz.php" class="btn-primary">Start de vragenlijst <i class="fas fa-arrow-right"></i></a>
        </div>
    </header>

    <section id="collectie">
        <header class="boekheader">
            <h1>📚 Collectie</h1>
            <input type="text" id="searchInput" placeholder="Zoek op titel of auteur...">
        </header>
 
        <main class="boekmain">
            <div id="bookList">
                <p>De collectie wordt geladen...</p>
            </div>

            <div class="view-more-container">
                <button id="loadMoreBtn">
                    <span id="btnText">Bekijk meer boeken</span> 
                    <i id="btnIcon" class="fas fa-chevron-down"></i>
                </button>
            </div>
        </main>
    </section>

    <div id="modal" class="modal hidden">
        <div class="modal-content">
            <span id="closeModal">&times;</span>
            <h2 id="modalTitle"></h2>
            <img id="modalImage" src="" alt="" class="modal-image" style="max-width: 200px;">
            <p><strong>Auteur:</strong> <span id="modalAuthor"></span></p>
            <p id="modalDescription"></p>
            <button id="reserveBtn" class="btn-primary"></button>
        </div>
    </div>

    <?php include '../includes/footer.php'; ?>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const bookList = document.getElementById('bookList');
        const searchInput = document.getElementById('searchInput');
        const loadMoreBtn = document.getElementById('loadMoreBtn');
        const btnText = document.getElementById('btnText');
        const btnIcon = document.getElementById('btnIcon');
        const modal = document.getElementById('modal');
        const closeModal = document.getElementById('closeModal');
        
        let allBooks = [];
        let isExpanded = false; // Status: is het menu uitgeklapt?

        // 1. Data ophalen
        fetch('../JSON/boeken.json')
            .then(response => response.json())
            .then(data => {
                allBooks = data;
                renderBooks(allBooks);
            });

        // 2. Boeken tekenen
        function renderBooks(books) {
            bookList.innerHTML = '';
            
            books.forEach((book, index) => {
                const card = document.createElement('div');
                card.className = 'book-card';
                
                // Verberg alles na de eerste 8, tenzij we al op 'isExpanded' staan
                if (index >= 10 && !isExpanded) {
                    card.classList.add('hidden-book');
                }

                card.innerHTML = `
                    <img src="${book.image}" alt="${book.title}" style="width:100%; border-radius:8px;">
                    <h3>${book.title}</h3>
                    <p>${book.author}</p>
                    <span class="${book.available ? 'available' : 'unavailable'}">
                        ${book.available ? 'Beschikbaar' : 'Niet beschikbaar'}
                    </span>
                `;
                
                card.addEventListener('click', () => openBookModal(book));
                bookList.appendChild(card);
            });

            // Toon/verberg de knop op basis van het aantal resultaten
            loadMoreBtn.parentElement.style.display = books.length > 8 ? 'block' : 'none';
        }

        // 3. De Uitklap/Inklap Logica
        loadMoreBtn.addEventListener('click', () => {
            isExpanded = !isExpanded; // Wissel de status (true/false)

            if (isExpanded) {
                // Uitklappen
                const hiddenCards = document.querySelectorAll('.hidden-book');
                hiddenCards.forEach(card => card.classList.remove('hidden-book'));
                btnText.innerText = "Minder boeken tonen";
                btnIcon.className = "fas fa-chevron-up";
            } else {
                // Inklappen
                renderBooks(allBooks); // Teken de lijst opnieuw (waardoor de class weer wordt toegevoegd)
                btnText.innerText = "Bekijk meer boeken";
                btnIcon.className = "fas fa-chevron-down";
                
                // Scroll zachtjes terug naar het begin van de collectie
                document.getElementById('collectie').scrollIntoView({ behavior: 'smooth' });
            }
        });

        // 4. Modal Functies
        function openBookModal(book) {
            document.getElementById('modalTitle').innerText = book.title;
            document.getElementById('modalImage').src = book.image;
            document.getElementById('modalAuthor').innerText = book.author;
            document.getElementById('modalDescription').innerText = book.description;
            document.getElementById('reserveBtn').innerText = book.available ? "Reserveer nu" : "Niet beschikbaar";
            modal.classList.remove('hidden');
        }

        closeModal.addEventListener('click', () => modal.classList.add('hidden'));

        // 5. Zoekfunctie
        searchInput.addEventListener('input', (e) => {
            isExpanded = false; // Reset naar ingeklapt bij een nieuwe zoekopdracht
            btnText.innerText = "Bekijk meer boeken";
            btnIcon.className = "fas fa-chevron-down";
            
            const term = e.target.value.toLowerCase();
            const filtered = allBooks.filter(b => 
                b.title.toLowerCase().includes(term) || b.author.toLowerCase().includes(term)
            );
            renderBooks(filtered);
        });
    });
    </script>

</body>
</html>