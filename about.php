<?php
require_once "config.php";

$user_id = null;
if (isset($_SESSION['user_id'])) {
   
    $user_id = $_SESSION['user_id'];}
    


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Whispering Pages | About</title>
   
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
        <h3>About Us</h3>
        <p><a href="home.php">home</a> / about</p>
    </div>

    <section class="home-about">
       
        <div class="flex">
            <div class="imgBx">
                <img src="img/2.png" alt="about">
            </div>
            <div class="content">
                <h3>why choose us ?</h3>
                <p> At Whispering Pages, we believe that every book holds a story waiting to be discovered. Our bookstore is a haven for readers seeking inspiration, adventure, and knowledge. With a carefully curated selection of novels, poetry, and non-fiction from various genres, we aim to provide a space where every visitor can find something that speaks to them. Whether you're a seasoned book lover or a curious explorer, Whispering Pages invites you to immerse yourself in the magic of storytelling and let each page reveal a new journey.
                    
                </p>
                <a href="" class="white-btn">contact us</a>
            </div>
        </div>
    </section>

    
  

    <?php include 'footer.php'; ?>
   
    <script src="js/main.js"></script>
</body>

</html>