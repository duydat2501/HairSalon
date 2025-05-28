<?php

use PHPMailer\PHPMailer\PHPMailer;
$contact = list_one_contact('id',$_GET['id']);
if (isset($_REQUEST['btnsave'])) {
    extract($_REQUEST);
    //Gửi mail
    require_once "../phpmailer/PHPMailer.php";
    require_once "../phpmailer/SMTP.php";
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
        $mail->addAddress($contact['email'], $contact['name']);

    //Thiết lập email reply
    $mail->addReplyTo($email);

    //Thiết lập tiêu đề
    $mail->Subject = "Trả lời liên hệ";

    //Thiết lập charset
    $mail->CharSet = 'utf-8';

    //Thiết lập nội dung
    $body = '<p>Xin chào,' . $contact['name'] . '</p>
            <p>Cảm ơn bạn đã liên hệ chúng tôi</p>
            <p>' . $content . '</p>';

    $mail->msgHTML($body);
    if ($mail->send() == false) {
        $_SESSION['message'] = 'Error: ' . $mail->ErrorInfo;
    } else {
        $_SESSION['message'] = 'Gửi email thành công';
        insert_reply_contact($content,$_SESSION['user']['id'],$contact['id']);
    }
    header('Location:' . ROOT . 'admin/?page=contact');
    die();
}

?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Trả lời </h6>
        </div>
        <div class="card-body">
        <form action="" method="post" class="needs-validation" novalidate>
                        <div class="form-group">
                            <label for="content">Nội dung</label>
                            <textarea name="content" id="detail" class="form-control" rows="5" required></textarea>
                            <div class="invalid-feedback">
                            Vui lòng nhập nội dung
                                </div>
                            <?php if(isset($errors['errors-content'])): ?>
                            <p class="text-danger mt-2"><?=$errors['errors-content']?></p>
                            <?php endif; ?>
                        </div>
                        <button type="submit" name="btnsave" class="btn btn-primary">Ghi lại</button>
                    </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->