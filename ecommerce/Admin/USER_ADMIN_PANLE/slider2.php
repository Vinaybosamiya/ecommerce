<?php
require '_dbconnect.php';
require 'function.php';

session_start();
if (!isset($_SESSION['logedin']) || $_SESSION['logedin'] != true) {
    header('location: ../USER_ADMIN_PANLE/login/index.php');
    exit;
}

// Step 1: Get product ID
if (!isset($_GET['id']) || $_GET['id'] == '') {
     header("location: ../USER_ADMIN_PANLE/products/product.php");
    exit;
}
$product_id = get_safe_val($conn, $_GET['id']);

// Step 2: Check if product exists
$check_sql = "SELECT * FROM product WHERE id = '$product_id'";
$check_res = mysqli_query($conn, $check_sql);
if (mysqli_num_rows($check_res) == 0) {
    header("location: ../USER_ADMIN_PANLE/products/product.php");
    exit;
}

// Step 3: Get category
$cat_sql = "SELECT c.categories 
            FROM product p 
            JOIN categoris c ON p.categories_id = c.id 
            WHERE p.id = '$product_id' LIMIT 1";
$cat_res = mysqli_query($conn, $cat_sql);
$cat_row = mysqli_fetch_assoc($cat_res);
if (!$cat_row) {
    echo "❌ Category not found!";
    exit;
}
$category = $cat_row['categories'];

// Step 4: Build upload folder path
$upload_dir = "media/ALL_PRODUCTS/" . $category . "/" . $product_id . "/";
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

// Step 5: Handle image upload
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['product_id']) || !isset($_FILES['slider_images'])) {
        die("❌ Missing upload data");
    }

    foreach ($_FILES['slider_images']['tmp_name'] as $key => $tmp_name) {
        $file_name = $_FILES['slider_images']['name'][$key];
        $file_tmp = $_FILES['slider_images']['tmp_name'][$key];

        if (!empty($file_name)) {
            $file_name = date('d-m-Y_H-i-s') . '_' . basename($file_name);
            $target_path = $upload_dir . $file_name;

            if (move_uploaded_file($file_tmp, $target_path)) {
                // Save to DB
                $insert_sql = "INSERT INTO product_slider (product_id, product_img) VALUES ('$product_id', '$file_name')";
                mysqli_query($conn, $insert_sql);   
            }
        }
    }

    echo "<p style='color:green;'>✅ Images uploaded and saved to database.</p>";
}

// Step 6: Fetch slider images from database
$slider_sql = "SELECT * FROM product_slider WHERE product_id = '$product_id'";
$slider_res = mysqli_query($conn, $slider_sql);
$total_images = mysqli_num_rows($slider_res);

// Step 7: Also scan image folder directly (optional)
$images = [];
if (is_dir($upload_dir)) {
    $files = scandir($upload_dir);
    foreach ($files as $file) {
        if ($file !== '.' && $file !== '..' && preg_match('/\.(jpg|jpeg|png|gif|webp)$/i', $file)) {
            $images[] = $upload_dir . $file;
        }
    }
}
?>
