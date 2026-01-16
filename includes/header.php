<nav class="navbar">
    <a href="index.php" class="logo"><i class="fas fa-search"></i><span> Boekzoeker.nl</span></a>
    <?php
if (isset($_SESSION["id"])) {
    global $conn;
    $stmt = $conn->prepare("SELECT user_id, rol FROM users WHERE user_id = ?");
    $stmt->execute([$_SESSION["id"]]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if($user["rol"] != "User") {
    echo('<a href="adminpanel.php" class="logo"><i class="fas fa-user-tie"></i> Beheer</a>');
    };
}
    ?>
    <a href="
    <?php if (isset($_SESSION["id"])) {
        echo "../php/logout.php";
    } else {
        echo "../paginas/login.php";
    } ?>" class="login-link"> <i class="far fa-user-circle"></i><?php if (isset($_SESSION["id"])) {
        echo " Uitloggen";
    } else {
        echo " Inloggen";
    } ?>
    </a>
</nav>