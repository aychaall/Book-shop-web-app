<?php

require_once "config.php";

session_start();

$user_id = null;
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
}

if (isset($_POST['add_to_cart'])) {
    if(!isset($user_id)){
        $message[] = "You need to login first!";
    }
    else
   { 
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];

    $check_cart_number = mysqli_query($conn, "SELECT * FROM cart WHERE user_id = '$user_id' AND name = '$product_name'") or die("Query failed: " . mysqli_connect_error());

    if (mysqli_num_rows($check_cart_number) > 0) {
        $message[] = "Product already in cart";
    } else {
        $insert_cart = mysqli_query($conn, "INSERT INTO cart (user_id, name, price, image, quantity) VALUES ('$user_id', '$product_name', '$product_price', '$product_image', '$product_quantity')") or die("Query failed: " . mysqli_connect_error());
        $message[] = "Product added to cart";
    }}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Whispering Pages | Home</title>
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


    <section class="home">
        <div class="content">
            <h3>Books are a uniquely portable magic.</h3>
            <p>Whispering Pages is a cozy, independent bookstore dedicated to nurturing a love for reading</p>
            <a href="about.php" class="white-btn">discover more</a>
        </div>
    </section>

    <section class="home-products">
        <h1 class="title">latest Books</h1>
        <div class="box-container">
            <?php
            $number_to_show = 3;
            $select_products = mysqli_query($conn, "SELECT * FROM products LIMIT 0,$number_to_show") or die("Query failed: " . mysqli_connect_error());

            if (mysqli_num_rows($select_products) > 0) {
                while ($row = mysqli_fetch_assoc($select_products)) {

            ?>

            <form action="" method="post" class="box" id="result_para">
                <img src="uploaded_img/<?php echo $row['image']; ?>" alt="<?php echo $row['image']; ?>">
                <div class="name"><?php echo $row['name']; ?></div>
                <div class="price"> <?php echo $row['price']; ?>DT</div>
                <input type="number" name="product_quantity" min="1" value="1" class="quantity">
                <input type="hidden" name="product_name" value="<?php echo $row['name']; ?>">
                <input type="hidden" name="product_price" value="<?php echo $row['price']; ?>">
                <input type="hidden" name="product_image" value="<?php echo $row['image']; ?>">
                <input type="submit" value="add to cart" name="add_to_cart" class="btn">
            </form>

            <?php
                }
            } else {
                echo '<p class="empty">Empty Cart!</p>';
            }
            ?>
        </div>
        <input type="hidden" id="result_no" value="3">
       <a href="shop.php"><input type="button" id="load" value="View More" class="option-btn"></a> 
    </section>

    <section class="home-about">
        <h1 class="title">About Whispering Pages</h1>
        <div class="flex">
            <div class="imgBx">
                <img src="img/7.png" alt="about">
            </div>
            <div class="content">
                <p>At Whispering Pages, we offer a curated collection of books that inspire and captivate. Our cozy space invites readers to explore new stories, discover hidden gems, and lose themselves in the magic of the written word</p>
                <a href="about.php" class="white-btn">discover more</a>
            </div>
        </div>
    </section>

    <section class="home-contact">
        <div class="content">
            <h3>have any questions</h3>
            <p>
            Stay connected with us and feel free to ask anything — we're here to assist you as quickly as possible!!</p>
            <a href="" class="white-btn">contact us</a>
        </div>
    </section>


    <?php include 'footer.php'; ?>

  



    <script src="js/main.js"></script>
</body>

</html>