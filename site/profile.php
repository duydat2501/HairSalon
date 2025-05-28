<?php
if (isset($_SESSION['user'])) {
    $user = user_check('id',$_SESSION['user']['id']);
}elseif(isset($_SESSION['barber'])){
    $user = barber_check('id',$_SESSION['barber']['id']);
} else {
    header('location:' . ROOT);
    die();
}
?>
<!-- bradcam_area_start -->
<div class="bradcam_area breadcam_bg overlay">
    <h3>Tài khoản của tôi</h3>
</div>
<!-- bradcam_area_end -->
<div class="section-padding">
    <div class="container">
        <div class="row">
            <div class="col-3 mb-5">
                <div class="avatar_user mb-4">
                    <img src="images/users/<?= $user['images'] ?>" alt="" class="rounded-circle mr-2" width="40" height="40">
                    <strong href="?page=profile&action=profile"><?= $user['name'] ?></strong>
                </div>
                <ul class="app-menu">
                    <li class="treeview"><a class="app-menu_item" href="<?= ROOT ?>?page=profile&action=profile">
                            <i class="fa fa-user-o mr-2" aria-hidden="true"></i>
                            <span class="app-menu_label">Tài khoản của tôi</span></a>
                        <ul class="treeview-menu ml-4">
                            <li><a class="treeview-item" href="<?= ROOT ?>?page=profile&action=profile">Hồ sơ</a></li>
                            <li><a class="treeview-item" href="<?= ROOT ?>?page=profile&action=password">Đổi mật khẩu</a>
                            </li>
                        </ul>
                    </li>
<?php if(isset($_SESSION['user'])): ?>
                    <li>
                        <a class="app-menu_item" href="<?= ROOT ?>?page=profile&action=purchase">
                            <i class="fa fa-book mr-2" aria-hidden="true"></i></i><span class="app-menu_label">Đơn mua</span></a>
                    </li>
<?php endif; ?>
                    <li>
                        <a class="app-menu_item" href="<?= ROOT ?>?page=profile&action=booking">
                            <i class="fa fa-calendar mr-2" aria-hidden="true"></i><span class="app-menu_label">Lịch hẹn</span></a>
                    </li>
                </ul>
            </div>
            <div class="col-9 pl-5">
                <?php
                $action = isset($_GET['action']) ? $_GET['action'] : '';
                switch ($action) {
                    case '':
                    case 'profile':
                        include_once "site/account/profile.php";
                        break;
                    case 'email':
                        include_once "site/account/email.php";
                        break;
                    case 'password':
                        include_once "site/account/password.php";
                        break;
                    case 'phone':
                        include_once "site/account/phone.php";
                        break;
                    case 'purchase':
                        include_once "site/account/purchase.php";
                        break;
                    case 'booking':
                        include_once "site/account/booking.php";
                        break;
                    case 'detail':
                        include_once "site/account/detail_booking.php";
                        break;
                    case 'resetEmail':
                        include_once "site/account/resetEmail.php";
                        break;
                    case 'resetPhone':
                        include_once "site/account/resetPhone.php";
                        break;
                    case 'rating':
                        include_once "site/account/rating.php";
                        break;
                    default:
                        include_once "site/404.php";
                        break;
                }
                ?>
            </div>
        </div>
    </div>
</div>