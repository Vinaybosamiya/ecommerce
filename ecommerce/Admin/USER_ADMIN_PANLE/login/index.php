<?php
include '../_dbconnect.php';
include '../function.php';
$login = false;
$showError = false;
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $username = get_safe_val($conn, $_POST['username']);
  $password =  get_safe_val($conn, $_POST['password']);

  $sql = "SELECT * FROM admin_panal WHERE username = '$username'";
  $res = mysqli_query($conn, $sql);
  $num = mysqli_num_rows($res);

  if ($num > 0) {
    while ($row = mysqli_fetch_assoc($res)) {
      if (password_verify($password, $row['psw'])) {
        $login = true;
        session_start();
        $_SESSION['logedin'] = true;
        $_SESSION['username'] = $username;
        if (isset($_SESSION['logedin']) && $_SESSION['logedin'] === true) {
          header("location: welcome.php");
          exit;  // Important to prevent further execution
        } else {
          $showError = 'Sorry, your username or password is incorrect.';
        }
      } else {
        $showError = 'Sorry, your username or password is incorrect.';
      }
    }
  } else {
    $showError = 'Sorry, your username or password is incorrect.';
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
      max-width: 450px;
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

  <?php if ($login): ?>
    <div class="alert alert-success text-center">✅ You are logged in!</div>
  <?php endif; ?>

  <?php if ($showError): ?>
    <div class="alert alert-danger text-center"><?= $showError ?></div>
  <?php endif; ?>

  <div class="login-card">
    <div class="text-center mb-4">
      <!-- Replace src with your logo image if needed -->
      <img src="https://cdn-icons-png.flaticon.com/512/5977/5977575.png" class="logo" alt="Logo">
      <h2><span style="color: #0dcaf0;">ScreenKing </span><span style="color: #ffffff;">- Multimedia</span></h2>
      <p style="color: #ffffff;">Admin Login Panel</p>
    </div>

    <form action="index.php" method="post">
      <div class="mb-3">
        <label for="username" class="form-label">👤 Username</label>
        <input type="text" class="form-control" id="username" name="username" required>
      </div>
      <div class="mb-4">
        <label for="password" class="form-label">🔒 Password</label>
        <div class="input-group">
          <input type="password" class="form-control" id="password" name="password" required>
          <span class="input-group-text" onclick="togglePassword()" id="toggleIcon">👁️</span>
        </div>
      </div>

      <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
    <br>
    <a href="signup.php"><button type="submit" class="btn btn-primary w-100">Sign Up</button></a>
  </div>

  <script>
    function togglePassword() {
      const passInput = document.getElementById('password');
      const icon = document.getElementById('toggleIcon');

      if (passInput.type === 'password') {
        passInput.type = 'text';
        icon.innerText = '🙈'; // Hide icon
      } else {
        passInput.type = 'password';
        icon.innerText = '👁️'; // Show icon
      }
    }
  </script>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>