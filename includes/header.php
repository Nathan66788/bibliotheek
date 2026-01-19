<nav class="navbar">
    <div class="nav-content">
        <a href="index.php" class="logo">
            <i class="fas fa-book-open"></i>
            <span>Boekzoeker.nl</span>
        </a>

        <ul class="nav-links">
            <li><a href="index.php#hero">Home</a></li>
            <li><a href="index.php#collectie">Collectie</a></li>
            <li><a href="quiz.php">Boekzoeker</a></li>
            <li><a href="index.php#about-section">Over Ons</a></li>
            <?php
            if (isset($_SESSION["id"])) {

                global $conn;

                $stmt = $conn-> prepare("SELECT user_id, rol FROM users WHERE user_id = ?");
                $stmt->execute([$_SESSION["id"]]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($user["rol"] != "User") {
                    echo ('<a href="admin.php">Beheer</a>');
                }
            }
            ?>
        </ul>

        <a href="<?php 
            if (isset($_SESSION["id"])) {
                echo "../php/logout.php";
            } else {
                echo "../paginas/login.php";
            } ?>" class="login-link">
            <i class="far fa-user-circle"></i>
            <span><?php echo isset($_SESSION["id"]) ? "Uitloggen" : "Inloggen"; ?></span>
        </a>
    </div>
</nav>