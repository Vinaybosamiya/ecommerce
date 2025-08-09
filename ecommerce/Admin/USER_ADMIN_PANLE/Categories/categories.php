  <?php
  include "../_dbconnect.php";
  include "../function.php";
  // $showAlert = false;
  // $showAlert="<b>Categories Is Created Succefully.</b>";
  session_start();
 
if (!isset($_SESSION['logedin']) || $_SESSION['logedin'] != true) {
    header('location: ../login/index.php');
    exit;
  }
  else{
  if (isset($_GET['type']) && $_GET['type'] != '') {
    $type = get_safe_val($conn, $_GET['type']);

    if ($type == 'status') {
      $opration = get_safe_val($conn, $_GET['opration']);
      $id = get_safe_val($conn, $_GET['id']);
      $status = $opration == 'active' ? '1' : '0';
      // $status = ($opration == 'active') ? '1' : '0';
      $sql_update = "update categoris set status='$status' where id='$id'";
      mysqli_query($conn, $sql_update);
    }

    if ($type == 'delete') {
      $id = get_safe_val($conn, $_GET['id']);
      $sql_delete = "DELETE FROM categoris where id='$id'";
      mysqli_query($conn, $sql_delete);

      $check_sql = "SELECT COUNT(*) AS Total from categoris";
      $res = mysqli_query($conn, $check_sql);
      $row = mysqli_fetch_assoc($res);

      if ($row['Total'] == 0) {
        $sql_all_delete = "TRUNCATE TABLE categoris";
        $res = mysqli_query($conn, $sql_all_delete);
      }
    }
  }

  $sql = "SELECT * FROM `categoris` order by categories asc";
  $result = mysqli_query($conn, $sql);
}
  ?>

  <!doctype html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <title>Category List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      .add-category-btn {
        background-color: #0a58ca;
        color: white;
        padding: 5px 20px;
        text-decoration: none;
        display: inline-block;
        border-radius: 6px;
        transition: all 0.2s ease-in-out;
      }

      .add-category-btn:hover {
        transform: scale(1.05);
      }

      body {
        background-color: #f5f6fa;
        font-family: 'Segoe UI', sans-serif;
        margin: 0;
        display: flex;
      }

      /* Sidebar */
      .sidebar {
        width: 240px;
        height: 100vh;
        background-color: #1e1e2f;
        color: white;
        padding: 20px;
        position: fixed;
        left: 0;
        top: 0;
      }

      .sidebar h2 {
        font-size: 24px;
        color: #0dcaf0;
        margin-bottom: 20px;
      }

      .sidebar ul {
        list-style: none;
        padding-left: 0;
      }

      .sidebar li {
        margin-bottom: 12px;
      }

      .sidebar a {
        color: white;
        text-decoration: none;
        font-weight: 500;
        display: block;
        padding: 8px 12px;
        border-radius: 8px;
      }

      .sidebar a:hover,
      .sidebar .active {
        background-color: #4a00e0;
      }

      /* Main Content */
      .main-content {
        margin-left: 260px;
        padding: 40px;
        width: 100%;
      }

      .main-content h2 {
        font-weight: 600;
        color: #1e1e2f;
        margin-bottom: 30px;
      }

      .table-container {
        background-color: #ffffff;
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.06);
      }

      .table {
        background-color: #fff;
        border-radius: 12px;
        overflow: hidden;
      }

      .table th {
        background-color: #f1f3f6;
        color: #333;
        font-weight: 600;
      }

      .table td {
        color: #555;
        vertical-align: middle;
      }

      .status-active {
        color: #198754;
        font-weight: 600;
      }

      .status-inactive {
        color: #dc3545;
        font-weight: 600;
      }

      .table a {
        margin: 0 6px;
        font-size: 14px;
        text-decoration: none;
      }

      .table a:hover {
        text-decoration: underline;
      }

      @media (max-width: 768px) {
        .main-content {
          margin-left: 0;
          padding: 20px;
        }

        .sidebar {
          display: none;
        }
      }
    </style>
  </head>

  <body>
    <!-- <?php if ($showAlert): ?>
    <div class="alert alert-success text-center"><?= $showAlert ?></div>
  <?php endif; ?> -->

    <div class="sidebar">
      <h2 style="font-size: 1.8rem; font-weight: 700; line-height: 1.2;">
        <span style="color: #0dcaf0;">ScreenKing</span><br>
        <span style="color: #ffffff;">MultiMedia</span>
      </h2>
      <ul>
        <li><a href="../login/welcome.php" class="active">🏠 Home</a></li>

        <li><a href="../products/manage_product.php">Manage Product Master</a></li>
        <li><a href="../products/product.php">Product Master</a></li>
        <!-- <li><a href="#">📊 Dashboard</a></li>
        <li><a href="#">⚙️ Settings</a></li> -->
        <li><a href="../contectus/contectUs.php">Contect Us</a></li>
        <li><a href="../login/logout.php" class="text-danger">🚪 Logout</a></li>
      </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
      <div class="table-container">
        <h2>
          <a class="add-category-btn" href="manage_categories.php">📂 Add Category In List</a>
        </h2>
        <h2>📂 Category List</h2>


        <table class="table table-bordered text-center align-middle">
          <thead>
            <tr>
              <th style="width: 6%;">SNO</th>
              <th style="width: 7%;">ID</th>
              <th style="width: 50%;">Category Name</th>
              <!-- <th style="width: 65%;">Category Name</th> -->

              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php $sno = 1;
            while ($row = mysqli_fetch_assoc($result)) { ?>
              <tr>
                <td><?= $sno++ ?></td>
                <td><?= $row['id'] ?></td>
                <td><?= htmlspecialchars($row['categories']) ?></td>
                <td>
                  <?php
                  echo "&nbsp;<a class='btn btn-sm text-white' style='background-color: #0a58ca; padding:5px 20px' href='manage_categories.php?type=edit&id=" . $row['id'] . "'>Edit</a>&nbsp; &nbsp;";
                  if ($row['status'] == 1) {
                    echo "<a class='btn btn-sm btn-success text-white' style='padding:5px 20px' href='?type=status&opration=deactive&id=" . $row['id'] . "'>Active</a>";
                  } else {
                    echo "<a class='btn btn-sm btn-secondary text-white' style='#0a58ca; padding:5px 20px' href='?type=status&opration=active&id=" . $row['id'] . "'>Deactive</a>";
                  }

                  echo "&nbsp; &nbsp;<a class='btn btn-sm btn-danger text-white' style='#0a58ca; padding:5px 20px' href='?type=delete&id=" . $row['id'] . "'>Delete</a>";

                  ?>

                </td>
              </tr>
            <?php }; ?>
          </tbody>
        </table>
      </div>
    </div>

  </body>

  </html>