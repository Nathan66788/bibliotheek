<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registreren - Boekzoeker.nl</title>

    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="login-page">

<?php include '../includes/header.php'; ?>

    <main class="login-container">
        <div class="login-card">
            <h2>Boekzoeker.nl</h2>
            <p class="subtitle">Maak een nieuw account aan</p>

            <form id="registerForm">
                <div class="input-group">
                    <label for="name">Volledige naam</label>
                    <input type="text" id="name" placeholder="Jan de Vries" required>
                </div>

                <div class="input-group">
                    <label for="email">E-mailadres</label>
                    <input type="email" id="email" placeholder="naam@voorbeeld.nl" required>
                </div>

                <div class="input-group">
                    <label for="password">Wachtwoord</label>
                    <input type="password" id="password" placeholder="Minimaal 8 tekens" required>
                </div>

                <div class="input-group">
                    <label for="password-confirm">Wachtwoord bevestigen</label>
                    <input type="password" id="password-confirm" placeholder="********" required>
                </div>

                <button type="submit" class="btn-login">Account aanmaken</button>
            </form>

            <a href="login.php" class="register-link">Heb je al een account? Log hier in!</a>

            <div class="demo-box">
                <p><i class="fas fa-info-circle"></i> <strong>Tip:</strong> Gebruik een sterk wachtwoord met letters, cijfers en symbolen om je account veilig te houden.</p>
            </div>
        </div>
    </main>

<?php include '../includes/footer.php'; ?>

    <script src="script.js"></script>
</body>
</html>