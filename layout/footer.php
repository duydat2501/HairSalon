
 <!-- footer -->
 <footer class="footer">
     <div class="footer_top">
         <div class="container">
             <div class="row">
                 <div class="col-xl-3 col-md-6 col-lg-3">
                     <div class="footer_widget">
                         <h3 class="footer_title">
                             Tham gia với chúng tôi
                         </h3>
                         <p class="footer_text doanar">
                             <a class="popup-with-form" href="#test-form">Đặt lịch hẹn</a>
                             <br />
                             <a href="#">+10 378 478 8768</a>
                         </p>
                     </div>
                 </div>
                 <div class="col-xl-3 col-md-6 col-lg-3">
                     <div class="footer_widget">
                         <h3 class="footer_title">
                             Địa chỉ
                         </h3>
                         <p class="footer_text">
                             154, Cầu Giấy, Hà Nội <br />
                             +10 367 267 2678 <br />
                             <a class="domain" href="#">contact@barbershop.com</a>
                         </p>
                         <div class="socail_links">
                             <ul>
                                 <li>
                                     <a href="#">
                                         <i class="fa fa-facebook-square"></i>
                                     </a>
                                 </li>
                                 <li>
                                     <a href="#">
                                         <i class="fa fa-twitter"></i>
                                     </a>
                                 </li>
                                 <li>
                                     <a href="#">
                                         <i class="fa fa-instagram"></i>
                                     </a>
                                 </li>
                             </ul>
                         </div>
                     </div>
                 </div>
                 <div class="col-xl-2 col-md-6 col-lg-2">
                     <div class="footer_widget">
                         <h3 class="footer_title">
                             Menu
                         </h3>
                         <ul>
                             <li><a href="<?=ROOT?>">Trang chủ</a></li>
                             <li><a href="<?=ROOT?>?page=introduce">Giới thiệu</a></li>
                             <li><a href="<?=ROOT?>?page=service">Dịch vụ</a></li>
                             <li><a href="<?=ROOT?>?page=blog">Tin tức</a></li>
                         </ul>
                     </div>
                 </div>
                 <div class="col-xl-4 col-md-6 col-lg-4">
                     <div class="footer_widget">
                         <h3 class="footer_title">
                             Bản tin
                         </h3>
                         <form action="#" class="newsletter_form">
                             <input type="text" placeholder="Nhập địa chỉ email của bạn" required/>
                             <button type="submit">Đăng ký</button>
                         </form>
                         <p class="newsletter_text">
                             Đăng ký nhận tin mới của chúng tôi
                         </p>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <div class="copy-right_text">
         <div class="container">
             <div class="footer_border"></div>
             <div class="row">
                 <div class="col-xl-12">
                     <p class="copy_right text-center">
                         <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                         Copyright &copy;
                         <script>
                             document.write(new Date().getFullYear());
                         </script>
                         All rights reserved | This template is made with
                         <i class="fa fa-heart-o" aria-hidden="true"></i> by
                         <a href="https://colorlib.com" target="_blank">Poly-barber</a>
                         <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                     </p>
                 </div>
             </div>
         </div>
     </div>
 </footer>
 <!-- footer -->
 <!-- link that opens popup -->
 <div id="test-form" class="white-popup-block mfp-hide">
     <div class="popup_box">
     <h3>Đặt lịch hẹn</h3>
     <h4>Yêu cầu: nhập số điện thoại đúng với tài khoản đăng ký</h4>
             <form class="needs-validation form-contact" action="" method="POST" novalidate>
                 <div class="row">
                     <div class="col-xl-6 col-md-6 form-group">
                         <input type="date" id="day" name="day" class="form-control" required
    min="<?= date('Y-m-d') ?>" value="<?= isset($day) ? htmlspecialchars($day) : date('Y-m-d') ?>">

                         <div class="invalid-feedback">
                             Vui lòng chọn ngày hẹn
                         </div>
                     </div>
                     <div class="col-xl-6 col-md-6 form-group">
                         <select class="form-control" name="id_barber" id="default-select" required>
                             <option value="">Chọn nhân viên</option>
                             <?php foreach ($barber as $b) : ?>
                                 <option value="<?= $b['id'] ?>"><?= $b['name'] ?></option>
                             <?php endforeach; ?>
                         </select>
                         <div class="invalid-feedback">
                             Vui lòng chọn nhân viên
                         </div>
                     </div>
                 </div>
                 <div class="row">
                     <div class="col-xl-6 col-md-6 select-service form-group">
                         <select class="mul-select form-control" name="id_service[]" multiple="true" required>
                             <option value="">Chọn dịch vụ</option>
                             <?php foreach ($service as $s) : ?>
                                 <option value="<?= $s['id'] ?>"><?= $s['name'] ?></option>
                             <?php endforeach; ?>
                         </select>
                         <?php if (isset($errors['errors_service'])) : ?>
                                <p class="text-danger mt-2"><?= $errors['errors_service'] ?></p>
                            <?php endif; ?>
                         <div class="invalid-feedback">
                             Vui lòng chọn dịch vụ
                         </div>
                     </div>
                     <div class="col-xl-6 col-md-6 form-group" id="result">
                     <select name="id_time" id="id_time" class="form-control" required>
                        <option value="">Chọn giờ hẹn</option>
                        <?php foreach ($time as $t) : ?>
                                <option value="<?= $t['id'] ?>"><?= $t['time'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback">
                        Vui lòng chọn giờ hẹn
                    </div>
                     </div>
                 </div>
                 <div class="row">
                     <div class="col-xl-6 col-md-6 form-group">
                         <input type="text" name="name" value="<?=isset($name)?$name:''?>" placeholder="Tên của bạn" class="form-control" title="Họ tên không bao gồm số" pattern="[a-zA-Z\s'-'\sáàảãạăâắằấầặẵẫậéèẻ ẽêẹếềểễệóòỏõọôốồổỗộ ơớờởỡợíìỉĩịđùúủũụưứ? ?ửữựÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠ ƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼ? ??ÊỀỂỄỆỈỊỌỎỐỒỔỖỘỚỜỞ ỠỢỤỨỪỬỮỰỲỴÝỶỸửữựỵ ỷỹ]{1,20}" required />
                         <div class="invalid-feedback">
                             Họ tên không đúng định dạng
                         </div>
                     </div>
                     <div class="col-xl-6 col-md-6 form-group">
                         <input type="text" name="phone" value="<?=isset($phone)?$phone:''?>" placeholder="Số điện thoại" class="form-control" pattern="^\+?\d{1,3}?[- .]?\(?(?:\d{2,3})\)?[- .]?\d\d\d[- .]?\d\d\d\d$" required />
                         <?php if (isset($errors['errors_phone'])) : ?>
                                <p class="text-danger mt-2"><?= $errors['errors_phone'] ?></p>
                            <?php endif; ?>
                         <div class="invalid-feedback">
                             SĐT không hợp lệ
                         </div>
                     </div>
                 </div>
                 <div class="row mt-3">
                     <div class="col-xl-12">
                         <button type="submit" name="btnBooking" class="boxed-btn3">Đặt lịch</button>
                     </div>
                 </div>
             </form>
     </div>
 </div>
 <!-- form itself end-->
 
 <!-- form itself end -->
 <!-- form-login -->
 <div id="login-form" class="white-popup-block mfp-hide">
     <div class="popup_box pb-3">
         <div class="popup_inner">
        <div class="flip">
            <div class="card border-0">
                <div class="face front">
            <form class="needs-validation form-contact" action="" method="POST" novalidate>
             <h3>Đăng nhập</h3>
             <div class="row">
                 <div class="col-xl-6 col-md-6">
                     <img src="images/login_image.png" class="img-fluid" alt="">
                 </div>
                 <div class="col-xd-6 col-md-6">
                     <div class="form-group">
                     <input type="text" name="phone" class="form-control"
                         placeholder="Tên đăng nhập" value="<?= isset($phone) ? $phone : '' ?>" autofocus required>
                     <?php if (isset($error['phone'])) : ?>
                     <p class="text-danger mt-2"><?= $error['phone'] ?></p>
                     <?php endif; ?>
                     <div class="invalid-feedback">
                         Vui lòng nhập tên đăng nhập 
                     </div>
                     </div>
                    <div class="form-group">
                    <input type="password" class="form-control" placeholder="Mật khẩu"
                         title="Mật khẩu chứa ít nhất 6 ký tự" name="password" minlength="6" value="<?= isset($password) ? $password : '' ?>" required>
                     <?php if (isset($error['password'])) : ?>
                     <p class="text-danger mt-2"><?= $error['password'] ?></p>
                     <?php endif; ?>
                     <div class="invalid-feedback">
                         Mật khẩu chứa ít nhất 6 ký tự
                     </div>
                    </div>
                     <div class="form-group">
                     <input style="width:auto;height:auto; margin-right: 10px;" id="my-input" type="checkbox"
                         name="rebarber"><label for="my-input">Nhớ đăng nhập</label>
                     </div>
                         <button type="submit" name="btnLogin" class="boxed-btn3 mb-3">Đăng nhập</button>
                         <a href="<?=ROOT?>site/forgot-password.php">Quên mật khẩu?</a>
                     <button type="button" class="btn rounded-0 border-0" data-toggle="flip">Bạn chưa có tài khoản? Đăng ký</button>
                        
                 </div>
             </div>
         </form>
         </div>
         <div class="face back">
         <form class="needs-validation form-contact" action="" method="POST" novalidate enctype="multipart/form-data">
             <h3>Đăng ký</h3>
             <div class="row">
                 <div class="col-xl-6 col-md-6">
                 <div class="form-group">
                            <input type="text" name="name" id="name" class="form-control" pattern="[a-zA-Z\s'-'\sáàảãạăâắằấầặẵẫậéèẻ ẽêẹếềểễệóòỏõọôốồổỗộ ơớờởỡợíìỉĩịđùúủũụưứ? ?ửữựÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠ ƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼ? ??ỀÊỂỄỆỈỊỌỎỐỒỔỖỘỚỜỞ ỠỢỤỨỪỬỮỰỲỴÝỶỸửữựỵ ỷỹ]{1,20}" title="Họ tên không bao gồm số" 
                            placeholder="Nhập họ tên" value="<?= isset($name) ? $name : '' ?>" required>
                            <div class="invalid-feedback">
                                Họ tên không bao gồm số
                            </div>
                            <?php if (isset($errors['errors_name'])) : ?>
                                <p class="text-danger mt-2"><?= $errors['errors_name'] ?></p>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <input type="tel" name="phone" id="phone" class="form-control" pattern="^\+?\d{1,3}?[- .]?\(?(?:\d{2,3})\)?[- .]?\d\d\d[- .]?\d\d\d\d$" placeholder="Nhập số điện thoại" value="<?= isset($phone) ? $phone : '' ?>" required>
                            <div class="invalid-feedback">
                                Số điện thoại không đúng định dạng
                            </div>
                            <?php if (isset($errors['errors_phone'])) : ?>
                                <p class="text-danger mt-2"><?= $errors['errors_phone'] ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <input type="file" class="form-control-file border" id="images" name="images">
                            <?php if (isset($errors['errors_img'])) : ?>
                                <p class="text-danger mt-2"><?= $errors['errors_img'] ?></p>
                            <?php endif; ?>
                        </div>
                 </div>
                 <div class="col-xd-6 col-md-6">
                     <div class="form-group">
                            <input type="password" name="password" id="password" class="form-control" title="Mật khẩu chứa ít nhất 6 ký tự" minlength="6" placeholder="Nhập mật khẩu" value="<?= isset($password) ? $password : '' ?>" required>
                            <div class="invalid-feedback">
                                Mật khẩu chứa ít nhất 6 ký tự
                            </div>
                            <?php if (isset($errors['errors_password'])) : ?>
                                <p class="text-danger mt-2"><?= $errors['errors_password'] ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" id="email" class="form-control" placeholder="Nhập email" value="<?= isset($email) ? $email : '' ?>" required>
                            <div class="invalid-feedback">
                                Địa chỉ email không đúng định dạng
                            </div>
                            <?php if (isset($errors['errors_email'])) : ?>
                                <p class="text-danger mt-2"><?= $errors['errors_email'] ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <input type="text" name="account" id="account" class="form-control" placeholder="Nhập tên tài khoản" value="<?= isset($account) ? $account : '' ?>" required>
                            <div class="invalid-feedback">
                                Vui lòng nhập tên tài khoản
                                </div>
                            <?php if (isset($errors['errors_account'])) : ?>
                                <p class="text-danger mt-2"><?= $errors['errors_account'] ?></p>
                            <?php endif; ?>
                        </div>
              </div>
                 <div class="col-12">
                 <div class="form-group">
                    <textarea class="form-control" minlength="15" name="address" rows="2" placeholder="Địa chỉ..." required><?= isset($address) ? $address : '' ?></textarea>
                    <div class="invalid-feedback">
                    Địa chỉ tối thiểu 15 ký tự
                    </div>
                    <?php if (isset($errors['errors_address'])) : ?>
                        <p class="text-danger mt-2"><?= $errors['errors_address'] ?></p>
                    <?php endif; ?>
                </div>
                 </div>
                 </div>
                <button type="submit" name="btnRegister" class="boxed-btn3 mb-3">Đăng ký</button>
                         <button type="button" class="btn rounded-0 border-0" data-toggle="flip">Bạn đã có tài khoản? Đăng nhập</button>

             </div>
         </form>
         </div>
            </div>
        </div>
         </div>
     </div>
 </div>
 <!-- form-login -->

 <script src="content/js/vendor/jquery-2.1.3.min.js"></script>
 <!-- JS here -->
 <script src="content/js/vendor/modernizr-3.5.0.min.js"></script>
 <!-- <script src="content/js/vendor/jquery-1.12.4.min.js"></script> -->
 <script src="content/js/popper.min.js"></script>
 <script src="content/js/bootstrap.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
 <script src="content/js/owl.carousel.min.js"></script>
 <script src="content/js/isotope.pkgd.min.js"></script>
 <script src="content/js/ajax-form.js"></script>
 <script src="content/js/waypoints.min.js"></script>
 <script src="content/js/jquery.counterup.min.js"></script>
 <script src="content/js/imagesloaded.pkgd.min.js"></script>
 <script src="content/js/scrollIt.js"></script>
 <script src="content/js/jquery.scrollUp.min.js"></script>
 <script src="content/js/wow.min.js"></script>
 <script src="content/js/nice-select.min.js"></script>
 <script src="content/js/jquery.slicknav.min.js"></script>
 <script src="content/js/jquery.magnific-popup.min.js"></script>
 <script src="content/js/plugins.js"></script>
 <script src="content/js/gijgo.min.js"></script>
 <script src="content/js/pgwslideshow.min.js"></script>
 <script src="content/js/toastr.min.js"></script>
 <script src="content/js/jquery.rateit.min.js"></script>
 <!--contact js-->
 <script src="content/js/contact.js"></script>
 <script src="content/js/jquery.ajaxchimp.min.js"></script>
 <script src="content/js/jquery.form.js"></script>
 <script src="content/js/jquery.validate.min.js"></script>
 <script src="content/js/mail-script.js"></script>
 <script src="content/js/bootstrap-input-spinner.js"></script>

 <script src="content/js/main.js"></script>
<?php if(isset($_SESSION['message'])){
  $mes= $_SESSION['message'];
    echo "<script>
    $(function () {
        toastr.success('$mes');
    });
</script>";
} ?>

 <script>
     $(document).ready(function() {
         $(".mul-select").select2({
             placeholder: "Chọn dịch vụ",
             tags: true,
             tokenSeparators: ['/', ',', ',', " "]
         });
         $('#default-select').change(function() {
             var id = $('#default-select').val();
             var day = $('#day').val();
             $.post("site/xulyTime.php", {
                 id: id,
                 day: day
             }, function(data) {
                 $('#result').html(data);
             });
         });
         $('#day').change(function() {
             var id = $('#default-select').val();
             var day = $('#day').val();
             $.post("site/xulyTime.php", {
                 id: id,
                 day: day
             }, function(data) {
                 $('#result').html(data);
             });
         });
         $('#sort').change(function() {
    var sort = $('#sort').val();
    $.post("site/xulySort.php", {
        sort: sort
    }, function(data) {
        $('#list_pro').html(data);
    });
});
$('#sortCate').change(function() {
    var sort = $('#sortCate').val();
    var id = $('#id_cate').val();
    $.post("site/xulySortCate.php", {
        sort: sort,id: id
    }, function(data) {
        $('#list_pro_cate').html(data);
    });
});
$('.flip [data-toggle="flip"]').click(function(){
        $('.card').toggleClass('flipped');

    });
     });
     //Validate form
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