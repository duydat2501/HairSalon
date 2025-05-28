<?php
if(isset($_POST['btnSave'])){
extract($_REQUEST);
if (user_check('email',$email)>0) {
    if($user['email']==$email){
        $_SESSION['message']= 'Cập nhật liệu thành công';
        header('location: '.ROOT.'admin/?page=profile&action=profile');
        die();
    }
    $error['errors_email'] = 'Địa chỉ email đã tồn tại';
}if (array_filter($error) == false) {
    user_change_email($_SESSION['user']['id'], $email);
    $_SESSION['user']['email']=$email;
    $_SESSION['message']= 'Cập nhật liệu thành công';
    header('location: '.ROOT.'admin/?page=profile&action=profile');
    die();
}
}
?>
<div class="my-account">
        <p class="my-account-title">Đổi Hộp Thư</p>
        <p>Vui lòng nhập địa chỉ email mới</p>
    </div>
    <form action="" method="post" novalidate class="needs-validation form-contact">
        <div class="form-group row">
            <div for="" class="col-sm-3 text-right">Địa chỉ email</div>
            <div class="col-sm-9">
                <span class=""><?= $user['email'] ?></span>
            </div>
        </div>
        <div class="form-group row">
            <div for="" class="col-sm-3 text-right">Địa chỉ email mới</div>
            <div class="col-sm-9">
                <input type="email" class="form-control w-50" id="" name="email" value="<?= isset($email) ? $email : '' ?>" required>
                <div class="invalid-feedback">
                    Email không đúng định dạng
                </div>
                <?php if (isset($error['errors_email'])) : ?>
                    <p class="text-danger mb-0"><?= $error['errors_email'] ?>
                    </p>
                <?php endif; ?>
                <button class="button button-contactForm boxed-btn mt-3" name="btnSave" type="submit">Xác nhận</button>
                <a class="button button-contactForm boxed-btn mt-3 ml-3" href="<?=ROOT?>admin/?page=profile&action=profile">Trở lại</a>
            </div>
        </div>

    </form>