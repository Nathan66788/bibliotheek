<?php 
// Hier komt later je PHP-logica voor het opslaan en verwijderen
include '../includes/header.php';
include "../php/database.php"; 
?>
<div id="admin-page-root">
    <link rel="stylesheet" href="../css/style.css">
    <main class="admin-wrapper">
    <section class="admin-card">
        <div class="card-header">
            <h2>Nieuw Boek Toevoegen</h2>
            <p>Vul de onderstaande velden in om een boek aan de database toe te voegen.</p>
        </div>

        <form method="POST" action="admin.php" class="admin-form">
            <div class="form-grid">
                <div class="input-group">
                    <label>Titel</label>
                    <input type="text" name="titel" placeholder="Bijv. Harry Potter" required>
                </div>
                <div class="input-group">
                    <label>Auteur</label>
                    <input type="text" name="auteur" placeholder="Bijv. J.K. Rowling" required>
                </div>

                <div class="input-group">
                    <label>Genre</label>
                    <select name="genre" required>
                        <option value="" disabled selected>Kies een genre...</option>
                        <option value="Fantasy">Fantasy</option>
                        <option value="Avontuur">Avontuur</option>
                        <option value="Romance">Romance</option>
                        <option value="Thriller">Thriller</option>
                        <option value="Science Fiction">Science Fiction</option>
                        <option value="Historisch">Historisch</option>
                        <option value="Horror">Horror</option>
                        <option value="Mystery">Mystery</option>
                        <option value="Informatief">Informatief</option>
                    </select>
                </div>

                <div class="input-group">
                    <label>Afbeelding URL</label>
                    <input type="url" name="imglink" placeholder="https://link-naar-foto.jpg">
                </div>

                <div class="input-group">
                    <label>Verdieping</label>
                    <select name="verdieping">
                        <option value="Begane grond">Begane grond</option>
                        <option value="1e Verdieping">1e Verdieping</option>
                        <option value="2e Verdieping">2e Verdieping</option>
                    </select>
                </div>

                <div class="input-group">
                    <label>Sectie</label>
                    <select name="sectie">
                        <option value="Young Adult">Young Adult</option>
                        <option value="Jeugd boeken">Jeugd boeken</option>
                        <option value="Romans">Romans</option>
                        <option value="Studie & Wetenschap">Studie & Wetenschap</option>
                        <option value="Kookboeken">Kookboeken</option>
                        <option value="Strips & Comics">Strips & Comics</option>
                    </select>
                </div>

                <div class="input-group">
                    <label>Kast</label>
                    <input type="text" name="kast" placeholder="Bijv. A12">
                </div>

                <div class="input-group">
                    <label>Beschikbaarheid</label>
                    <select name="aanwezigheid">
                        <option value="0">Aanwezig (0)</option>
                        <option value="1">Uitgeleend (1)</option>
                    </select>
                </div>
            </div>

            <div class="input-group full-width">
                <label>Beschrijving</label>
                <textarea name="beschrijving" placeholder="Waar gaat het boek over?"></textarea>
            </div>

            <button type="submit" class="btn-save">
                <i class="fas fa-plus"></i> Boek Opslaan
            </button>
        </form>
    </section>

    <section class="admin-card">
        <div class="card-header">
            <h2>Huidige Collectie</h2>
        </div>
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Cover</th>
                        <th>Titel</th>
                        <th>Genre</th>
                        <th>Status</th>
                        <th>Acties</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><img src="https://via.placeholder.com/40x60" class="table-img" alt="cover"></td>
                        <td><strong>Voorbeeld Boek</strong></td>
                        <td>Fantasy</td>
                        <td><span class="status-tag available">Aanwezig</span></td>
                        <td>
                            <a href="#" class="btn-delete">Verwijderen</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</main>

<?php include '../includes/footer.php'; ?>