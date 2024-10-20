<?php

require_once "config.php";


session_start();

if (isset($_POST['submit'])) {

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

    $select_users = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email' AND password = '$pass'") or die("Query failed: " . mysqli_connect_error());

    if (mysqli_num_rows($select_users) > 0) {

        $row = mysqli_fetch_assoc($select_users);

        if ($row['user_type'] == 'admin') {
            $_SESSION['admin_name'] = $row['name'];
            $_SESSION['admin_email'] = $row['email'];
            $_SESSION['admin_id'] = $row['id'];
            $_SESSION['admin_p_image'] = $row['p_image'];
            header('location: admin/home.php');
            // var_dump($_SESSION);
        } else if ($row['user_type'] == 'user') {
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_p_image'] = $row['p_image'];
            header('location: home.php');
        }
    } else {
        $message[] = "Incorrect email or password!";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Whispering Pages | Login</title>
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

    <?php

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

    <section class="form-container">
        <form action="" method="post">
            <h3>Login Now</h3>
            <input type="email" name="email" placeholder="Enter Your Email Address" class="box" required>
            <input type="password" name="password" placeholder="Enter A Password" class="box" required>
            <input type="submit" name="submit" value="Login" class="btn">
            <p>Don't have an account? <a href="register.php">Create new account</a></p>
            <p class="error"></p>
        </form>
    </section>
</body>

</html>