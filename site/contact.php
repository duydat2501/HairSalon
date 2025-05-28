<?php

use PHPMailer\PHPMailer\PHPMailer;

$user = user_list_role(1);
if (isset($_REQUEST['btnContact'])) {
    extract($_REQUEST);
    //Gửi mail
    require_once "phpmailer/PHPMailer.php";
    require_once "phpmailer/SMTP.php";
    $mail = new PHPMailer();
    // Gọi đến lpows smtp
    $mail->isSMTP();

    // $mail->SMTPDebug = 1;  //Hiển thị thông báo trong quá trình kết nối SMTP
    // 1 - Hiển thị message + error
    // 2 - Hiển thị message

    $mail->SMTPAuth     = true;
    $mail->SMTPSecure   = 'ssl';
    $mail->Host         = 'smtp.gmail.com';
    $mail->Port         = 465;
    $mail->Username     = 'dinhdat25012000@gmail.com';
    $mail->Password     = 'hixi xelx bati cebb';


    //Thiết lập thông tin người gửi và mail người gửi
    $mail->setFrom('dinhdat25012000@gmail.com', 'PolyBarber');

    //Thiết lập thông tin người nhận và email người nhận
    foreach ($user as $u) {
        $mail->addAddress($u['email'], $u['account']);
    }

    //Thiết lập email reply
    $mail->addReplyTo($email);

    //Thiết lập tiêu đề
    $mail->Subject = $subject;

    //Thiết lập charset
    $mail->CharSet = 'utf-8';

    //Thiết lập nội dung
    $body = '<p>Xin chào,</p>
            <p>Khách hàng: ' . $name . '</p>
            <p>Email: ' . $email . '</p>
            <p>Số điện thoại: ' . $phone . '</p>
            <p>Đã có ý kiến với nội dung: ' . $content . '</p>';

    $mail->msgHTML($body);
    if ($mail->send() == false) {
        $_SESSION['message'] = 'Error: ' . $mail->ErrorInfo;
    } else {
        $_SESSION['message'] = 'Gửi liên hệ thành công! Chúng tôi sẽ phản hồi lại sớm.';
        insert_contact($content,$name,$phone,$email);
    }
    header('location:' . $_SERVER['REQUEST_URI']);
    die();
}

?>
<!-- bradcam_area_start -->
<div class="bradcam_area breadcam_bg overlay">
    <h3>Liên hệ</h3>
</div>
<!-- bradcam_area_end -->

<!-- ================ contact section start ================= -->
<section class="contact-section">

    <div class="container">
        <div>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.095979590172!2d105.8023950148835!3d21.02884528599835!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab421ebbe0af%3A0xc932e99ea855cbbb!2zMTU0IMSQxrDhu51uZyBD4bqndSBHaeG6pXksIEzDoW5nIFRoxrDhu6NuZywgQmEgxJDDrG5oLCBIw6AgTuG7mWksIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1597290327701!5m2!1svi!2s" width="100%" height="600" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        </div>
        <div class="row mt-5">
            <div class="col-12">
                <h2 class="contact-title">Liên hệ chúng tôi</h2>
            </div>
            <div class="col-lg-8">
                <form class="form-contact contact_form needs-validation" action="" method="post" novalidate>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <textarea class="form-control w-100" minlength="10" name="content" id="content" cols="30" rows="9" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nhập góp ý của bạn'" placeholder="Góp ý" required></textarea>
                                <div class="invalid-feedback">
                                    Vui lòng nhập nội dung
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input class="form-control" name="name" id="name" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Họ tên'" placeholder="Họ tên" title="Họ tên không bao gồm số" pattern="[a-zA-Z\s'-'\sáàảãạăâắằấầặẵẫậéèẻ ẽêẹếềểễệóòỏõọôốồổỗộ ơớờởỡợíìỉĩịđùúủũụưứ? ?ửữựÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠ ƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼ? ??ÊỀỂỄỆỈỊỌỎỐỒỔỖỘỚỜỞ ỠỢỤỨỪỬỮỰỲỴÝỶỸửữựỵ ỷỹ]{1,20}" required>
                                <div class="invalid-feedback">
                                    Họ tên không đúng định dạng
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input class="form-control" name="email" id="email" type="email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nhập địa chỉ email'" placeholder="Email" required>
                                <div class="invalid-feedback">
                                    Email không đúng định dạng
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <input class="form-control" name="subject" id="subject" type="text" minlength="5" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Tiêu đề thông điệp'" placeholder="Tiêu đề thông điệp" required>
                                <div class="invalid-feedback">
                                    Vui lòng nhập tiêu đề
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input class="form-control" name="phone" id="phone" type="text" pattern="^\+?\d{1,3}?[- .]?\(?(?:\d{2,3})\)?[- .]?\d\d\d[- .]?\d\d\d\d$" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nhập số điện thoại'" placeholder="Số điện thoại" required>
                                <div class="invalid-feedback">
                                    Số điện thoại không đúng định dạng
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <button type="submit" name="btnContact" class="button button-contactForm boxed-btn">Gửi</button>
                    </div>
                </form>
            </div>
            <div class="col-lg-3 offset-lg-1">
                <div class="media contact-info">
                    <span class="contact-info__icon"><i class="ti-home"></i></span>
                    <div class="media-body">
                        <h3>154, Cầu Giấy, Hà Nội.</h3>
                        <p>Rosemead, CA 91770</p>
                    </div>
                </div>
                <div class="media contact-info">
                    <span class="contact-info__icon"><i class="ti-tablet"></i></span>
                    <div class="media-body">
                        <h3>+1 253 565 2365</h3>
                        <p>Tất cả các ngày trong tuần</p>
                    </div>
                </div>
                <div class="media contact-info">
                    <span class="contact-info__icon"><i class="ti-email"></i></span>
                    <div class="media-body">
                        <h3>contact@barbershop.com</h3>
                        <p>Liên hệ chúng tôi mọi lúc</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ================ contact section end ================= -->