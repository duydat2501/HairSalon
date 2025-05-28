<?php

use PHPMailer\PHPMailer\PHPMailer;

require_once "../golbal.php";
require_once "../libs/barbers.php";
require_once "../libs/users.php";
require_once "../phpmailer/PHPMailer.php";
require_once "../phpmailer/SMTP.php";
extract($_REQUEST);
$m= user_check('email',$email);
$c=barber_check('email',$email);
$ok=false;
if (!empty($c)) {
  $user = barber_check('email', $email);
  if ($code == $user['code'] && (time() - $user['time_code']) < 600) {
    if (isset($_POST['btnSave'])) {
        if ($newPassword == $newPasswordRepeat) {
          barber_change_password($user['id'], $newPassword);
          update_code_barber($user['id'], '', '');
          $ok=true;
        } else {
          $error['newPasswordRepeat'] = 'Mật khẩu và Mật khẩu xác nhận không giống nhau';
        }
    }
  } else {
    update_code_barber($user['id'], '', '');
    header('location: ' . ROOT);
    die();
  }
} elseif (!empty($m)) {
  $user = user_check('email', $email);
  if ($code == $user['code'] && (time() - $user['time_code']) < 600) {
    if (isset($_POST['btnSave'])) {
        if ($newPassword == $newPasswordRepeat) {
          user_change_password($user['id'], $newPassword);
          update_code_user($user['id'], '', '');
          $ok=true;
        } else {
          $error['newPasswordRepeat'] = 'Mật khẩu và Mật khẩu xác nhận không giống nhau';
        }
    }
  } else {
    if ($user['role'] == 1) {
      update_code_user($user['id'], '', '');
      header('location: ' . ROOT . 'admin');
      die();
    } else {
      update_code_user($user['id'], '', '');
      header('location: ' . ROOT);
      die();
    }
  }
} 
if($ok == true){
  //Gửi mail

  $mail = new PHPMailer();
  // Gọi đến lpows smtp
  $mail->isSMTP();

  $mail->SMTPAuth     = true;
  $mail->SMTPSecure   = 'ssl';
  $mail->Host         = 'smtp.gmail.com';
  $mail->Port         = 465;
  $mail->Username     = 'dinhdat25012000@gmail.com';
  $mail->Password     = 'hixi xelx bati cebb';

  //Thiết lập thông tin người gửi và mail người gửi
  $mail->setFrom('dinhdat25012000@gmail.com', 'PolyBarber');

  //Thiết lập thông tin người nhận và email người nhận
  $mail->addAddress($email, $user['name']);

  //Thiết lập email reply
  $mail->addReplyTo('dinhdat25012000@gmail.com');

  //Thiết lập tiêu đề
  $mail->Subject = "Mật khẩu đăng nhập PolyBarber đã được thay đổi";

  //Thiết lập charset
  $mail->CharSet = 'utf-8';

  //Thiết lập nội dung
  $body = '<p>Xin chào ' . $user['name'] . ',</p>
      <p>Mật khẩu đăng nhập vào tài khoản PolyBarber của bạn đã thay đổi</p>
      <p>Nếu bạn không thay đổi mật khẩu, vui lòng liên hệ với chúng tôi qua email: dinhdat25012000@gmail.com
      </p>
      <p>Nếu chính bạn đã thay đổi mật khẩu hãy <a href="' . ROOT . '"> đăng nhập</a> PolyBarber và đặt lịch ngay.</p>';
  $mail->msgHTML($body);
  if ($mail->send() == false) {
    echo  'Error: ' . $mail->ErrorInfo;
  } else {
    $_SESSION['message'] = 'Mật khẩu đăng nhập vào tài khoản PolyBarber của bạn đã thay đổi';
    header('location: ' . ROOT);
    die();
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

  <title>PolyBarber - Reset Password</title>

  <!-- user fonts for this template-->
  <link href="../admin/resource/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- user styles for this template-->
  <link href="../admin/resource/css/sb-admin-2.css" rel="stylesheet">

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
              <div class="col-12 pt-5 pb-3">
                <form action="" method="post" novalidate class="needs-validation">
                  <h3 class="login-head mb-5 text-center"><i class="fa fa-lg fa-fw fa-lock"></i>Đặt lại mật khẩu</h3>
                  <div class="text-center">
                    <p>Đặt mật khẩu mới cho <?=$user['email']?></p>
                  </div>
                  <div class="form-group row">
                    <div for="" class="col-sm-5 text-right">Mật khẩu mới</div>
                    <div class="col-sm-7">
                      <input type="password" class="form-control w-75" title="Mật khẩu chứa ít nhất 6 ký tự" minlength="6" name="newPassword" id="newPassword" value="<?= isset($newPassword) ? $newPassword : '' ?>" required>
                      <div class="invalid-feedback">
                        Mật khẩu chứa ít nhất 6 ký tự
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div for="" class="col-sm-5 text-right">Xác nhận mật khẩu mới</div>
                    <div class="col-sm-7">
                      <input type="password" class="form-control w-75" title="Mật khẩu chứa ít nhất 6 ký tự" minlength="6" name="newPasswordRepeat" id="newPasswordRepeat" value="<?= isset($newPasswordRepeat) ? $newPasswordRepeat : '' ?>" required>
                      <div class="invalid-feedback">
                        Mật khẩu chứa ít nhất 6 ký tự
                      </div>
                      <?php if (isset($error['newPasswordRepeat'])) : ?>
                        <p class="text-danger mb-0"><?= $error['newPasswordRepeat'] ?>
                        </p>
                      <?php endif; ?>
                      <button class="btn btn-primary pl-4 pr-4 mt-3 pt-2 pb-2 rounded-0" name="btnSave" type="submit">Xác nhận</button>
                      <a class="btn btn-outline-primary text-uppercase pr-4 mt-3 ml-4 pt-2 pb-2 rounded-0" href="<?= ROOT ?>">Trở lại</a>
                    </div>
                  </div>

                </form>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="../admin/resource/vendor/jquery/jquery.min.js"></script>
  <script src="../admin/resource/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../admin/resource/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- user scripts for all pages-->
  <script src="../admin/resource/js/sb-admin-2.js"></script>
  <script>
    (function() {
      'use strict';
      window.addEventListener('load', function() {
        // Fetch all the forms we want to apply user Bootstrap validation styles to
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