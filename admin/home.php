<?php
require_once "../config.php";
require_once "../securite.php";

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('Location: ../login.php');
};

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Whispering Pages | Home<</title>
    <!-- Tab Icon -->
    <link rel="shortcut icon" href="img/livre.png" type="image/x-icon">
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Custom CSS Style File -->
    <link rel="stylesheet" href="../css/admin_styles.css">
</head>

<body>
    <?php include 'admin_header.php'; ?>

    <!-- Start Admin Dashboard -->
    <section class="dashboard">
        <h1 class="title">Dashboard</h1>
        <div class="box-container">

            <!-- Pending Orders -->
            <div class="box">
                <?php
                $total_pendings = 0;
                $select_pending = mysqli_query($conn, "SELECT total_price FROM `orders` WHERE payment_status = 'pending'") or die("Query failed: " . mysqli_connect_error());

                if (mysqli_num_rows($select_pending) > 0) {
                    while ($fetch_pendings = mysqli_fetch_assoc($select_pending)) {
                        $total_price = $fetch_pendings['total_price'];
                        $total_pendings += $total_price;
                    };
                };
                ?>
                <h3><?php echo $total_pendings; ?>DT</h3>
                <p>total pendings</p>
            </div>

            <!-- Completed Orders -->
            <div class="box">
                <?php

                $total_completed = 0;
                $select_completed = mysqli_query($conn, "SELECT total_price FROM `orders` WHERE payment_status = 'completed'") or die("Query failed: " . mysqli_connect_error());

                if (mysqli_num_rows($select_completed) > 0) {
                    while ($fetch_completed = mysqli_fetch_assoc($select_completed)) {
                        $total_price = $fetch_completed['total_price'];
                        $total_completed += $total_price;
                    };
                };
                ?>
                <h3><?php echo $total_completed; ?>DT</h3>
                <p>completed payments</p>
            </div>

            <!-- All Orders -->
            <div class="box">
                <?php
                $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die("Query failed: " . mysqli_connect_error());
                $number_of_orders = mysqli_num_rows($select_orders);
                ?>
                <h3><?php echo $number_of_orders; ?></h3>
                <p>orders placed</p>
            </div>

            <!-- Products -->
            <div class="box">
                <?php
                $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die("Query failed: " . mysqli_connect_error());
                $number_of_products = mysqli_num_rows($select_products);
                ?>
                <h3><?php echo $number_of_products; ?></h3>
                <p>products added</p>
            </div>


        </div>
    </section>









    <!-- Custom admin js file -->
    <script src="../js/admin_script.js"></script>
</body>

</html>