<?php
error_reporting(0);
ini_set('display_errors', 0);

require('../_dbconnect.php');
require('../function.php');
// ... rest of your code ...


if (isset($_POST['submit'])) {
    // Ensure images folder exists
    if (!is_dir('images')) {
        mkdir('images', 0777, true);
    }

    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    $errors = [];

    // Validate product_id
    
    $product_id = intval($_POST['product_id']); // Prevent injection

    // === Handle Main Image ===
    if (!empty($_FILES['image']['name'])) {
        $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        if (in_array($ext, $allowedExtensions)) {
            // Rename file for security
            $file_name = uniqid('main_', true) . '.' . $ext;
            $folder = 'images/' . $file_name;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $folder)) {
                // Insert into database
                $stmt = $conn->prepare("INSERT INTO letest_product_img (letestProduct_img, product_id) VALUES (?, ?)");
                $stmt->bind_param("si", $file_name, $product_id);
                $stmt->execute();
            } else {
                $errors[] = "Failed to upload main image.";
            }
        } else {
            $errors[] = "Main image has an invalid file extension.";
        }
    }

    // === Handle Slider Images ===
    if (!empty($_FILES['slider_images']['name'][0])) {
        foreach ($_FILES['slider_images']['tmp_name'] as $key => $tmp_name) {
            $name = basename($_FILES['slider_images']['name'][$key]);
            $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));

            if (in_array($ext, $allowedExtensions)) {
                // Rename slider image
                $slider_file = uniqid('slider_', true) . '.' . $ext;
                if (move_uploaded_file($tmp_name, 'images/' . $slider_file)) {
                    // Insert slider image into DB
                    $stmt = $conn->prepare("INSERT INTO letest_product_img (letestProduct_img, product_id) VALUES (?, ?)");
                    $stmt->bind_param("si", $slider_file, $product_id);
                    $stmt->execute();
                } else {
                    $errors[] = "$name could not be uploaded.";
                }
            } else {
                $errors[] = "$name has an invalid file extension.";
            }
        }
    }

    // === Show result ===
    if (count($errors) > 0) {
        foreach ($errors as $error) {
            echo '<p style="color:red;">' . htmlspecialchars($error) . '</p>';
        }
    } else {
        echo '<p style="color:green;">Images uploaded successfully!</p>';
    }
}
?>
