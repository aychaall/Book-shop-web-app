<?php
require_once "config.php";
require_once "securite.php";

$user_id = null;
if (isset($_SESSION['user_id'])) {
   
    $user_id = $_SESSION['user_id'];}
    
if (isset($_POST['order_btn'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $address = mysqli_real_escape_string($conn, 'flat no. ' . $_POST['flat'] . ', ' . $_POST['street'] . ', ' . $_POST['state'] . ', ' . $_POST['city'] . ', ' . $_POST['country'] . ' - ' . $_POST['pin_code']);
    $phone = $_POST['phone'];
    $placed_on = date('d-M-Y');
    $method = mysqli_real_escape_string($conn, $_POST['method']);

    $cart_total = 0;
    $cart_products[] = '';

    $cart_query = mysqli_query($conn, "SELECT * FROM cart WHERE user_id = '$user_id'") or die("Query failed: " . mysqli_connect_error());

    if (mysqli_num_rows($cart_query) > 0) {
        while ($cart_row = mysqli_fetch_assoc($cart_query)) {
            $cart_products[] = $cart_row['name'] . ' (' . $cart_row['quantity'] . ')';
            $sub_total = ($cart_row['price'] * $cart_row['quantity']);
            $cart_total += $sub_total;
        }
    }

    $total_products = implode(', ', $cart_products);

    $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE name='$name' AND email = '$email' AND number='$phone' AND method='$method' AND address='$address' AND total_products='$total_products' AND total_price='$cart_total'") or die("Query failed: " . mysqli_connect_error());

    if ($cart_total == 0) {
        $message[] = 'Your cart is empty';
    } else {
        if (mysqli_num_rows($order_query) > 0) {
            $message[] = 'Order already placed';
        } else {
            mysqli_query($conn, "INSERT INTO `orders` (user_id, name, email, number, address, total_price, total_products, placed_on, method, payment_status) VALUES ('$user_id', '$name', '$email', '$phone', '$address', '$cart_total', '$total_products', '$placed_on', '$method', 'pending')") or die("Query failed: " . mysqli_connect_error());

            mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die("Query failed: " . mysqli_connect_error());

            $message[] = 'Order placed successfully';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Whispering Pages | Checkout</title>
   
    <link rel="shortcut icon" href="img/livre.png" type="image/x-icon">
 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
  
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <?php include 'header.php'; ?>

    <div class="heading">
        <h3>checkout</h3>
        <p><a href="home.php">home</a> / checkout</p>
    </div>

    <section class="display-order">
        <h3>your order</h3>
        <?php
        $grand_total = 0;
        $select_cart = mysqli_query($conn, "SELECT * FROM cart WHERE user_id = '$user_id'") or die("Query failed: " . mysqli_connect_error());
        if (mysqli_num_rows($select_cart) > 0) {
            while ($row = mysqli_fetch_assoc($select_cart)) {
                $total_price = ($row['price'] * $row['quantity']);
                $grand_total += $total_price;
        ?>

        <p><?php echo $row['name']; ?>
            <span>(<?php echo $row['quantity'] . ' x '  . $row['price'] . 'DT'; ?>)</span>
        </p>
        <?php
            }
        } else {
            echo "<p class='empty'>Your cart is empty</p>";
        }
        ?>
        <div class="grand-total">grand total: <span><?php echo $grand_total; ?>DT</span></div>
    </section>

    <section class="checkout">
        <form action="" method="post">
            <h3>place your order</h3>
            <div class="flex">
                <div class="input-box">
                    <label for="name">your name :</label>
                    <input type="text" name="name" id="name" required placeholder="Your Full Name">
                </div>
                <div class="input-box">
                    <label for="phone">your number :</label>
                    <input type="number" name="phone" id="phone" required placeholder="Your phone number">
                </div>
                <div class="input-box">
                    <label for="email">your email :</label>
                    <input type="email" name="email" id="email" required placeholder="Your email">
                </div>
                <div class="input-box">
                    <label>payment method :</label>
                    <select name="method" id="method" required>
                        <option value="cash on delivery" selected>cash on delivery</option>
                        <option value="credit card">credit card</option>
                        <option value="paypal">paypal</option>
                        <option value="mastercard">mastercard</option>
                    </select>
                </div>
                <div class="input-box">
                    <label for="flat">address line 01 :</label>
                    <input type="number" min="0" name="flat" id="flat" required placeholder="flat no.">
                </div>
                <div class="input-box">
                    <label for="street">address line 02 :</label>
                    <input type="text" name="street" id="street" required placeholder="street name">
                </div>
                <div class="input-box">
                    <label for="city">city :</label>
                    <input type="text" name="city" id="city" required placeholder="city">
                </div>
                <div class="input-box">
                    <label for="state">state :</label>
                    <input type="text" name="state" id="state" required placeholder="state">
                </div>
                <div class="input-box">
                    <label for="country">country :</label>
                    <input type="text" name="country" id="country" required placeholder="country">
                </div>
                <div class="input-box">
                    <label for="pin_code">pin code :</label>
                    <input type="number" min="0" name="pin_code" id="pin_code" required placeholder="pin code">
                </div>
            </div>
            <input type="submit" value="order now" class="btn" name="order_btn">
        </form>
    </section>

    <?php include 'footer.php'; ?>

    <script src="js/main.js"></script>
</body>

</html>