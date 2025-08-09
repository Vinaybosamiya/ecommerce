<?php

require('../_dbconnect.php');
require('../function.php');
session_start();
if (!isset($_SESSION['logedin']) || $_SESSION['logedin'] != true) {
    header('location: ../login/index.php');
    exit;
  }
  
$cat = '';
$categories_id = '';
$name = '';
$mrp = '';
$price = '';
$qty = '';
$image = '';
$short_desc = '';
$description = '';
$meta_title = '';
$meta_desc = '';
$meta_keyword = '';
$status = '';

// $showAlert = false;
$showError = false;
$image_required = 'required';

if (isset($_GET['id']) && $_GET['id'] != '') {
  $image_required = '';
  $id = get_safe_val($conn, $_GET['id']);
  $edit_sql = "SELECT * FROM product WHERE id='$id'";
  $res = mysqli_query($conn, $edit_sql);
  $check = mysqli_num_rows($res);
  if ($check > 0) {
    $row = mysqli_fetch_assoc($res);
    $categories_id = $row['categories_id'];
    $name = $row['name'];
    $mrp = $row['mrp'];
    $price = $row['price'];
    $qty = $row['qty'];
    $image = $row['image'];
    $short_desc = $row['short_desc'];
    $description = $row['description'];
    $meta_title = $row['meta_title'];
    $meta_desc = $row['meta_desc'];
    $meta_keyword = $row['meta_keyword'];
    $status = $row['status'];
  } else {
    header("location: categories.php");
    die();
  }
}

if (isset($_POST['submit'])) {
  $categories_id = get_safe_val($conn, $_POST['categories_id']);
  $name = get_safe_val($conn, $_POST['name']);
  $mrp = get_safe_val($conn, $_POST['mrp']);
  $price = get_safe_val($conn, $_POST['price']);
  $qty = get_safe_val($conn, $_POST['qty']);
  $short_desc = get_safe_val($conn, $_POST['short_desc']);
  $description = get_safe_val($conn, $_POST['description']);
  $meta_title = get_safe_val($conn, $_POST['meta_title']);
  $meta_desc = get_safe_val($conn, $_POST['meta_desc']);
  $meta_keyword = get_safe_val($conn, $_POST['meta_keyword']);
  $status = get_safe_val($conn, $_POST['status']);

  // if ($_FILES['image']['name'] != '') {
  //   $image = date('d-m-Y_H-i-s') . '_' . $_FILES['image']['name'];
  //   move_uploaded_file($_FILES['image']['tmp_name'], PRODUCT_IMAGE_SERVER_PATH . $image);
  // } else {
  //   // If editing and no new image selected, keep old image
  //   if (isset($_GET['id']) && $_GET['id'] != '') {
  //     $image = $row['image'];
  //   }
  // }

  $edit_sql = "SELECT * FROM product WHERE name='$name'";
  $res = mysqli_query($conn, $edit_sql);
  $check = mysqli_num_rows($res);
  if ($check > 0) {
    if (isset($_GET['id']) && $_GET['id'] != '') {
      $getData = mysqli_fetch_assoc($res);
      if ($id == $getData['id']) {
        // header("location: product.php");
      } else {
        $showError = "<b>Product Already Exists.</b>";
      }
    } else {
      $showError = "<b>Product Already Exists.</b>";
    }
  }
  date_default_timezone_set('Asia/Kolkata'); // ✅ Add this line
 

  if( $_FILES['image']['type']!='image/png' && $_FILES['image']['type']!= 'image/jpeg' && $_FILES['image']['type']!= 'image/xml' && $_FILES['image']['type']!= 'image/gif' && $_FILES['image']['type']!= ''){
    $showError = "❌ Invalid file type. Only images (PNG, JPG, JPEG, SVG, GIF) are allowed.";

  }

  if ($showError == '') {
    if (isset($_GET['id']) && $_GET['id'] != '') {
      if ($_FILES['image']['name'] != '') {
        $image = date('d-m-Y_H-i-s') . '_' . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], PRODUCT_IMAGE_SERVER_PATH . $image);
        
        $sql = "UPDATE product set categories_id='$categories_id', name='$name', mrp='$mrp', price='$price', qty='$qty', image='$image', short_desc='$short_desc', description='$description', meta_title='$meta_title', meta_desc='$meta_desc', meta_keyword='$meta_keyword' where id='$id' ";
      }
      else{
         $sql = "UPDATE product set categories_id='$categories_id', name='$name', mrp='$mrp', price='$price', qty='$qty', short_desc='$short_desc', description='$description', meta_title='$meta_title', meta_desc='$meta_desc', meta_keyword='$meta_keyword' where id='$id' ";
      }
      $res = mysqli_query($conn, $sql);
    } else {
      $image = date('d-m-Y_H-i-s') . '_' . $_FILES['image']['name'];
      move_uploaded_file($_FILES['image']['tmp_name'], PRODUCT_IMAGE_SERVER_PATH . $image);
      $sql = "INSERT INTO product(categories_id, name, mrp, price, qty, image, short_desc, description, meta_title, meta_desc, meta_keyword, status)
        VALUES ('$categories_id', '$name', '$mrp', '$price', '$qty', '$image', '$short_desc', '$description', '$meta_title', '$meta_desc', '$meta_keyword', '1')";
      $res = mysqli_query($conn, $sql);
    }
    header("location: product.php");
    //  $showAlert="<b>Categories Is Created Succefully.</b>";
    die();
  }
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login | ScreenKing</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #1e1e2f;
      font-family: 'Segoe UI', sans-serif;
      color: white;
    }

    .login-card {
      position: relative;
      max-width: 80%;
      margin: 100px auto;
      background-color: #2d2d44;
      border-radius: 16px;
      padding: 35px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
      left: 5px;
    }

    .form-control {
      background-color: #383857;
      border: 1px solid #4a4a6a;
      color: white;
    }

    .form-control:focus {
      background-color: #383857;
      color: white;
      box-shadow: none;
      border-color: #0dcaf0;
    }

    .btn-primary {
      background-color: #6f42c1;
      border-color: #6f42c1;
    }

    .btn-primary:hover {
      background-color: #5a36a6;
      border-color: #5a36a6;
    }

    .logo {
      width: 60px;
      height: 60px;
      margin-bottom: 10px;
    }

    .input-group-text {
      background-color: #383857;
      border: 1px solid #4a4a6a;
      color: #ccc;
      cursor: pointer;
    }

    .input-group-text:hover {
      color: #0dcaf0;
    }
  </style>
</head>

<body>
  <!-- <?php if ($showAlert): ?>
    <div class="alert alert-success text-center"><?= $showAlert ?></div>
  <?php endif; ?> -->

  <?php if ($showError): ?>
    <div class="alert alert-danger text-center"><?= $showError ?></div>
  <?php endif; ?>

  <h1 style="color: #ffffff; text-align: center; padding-top:90px ;padding-bottom:0px">Add & Manage product Panel</h1>

  <div class="login-card">
    <div style="align-items: center;" class="text-center mb-4">
      <!-- Replace src with your logo image if needed -->
      <img src="https://cdn-icons-png.flaticon.com/512/5977/5977575.png" class="logo" alt="Logo">
      <h2><span style="color: #0dcaf0;">ScreenKing </span><span style="color: #ffffff;">- Multimedia</span></h2>
    </div>

    <form method="post" enctype="multipart/form-data">
      <div class="row">
        <!-- Left Column -->
        <div class="col-md-6">
          <div class="mb-3">
            <label class="form-label">Select Category</label>
            <select class="form-control" name="categories_id" required>
              <option value="">Select Category</option>
              <?php
              $res = mysqli_query($conn, "SELECT id, categories FROM categoris ORDER BY categories ASC");
              while ($r = mysqli_fetch_assoc($res)) {
                if ($categories_id == $r['id']) {
                  echo "<option selected value='" . $r['id'] . "'>" . $r['categories'] . "</option>";
                } else {
                  echo "<option value='" . $r['id'] . "'>" . $r['categories'] . "</option>";
                }
              }
              ?>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label">Product Name</label>
            <input type="text" placeholder="Enter Product Name" class="form-control" name="name" value="<?= $name ?>" required>
          </div>

          <div class="mb-3">
            <label class="form-label">MRP</label>
            <input type="text" placeholder="Enter MRP" class="form-control" name="mrp" value="<?= $mrp ?>" required>
          </div>

            <div class="mb-3">
            <label class="form-label">Selling Price</label>
            <input type="text" placeholder="Enter Selling Price" class="form-control" name="price" value="<?= $price ?>" >
          </div>

          <div class="mb-3">
            <label class="form-label">Quantity</label>
            <input type="text" placeholder="Enter Quantity" class="form-control" name="qty" value="<?= $qty ?>" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Status</label>
            <input type="text" placeholder="Enter Status" class="form-control" name="status" value="<?= $status ?>" >
          </div>
        </div> 

          <!-- Right Column -->
          <div class="col-md-6">
            <div class="mb-3">
              <label class="form-label">Product Image</label>
              <input type="file" class="form-control" name="image" <?php echo $image_required ?>>
            </div>
    
          <div class="mb-3">
            <label class="form-label">Short Description</label>
            <textarea placeholder="Enter Short Description" class="form-control" name="short_desc" required><?= $short_desc ?></textarea>
          </div>

          <div class="mb-3">
            <label class="form-label">Full Description</label>
            <input type="text" placeholder="Enter Full Description" class="form-control" name="description" value="<?= $description ?>" >
          </div>

          <div class="mb-3">
            <label class="form-label">Meta Title</label>
            <input type="text" placeholder="Enter Meta Title" class="form-control" name="meta_title" value="<?= $meta_title ?>">
          </div>

          <div class="mb-3">
            <label class="form-label">Meta Description</label>
            <input type="text" placeholder="Enter Meta Description" class="form-control" name="meta_desc" value="<?= $meta_desc ?>">
          </div>

          <div class="mb-3">
            <label class="form-label">Meta Keywords</label>
            <input type="text" placeholder="Enter Meta Keywords" class="form-control" name="meta_keyword" value="<?= $meta_keyword ?>">
          </div>
        </div>
      </div>  

            <button type="submit" name="submit" class="btn btn-primary w-100 mt-3">Submit</button>
    </form>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>