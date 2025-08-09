<?php

include '../_dbconnect.php';
include '../function.php';
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
if (isset($_GET['id']) && $_GET['id'] != '') {
  $id = get_safe_val($conn, $_GET['id']);
  $edit_sql = "SELECT * FROM categoris WHERE id='$id'";
  $res = mysqli_query($conn, $edit_sql);
  $check = mysqli_num_rows($res);
  if ($check > 0) {
    $row = mysqli_fetch_assoc($res);
    $cat = $row['categories'];
  } else {
    header("location: categories.php");
    die();
  }
}

if (isset($_POST['submit'])) {
  $addcat = get_safe_val($conn, $_POST['addcategories']);

  $edit_sql = "SELECT * FROM categoris WHERE categories='$addcat'";
  $res = mysqli_query($conn, $edit_sql);
  $check = mysqli_num_rows($res);
  if ($check > 0) {
    if (isset($_GET['id']) && $_GET['id'] != ''){
      $getData = mysqli_fetch_assoc($res);
      if($id == $getData['id']){
        header("location: categories.php"); 
      }
      else{
        $showError = "<b>Categories Already Exists.</b>";  
      }
    }
    else{
      $showError = "<b>Categories Already Exists.</b>";
    }
  } 
  if($showError == ''){
  if (isset($_GET['id']) && $_GET['id'] != '') {
    $sql = "UPDATE categoris set categories = '$addcat' where id='$id' ";
    $res = mysqli_query($conn, $sql);
  } else {
    $sql = "INSERT INTO categoris(categories,status) values('$addcat','1') ";
    $res = mysqli_query($conn, $sql);
  }
  header("location: categories.php");
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
      max-width: 450px;
      margin: 100px auto;
      background-color: #2d2d44;
      border-radius: 16px;
      padding: 30px;
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

  <h1 style="color: #ffffff; text-align: center; padding-top:90px ;padding-bottom:0px">Add & Manage Categoris Panel</h1>

  <div class="login-card">
    <div style="align-items: center;" class="text-center mb-4">
      <!-- Replace src with your logo image if needed -->
      <img src="https://cdn-icons-png.flaticon.com/512/5977/5977575.png" class="logo" alt="Logo">
      <h2><span style="color: #0dcaf0;">ScreenKing </span><span style="color: #ffffff;">- Multimedia</span></h2>
    </div>

    <form method="post">
      <div class="mb-3">
        <label for="addcategories" class="form-label">Add & Manage Categories</label>
        <input type="text" class="form-control" name="addcategories" value="<?php echo $cat ?>" required>
      </div>

      <button type="submit" name="submit" class="btn btn-primary w-100">Submit</button>
      
      
      <!-- <span class="text-danger"><?php echo $msg;?></span> -->

    </form>
   



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>