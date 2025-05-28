<?php
if(isset($_POST['btnSave'])){
extract($_REQUEST);
 if(password_verify($password, $user['password'])){
    header('location: '.ROOT.'admin/?page=profile&action=resetPhone');
    die();
 }else{
    $error['password'] = "Mật khẩu không đúng";
 }
}
?>
<div class="my-account">
                    <p class="my-account-title">Đổi Số Điện Thoại</p>
                    <p>Để đảm bảo tính bảo mật, vui lòng làm theo các bước sau để đổi số điện thoại</p>
                </div>
                <form action="" method="post" novalidate class="needs-validation form-contact">
                    <div class="form-group row">
                        <div for="" class="col-sm-3 text-right">Số điện thoại</div>
                        <div class="col-sm-9">
                            <span class=""><?= $user['phone'] ?></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div for="" class="col-sm-3 text-right">Mật khẩu</div>
                        <div class="col-sm-9">
                        <input type="password" class="form-control w-50" title="Mật khẩu chứa ít nhất 6 ký tự" minlength="6" name="password" id="" value="<?=isset($password)?$password:''?>" required>
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