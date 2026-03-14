<?php
require_once __DIR__ . '/auth_init.php';

// If already logged in, redirect to dashboard
if ($auth->isLogged()) {
    header('Location: index.php');
    exit;
}

$error = '';
$success = '';

// Handle login submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $remember = isset($_POST['remember']) ? true : false;

    $login = $auth->login($email, $password, $remember);

    if ($login['error']) {
        $error = $login['message'];
    } else {
        // Login successful, PHPAuth sets the cookie automatically
        header('Location: index.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin- Login</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
  <style>
      .login-logo img {
          max-height: 80px;
          margin-bottom: 20px;
      }
      .btn-primary {
          background-color: #28a745;
          border-color: #28a745;
      }
      .btn-primary:hover {
          background-color: #218838;
          border-color: #1e7e34;
      }
      .login-box {
          width: 400px;
      }
      @media (max-width: 576px) {
          .login-box {
              width: 90%;
          }
      }
  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../">
        <img src="<?= ADMIN_URL ?>/src/images/logo.png" alt="Vastu Mitra Logo">
    </a>
  </div>
  <!-- /.login-logo -->
  <div class="card card-outline card-success">
    <div class="card-body login-card-body">
      <h5 class="login-box-msg font-weight-bold text-dark">Admin Login Panel</h5>

      <?php if ($error): ?>
          <div class="alert alert-danger" role="alert">
              <?= htmlspecialchars($error) ?>
          </div>
      <?php endif; ?>

      <form action="login.php" method="post">
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email" required autofocus value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember" name="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<!-- Bootstrap 4 (required for AdminLTE 3) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>
</html>
