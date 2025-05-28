<?php
if(isset($_POST['btnSave'])){
extract($_REQUEST);
 if(password_verify($password, $user['password'])){
    header('location: '.ROOT.'admin/?page=profile&action=resetEmail');
    die();
 }else{
    $error['password'] = "Mật khẩu không đúng";
 }
}
?>
<div class="my-account">
                    <p class="my-account-title">Đổi Hộp Thư</p>
                    <p>Để cập nhật email mới, vui lòng xác nhận bằng cách nhập mật khẩu</p>
                </div>
                <form action="" method="post" novalidate class="needs-validation form-contact">
                    <div class="form-group row">
                        <div for="" class="col-sm-3 text-right">Địa chỉ email</div>
                        <div class="col-sm-9">
                            <span class=""><?= $user['email'] ?></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div for="" class="col-sm-3 text-right">Mật khẩu</div>
                        <div class="col-sm-9">
                        <input type="password" class="form-control w-50" id="" title="Mật khẩu chứa ít nhất 6 ký tự" minlength="6" name="password" value="<?=isset($password)?$password:''?>" required>
                        <div class="invalid-feedback">
                            Mật khẩu chứa ít nhất 6 ký tự
                        </div>
                        <?php if (isset($error['password'])) : ?>
            <p class="text-danger mb-0"><?= $error['password'] ?>
            </p>
          <?php endif; ?>
                        <button class="button button-contactForm boxed-btn mt-3" name="btnSave" type="submit">Xác nhận</button>
                        </div>
                    </div>
                   
                </form>