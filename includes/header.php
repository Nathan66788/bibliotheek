<nav class="navbar">
    <a href="index.php" class="logo"><i class="fas fa-search"></i><span> Boekzoeker.nl</span></a>
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