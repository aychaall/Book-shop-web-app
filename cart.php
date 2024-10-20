<?php

require_once "config.php";
require_once "securite.php";

$user_id = null;
if (isset($_SESSION['user_id'])) {
   
    $user_id = $_SESSION['user_id'];}
    




if (isset($_GET['delete_book'])) {
    $cart_id = $_GET['delete_book'];
    $delete_query = mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$cart_id'") or die("Query failed: " . mysqli_connect_error());

    if ($delete_query) {
        header('Location: cart.php');
         $message[] = "Book deleted successfully";
    }
}

if (isset($_POST['update_cart'])) {
    $cart_id = $_POST['cart_id'];
    $cart_quantity = $_POST['quantity'];

    $update_query = mysqli_query($conn, "UPDATE `cart` SET quantity='$cart_quantity' WHERE id = '$cart_id'") or die("Query failed: " . mysqli_connect_error());

    if ($update_query) {
        $message[] = "Cart quantity updated successfully";
    }
}


if (isset($_GET['delete_all'])) {
    $cart_id = $_GET['delete_book'];
    $delete_query = mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die("Query failed: " . mysqli_connect_error());

    if ($delete_query) {
        header('Location: cart.php');
         $message[] = "Your Cart has been deleted successfully";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Whispering Pages | Cart</title>
    <!-- Tab Icon -->
    <link rel="shortcut icon" href="img/livre.png" type="image/x-icon">
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Custom CSS Style File -->
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <?php include 'header.php'; ?>

    <div class="heading">
        <h3>shopping cart</h3>
        <p><a href="home.php">home</a> / cart</p>
    </div>

    <section class="shopping-cart">
        <h1 class="title">Books Added</h1>

        <div class="box-container">
            <?php
            $grand_total = 0;
            $select_cart = mysqli_query($conn, "SELECT * FROM cart WHERE user_id = '$user_id'") or die("Query failed: " . mysqli_connect_error());

            if (mysqli_num_rows($select_cart) > 0) {
                while ($row = mysqli_fetch_assoc($select_cart)) {
            ?>

            <div class="box">
                <a href="cart.php?delete_book=<?php echo $row['id']; ?>" class="fas fa-times"
                    onclick="return confirm('Are You Sure Delete This Book From Cart?!');"></a>
                <img src="uploaded_img/<?php echo $row['image']; ?>" alt="<?php echo $row['image']; ?>">
                <div class="name"><?php echo $row['name']; ?></div>
                <div class="price"><?php echo $row['price']; ?>DT</div>
                <form action="" method="post">
                    <input type="hidden" name="cart_id" value="<?php echo $row['id']; ?>">
                    <input type="number" min="1" name="quantity" value="<?php echo $row['quantity']; ?>">
                    <input type="submit" name="update_cart" value="Update" class="option-btn">
                </form>
                <div class="sub-total">sub-total:
                    <span><?php echo $sub_total = ($row['quantity'] * $row['price']); ?>DT</span>
                </div>
            </div>

            <?php
                    $grand_total += $sub_total;
                }
            } else {
                echo "<p class='empty'>No books added to cart</p>";
                // echo "<style>
                //     .delete-all{
                //         display: none;
                //     }
                // </style>";
            }
            ?>
        </div>
        <div style="margin-top:2rem; text-align:center;">
            <a href="cart.php?delete_all"
                class="delete-btn delete-all  <?php echo ($grand_total > 1) ? '' : 'disabled'; ?>"
                onclick="return confirm('Are You Sure Delete All From Cart?!');">Delete All</a>
        </div>
        <div class="cart-total">
            <p>grand total: <span><?php echo $grand_total; ?>DT</span></p>
            <div class="flex">
                <a href="shop.php" class="option-btn">continue shopping</a>
                <a href="checkout.php" class="btn <?php echo ($grand_total > 1) ? '' : 'disabled'; ?>">proceed to
                    checkout </a>
            </div>
        </div>
    </section>



    <?php include 'footer.php'; ?>

    <script src="js/main.js"></script>
</body>

</html>