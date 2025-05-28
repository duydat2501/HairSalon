<?php 
use PHPMailer\PHPMailer\PHPMailer;

require_once '../golbal.php';
require_once '../libs/users.php';
if(isset($_REQUEST['btnReset'])){
  $error = [];
  extract($_REQUEST);
  $m=user_check('email',$email);
if(!empty($m)){
  $custom=user_check('email',$email);
  $code=time().$custom['email'];
  $codehash=password_hash($code,PASSWORD_DEFAULT);
  $time_code=time();
  update_code_user($custom['id'],$codehash,$time_code);
}else{
  $error['email']= 'Địa chỉ email không đúng';
}if (empty($error)){
   //Gửi mail
 $custom = user_check('email',$email);
require_once "../phpmailer/PHPMailer.php";
require_once "../phpmailer/SMTP.php";
$mail = new PHPMailer();
// Gọi đến lpows smtp
$mail->isSMTP();

// $mail->SMTPDebug = 1;  //Hiển thị thông báo trong quá trình kết nối SMTP
                        // 1 - Hiển thị messages + error
                        // 2 - Hiển thị messages

$mail->SMTPAuth     = true;
$mail->SMTPSecure   = 'ssl';
$mail->Host         = 'smtp.gmail.com';
$mail->Port         = 465;
$mail->Username     = 'dinhdat25012000@gmail.com';
$mail->Password     = 'hixi xelx bati cebb';    


//Thiết lập thông tin người gửi và mail người gửi
$mail->setFrom('dinhdat25012000@gmail.com','PolyBarber');

//Thiết lập thông tin người nhận và email người nhận
$mail->addAddress($email,$custom['name']);
//Them nguoi nhan
// $mail->addAddress('hoachu938@gmail.com','Hoa');

//Thiết lập email reply
$mail->addReplyTo('dinhdat25012000@gmail.com');

//Thiết lập tập tin
// $mail->addAttachment('01.php','My file');

//Thiết lập tiêu đề
$mail->Subject = "Thiết lập lại mật khẩu đăng nhập PolyBarber";

//Thiết lập charset
$mail->CharSet = 'utf-8';

//Thiết lập nội dung
$body = '<p>Xin chào '.$custom['name'].',</p>
          <p>Bạn đã yêu cầu thiết lập lại mật khẩu của mình trên PolyBarber.</p>
          <p>Để thiết lập lại, bạn chỉ cần click vào đường link dưới đây hoặc sao chép rồi dán vào trình duyệt của mình.</p>
          <a href="'.ROOT.'resetPass/?code='.$custom['code'].'&email='.$custom['email'].'">'.ROOT.'resetPass/?code='.$custom['code'].'&email='.$custom['email'].'</a>
          <p>Đường dẫn chỉ có hiệu lực trong vòng 10 phút</p>';

$mail->msgHTML($body);
if($mail->send() == false){
  $_SESSION['messages'] = 'Error: '.$mail->ErrorInfo;
}else{
 $_SESSION['messages'] = 'Mã xác minh đã được gửi đến địa chỉ email  <p class="stadurt">' . $custom['email'].'</p> Vui lòng kiểm tra hộp thư đến của bạn!';
}
header('location:' . $_SERVER['REQUEST_URI']);
die();
}

}
if(isset($_REQUEST['btnBack'])){
  if (isset($_SESSION['messages'])) {
    unset($_SESSION['messages']);
}
header('location:' . ROOT);
die();
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

  <title>PolyBarber - Forgot Password</title>

<!-- Custom fonts for this template-->
<link href="../admin/resource/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

<!-- Custom styles for this template-->
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
              <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                <?php if(!isset($_SESSION['messages'])): ?>
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-2">Quên mật khẩu</h1>
                    <p class="mb-4">Chỉ cần nhập địa chỉ email của bạn dưới đây và chúng tôi sẽ gửi cho bạn một liên kết để đặt lại mật khẩu của bạn!</p>
                  </div>
                  <form class="user needs-validation" action=""  method="POST" novalidate>
                    <div class="form-group">
                      <input type="email" class="form-control form-control-user" name="email"  value="<?= isset($email) ? $email : '' ?>" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address..." required>
                      <div class="invalid-feedback">
                                Vui lòng nhập địa chỉ email
                            </div>
                            <?php if (isset($error['email'])) : ?>
            <p class="text-danger mt-2"><?= $error['email'] ?>
            </p>
          <?php endif; ?>
                    </div>
                    <button type="submit" name="btnReset" class="btn btn-primary btn-user btn-block text-uppercase">
                     Đặt lại mật khẩu
                    </button>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="<?=ROOT?>admin/">Quay về trang chủ</a>
                  </div>
                <?php else: ?>
                  <div class="text-center">
        <h3 class="font-weight-light">Đặt Lại Mật Khẩu</h3>
        <svg class="stardust-icon" viewBox="0 0 77 50" style="width: 90px; height: 100px;"><path stroke="none" d="M59.4 0H6.6C2.96 0 0 2.983 0 6.667v36.667C0 47.017 2.953 50 6.6 50h42.826c.7-.008 1.653-.354 1.653-1.497 0-1.156-.814-1.482-1.504-1.482h-.15v-.023H6.6c-1.823 0-3.568-1.822-3.568-3.664V6.667c0-1.842 1.745-3.623 3.568-3.623h52.8c1.824 0 3.6 1.78 3.6 3.623V18c0 .828.538 1.468 1.505 1.468S66 18.828 66 18v-.604-10.73C66 2.983 63.047 0 59.4 0zm-.64 5.76c.374.713.35 1.337-.324 1.733L33.84 21.53c-.423.248-1.575.923-3.124-.004L7.465 7.493c-.672-.396-.52-.896-.146-1.6s.753-1.094 1.426-.698L32.065 19.4 57.202 5.186c.672-.396 1.183-.14 1.556.574zm14.335 26.156l.277.078c.34.092.5.148.45.168 1.862.8 3.178 2.735 3.178 5v7.47c0 2.967-2.28 5.38-5.08 5.38H57.08c-2.8 0-5.08-2.413-5.08-5.38V37.15c0-2.538 1.67-4.665 3.905-5.23v-1.807C55.905 25.087 59.76 21 64.5 21c3.52 0 6.63 2.234 7.944 5.635l.02.05.006.016a9.55 9.55 0 0 1 .625 3.415v1.8zM70.48 28.17a1.28 1.28 0 0 1-.028-.081c-.83-2.754-3.223-4.604-5.954-4.604-3.447 0-6.25 2.974-6.25 6.63v1.655h12.505v-1.655c0-.677-.096-1.33-.275-1.946h.001zm4.18 16.45h-.002c0 1.596-1.227 2.892-2.737 2.892H57.08c-1.507 0-2.737-1.3-2.737-2.893v-7.47c0-1.597 1.227-2.893 2.738-2.893h14.84c1.508 0 2.737 1.3 2.737 2.893v7.47z" fill-opacity=".87" fill-rule="evenodd"></path><rect stroke="none" x="63" y="38" width="3" height="6" viewBox="0 0 3 6" rx="1.5" fill-opacity=".87"></rect></svg>
        <p><?=$_SESSION['messages'];?></p>
        <a href="<?=ROOT?>site/forgot-password.php?btnBack" class="btn btn-primary pl-5 pr-5">OK</a>
        </div>
                <?php endif; ?>
                </div>
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

  <!-- Custom scripts for all pages-->
  <script src="../admin/resource/js/sb-admin-2.js"></script>
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