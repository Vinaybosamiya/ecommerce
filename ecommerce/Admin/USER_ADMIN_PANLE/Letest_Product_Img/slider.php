<?php require "slider_php.php";
require('../login/nav.php');
session_start();
if (!isset($_SESSION['logedin']) || $_SESSION['logedin'] != true) {
    header('location: ../login/logout.php');
    exit();
}
?>
<!-- Place this in your page where you want the form to show -->
<form class="custom-upload-form" action="slider_php.php" method="post" enctype="multipart/form-data">
    <label for="slider-images" class="custom-label">Select Letest Product slider images:</label>
    <input id="slider-images" class="custom-file-input" type="file" name="slider_images[]" multiple>
    <input class="custom-submit" type="submit" name="submit" value="Upload">
</form>

<style>
.custom-upload-form {
    background: #fff;
    border-radius: 14px;
    box-shadow: 0 2px 16px rgba(15,18,38,0.10);
    max-width: 700px;
    margin: 40px auto;
     margin-top: 250px;
    padding: 32px 42px 30px 42px;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 28px;
    font-family: 'Segoe UI', Arial, sans-serif;
}

.custom-label {
    color: #5327c6;
    font-weight: 700;
    font-size: 2.1rem;
    margin-bottom: 8px;
    letter-spacing: 0.02em;
    width: 600px;
   
}

.custom-file-input {
    padding: 11px;
    border-radius: 8px;
    background: #f6f7fb;
    border: 1.5px solid #e2e7ef;
    font-size: 1rem;
    color: #2a3756;
    width: 100%;
    transition: border 0.2s;
}
.custom-file-input:hover, .custom-file-input:focus {
    border-color: #7b3eff;
    outline: none;
}
.custom-submit {
    background: linear-gradient(90deg, #26a7ff 0%, #7b3eff 100%);
    color: #fff;
    border: none;
    padding: 13px 0;
    width: 100%;
    border-radius: 8px;
    font-size: 1.05rem;
    font-weight: 700;
    box-shadow: 0 3px 14px rgba(123,62,255,0.13);
    letter-spacing: 0.01em;
    cursor: pointer;
    margin-top: 8px;
    transition: background 0.18s, box-shadow 0.18s;
}
.custom-submit:hover, .custom-submit:focus {
    background: linear-gradient(90deg, #5327c6 0%, #2600fa 100%);
    box-shadow: 0 5px 24px rgba(123,62,255,0.27);
}
</style>
