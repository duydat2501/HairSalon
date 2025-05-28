<?php
require_once '../golbal.php';
require_once '../libs/users.php';
//Nếu đã đăng nhập rồi thì check_session
if (isset($_COOKIE['account'])) {
  $account = $_COOKIE['account'];
  $password = $_COOKIE['password'];
}

check_session();
extract($_REQUEST);
if (isset($btnlogin)) {
  if (check_user($account)) {
    //Trong trường hợp account tồn tại thì lấy ra dữ liệu
    $user = check_user($account);
    if (password_verify($password, $user['password'])) {
      $_SESSION['user'] = $user;
      if ($_SESSION['user']['role'] == 1) {
        header('location:' . ROOT . 'admin');
      }
      if ($_SESSION['user']['role'] != 1) {
        header('location:' . ROOT);
      }
      if (isset($remember)) {
        //Nếu người dùng nhớ mật khẩu thì lưu lại trong 30 ngày trong cookie
        setcookie('account', $account, time() + 3600 * 30, "/");
        setcookie('password', $password, time() + 3600 * 30, "/");
      } else {
        //Ngược lại thì xóa cookie cũ đi
        setcookie('account', $account, time() - 3600 * 30, "/");
        setcookie('password', $password, time() - 3600 * 30, "/");
      }
    } else {
      $error['password'] = "Mật khẩu không đúng!";
    }
  } else {
    $error['account'] = "Tài khoản không đúng";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>PolyBarber - Login</title>

  <!-- Custom fonts for this template-->
  <link href="resource/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="resource/css/sb-admin-2.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
              <div class="p-5">

              </div>
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Đăng nhập</h1>
                  </div>
                  <form class="user needs-validation" action="" method="POST" novalidate >
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" value="<?= isset($account) ? $account : '' ?>" placeholder="Tài khoản..." name="account" autofocus required>
                      <?php if (isset($error['account'])) : ?>
                                <p class="text-danger mt-2"><?= $error['account'] ?></p>
                            <?php endif; ?>
                            <div class="invalid-feedback">
                                Vui lòng nhập tài khoản
                            </div>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="exampleInputPassword" title="Mật khẩu chứa ít nhất 6 ký tự" minlength="6" value="<?= isset($password) ? $password : '' ?>" placeholder="Password" name="password" required>
                      <?php if (isset($error['password'])) : ?>
                                <p class="text-danger mt-2"><?= $error['password'] ?></p>
                            <?php endif; ?>
                            <div class="invalid-feedback">
                                Mật khẩu chứa ít nhất 6 ký tự
                            </div>
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck" name="remember">
                        <label class="custom-control-label" for="customCheck">Nhớ mật khẩu</label>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block text-uppercase" name="btnlogin">Đăng nhập</button>

                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="forgot-password.php">Quên mật khẩu</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
<script src="resource/vendor/jquery/jquery.min.js"></script>
<script src="resource/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="resource/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="resource/js/sb-admin-2.js"></script>
<script>
   (function() {
    'use strict';
    window.addEventListener('load', function() {
      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.getElementsByClassName('needs-validation');
      // Loop over them and prevent submission
      var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
          if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false);
      });
    }, false);
  })();
</script>
</body>

</html>
