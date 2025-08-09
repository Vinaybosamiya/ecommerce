<?php
require "../_dbconnect.php";
require "../function.php";





// Handle actions (status update or delete)
if (isset($_GET['type']) && $_GET['type'] != '') {
    $type = get_safe_val($conn, $_GET['type']);

    // Change product status (not related to images)
    if ($type == 'status') {
        $opration = get_safe_val($conn, $_GET['opration']);
        $id = get_safe_val($conn, $_GET['id']);
        $status = $opration == 'active' ? '1' : '0';
        mysqli_query($conn, "UPDATE product SET status='$status' WHERE id='$id'");
    }

    // Delete image from letest_product_img
    if ($type == 'delete') {
        $id = intval($_GET['id']); 
        $image = $_GET['image']; 

        // Delete file from server
        $file_path = "images/" . $image;
        if (file_exists($file_path)) {
            unlink($file_path);
        }

        // Delete from database
        mysqli_query($conn, "DELETE FROM letest_product_img WHERE id='$id'");

        // Check if table is empty and truncate if needed
        $check_sql = "SELECT COUNT(*) AS total FROM letest_product_img";
        $check_res = mysqli_query($conn, $check_sql);
        $count_row = mysqli_fetch_assoc($check_res);

        if ($count_row['total'] == 0) {
            mysqli_query($conn, "TRUNCATE TABLE letest_product_img");
        }

        // Redirect back to prevent duplicate actions on refresh
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}

// Fetch images
$sql = "SELECT * FROM letest_product_img";
$result = mysqli_query($conn, $sql);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Image List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f6fa;
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            display: flex;
        }
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
        .sidebar ul { list-style: none; padding-left: 0; }
        .sidebar li { margin-bottom: 12px; }
        .sidebar a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            display: block;
            padding: 8px 12px;
            border-radius: 8px;
        }
        .sidebar a:hover,
        .sidebar .active { background-color: #4a00e0; }
        .main-content {
            margin-left: 260px;
            padding: 40px;
            width: 100%;
        }
        .table-container {
            background-color: #ffffff;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.06);
        }
        .slider-img {
            width: 100px;
            height: auto;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h2>
        <span style="color: #0dcaf0;">ScreenKing</span><br>
        <span style="color: #ffffff;">MultiMedia</span>
    </h2>
    <ul>
        <li><a href="../login/welcome.php" class="active">🏠 Home</a></li>
        <li><a href="../Categories/categories.php">📂 Categories Master</a></li>
        <!-- <li><a href="#">📊 Dashboard</a></li>
        <li><a href="#">⚙️ Settings</a></li> -->
        <li><a href="../contectus/contectUs.php">Contact Us</a></li>
        <li><a href="../login/logout.php" class="text-danger">🚪 Logout</a></li>
    </ul>
</div>

<div class="main-content">
    <div class="table-container">
        <h2>
            <a class="btn btn-primary" href="manage_product.php">📂 Add Product In List</a>
        </h2>
        <h2>📂 Image List</h2>

        <table class="table table-bordered text-center align-middle">
            <thead>
                <tr>
                    <th>SNO</th>
                    <th>ID</th>
                    <th>Image Name</th>
                    <th>Preview</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $sno = 1;
                while ($row = mysqli_fetch_assoc($result)) :
                    $imagePath = 'images/' . $row['letestProduct_img'];
                ?>
                <tr>
                    <td><?= $sno++ ?></td>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['letestProduct_img']) ?></td>
                    <td><img src="<?= $imagePath ?>" alt="slider image" class="slider-img"></td>
                    <td>
                        <a class="btn btn-sm btn-danger text-white" 
                           href="?type=delete&id=<?= $row['id'] ?>&image=<?= urlencode($row['letestProduct_img']) ?>"
                           onclick="return confirm('Are you sure you want to delete this image?');">
                           Delete
                        </a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
