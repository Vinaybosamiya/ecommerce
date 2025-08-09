<?php
session_start();
if (!isset($_SESSION['logedin']) || $_SESSION['logedin'] != true) {
  header('location: index.php');
  exit;
}
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Welcome <?= htmlspecialchars($username) ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
    }
    .sidebar {
      height: 100vh;
      background: #1e1e2f;
      color: white;
    }
    .sidebar h2 {
      line-height: 1.2;
    }
    .sidebar .nav-link.active {
      background-color: #680aff;
      border-radius: 8px;
    }
    /* Hover effect for ALL sidebar links */
    .sidebar .nav-link:hover,
    .sidebar .nav-link:focus {
      background-color: #680aff;
      color: #fff;
      border-radius: 8px;
    }
    .content {
      background: #f5f6fa;
      padding: 2rem;
    }
    .card-custom {
      border: none;
      border-radius: 1rem;
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
    }
  </style>
</head>

<body>
  <div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar p-3" style="width: 250px;">
      <!-- Logo / Branding -->
      <div class="mb-4">
        <h2 style="font-size: 1.8rem; font-weight: 700;">
          <div class="mb-4 text-center">
            <h2 style="font-size: 1.8rem; font-weight: 700; line-height: 1.2;">
              <span style="color: #0dcaf0;">ScreenKing</span><br>
              <span style="color: #ffffff;">MultiMedia</span>
            </h2>
          </div>
        </h2>
      </div>
      <hr>
      <ul class="nav flex-column">
        
        <li class="nav-item"><a class="nav-link text-white active" href="../login/welcome.php">🏠 Home</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="../Categories/categories.php">Categories Master</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="../products/product.php">Product Master</a></li>
        <!-- <li class="nav-item"><a class="nav-link text-white" href="">Order Master</a></li> -->
        <li class="nav-item"><a class="nav-link text-white" href="../login/users.php">User Master</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="../contectus/contectUs.php">Contect Us</a></li>
        <!-- <li class="nav-item"><a class="nav-link text-white" href="#">👥 Affiliates</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="#">🛡️ ID Monitoring</a></li> -->
        <!-- <li class="nav-item"><a class="nav-link text-white" target="_blank" href="http://localhost/phpmyadmin/index.php?route=/database/structure&db=ecommerce">💾 Database</a></li> -->
        <li class="nav-item"><a class="nav-link text-white" target="_blank" href="http://localhost/ecommerce/admin/USER_ADMIN_PANLE/Categories/categories.php">💾 Category</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="../Letest_Product_Img/slider.php">Upload Slider Images</a></li>
        <!-- <li class="nav-item"><a class="nav-link text-white" href="#">⚙️ Apps</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="#">🚨 Alerts</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="#">🔌 Integration</a></li> -->
        <li class="nav-item mt-3"><a class="nav-link text-danger" href="../login/logout.php">🚪 Log Out</a></li>
      </ul>
    </div>

    <!-- Main content -->
    <div class="content flex-fill">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>Welcome, <?= htmlspecialchars($username) ?></h4>
        <div>
          <button class="btn btn-outline-primary">Last Week</button>
          <button class="btn btn-outline-secondary">Last Month</button>
        </div>
      </div>
       