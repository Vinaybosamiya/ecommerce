<?php require 'slider2.php';  ?>
<!DOCTYPE html>
<html>
<head>
  <title>Upload Product Slider Images</title>
  <style>
    body {
      font-family: 'Segoe UI', Arial, sans-serif;
      background: #f4f7fa;
      margin: 0;
      padding: 0;
      min-height: 100vh;
    }
    .upload-container {
      background: #fff;
      border-radius: 16px;
      box-shadow: 0 2px 16px rgba(50,28,154,0.08), 0 1.5px 5px rgba(35,94,226,0.05);
      max-width: 420px;
      margin: 50px auto;
      padding: 36px 36px 28px 36px;
    }
    h2 {
      text-align: center;
      color: #261d77;
      font-size: 1.38rem;
      font-weight: 700;
      margin-bottom: 26px;
      letter-spacing: 0.02em;
    }
    form label {
      display: inline-block;
      margin-bottom: 9px;
      font-weight: 600;
      color: #7b3eff;
      font-size: 1.08rem;
    }
    input[type="file"] {
      padding: 10px 13px;
      border-radius: 8px;
      background: #f6f7fb;
      border: 1.5px solid #e2e7ef;
      font-size: 1rem;
      color: #2a3756;
      width: 100%;
      transition: border 0.18s;
      margin-bottom: 18px;
    }
    input[type="file"]:hover, input[type="file"]:focus {
      border-color: #7b3eff;
      outline: none;
    }
    button[type="submit"] {
      width: 100%;
      background: linear-gradient(90deg, #26a7ff 0%, #7b3eff 100%);
      color: #fff;
      border: none;
      padding: 13px 0;
      border-radius: 8px;
      font-size: 1.07rem;
      font-weight: 700;
      letter-spacing: 0.01em;
      cursor: pointer;
      margin-top: 10px;
      box-shadow: 0 3px 12px rgba(123,62,255,0.13);
      transition: background 0.18s, box-shadow 0.18s;
    }
    button[type="submit"]:hover,
    button[type="submit"]:focus {
      background: linear-gradient(90deg, #5327c6 0%, #2600fa 100%);
      box-shadow: 0 5px 22px rgba(123,62,255,0.22);
    }
  </style>
</head>

<body>
  <div class="upload-container">
    <h2>Upload 3 Slider Images for Product ID: <?= $product_id ?></h2>
    <form method="POST" enctype="multipart/form-data">
      <input type="hidden" name="product_id" value="<?= $product_id ?>">

      <label>Image 1:</label>
      <input type="file" name="slider_images[]" required>

      <label>Image 2:</label>
      <input type="file" name="slider_images[]" required>

      <label>Image 3:</label>
      <input type="file" name="slider_images[]" required>

      <button type="submit">Upload Images</button>
    </form>
  </div>
</body>
</html>


<!-- not work code better -->
<?php
// require '_dbconnect.php';
// require 'function.php';
// session_start();


// // Get product ID from URL
// if (isset($_GET['id'])) {
//     $product_id = $_GET['id'];
// } else {
//     echo "No product ID provided.";
//     exit;
// }
//  $SQL = "SELECT product.id, categories FROM categoris,product WHERE product.id = '$product_id'";
//     $res = mysqli_query($conn, $SQL);

// // Upload Handling
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     if (!isset($_POST['product_id']) || !isset($_FILES['slider_images'])) {
//         die("Missing data");
//     }

//     $product_id = $_POST['product_id'];

//     while ($row = mysqli_fetch_assoc($res)) {

//       // Folder: product_slider/1/
//       $upload_dir = "media/ALL_PRODUCTS/".$row['categories'] . "/" . $product_id . "/";
//       if (!is_dir($upload_dir)) {
//         mkdir($upload_dir, 0777, true);
//       }
//     }

//     foreach ($_FILES['slider_images']['tmp_name'] as $key => $tmp_name) {
//         $file_name = $_FILES['slider_images']['name'][$key];
//         $file_tmp = $_FILES['slider_images']['tmp_name'][$key];

//         if (!empty($file_name)) {
//             $file_name = time() . '_' . basename($file_name); // Make file name unique
//             $target_path = $upload_dir . $file_name;

//             if (move_uploaded_file($file_tmp, $target_path)) {
//                 // Save to database
//                 $sql = "INSERT INTO product_slider (product_id, product_img) VALUES ('$product_id', '$file_name')";
//                 mysqli_query($conn, $sql);
//             }
//         }
//     }

//     echo "<p style='color:green;'>✅ Images uploaded and saved to database.</p>";
// }
// 
?>







<!-- 

<style>
  .carousel-control-prev-icon,
  .carousel-control-next-icon {
    background-color: transparent; /* Remove default white icon */
    background-image: none;
    width: 30px;
    height: 30px;
    border: solid 3px black;
    border-width: 0 3px 3px 0;
    display: inline-block;
    padding: 6px;
  }

  .carousel-control-prev-icon {
    transform: rotate(135deg);
  }

  .carousel-control-next-icon {
    transform: rotate(-45deg);
  }
</style> -->

<!-- <div id="carouselExampleIndicators" class="carousel slide mx-auto" data-ride="carousel" style="max-width: 90%;"> -->

<!-- Indicators -->
<!-- <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol> -->

<!-- Slides -->
<!-- <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="image/image1.jpg" class="d-block w-100" style="height: 600px;" alt="User Image">
    </div>
    <div class="carousel-item">
      <img src="image/image2.jpg" class="d-block w-100" style="height: 600px;" alt="User Image">
    </div>
    <div class="carousel-item">
      <img src="image/image3.jpg" class="d-block w-100" style="height: 600px;" alt="User Image">
    </div>
  </div> -->

<!-- Navigation with black arrow icons -->
<!-- <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev" style="background-color: rgba(0,0,0,0.1); padding: 20px;">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next" style="background-color: rgba(0,0,0,0.1); padding: 20px;">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div> -->