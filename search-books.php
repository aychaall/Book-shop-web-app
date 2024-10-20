<?php
require_once "config.php";


session_start();
$user_id = null;
if (isset($_SESSION['user_id'])) {
   
    $user_id = $_SESSION['user_id'];}
    



if (isset($_POST['add_to_cart'])) {
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];

    $check_cart_number = mysqli_query($conn, "SELECT * FROM cart WHERE user_id = '$user_id' AND name = '$product_name'") or die("Query failed: " . mysqli_connect_error());

    if (mysqli_num_rows($check_cart_number) > 0) {
        $message[] = "Product is already in cart";
    } else {
        $insert_cart = mysqli_query($conn, "INSERT INTO cart (user_id, name, price, image, quantity) VALUES ('$user_id', '$product_name', '$product_price', '$product_image', '$product_quantity')") or die("Query failed: " . mysqli_connect_error());
        $message[] = "Product successfuly added to cart";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Whispering Pages| Search Books</title>
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
        <h3>search books</h3>
        <p><a href="home.php">home</a> / search</p>
    </div>

    <section class="search-form">
        <form action="" method="post">
            <input type="text" name="search" placeholder="search for a book" required class="box">
            <input type="submit" name="submit" value="Search" class="btn">
        </form>
    </section>


    <div class="home-products" style="padding-top:0; padding-bottom:1.5rem;">
        <div class="box-container">
            <?php
            if (isset($_POST['submit'])) {
                $search = $_POST['search'];
                $sql = "SELECT * FROM products WHERE name LIKE '%$search%'";
                $select_item = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                if (mysqli_num_rows($select_item) > 0) {
                    while ($row = mysqli_fetch_assoc($select_item)) {
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
                    echo "<p class='empty'>No results found</p>";
                }
            } else {
                echo "<p class='empty'>Any needs!</p>";
            }

            ?>
        </div>
    </div>


    <?php include 'footer.php'; ?>

    <script src="js/main.js"></script>
</body>

</html>