<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inloggen - Boekzoeker.nl</title>

    <link rel="stylesheet" href="../css/style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="login-page">

<?php include '../includes/header.php'; ?>
    <main class="login-container">
        <div class="login-card">
            <h2>Boekzoeker.nl</h2>
            <p class="subtitle">Log in met je account</p>

            <form id="loginForm">
                <div class="input-group">
                    <label for="email">Gebruikersnaam of E-mail</label>
                    <input type="text" id="email" placeholder="naam@voorbeeld.nl" required>
                </div>

                <div class="input-group">
                    <label for="password">Wachtwoord</label>
                    <input type="password" id="password" placeholder="********" required>
                </div>

                <button type="submit" class="btn-login">Login</button>
            </form>

            <a href="#" class="register-link">Nog geen account? Registreer hier!</a>

            <div class="demo-box">
                <p><strong>Demo inloggegevens:</strong></p>
                <p>Admin: admin@boekzoeker.nl / admin</p>
                <p>Medewerker: medewerker@boekzoeker.nl / medewerker</p>
            </div>
        </div>
    </main>
<<<<<<< HEAD:html/login.html

    <footer class="footer-fixed">
        <p>&copy; 2026 Boekzoeker.nl - Vind jouw perfecte boek</p>
    </footer>

    <script src="/js/script.js"></script>
=======
<?php include '../includes/footer.php'; ?>
    <script src="script.js"></script>
>>>>>>> 8235fd978ba0d732cb3cf77c91034d9ab250f4d2:paginas/login.php
</body>
</html>