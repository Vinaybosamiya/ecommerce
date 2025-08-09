<?php
require '_dbconnect.php';
require 'function.php';

session_start();
if (!isset($_SESSION['logedin']) || $_SESSION['logedin'] != true) {
  header('location: ../USER_ADMIN_PANLE/login/index.php');
}
// Get product ID from URL
if (isset($_GET['id'])) {
  $product_id = get_safe_val($conn, $_GET['id']);
  // $product_id = $_GET['id'];
} else {
  echo "No product ID provided.";
  exit;
}


// ✅ Fix: Proper join to get category
$SQL = "SELECT p.id, c.categories 
        FROM product p 
        JOIN categoris c ON p.categories_id = c.id 
        WHERE p.id = '$product_id' LIMIT 1";
$res = mysqli_query($conn, $SQL);



// Upload Handling
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (!isset($_POST['product_id']) || !isset($_FILES['slider_images'])) {
    die("Missing data");
  }

  $product_id = $_POST['product_id'];

  // Get category name from result
  $upload_dir = '';
  while ($row = mysqli_fetch_assoc($res)) {
    $category = $row['categories'];
    $upload_dir = "media/ALL_PRODUCTS/" . $category . "/" . $product_id . "/";
    if (!is_dir($upload_dir)) {
      mkdir($upload_dir, 0777, true);
    }
  }

  // Upload images
  foreach ($_FILES['slider_images']['tmp_name'] as $key => $tmp_name) {
    $file_name = $_FILES['slider_images']['name'][$key];
    $file_tmp = $_FILES['slider_images']['tmp_name'][$key];

    if (!empty($file_name)) {
      $file_name = date('d-m-Y_H-i-s') . '_' . basename($file_name);
      $target_path = $upload_dir . $file_name;

      if (move_uploaded_file($file_tmp, $target_path)) {
        // Insert into DB
        $sql = "INSERT INTO product_slider (product_id, product_img) VALUES ('$product_id', '$file_name')";
        mysqli_query($conn, $sql);
      }
    }
  }

  echo "<p style='color:green;'>✅ Images uploaded and saved to database.</p>";
}
// check id is available or not at database
if (isset($_GET['id']) && $_GET['id'] != '') {
  // $id = get_safe_val($conn, $_GET['id']);

  // $slider_sql = "select product.id, product_slider.* from product_slider,product where product.id='$id'";

   // ✅ First: Check if product exists
  $slider_sql =  "SELECT * FROM product WHERE id = '$product_id'";
  $slider_res = mysqli_query($conn, $slider_sql);
  $check = mysqli_num_rows($slider_res);
  
  if ($check == 0) {
     // ❌ Product ID not found in database — redirect!
    header("location: ../USER_ADMIN_PANLE/products/product.php");
    exit;
  }
   // ✅ Then: Fetch slider images
    $slider_sql = "SELECT * FROM product_slider WHERE product_id = '$product_id'";
    $slider_res = mysqli_query($conn, $slider_sql);
    $total_images = mysqli_num_rows($slider_res);
} else {
  header("location: ../USER_ADMIN_PANLE/products/product.php");
  die();
}

?>