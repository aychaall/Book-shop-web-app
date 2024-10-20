<?php
require_once "../config.php";
require_once "../securite.php";


$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('Location: ../login.php');
};

if (isset($_POST['add_product'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = $_POST['price'];
    $image = basename($_FILES['image']['name']);
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../uploaded_img/' . $image;

    $select_product_name = mysqli_query($conn, "SELECT name FROM products WHERE name = '$name'") or die("Query failed: " . mysqli_connect_error());

    if (mysqli_num_rows($select_product_name) > 0) {
        $message[] = 'Product name already exists';
    } else {
        $insert_product = mysqli_query($conn, "INSERT INTO products (name, price, image) VALUES ('$name', '$price', '$image')") or die("Query failed: " . mysqli_connect_error());
        if ($insert_product) {
            if ($image_size > 2000000) {
                $message[] = 'Image size is too big';
            } else {
                move_uploaded_file($image_tmp_name, $image_folder);
                $message[] = 'Product Added Successfully';
            }
        } else {
            $message[] = 'Product not added, Try again';
        }
    }
};

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $select_del_product = mysqli_query($conn, "SELECT image FROM products WHERE id = '$id'") or die("Query failed: " . mysqli_connect_error());
    $fetch_delete_image = mysqli_fetch_assoc($select_del_product);

    unlink('../uploaded_img/' . $fetch_delete_image['image']);

    $delete_product = mysqli_query($conn, "DELETE FROM products WHERE id = '$id'") or die("Query failed: " . mysqli_connect_error());
    var_dump($delete_product);
    if ($delete_product) {
        $message[] = 'Product has been deleted successfully';
        header('Location:products.php');
    } else {
        $message[] = 'Product not deleted, Try again';
    }
}

if (isset($_POST['update_product'])) {
    $updated_p_id = $_POST['update_p_id'];
    $update_name = $_POST['update_name'];
    $update_price = $_POST['update_price'];

    if (!empty($update_name)) {
        mysqli_query($conn, "UPDATE products SET name = '$update_name' WHERE id = '$updated_p_id'") or die("Query failed: " . mysqli_connect_error());
        $message[] = 'Product updated successfully';
    }

    if (!empty($update_price)) {
        mysqli_query($conn, "UPDATE products SET price = '$update_price' WHERE id = '$updated_p_id'") or die("Query failed: " . mysqli_connect_error());
        $message[] = 'Product updated successfully';
    }

    $update_image = $_FILES['update_image']['name'];
    $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
    $update_image_size = $_FILES['update_image']['size'];
    $update_image_folder = '../uploaded_img/' . $update_image;
    $update_old_image = $_POST['update_old_image'];

    if (!empty($update_image)) {
        if ($update_image_size > 2000000) {
            $message[] = 'Image size is too big';
        } else {
            move_uploaded_file($update_image_tmp_name, $update_image_folder);
            mysqli_query($conn, "UPDATE products SET image = '$update_image' WHERE id = '$updated_p_id'") or die("Query failed: " . mysqli_connect_error());
            unlink('../uploaded_img/' . $update_old_image);
            $message[] = 'Product updated successfully';
        }
    }

    header('Location: products.php');
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

    <!-- Product CRUD Section Start -->
    <section class="add-products">
        <h1 class="title">shop products</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <h3>Add New Product</h3>
            <input type="text" name="name" id="name" class="box" placeholder="Enter Product Name" required>
            <input type="number" name="price" min="0" id="price" class="box" placeholder="Enter Product Price" required>
            <input type="file" name="image" id="image" class="box" accept="image/jpg, image/jpeg, image/png" required>
            <input type="submit" value="Add Product" name="add_product" class="btn" placeholder="Enter Product Name" required>
        </form>
    </section>

    <!-- Show Products -->
    <section class="show-products">
        <div class="box-container">
            <?php
            $select_products = mysqli_query($conn, "SELECT * FROM products") or die("Query failed: " . mysqli_connect_error());

            if (mysqli_num_rows($select_products) > 0) {
                while ($row = mysqli_fetch_assoc($select_products)) {
            ?>
                    <div class="box">
                        <img src="../uploaded_img/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
                        <div class="name"><?php echo $row['name']; ?></div>
                        <div class="price"> <?php echo $row['price']; ?>DT</div>
                        <a href="products.php?update=<?php echo $row['id']; ?>" class="option-btn">Edit</a>
                        <a href="products.php?delete=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Are You Sure To Delete This Product?!');">Delete</a>
                    </div>

            <?php
                }
            } else {
                echo '<h3 class="empty">No Products Added Yet!</h3>';
            }
            ?>
        </div>
    </section>

    <!-- Edit Product -->
    <section class="edit-product">
        <?php
        if (isset($_GET['update'])) {
            $id = $_GET['update'];
            $select_product = mysqli_query($conn, "SELECT * FROM products WHERE id = '$id'") or die("Query failed: " . mysqli_connect_error());
            if (mysqli_num_rows($select_products) > 0) {
                while ($row = mysqli_fetch_assoc($select_product)) {

        ?>

                    <h3>Edit Product</h3>
                    <form action="" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="update_p_id" value="<?php echo $row['id']; ?>">
                        <input type="hidden" name="update_old_image" value="<?php echo $row['image']; ?>">

                        <img src="../uploaded_img/<?php echo $row['image']; ?>" alt="<?php echo $row['image']; ?>">

                        <input type="text" name="update_name" id="update_name" class="box" placeholder="Update Product Name" value="<?php echo $row['name']; ?>">

                        <input type="number" name="update_price" min="0" id="update_price" class="box" placeholder="Update Product Price" value="<?php echo $row['price']; ?>">

                        <input type="file" name="update_image" id="update_image" class="box" accept="image/jpg, image/jpeg, image/png">

                        <input type="submit" value="Update" name="update_product" class="btn">
                        <input type="reset" value="Cancel" id="cancel-edit" class="option-btn">
                    </form>

        <?php
                }
            }
        } else {
            echo "<script>document.querySelector('.edit-product').style.display = 'none';</script>";
        }
        ?>
    </section>


    <!-- Custom admin js file -->
    <script src="../js/admin_script.js"></script>
</body>

</html>