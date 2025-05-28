<?php
require_once "site/login.php";
require_once "site/booking.php";
extract($_REQUEST);
if(isset($_GET['page'])){
    $page=$_GET['page'];
}
//dat lich hen 
$type = list_all_type();
$barber = barber_list_all();
$service = service_list_all();
// $users = custom_list_all();
$date = date_create();
$time = list_all_time();
$setting = list_limit_setting();
 ?>

<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title><?=isset($title)?$title.'-':''?><?=$setting['title']?></title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="shortcut icon" type="image/x-icon" href="images/<?=$setting['file_ico']?>" />
    <!-- Place favicon.ico in the root directory -->
   

    <!-- CSS here -->
    <link rel="stylesheet" href="content/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" />
    <link rel="stylesheet" href="content/css/toastr.min.css" />
    <link rel="stylesheet" href="content/css/owl.carousel.min.css" />
    <link rel="stylesheet" href="content/css/magnific-popup.css" />
    <link rel="stylesheet" href="content/css/font-awesome.min.css" />
    <link rel="stylesheet" href="content/css/themify-icons.css" />
    <link rel="stylesheet" href="content/css/nice-select.css" />
    <link rel="stylesheet" href="content/css/flaticon.css" />
    <link rel="stylesheet" href="content/css/gijgo.css" />
    <link rel="stylesheet" href="content/css/animate.css" />
    <link rel="stylesheet" href="content/css/slicknav.css" />
    <link rel="stylesheet" href="content/css/pgwslideshow.min.css">
    <link rel="stylesheet" href="content/css/rateit.css">
    <link rel="stylesheet" href="content/css/style.css" />
    <!-- <link rel="stylesheet" href="content/css/responsive.css"> -->
</head>

<body>
    <!-- header-start -->
    <header>
        <div class="header-area ">
            <div id="sticky-header" class="main-header-area">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-2 col-lg-2">
                            <div class="logo-img">
                                <a href="<?= ROOT ?>">
                                    <img src="images/<?=$setting['logo']?>" alt="" width="100" height="80">
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-10 col-lg-10">
                            <div class="menu_wrap d-none d-lg-block">
                                <div class="menu_wrap_inner d-flex align-items-center justify-content-end">
                                    <div class="main-menu">
                                        <nav>
                                            <ul id="navigation" class="mt-3">
                                                <li><a class="<?= ($page == 'home' || $page == '') ? 'active' : '' ?>" href="<?= ROOT ?>">Trang chủ</a></li>
                                                <li><a class="<?= ($page == 'introduce') ? 'active' : '' ?>" href="<?= ROOT ?>?page=introduce">Giới thiệu</a></li>
                                                <li><a class="<?= ($page == 'service' || $page == 'service-list') ? 'active' : '' ?>" href="<?= ROOT ?>?page=service">Dịch vụ</a>
                                                <ul class="submenu">
                                                    <?php foreach($type as $t): ?>
													<li><a href="<?=ROOT?>?page=service-list&id=<?=$t['id']?>"><img src="images/categories/<?=$t['images']?>" class="mr-2" alt="" width="20" height="20"><?=$t['name']?></a></li>
                                                    <?php endforeach; ?>
												</ul>
                                            </li>
                                                <li><a class="<?= ($page == 'product-list' || $page == 'pro-list' || $page == 'product-detail') ? 'active' : '' ?>" href="<?= ROOT ?>?page=product-list">Sản phẩm</a></li>
                                                <li><a class="<?= ($page == 'blog' || $page == 'blog-detail') ? 'active' : '' ?>" href="<?= ROOT ?>?page=blog">Tin tức</a></li>
                                                <li><a class="<?= ($page == 'contact') ? 'active' : '' ?>" href="<?= ROOT ?>?page=contact">Liên hệ</a></li>
                                            </ul>
                                        </nav>
                                    </div>

                                    <div class="icon cart-icon">
                                        <a href="<?=ROOT?>?page=cart"><i class="fa fa-shopping-bag text-white ml-2" aria-hidden="true"></i><span class="bag">
                                            <?php if(isset($_SESSION['user'])): ?>
                                                <?= isset($_SESSION['cartCustom'][$_SESSION['user']['id']]) ? total_item($_SESSION['cartCustom'][$_SESSION['user']['id']]) : 0; ?>
                                            <?php else: ?>
                                        <?= isset($_SESSION['cart']) ? total_item($_SESSION['cart']) : 0; ?>
                                            <?php endif; ?>
                                        </span></a>
                                    </div>
                                    <?php if(isset($_SESSION['user'])): ?> 
                                    <div class="dropdown no-arrow mr-1">
                                        <button type="button" class="btn bg-transparent p-0 ml-2 dropdown-toggle text-white" id="dropdownMenuOffset" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-offset="0,20">
                                        <i class="fa fa-user-o ml-2" aria-hidden="true"></i>
                                        <?=$_SESSION['user']['account'] ?>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuOffset">
                                            <?php if($_SESSION['user']['role'] == 1): ?>
                                            <a class="dropdown-item" href="<?=ROOT?>admin">Trang quản trị</a>
                                            <?php endif; ?>
                                            <a class="dropdown-item" href="<?=ROOT?>?page=profile&action=profile">Tài khoản của tôi</a>
                                            <a class="dropdown-item" href="<?=ROOT?>?page=profile&action=booking">Lịch hẹn</a>
                                            <a class="dropdown-item" href="<?=ROOT?>?page=logout">Đăng xuất</a>
                                        </div>
                                    </div>
                                    <?php elseif(isset($_SESSION['barber'])): ?>
                                        <div class="dropdown no-arrow mr-1">
                                        <button type="button" class="btn bg-transparent p-0 ml-2 dropdown-toggle text-white" id="dropdownMenuOffset" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-offset="0,20">
                                        <i class="fa fa-user-o ml-2" aria-hidden="true"></i>
                                        <?=$_SESSION['barber']['name'] ?>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuOffset">
                                            <a class="dropdown-item" href="<?=ROOT?>?page=profile&action=profile">Tài khoản của tôi</a>
                                            <a class="dropdown-item" href="<?=ROOT?>?page=profile&action=booking">Lịch hẹn</a>
                                            <a class="dropdown-item" href="<?=ROOT?>?page=logout">Đăng xuất</a>
                                        </div>
                                    </div>
                                    <?php else: ?>                        
                                    <a href="#login-form" class="popup-with-form text-white text-uppercase ml-3 mt-1">Đăng nhập</a>
                                    <?php endif; ?>
                                    <div class="book_room">
                                        <div class="book_btn">
                                            <a class="popup-with-form" href="#test-form">Đặt lịch ngay</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header-end -->