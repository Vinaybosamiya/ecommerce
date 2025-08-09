<?php
include '../_dbconnect.php';
include '../function.php';
$showAlert = false;
$showError = false;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $username = get_safe_val($conn,$_POST['username']);
  $password =  get_safe_val($conn,$_POST['password']);
  $cpassword =  get_safe_val($conn,$_POST['cpassword']);
  $email =  get_safe_val($conn,$_POST['email']);
  $mob =  get_safe_val($conn,$_POST['number']);

    $existsSql = "SELECT * FROM admin_panal WHERE username = '$username'";
    $result = mysqli_query($conn, $existsSql);
    $existsnum = mysqli_num_rows($result);

    if ($existsnum > 0) {
        $showError = "<b>Username already exists.</b>";
    } else {
        if ($password === $cpassword) {
            $hasspsw = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `admin_panal` (`username`, `psw`, `dt`) VALUES ('$username', '$hasspsw', current_timestamp())";
            $res = mysqli_query($conn, $sql);
            $sqli = "INSERT INTO `user` (`name`,`psw`,`email`,`mobile`, `added_on`) VALUES ('$username', '$hasspsw','$email','$mob', current_timestamp())";
            $ress = mysqli_query($conn, $sqli);
            if ($res) {
                $showAlert = 'Your account was created successfully. You can now login.';
            }
        } else {
            $showError = 'Your password and confirm password do not match.';
        }
    }
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Signup | ScreenKing</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #1e1e2f;
      font-family: 'Segoe UI', sans-serif;
      color: white;
    }

    .signup-card {
      max-width: 500px;
      margin: 100px auto;
      background-color: #2d2d44;
      border-radius: 16px;
      padding: 30px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
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

  <?php if ($showAlert): ?>
    <div class="alert alert-success text-center"><?= $showAlert ?></div>
  <?php endif; ?>

  <?php if ($showError): ?>
    <div class="alert alert-danger text-center"><?= $showError ?></div>
  <?php endif; ?>

  <div class="signup-card">
    <div class="text-center mb-4">
      <img src="https://cdn-icons-png.flaticon.com/512/5977/5977575.png" class="logo" alt="Logo">
      <h2><span style="color: #0dcaf0;">ScreenKing </span><span style="color: #ffffff;">- Multimedia</span></h2>
      <p style="color: #ffffff;">Create Admin Account</p>
    </div>

    <form action="signup.php" method="post">
      <div class="mb-3">
        <label for="username" class="form-label">👤 Username</label>
        <input type="text" class="form-control" maxlength="100" id="username" name="username" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">🔒 Password</label>
        <div class="input-group">
          <input type="password" class="form-control" id="password" name="password" required>
          <span class="input-group-text" onclick="togglePassword('password', 'togglePassIcon')">
            <span id="togglePassIcon">👁️</span>
          </span>
        </div>
      </div>
      <div class="mb-4">
        <label for="cpassword" class="form-label">🔁 Confirm Password</label>
        <div class="input-group">
          <input type="password" class="form-control" id="cpassword" name="cpassword" required>
          <span class="input-group-text" onclick="togglePassword('cpassword', 'toggleCPassIcon')">
            <span id="toggleCPassIcon">👁️</span>
          </span>
        </div>
      </div>

    <div class="mb-3">
        <label for="username" class="form-label">📧 Email</label>
        <input type="email" class="form-control" maxlength="100" id="email" name="email" required>
      </div> 
      
      <div class="mb-3">
        <label for="username" class="form-label">☎️ Mobile Number</label>
        <input type="number" class="form-control" maxlength="100" id="number" name="number" required>
      </div>

      <button type="submit" class="btn btn-primary w-100">Sign Up</button>
    </form>
    <br>
    <a href="index.php"><button type="submit" class="btn btn-primary w-100">Login Now</button></a>
  </div>

  <script>
    function togglePassword(fieldId, iconId) {
      const input = document.getElementById(fieldId);
      const icon = document.getElementById(iconId);

      if (input.type === 'password') {
        input.type = 'text';
        icon.textContent = '🙈';
      } else {
        input.type = 'password';
        icon.textContent = '👁️';
      }
    }
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
