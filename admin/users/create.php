<?php
$errors = [];
if (isset($_POST['btnsave'])) {
    extract($_REQUEST);
    $okUpload = false;
    $cus = user_check('phone', $phone);
    if (checkType($_FILES['images']['name'], array('jpg', 'png', 'gif', 'tiff')) && checkSize($_FILES['images']['size'], 0, 5 * 1024 * 1024)) {
        $okUpload = true;
        $images = uniqid() . $_FILES['images']['name'];
    }else {
        $images = 'user.svg';
    }
    if (checkType($_FILES['images']['name'], array('jpg', 'png', 'gif', 'tiff')) == false && $_FILES['images']['size'] > 0) {
        $errors['errors_img'] = 'File không đúng định dạng';
    }
    if (empty($account)) {
        $errors['errors_account'] = 'Vui lòng nhập tên tài khoản';
    }
    if (user_check('account', $account) > 0 || barber_check('account', $account) > 0) {
        $errors['errors_account'] = 'Tên tài khoản đã tồn tại';
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
    if (empty($email)) {
        $errors['errors_email'] = 'Vui lòng nhập một địa chỉ email hợp lệ';
    }
    if (user_check('email', $email) > 0 || barber_check('email', $email) > 0) {
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
            move_uploaded_file($_FILES['images']['tmp_name'], '../images/users/' . $images);
        }
        $_SESSION['message'] = "Thêm người dùng thành công";
        header('Location:' . ROOT . 'admin/?page=user');
        die();
    }
}
?>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">

    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Thêm thành viên</h6>
        </div>
        <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                <div class="row">
                    <div class="col-md-6">
                    <div class="form-group">
                            <label for="account">Tên tài khoản</label>
                            <input type="text" name="account" id="account" class="form-control" placeholder="Nhập tên tài khoản" value="<?= isset($account) ? $account : '' ?>" required>
                            <div class="invalid-feedback">
                                Vui lòng nhập tên tài khoản
                                </div>
                            <?php if (isset($errors['errors_account'])) : ?>
                                <p class="text-danger mt-2"><?= $errors['errors_account'] ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="name">Họ tên</label>
                            <input type="text" name="name" id="name" class="form-control" pattern="[a-zA-Z\s'-'\sáàảãạăâắằấầặẵẫậéèẻ ẽêẹếềểễệóòỏõọôốồổỗộ ơớờởỡợíìỉĩịđùúủũụưứ? ?ửữựÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠ ƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼ? ??ỀÊỂỄỆỈỊỌỎỐỒỔỖỘỚỜỞ ỠỢỤỨỪỬỮỰỲỴÝỶỸửữựỵ ỷỹ]{1,20}" title="Họ tên không bao gồm số" 
                            placeholder="Nhập họ tên" value="<?= isset($name) ? $name : '' ?>" required>
                            <div class="invalid-feedback">
                                Vui lòng nhập họ tên
                            </div>
                            <?php if (isset($errors['errors_name'])) : ?>
                                <p class="text-danger mt-2"><?= $errors['errors_name'] ?></p>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="phone">Số điện thoại</label>
                            <input type="tel" name="phone" id="phone" class="form-control" pattern="^\+?\d{1,3}?[- .]?\(?(?:\d{2,3})\)?[- .]?\d\d\d[- .]?\d\d\d\d$" placeholder="Nhập số điện thoại" value="<?= isset($phone) ? $phone : '' ?>" required>
                            <div class="invalid-feedback">
                                Số điện thoại không đúng định dạng
                            </div>
                            <?php if (isset($errors['errors_phone'])) : ?>
                                <p class="text-danger mt-2"><?= $errors['errors_phone'] ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Nhập email" value="<?= isset($email) ? $email : '' ?>" required>
                            <div class="invalid-feedback">
                                Địa chỉ email không đúng định dạng
                            </div>
                            <?php if (isset($errors['errors_email'])) : ?>
                                <p class="text-danger mt-2"><?= $errors['errors_email'] ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="password">Mật khẩu</label>
                            <input type="password" name="password" id="password" class="form-control" title="Mật khẩu chứa ít nhất 6 ký tự" minlength="6" placeholder="Nhập mật khẩu" value="<?= isset($password) ? $password : '' ?>" required>
                            <div class="invalid-feedback">
                                Mật khẩu chứa ít nhất 6 ký tự
                            </div>
                            <?php if (isset($errors['errors_password'])) : ?>
                                <p class="text-danger mt-2"><?= $errors['errors_password'] ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="role">Vai trò</label>
                            <select name="role" id="role" required class="custom-select">
                                <option value="">Chọn vai trò</option>
                                <option value="1">Quản trị</option>
                                <option value="2">Lễ tân</option>
                                <option value="3">Khách hàng</option>
                            </select>
                            <div class="invalid-feedback">
                                Vui lòng chọn vai trò
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="images">Ảnh đại diện</label>
                            <input type="file" class="form-control-file border" id="images" name="images">
                            <?php if (isset($errors['errors_img'])) : ?>
                                <p class="text-danger mt-2"><?= $errors['errors_img'] ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="address">Địa chỉ</label>
                    <textarea class="form-control" minlength="15" name="address" rows="5" required><?= isset($address) ? $address : '' ?></textarea>
                    <div class="invalid-feedback">
                    Địa chỉ tối thiểu 15 ký tự
                    </div>
                    <?php if (isset($errors['errors_address'])) : ?>
                        <p class="text-danger mt-2"><?= $errors['errors_address'] ?></p>
                    <?php endif; ?>
                </div>
                <button type="submit" name="btnsave" class="btn btn-success">Ghi lại</button>
            </form>
        </div>
    </div>
</div>