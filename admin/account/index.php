<?php 
    $user = user_check('id',$_SESSION['user']['id']);
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tài khoản của tôi</h6>
        </div>
        <div class="card-body">
        <div class="section-padding">
        <div class="row">
            <div class="col-2 mb-5">
                <div class="avatar_user mb-4">
                    <img src="../images/users/<?= $user['images'] ?>" alt="" class="rounded-circle mr-2" width="40"
                        height="40">
                    <strong href="?page=profile&action=profile"><?= $user['name'] ?></strong>
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item"><a class="nav_link" href="<?=ROOT?>admin/?page=profile&action=profile">Tài khoản của tôi</a>
                        <ul class="nav flex-column ml-4">
                            <li class="nav-item"><a class="nav_link" href="<?=ROOT?>admin/?page=profile&action=profile">Hồ sơ</a></li>
                            <li class="nav-item"><a class="nav_link" href="<?=ROOT?>admin/?page=profile&action=password">Đổi mật khẩu</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="col-10 pl-5">
                <?php if(isset($_SESSION['message'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Cập nhật dữ liệu thành công!</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php endif; ?>
                <?php
      $action = isset($_GET['action']) ? $_GET['action'] : '';
      switch ($action) {
        case '':
        case 'profile':
          include_once "account/profile.php";
          break;
        case 'email':
          include_once "account/email.php";
          break;
        case 'password':
          include_once "account/password.php";
          break;
        case 'phone':
          include_once "account/phone.php";
          break;
          case 'resetEmail':
            include_once "account/resetEmail.php";
            break; 
            case 'resetPhone':
              include_once "account/resetPhone.php";
              break; 
        default:
          include_once "404.php";
          break;
      }
      ?>
            </div>
        </div>
</div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
