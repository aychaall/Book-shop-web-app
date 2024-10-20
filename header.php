<?php
require_once "config.php";



$user_id = null;
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
}

if (isset($message)) {
    foreach ($message as $msg) {
        echo '
            <div class="message">
                <span>' . $msg . '</span>
                <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
            </div>
            ';
    }
}
?>

<header class="header">
    <div class="main-header">
        <div class="flex">
            <a href="home.php" class="logo">Whispering Pages</a>

            <nav class="navbar">
                <a href="home.php">home</a>
                <a href="shop.php">shop</a>
                <a href="orders.php">orders</a>
                <a href="about.php">about</a>
                <a href="about.php">contact</a> <!-- Corrigé le lien "contact" -->
            </nav>

            <div class="icons">
                <div id="menu-btn" class="fas fa-bars"></div>
                <a href="search-books.php" class="fas fa-search"></a>

                <?php
                if ($user_id) {
                    // Si l'utilisateur est connecté, afficher le nombre d'articles dans le panier
                    $select_cart_number = mysqli_query($conn, "SELECT * FROM cart WHERE user_id = '$user_id'") or die("Query failed: " . mysqli_connect_error());
                    $cart_rows_number = mysqli_num_rows($select_cart_number);
                } else {
                    // Si l'utilisateur n'est pas connecté, définir le nombre à 0
                    $cart_rows_number = 0;
                }
                ?>

                <a href="cart.php"><i class="fas fa-shopping-cart"></i>
                    <span>(<?php echo $cart_rows_number; ?>)</span></a>
                <div id="user-btn" class="fas fa-user"></div>
            </div>

            <div class="user-box">
                <?php if (!isset($_SESSION['user_id'])) { ?>
                    <a href="login.php" class="delete-btn">Login</a>
                    <a href="register.php" class="delete-btn">Register</a>
                <?php } else { ?>
                    <p>Username: <span><?php echo $_SESSION['user_name']; ?></span></p>
                    <p>Email: <span><?php echo $_SESSION['user_email']; ?></span></p>
                    <a href="logout.php" class="delete-btn">Logout</a>
                <?php } ?>
            </div>
        </div>
    </div>
</header>
