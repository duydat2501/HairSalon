<?php
if(isset($_POST['btnSave'])){
extract($_REQUEST);
 if(password_verify($password, $user['password'])){
    if($newPassword==$newPasswordRepeat){
            user_change_password($_SESSION['user']['id'], $newPassword);
            $_SESSION['user']['password']=$newPassword;
        $_SESSION['message']= 'Cập nhật liệu thành công';
        header('location: '.ROOT.'admin/?page=profile&action=profile');
    die();
    }else{
        $error['newPasswordRepeat'] = 'Mật khẩu và Mật khẩu xác nhận không giống nhau';
    }
 }else{
    $error['password'] = "Mật khẩu không đúng";
 }
}
?>
<div class="my-account">
        <p class="my-account-title">Đổi Mật Khẩu</p>
        <p>Để bảo mật tài khoản, vui lòng không chia sẻ mật khẩu cho người khác</p>
    </div>
    <form action="" method="post" novalidate class="needs-validation form-contact">
        <div class="form-group row">
            <div for="" class="col-sm-3 text-right">Mật khẩu hiện tại</div>
            <div class="col-sm-9">
                <input type="password" class="form-control w-50 d-inline-block"  title="Mật khẩu chứa ít nhất 6 ký tự" minlength="6" name="password" id="password" value="<?=isset($password)?$password:''?>" required>

                <button type="button" class="btn text-primary ml-5" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Vui lòng đăng xuất khỏi tài khoản của bạn và nhấp vào 'Quên mật khẩu' tại trang đăng nhập.">
                    Quên mật khẩu?
                </button>
                <div class="invalid-feedback">
                    Mật khẩu chứa ít nhất 6 ký tự
                </div>
                <?php if (isset($error['password'])) : ?>
                    <p class="text-danger mb-0"><?= $error['password'] ?>
                    </p>
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group row">
            <div for="" class="col-sm-3 text-right">Mật khẩu mới</div>
            <div class="col-sm-9">
                <input type="password" class="form-control w-50" title="Mật khẩu chứa ít nhất 6 ký tự" minlength="6" name="newPassword" id="newPassword" value="<?=isset($newPassword)?$newPassword:''?>" required>
                <div class="invalid-feedback">
                    Mật khẩu chứa ít nhất 6 ký tự
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div for="" class="col-sm-3 text-right">Xác nhận mật khẩu mới</div>
            <div class="col-sm-9">
                <input type="password" class="form-control w-50" title="Mật khẩu chứa ít nhất 6 ký tự" minlength="6" name="newPasswordRepeat" id="newPasswordRepeat" value="<?=isset($newPasswordRepeat)?$newPasswordRepeat:''?>" required>
                <div class="invalid-feedback">
                    Mật khẩu chứa ít nhất 6 ký tự
                </div>
                <?php if (isset($error['newPasswordRepeat'])) : ?>
                    <p class="text-danger mb-0"><?= $error['newPasswordRepeat'] ?>
                    </p>
                <?php endif; ?>
                <button class="button button-contactForm boxed-btn mt-3" name="btnSave" type="submit">Xác nhận</button>
            </div>
        </div>

    </form>