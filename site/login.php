<?php
$errors = [];
//Nếu đã đăng nhập rồi thì check_session
if (isset($_COOKIE['phone'])) {
  $phone = $_COOKIE['phone'];
  $password = $_COOKIE['password'];
}
extract($_REQUEST);
if (isset($btnLogin)) {
  if (check_user($phone)) { 
    $user = check_user($phone);
    if (password_verify($password, $user['password'])) {
      $_SESSION['user'] = $user;
      $_SESSION['message']="Đăng nhập thành công";
      header('location:' . $_SERVER['REQUEST_URI']);
      die();
      if (isset($remember)) {
        //Nếu người dùng nhớ mật khẩu thì lưu lại trong 30 ngày trong cookie
        setcookie('phone', $phone, time() + 3600 * 30, "/");
        setcookie('password', $password, time() + 3600 * 30, "/");
      } else {
        //Ngược lại thì xóa cookie cũ đi
        setcookie('phone', $phone, time() - 3600 * 30, "/");
        setcookie('password', $password, time() - 3600 * 30, "/");
      }
    } else {
      $error['password'] = "Mật khẩu không đúng";
      $_SESSION['message']="Đăng nhập thất bại";
    }
  } elseif (check_barber($phone)) {
    $barber = check_barber($phone);
    if (password_verify($password, $barber['password'])) {
      $_SESSION['barber'] = $barber;
      $_SESSION['message']="Đăng nhập thành công";
      header('location:' . $_SERVER['REQUEST_URI']);
      die();
      if (isset($remember)) {
        //Nếu người dùng nhớ mật khẩu thì lưu lại trong 30 ngày trong cookie
        setcookie('phone', $phone, time() + 3600 * 30, "/");
        setcookie('password', $password, time() + 3600 * 30, "/");
      } else {
        //Ngược lại thì xóa cookie cũ đi
        setcookie('phone', $phone, time() - 3600 * 30, "/");
        setcookie('password', $password, time() - 3600 * 30, "/");
      }
    } else {
      $error['password'] = "Mật khẩu không đúng";
      $_SESSION['message']="Đăng nhập thất bại";
    }
  } else {
    $error['phone'] = "Tên đăng nhập không đúng";
    $_SESSION['message']="Đăng nhập thất bại";
  }
}

if (isset($_POST['btnRegister'])) {
  extract($_REQUEST);
  $okUpload = false;
  $cus = user_check('phone', $phone);
  if (checkType($_FILES['images']['name'], array('jpg', 'png', 'gif', 'tiff')) && checkSize($_FILES['images']['size'], 0, 5 * 1024 * 1024)) {
    $okUpload = true;
    $images = uniqid() . $_FILES['images']['name'];
  } else {
    $images = 'user.svg';
  }
  if (checkType($_FILES['images']['name'], array('jpg', 'png', 'gif', 'tiff')) == false && $_FILES['images']['size'] > 0) {
    $errors['errors_img'] = 'File không đúng định dạng';
  }
  if (empty($name)) {
    $errors['errors_name'] = 'Vui lòng nhập họ tên';
  }
  if (empty($phone)) {
    $errors['errors_phone'] = 'Vui lòng nhập số điện thoại';
  }
  if (user_check('phone', $phone) > 0 && !empty($cus['password'])) {
    $errors['errors_phone'] = 'Số điện thoại đã tồn tại';
  }if(barber_check('phone',$phone) > 0){
    $errors['errors_phone'] = 'Số điện thoại đã tồn tại';
  }
  if (empty($account)) {
    $errors['errors_account'] = 'Vui lòng nhập tên tài khoản';
  }
  if (user_check('account', $account) > 0 || barber_check('account',$account) > 0) {
    $errors['errors_account'] = 'Tài khản đã tồn tại';
  }
  if (empty($email)) {
    $errors['errors_email'] = 'Vui lòng nhập một địa chỉ email hợp lệ';
  }
  if (user_check('email', $email) > 0 || barber_check('email',$email) > 0) {
    $errors['errors_email'] = 'Địa chỉ email đã tồn tại';
  }
  if (empty($password)) {
    $errors['errors_password'] = 'Vui lòng nhập mật khẩu';
  }
  if (empty($address)) {
    $errors['errors_address'] = 'Địa chỉ không được để trống';
  }

  if (array_filter($errors) == false) {
    if (user_check('phone', $phone)>0) {
      user_change($cus['id'],$account, $password, $name, $address, $images, $email,3);
    } else {
      user_insert($account, $password, $name,$address,$phone, $email, $images,3);
    }
    if ($okUpload) {
      move_uploaded_file($_FILES['images']['tmp_name'], 'images/users/' . $images);
    }
    $_SESSION['message'] = "Đăng ký thành công";
    header('location:' . $_SERVER['REQUEST_URI']);
    die();
  }else{
    $_SESSION['message']="Đăng ký thất bại";
  }
}
