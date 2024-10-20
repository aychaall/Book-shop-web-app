<?php

require_once "../config.php";
require_once "../securite.php";


$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('Location: ../login.php');
};

if (isset($_POST['update_order'])) {
    $order_update_id = $_POST['order_id'];
    $update_payment = $_POST['update_payment'];

    mysqli_query($conn, "UPDATE `orders` SET payment_status='$update_payment' WHERE id='$order_update_id'") or die("Query failed: " . mysqli_connect_error());

    $message[] = 'Payment status has been updated successfully';
}

if (isset($_GET['delete_order'])) {
    $order_delete_id = $_GET['delete_order'];
    mysqli_query($conn, "DELETE FROM `orders` WHERE id='$order_delete_id'") or die("Query failed: " . mysqli_connect_error());
    $message[] = 'Order has been Canceled successfully';

    header('Location: orders.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Whispering Pages </title>
    <!-- Tab Icon -->
    <link rel="shortcut icon" href="img/livre.png" type="image/x-icon">
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Custom CSS Style File -->
    <link rel="stylesheet" href="../css/admin_styles.css">
</head>

<body>
    <?php include 'admin_header.php'; ?>

    <section class="orders">
        <h1 class="title">Placed Orders</h1>

        <div class="box-container">
            <?php
            $select_orders = mysqli_query($conn, "SELECT * FROM orders") or die("Query failed: " . mysqli_connect_error());

            if (mysqli_num_rows($select_orders) > 0) {
                while ($row = mysqli_fetch_assoc($select_orders)) {


            ?>

                    <div class="box"<?= $row['payment_status'] === 'completed' ? 'complete' : 'pending' ?>>
                        <p>User ID: <span><?php echo $row['user_id'] ?></span></p>
                        <p>Placed On: <span><?php echo $row['placed_on'] ?></span></p>
                        <p>Name: <span><?php echo $row['name'] ?></span></p>
                        <p>number: <span><?php echo $row['number'] ?></span></p>
                        <p>email: <span><?php echo $row['email'] ?></span></p>
                        <p>address: <span><?php echo $row['address'] ?></span></p>
                        <p>total products: <span><?php echo $row['total_products'] ?></span></p>
                        <p>total price: <span> <?php echo $row['total_price'] ?>DT</span></p>
                        <p>payment method: <span><?php echo $row['method'] ?></span></p>
                        <form action="" method="post">
                            <input type="hidden" name="order_id" value="<?php echo $row['id'] ?>">
                            <select name="update_payment">
                                <option value="" selected disabled><?php echo $row['payment_status'] ?></option>
                                <option value="pending">Pending</option>
                                <option value="completed">Completed</option>
                            </select>
                            <input type="submit" value="Update" name="update_order" class="option-btn">
                            <a href="orders.php?delete_order=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure to delete this order?');">Delete</a>
                        </form>
                    </div>

            <?php
                }
            } else {
                echo "<h3 class='empty'>No orders placed yet!</h3>";
            }
            ?>
        </div>
    </section>







    <!-- Custom admin js file -->
    <script src="../js/admin_script.js"></script>
</body>

</html>