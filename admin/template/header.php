<?php $setting = list_limit_setting(); ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?=$setting['title']?></title>
    <link rel="shortcut icon" type="image/x-icon" href="../images/<?=$setting['file_ico']?>" />
    <!-- Custom fonts for this template-->
    <link href="resource/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="resource/vendor/select2.min.css" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- Custom styles for this template-->
    <link href="resource/css/sb-admin-2.css" rel="stylesheet">
    <link href="resource/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center mb-3 pt-5" href="<?=ROOT?>admin">
                <img src="../images/<?=$setting['logo']?>" alt="logo" width="90" height="70">
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="<?= ROOT ?>admin">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Bản tin</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">


            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Dịch vụ</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="<?= ROOT ?>admin/?page=type">Quản lý loại dịch vụ</a>
                        <a class="collapse-item" href="<?= ROOT ?>admin/?page=service">Quản lý dịch vụ</a>
                        <a class="collapse-item" href="<?= ROOT ?>admin/?page=time">Quản lý khung giờ</a>
                    </div>
                </div>
            </li>

                <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="<?= ROOT ?>admin/?page=appointment">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Lịch hẹn</span></a>
            </li>
             <!-- Nav Item - Pages Collapse Menu -->
             <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages2" aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Thành viên</span>
                </a>
                <div id="collapsePages2" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="<?= ROOT ?>admin/?page=user">Quản lý người dùng</a>
                        <a class="collapse-item" href="<?= ROOT ?>admin/?page=barber">Quản lý thợ cắt</a>
                    </div>
                </div>
            </li>
             <!-- Nav Item - Pages Collapse Menu -->
             <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages3" aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Phản hồi</span>
                </a>
                <div id="collapsePages3" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="<?= ROOT ?>admin/?page=comment">Bình luận sản phẩm</a>
                        <a class="collapse-item" href="<?= ROOT ?>admin/?page=evaluate">Đánh giá dịch vụ</a>
                        <a class="collapse-item" href="<?= ROOT ?>admin/?page=contact">Quản lý liên hệ</a>
                    </div>
                </div>
            </li>
               <!-- Nav Item - Charts -->
               <li class="nav-item">
                <a class="nav-link" href="<?= ROOT ?>admin/?page=new">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Tin tức</span></a>
            </li>
  <!-- Nav Item - Charts -->
  <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages4" aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Thư viện ảnh</span>
                </a>
                <div id="collapsePages4" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="<?= ROOT ?>admin/?page=slider">Quản lý slider</a>
                        <a class="collapse-item" href="<?= ROOT ?>admin/?page=hair">Quản lý mẫu tóc</a>
                    </div>
                </div>
            </li>
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="far fa-file-alt"></i>
                    <span>Sản phẩm</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="<?= ROOT ?>admin/?page=category">Quản lý danh mục</a>
                        <a class="collapse-item" href="<?= ROOT ?>admin/?page=product">Quản lý sản phẩm</a>
                    </div>
                </div>
            </li>
           
               <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="<?= ROOT ?>admin/?page=order">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Hóa đơn</span></a>
            </li>
            
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo1" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="far fa-file-alt"></i>
                    <span>Thống kê</span>
                </a>
                <div id="collapseTwo1" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="<?= ROOT ?>admin/?page=statistic&action=product">Thống kê sản phẩm</a>
                        <a class="collapse-item" href="<?= ROOT ?>admin/?page=statistic&action=comment">Thống kê bình luận</a>
                        <a class="collapse-item" href="<?= ROOT ?>admin/?page=statistic&action=service">Thống kê dịch vụ</a>
                    </div>
                </div>
            </li>
               <!-- Nav Item - Charts -->
               <li class="nav-item">
                <a class="nav-link" href="<?= ROOT ?>admin/?page=setting">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Quản lý website</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" method="POST" action="<?= ROOT ?>admin/search.php">
                        <div class="input-group">
                            <input name="keyword" type="text" title="Vui lòng nhập nội dung tìm kiếm" class="form-control bg-light border-0 small" placeholder="Tìm kiếm..." aria-label="Search" aria-describedby="basic-addon2" required>
                            <select name="select_search" id="" class="form-control form-control-sm select-search">
                        <option value="1">Sản phẩm</option>
                        <option value="2">Dịch vụ</option>
                        <option value="3">Tin tức</option>
                        <option value="4">Thợ cắt</option>
                        <option value="5">Người dùng</option>
                        <option value="6">Danh mục</option>
                    </select>
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search" method="POST">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                        <li class="nav-item no-arrow">
                            <a href="<?=ROOT?>" class="nav-link bg-success text-white h-50 mt-3 rounded"><i class="fas fa-calendar-alt mr-2"></i>Xem trang web</a>
                        </li>
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"></span>
                                <img class="img-profile rounded-circle" src="../images/users/<?=$_SESSION['user']['images']?>">
                                <span class="ml-2 mr-2 text-black-50"><?=$_SESSION['user']['account']?></span>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="<?= ROOT ?>admin/?page=profile">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Tài khoản
                                </a>
                                <a class="dropdown-item" href="<?= ROOT ?>admin/?page=setting">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Cài đặt
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= ROOT ?>?page=logout" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Đăng xuất
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->