<?php
include '../includes/header.php';
include "../php/database.php";
include "../php/functions.php";
include "../php/forms.php";

// Haalt nodige data uit datbase
try {
    $genres = $conn->query("SELECT DISTINCT genre FROM boeken;")->fetchAll(PDO::FETCH_ASSOC);
    $boeken = $conn->query("SELECT * FROM boeken ORDER BY boek_id DESC")->fetchAll(PDO::FETCH_ASSOC);
    $users = $conn->query("SELECT user_id, username, email FROM users ORDER BY user_id DESC")->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $boeken = [];
    $users = [];
    $genres = [];
}
?>

<div id="admin-page-root">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <main class="admin-wrapper">
        <div class="tabs">
            <button class="tab active" onclick="openTab(event, 'tab-boeken')">Boeken Beheer</button>
            <button class="tab" onclick="openTab(event, 'tab-users')">Gebruikers</button>
        </div>

        <div id="tab-boeken" class="tab-content active">
            <section class="admin-card">
                <h2>Nieuw Boek Toevoegen</h2>
                <form method="post" class="admin-form">
                    <div class="form-grid">
                        <div class="input-group"><label>Titel</label><input type="text" name="titel" required></div>
                        <div class="input-group"><label>Auteur</label><input type="text" name="auteur" required></div>
                        <div class="input-group">
                            <label>Genre</label>
                            <select name="genre" id="genreSelect" required>
                                <option value="" disabled selected>Kies een genre...</option>
                                <?php foreach ($genres as $genre) {echo "<option value='{$genre['genre']}'>{$genre['genre']}</option>";}?>
                                <option value="nieuw">Nieuw</option>
                            </select>
                            <input type="text" name="new_genre" id="newGenreInput" placeholder="Typ een nieuw genre" style="display:none;">
                        </div>
                        <div class="input-group"><label>Afbeelding URL</label><input type="url" name="imglink"></div>
                    </div>
                    <div class="input-group full-width" style="margin-top: 15px;">
                        <label>Beschrijving</label>
                        <textarea name="beschrijving"></textarea>
                    </div>
                    <button type="submit" class="btn-save">Boek Opslaan</button>
                </form>
            </section>

            <section class="admin-card">
                <h2>Huidige Collectie</h2>
                <div class="table-responsive">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Cover</th>
                                <th>Titel</th>
                                <th>Genre</th>
                                <th>Auteur</th>
                                <th>Aanwezigheid</th>
                                <th>Beschrijving</th>
                                <th>Acties</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($boeken as $boek): ?>
                                <tr>
                                    <td><img class="table-img" src="<?php echo ($boek['imglink']); ?>"></img></td>
                                    <td><?php echo ($boek['titel']); ?></td>
                                    <td><?php echo ($boek['genre']); ?></td>
                                    <td><?php echo ($boek['auteur']); ?></td>
                                    <td><?php echo ($boek['aanwezig']); ?></td>\
                                    <td><?php echo ($boek['beschrijving']); ?></td>
                                    <td><button class="btn-edit-small">Aanpassen</button></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>

        <div id="tab-users" class="tab-content" style="display:none;">
            <section class="admin-card">
                <h2>Geregistreerde Gebruikers</h2>
                <div class="table-responsive">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Acties</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user): ?>
                                <tr id="user-row-<?php echo $user['user_id']; ?>">
                                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                                    <td>
                                        <button onclick="toggleEditUser(<?php echo $user['user_id']; ?>)"
                                            class="btn-edit-small">Aanpassen</button>
                                        <a href="delete.php?type=user&id=<?php echo $user['user_id']; ?>"
                                            class="btn-delete-small">Verwijderen </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </main>
</div>

<script>
    // Tabs switch
    function openTab(evt, tabName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tab-content");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tab");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].classList.remove("active");
        }
        document.getElementById(tabName).style.display = "block";
        evt.currentTarget.classList.add("active");
    }
    //open new genre wanneer selected
    const genreSelect = document.getElementById("genreSelect");
    const newGenreInput = document.getElementById("newGenreInput");

    genreSelect.addEventListener("change", function () {
        if (this.value === "nieuw") {
            newGenreInput.style.display = "block";
            newGenreInput.required = true;
        } else {
            newGenreInput.style.display = "none";
            newGenreInput.required = false;
        }
    });
</script>

<?php include '../includes/footer.php'; ?>