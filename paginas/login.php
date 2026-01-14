<?php
session_start();
include '../php/database.php';
include '../php/functions.php';
include '../php/forms.php';
?>


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

            <form method="post" id="loginForm">
                <div class="input-group">
                    <label for="email">Gebruikersnaam of E-mail</label>
                    <input type="text" name="userMail" placeholder="naam@voorbeeld.nl" required>
                </div>

                <div class="input-group">
                    <label for="password">Wachtwoord</label>
                    <input type="password" name="password" id="password" placeholder="********" required>
                </div>

                <button type="submit" class="btn-login">Login</button>
            </form>

            <a href="register.php" class="register-link">Nog geen account? Registreer hier!</a>

            <div class="demo-box">
            </div>
        </div>
    </main>
<?php include '../includes/footer.php'; ?>  
    <script src="script.js"></script>
</body>
</html>