<?php
if(isset($_POST['btnSave'])){
extract($_REQUEST);
if (user_check('phone', $phone) > 0 || barber_check('phone',$phone)>0) {
    if($user['phone']==$phone){
        $_SESSION['message']= 'Cập nhật số điện thoại thành công';
        header('location: '.ROOT.'?page=profile&action=profile');
        die();
    }
    $error['errors_phone'] = 'Số điện thoại đã tồn tại';
}if (array_filter($error) == false) {
  if(isset($_SESSION['barber'])){
    barber_change_phone($_SESSION['barber']['id'], $phone);
    $_SESSION['barber']['phone']=$phone;
  }else{
   user_change_phone($_SESSION['user']['id'], $phone);
    $_SESSION['user']['phone']=$phone;
  }
    $_SESSION['message']= 'Cập nhật số điện thoại thành công';
    header('location: '.ROOT.'?page=profile&action=profile');
    die();
}
}
?>
<div class="my-account">
                    <p class="my-account-title">Đổi Số điện thoại</p>
                    <p>Vui lòng nhập địa số điện thoại mới</p>
                </div>
                <form action="" method="post" novalidate class="needs-validation form-contact">
                    <div class="form-group row">
                        <div for="" class="col-sm-3 text-right">Số điện thoại</div>
                        <div class="col-sm-9">
                            <span class=""><?= $user['phone'] ?></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div for="" class="col-sm-3 text-right">Nhập số điện thoại mới</div>
                        <div class="col-sm-9">
                        <input type="text" class="form-control w-50" id="" name="phone" value="<?=isset($phone)?$phone:''?>" pattern="^\+?\d{1,3}?[- .]?\(?(?:\d{2,3})\)?[- .]?\d\d\d[- .]?\d\d\d\d$" required>
                        <div class="invalid-feedback">
                            Số điện thoại không đúng định dạng
                        </div>
                        <?php if (isset($error['errors_phone'])) : ?>
            <p class="text-danger mb-0"><?= $error['errors_phone'] ?>
            </p>
          <?php endif; ?>
                        <button class="button button-contactForm boxed-btn mt-3" name="btnSave" type="submit">Xác nhận</button>
                        <a class="button button-contactForm boxed-btn mt-3 ml-3" href="<?=ROOT?>?page=profile&action=profile">Trở lại</a>
                        </div>
                    </div>
                   
                </form>