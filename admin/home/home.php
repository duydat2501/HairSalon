<?php
$barber = count_row('barbers');
$user = count_row('users');
$service = count_row('services');
$appointments = count_row('appointments');
$product = count_row('products');
$orders = count_row('orders');
$category = count_row('categories');
$news = count_row('news');
$appointment = list_all_appointment();
$app_com = appointment_list_cancel('0');
$app_cancel = appointment_list_cancel('4');
$order = list_all_order();
$order_wait =list_status_order('Chờ lấy hàng');
$order_delivery = list_status_order('Đang giao');
$order_delivered = list_status_order('Đã giao');
$order_cancelled =list_status_order('Đã hủy');
?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Bảng tin</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="bg-success p-3 text-white rounded-top">
                <div class="row">
                    <div class="col-6">
                        <i class="fas fa-users icon-3x"></i>
                    </div>
                    <div class="col-6 text-right">
                        <p class="qty-3x"><?= $barber ?></p>
                       Thợ cắt
                    </div>
                </div>
            </div>
            <div class="bg-gray-200 border-top p-3 rounded-bottom">
                <div class="row">
                    <div class="col-6"><a href="<?= ROOT ?>/admin/?page=barber" class="text-success">Xem chi tiết</a></div>
                    <div class="col-6 text-right"><a href="<?= ROOT ?>/admin/?page=barber" class="text-success"><i class="fas fa-arrow-alt-circle-right"></i></a></div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="bg-primary p-3 text-white rounded-top">
                <div class="row">
                    <div class="col-6">
                        <i class="fas fa-cut icon-3x"></i></i>
                    </div>
                    <div class="col-6 text-right">
                        <p class="qty-3x"><?= $service ?></p>
                        Dịch vụ
                    </div>
                </div>
            </div>
            <div class="bg-gray-200 border-top p-3 rounded-bottom">
                <div class="row">
                    <div class="col-6"><a href="<?= ROOT ?>/admin/?page=service" class="text-primary">Xem chi tiết</a></div>
                    <div class="col-6 text-right"><a href="<?= ROOT ?>/admin/?page=service" class="text-primary"><i class="fas fa-arrow-alt-circle-right"></i></a></div>
                </div>
            </div>
        </div>
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="bg-warning p-3 text-white rounded-top">
                <div class="row">
                    <div class="col-6">
                        <i class="fas fa-users icon-3x"></i>
                    </div>
                    <div class="col-6 text-right">
                        <p class="qty-3x"><?= $user ?></p>
                        Người dùng
                    </div>
                </div>
            </div>
            <div class="bg-gray-200 border-top p-3 rounded-bottom">
                <div class="row">
                    <div class="col-6"><a href="<?= ROOT ?>/admin/?page=user" class="text-warning">Xem chi tiết</a></div>
                    <div class="col-6 text-right"><a href="<?= ROOT ?>/admin/?page=user" class="text-warning"><i class="fas fa-arrow-alt-circle-right"></i></a></div>
                </div>
            </div>
        </div>
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="bg-danger p-3 text-white rounded-top">
                <div class="row">
                    <div class="col-6">
                        <i class="far fa-calendar-alt icon-3x"></i>
                    </div>
                    <div class="col-6 text-right">
                        <p class="qty-3x"><?= $appointments ?></p>
                        Lịch hẹn
                    </div>
                </div>
            </div>
            <div class="bg-gray-200 border-top p-3 rounded-bottom">
                <div class="row">
                    <div class="col-6"><a href="<?= ROOT ?>/admin/?page=appointment" class="text-danger">Xem chi tiết</a></div>
                    <div class="col-6 text-right"><a href="<?= ROOT ?>/admin/?page=appointment" class="text-danger"><i class="fas fa-arrow-alt-circle-right"></i></a></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">

<!-- Earnings (Monthly) Card Example -->

<div class="col-xl-3 col-md-6 mb-4">
    <div class="bg-danger p-3 text-white rounded-top">
        <div class="row">
            <div class="col-6">
            <i class="fas fa-file-invoice icon-3x"></i>
            </div>
            <div class="col-6 text-right">
                <p class="qty-3x"><?= $orders ?></p>
                Hóa đơn
            </div>
        </div>
    </div>
    <div class="bg-gray-200 border-top p-3 rounded-bottom">
        <div class="row">
            <div class="col-6"><a href="<?= ROOT ?>/admin/?page=order" class="text-danger">Xem chi tiết</a></div>
            <div class="col-6 text-right"><a href="<?= ROOT ?>/admin/?page=order" class="text-danger"><i class="fas fa-arrow-alt-circle-right"></i></a></div>
        </div>
    </div>
</div>
<!-- Earnings (Monthly) Card Example -->

<div class="col-xl-3 col-md-6 mb-4">
    <div class="bg-success p-3 text-white rounded-top">
        <div class="row">
            <div class="col-6">
            <i class="fas fa-book icon-3x"></i>
            </div>
            <div class="col-6 text-right">
                <p class="qty-3x"><?= $category ?></p>
                Danh mục
            </div>
        </div>
    </div>
    <div class="bg-gray-200 border-top p-3 rounded-bottom">
        <div class="row">
            <div class="col-6"><a href="<?= ROOT ?>/admin/?page=category" class="text-success">Xem chi tiết</a></div>
            <div class="col-6 text-right"><a href="<?= ROOT ?>/admin/?page=category" class="text-success"><i class="fas fa-arrow-alt-circle-right"></i></a></div>
        </div>
    </div>
</div>
<div class="col-xl-3 col-md-6 mb-4">
    <div class="bg-primary p-3 text-white rounded-top">
        <div class="row">
            <div class="col-6">
            <i class="fas fa-newspaper icon-3x"></i>
            </div>
            <div class="col-6 text-right">
                <p class="qty-3x"><?= $news ?></p>
                Tin tức
            </div>
        </div>
    </div>
    <div class="bg-gray-200 border-top p-3 rounded-bottom">
        <div class="row">
            <div class="col-6"><a href="<?= ROOT ?>/admin/?page=new" class="text-primary">Xem chi tiết</a></div>
            <div class="col-6 text-right"><a href="<?= ROOT ?>/admin/?page=new" class="text-primary"><i class="fas fa-arrow-alt-circle-right"></i></a></div>
        </div>
    </div>
</div>
<!-- Earnings (Monthly) Card Example -->
<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="bg-warning p-3 text-white rounded-top">
        <div class="row">
            <div class="col-6">
            <i class="fab fa-product-hunt icon-3x"></i>
            </div>
            <div class="col-6 text-right">
                <p class="qty-3x"><?= $product ?></p>
                Sản phẩm
            </div>
        </div>
    </div>
    <div class="bg-gray-200 border-top p-3 rounded-bottom">
        <div class="row">
            <div class="col-6"><a href="<?= ROOT ?>/admin/?page=product" class="text-warning">Xem chi tiết</a></div>
            <div class="col-6 text-right"><a href="<?= ROOT ?>/admin/?page=product" class="text-warning"><i class="fas fa-arrow-alt-circle-right"></i></a></div>
        </div>
    </div>
</div>

</div>
    <!-- Lịch hẹn  -->

    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Lịch hẹn sắp tới</a>
            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Tất cả lịch hẹn</a>
            <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Lịch hẹn đã hủy</a>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <form action="<?= ROOT ?>/admin/?page=appointment" method="POST" class="col-md-12">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>
                                            <input type="checkbox" name="checkall" class="checkall">
                                        </th>
                                        <th>Mã lịch hẹn</th>
                                        <th>Thợ cắt</th>
                                        <th>Tên khách hàng</th>
                                        <th>Số điện thoại</th>
                                        <th>Ngày cắt</th>
                                        <th>Thời gian bắt đầu</th>
                                        <th>Trạng thái</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>
                                            <input type="checkbox" name="checkall" class="checkall">
                                        </th>
                                        <th>Mã lịch hẹn</th>
                                        <th>Thợ cắt</th>
                                        <th>Tên khách hàng</th>
                                        <th>Số điện thoại</th>
                                        <th width=100>Ngày cắt</th>
                                        <th>Thời gian bắt đầu</th>
                                        <th>Trạng thái</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php foreach ($app_com as $ac) : ?>
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="id[]" id="" value="<?= $ac['id'] ?>">
                                            </td>
                                            <td><?= $ac['id'] ?></td>
                                            <td><?= $ac['account'] ?></td>
                                            <td><?= $ac['name'] ?></td>
                                            <td><?= $ac['phone'] ?></td>
                                            <td><?= $ac['day'] ?></td>
                                            <td><?= $ac['time'] ?></td>
                                            <?php if($ac['cancel']==0): ?>
                                    <td>Sắp tới</td>
                                    <?php elseif($ac['cancel']==1): ?>
                                        <td>Chờ phục vụ</td>
                                        <?php elseif($ac['cancel']==2): ?>
                                        <td>Đang phục vụ</td>
                                        <?php elseif($ac['cancel']==3): ?>
                                        <td>Hoàn thành</td>
                                        <?php elseif($ac['cancel']==4): ?>
                                        <td>Đã hủy lịch</td>
                                    <?php endif; ?>
                                            <td>
                                                <a href="<?= ROOT ?>admin/?page=appointment&action=detail&id=<?= $ac['id'] ?>" class="btn btn-primary  d-block p-2 w-75 mb-2"><i class="fas fa-info-circle"></i></a>
                                                <a href="<?= ROOT ?>admin/?page=appointment&id=<?= $ac['id'] ?>" onclick="return confirm('Bạn có chắc muốn xóa không')" class="btn btn-danger  d-block p-2 w-75 mb-2"><i class="far fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-primary" id="btndel-appointment" name="btn-del">Xóa mục đánh dấu</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <form action="<?= ROOT ?>/admin/?page=appointment" method="POST" class="col-md-12">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>
                                            <input type="checkbox" name="checkall" class="checkall">
                                        </th>
                                        <th>Mã lịch hẹn</th>
                                        <th>Thợ cắt</th>
                                        <th>Tên khách hàng</th>
                                        <th>Số điện thoại</th>
                                        <th>Ngày cắt</th>
                                        <th>Thời gian bắt đầu</th>
                                        <th>Trạng thái</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>
                                            <input type="checkbox" name="checkall" class="checkall">
                                        </th>
                                        <th>Mã lịch hẹn</th>
                                        <th>Thợ cắt</th>
                                        <th>Tên khách hàng</th>
                                        <th>Số điện thoại</th>
                                        <th>Ngày cắt</th>
                                        <th>Thời gian bắt đầu</th>
                                        <th>Trạng thái</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php foreach ($appointment as $a) : ?>
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="id[]" id="" value="<?= $a['id'] ?>">
                                            </td>
                                            <td><?= $a['id'] ?></td>
                                            <td><?= $a['account'] ?></td>
                                            <td><?= $a['name'] ?></td>
                                            <td><?= $a['phone'] ?></td>
                                            <td><?= $a['day'] ?></td>
                                            <td><?= $a['time'] ?></td>
                                            <?php if($a['cancel']==0): ?>
                                    <td>Sắp tới</td>
                                    <?php elseif($a['cancel']==1): ?>
                                        <td>Chờ phục vụ</td>
                                        <?php elseif($a['cancel']==2): ?>
                                        <td>Đang phục vụ</td>
                                        <?php elseif($a['cancel']==3): ?>
                                        <td>Hoàn thành</td>
                                        <?php elseif($a['cancel']==4): ?>
                                        <td>Đã hủy lịch</td>
                                    <?php endif; ?>
                                            <td>
                                                <a href="<?= ROOT ?>admin/?page=appointment&action=detail&id=<?= $a['id'] ?>" class="btn btn-primary"><i class="fas fa-info-circle"></i></a>
                                                <a href="<?= ROOT ?>admin/?page=appointment&id=<?= $a['id'] ?>" onclick="return confirm('Bạn có chắc muốn xóa không')" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-primary" id="btndel-appointment" name="btn-del">Xóa mục đánh dấu</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <form action="<?= ROOT ?>/admin/?page=appointment" method="POST" class="col-md-12">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>
                                            <input type="checkbox" name="checkall" class="checkall">
                                        </th>
                                        <th>Mã lịch hẹn</th>
                                        <th>Thợ cắt</th>
                                        <th>Tên khách hàng</th>
                                        <th>Số điện thoại</th>
                                        <th>Ngày cắt</th>
                                        <th>Thời gian bắt đầu</th>
                                        <th>Trạng thái</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>
                                            <input type="checkbox" name="checkall" class="checkall">
                                        </th>
                                        <th>Mã lịch hẹn</th>
                                        <th>Thợ cắt</th>
                                        <th>Tên khách hàng</th>
                                        <th>Số điện thoại</th>
                                        <th>Ngày cắt</th>
                                        <th>Thời gian bắt đầu</th>
                                        <th>Trạng thái</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php foreach ($app_cancel as $cancel) : ?>
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="id[]" id="" value="<?= $cancel['id'] ?>">
                                            </td>
                                            <td><?= $cancel['id'] ?></td>
                                            <td><?= $cancel['account'] ?></td>
                                            <td><?= $cancel['name'] ?></td>
                                            <td><?= $cancel['phone'] ?></td>
                                            <td><?= $cancel['day'] ?></td>
                                            <td><?= $cancel['time'] ?></td>
                                            <?php if($cancel['cancel']==0): ?>
                                    <td>Sắp tới</td>
                                    <?php elseif($cancel['cancel']==1): ?>
                                        <td>Chờ phục vụ</td>
                                        <?php elseif($cancel['cancel']==2): ?>
                                        <td>Đang phục vụ</td>
                                        <?php elseif($cancel['cancel']==3): ?>
                                        <td>Hoàn thành</td>
                                        <?php elseif($cancel['cancel']==4): ?>
                                        <td>Đã hủy lịch</td>
                                    <?php endif; ?>
                                            <td>
                                                <a href="<?= ROOT ?>admin/?page=appointment&action=detail&id=<?= $cancel['id'] ?>" class="btn btn-primary"><i class="fas fa-info-circle"></i></a>
                                                <a href="<?= ROOT ?>admin/?page=appointment&id=<?= $cancel['id'] ?>" onclick="return confirm('Bạn có chắc muốn xóa không')" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-primary" id="btndel-appointment" name="btn-del">Xóa mục đánh dấu</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <h2>Danh sách đơn hàng</h2>
    <!-- Bang don hang  -->
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-item nav-link" id="order-all" data-toggle="tab" href="#all" role="tab" aria-controls="all" aria-selected="true">Tất cả đơn hàng</a>
            <a class="nav-item nav-link active" id="order-wait" data-toggle="tab" href="#wait" role="tab" aria-controls="wait" aria-selected="true">Chờ lấy hàng</a>
            <a class="nav-item nav-link" id="order-delivery" data-toggle="tab" href="#delivery" role="tab" aria-controls="delivery" aria-selected="false">Đang giao</a>
            <a class="nav-item nav-link" id="order-delivered" data-toggle="tab" href="#delivered" role="tab" aria-controls="delivered" aria-selected="false">Đã giao</a>
            <a class="nav-item nav-link" id="order-cancelled" data-toggle="tab" href="#cancelled" role="tab" aria-controls="cancelled" aria-selected="false">Đã hủy</a>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="wait" role="tabpanel" aria-labelledby="order-wait">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <form action="<?=ROOT?>/admin/?page=order" method="POST" class="col-md-12">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>
                                            <input type="checkbox" name="checkall" class="checkall">
                                        </th>
                                        <th>Mã đơn hàng</th>
                                        <th>Tên khách hàng</th>
                                        <th>Số điện thoại</th>
                                        <th>Địa chỉ nhận hàng</th>
                                        <th>Trạng thái</th>
                                        <th>Ngày mua</th>
                                        <th>Tổng tiền</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>
                                            <input type="checkbox" name="checkall" class="checkall">
                                        </th>
                                        <th>Mã đơn hàng</th>
                                        <th>Tên khách hàng</th>
                                        <th>Số điện thoại</th>
                                        <th>Địa chỉ nhận hàng</th>
                                        <th>Trạng thái</th>
                                        <th>Ngày mua</th>
                                        <th>Tổng tiền</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php foreach ($order_wait as $wait) : ?>
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="id[]" id="" value="<?= $wait['id'] ?>">
                                            </td>
                                            <td><?= $wait['id'] ?></td>
                                            <td><?= $wait['name'] ?></td>
                                            <td><?= $wait['phone'] ?></td>
                                            <td><?= $wait['address'] ?></td>
                                            <td><?= $wait['status'] ?></td>
                                            <td><?= $wait['created_at'] ?></td>
                                            <?php $detail = list_all_detail($wait['id']);
                                            $total = 0;
                                            foreach ($detail as $d) {
                                                $price_new = $d['price'] - ($d['price'] * $d['sale']);
                                                $total += $d['quantity'] * $price_new;
                                            }
                                            ?>
                                            <td><?= number_format($total, 0, ',', '.') . ' đ'; ?></td>
                                            <td>
                                                <a href="<?= ROOT ?>admin/?page=order&action=edit&id=<?= $wait['id'] ?>" class="btn btn-success d-block p-2 w-75 mb-2"><i class="far fa-edit"></i></a>
                                                <a href="<?= ROOT ?>admin/?page=order&action=detail&id=<?= $wait['id'] ?>" class="btn btn-primary d-block p-2 w-75 mb-2"><i class="fas fa-info-circle"></i></a>
                                                <a href="<?= ROOT ?>admin/?page=order&id=<?= $wait['id'] ?>" onclick="return confirm('Bạn có chắc muốn xóa không')" class="btn btn-danger d-block p-2 w-75 mb-2"><i class="far fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-primary" id="btndel-category" name="btn-del">Xóa mục đánh dấu</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="all" role="tabpanel" aria-labelledby="order-all"><div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <form action="<?=ROOT?>/admin/?page=order" method="POST" class="col-md-12">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>
                                            <input type="checkbox" name="checkall" class="checkall">
                                        </th>
                                        <th>Mã đơn hàng</th>
                                        <th>Tên khách hàng</th>
                                        <th>Số điện thoại</th>
                                        <th>Địa chỉ nhận hàng</th>
                                        <th>Trạng thái</th>
                                        <th>Ngày mua</th>
                                        <th>Tổng tiền</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>
                                            <input type="checkbox" name="checkall" class="checkall">
                                        </th>
                                        <th>Mã đơn hàng</th>
                                        <th>Tên khách hàng</th>
                                        <th>Số điện thoại</th>
                                        <th>Địa chỉ nhận hàng</th>
                                        <th>Trạng thái</th>
                                        <th>Ngày mua</th>
                                        <th>Tổng tiền</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php foreach ($order as $o) : ?>
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="id[]" id="" value="<?= $o['id'] ?>">
                                            </td>
                                            <td><?= $o['id'] ?></td>
                                            <td><?= $o['name'] ?></td>
                                            <td><?= $o['phone'] ?></td>
                                            <td><?= $o['address'] ?></td>
                                            <td><?= $o['status'] ?></td>
                                            <td><?= $o['created_at'] ?></td>
                                            <?php $detail = list_all_detail($o['id']);
                                            $total = 0;
                                            foreach ($detail as $d) {
                                                $price_new = $d['price'] - ($d['price'] * $d['sale']);
                                                $total += $d['quantity'] * $price_new;
                                            }
                                            ?>
                                            <td><?= number_format($total, 0, ',', '.') . ' đ'; ?></td>
                                            <td>
                                                <a href="<?= ROOT ?>admin/?page=order&action=edit&id=<?= $o['id'] ?>" class="btn btn-success d-block p-2 w-75 mb-2"><i class="far fa-edit"></i></a>
                                                <a href="<?= ROOT ?>admin/?page=order&action=detail&id=<?= $o['id'] ?>" class="btn btn-primary d-block p-2 w-75 mb-2"><i class="fas fa-info-circle"></i></a>
                                                <a href="<?= ROOT ?>admin/?page=order&id=<?= $o['id'] ?>" onclick="return confirm('Bạn có chắc muốn xóa không')" class="btn btn-danger d-block p-2 w-75 mb-2"><i class="far fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-primary" id="btndel-category" name="btn-del">Xóa mục đánh dấu</button>
                        </form>
                    </div>
                </div>
            </div></div>
        <div class="tab-pane fade" id="delivery" role="tabpanel" aria-labelledby="order-delivery">
        <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <form action="<?=ROOT?>/admin/?page=order" method="POST" class="col-md-12">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>
                                            <input type="checkbox" name="checkall" class="checkall">
                                        </th>
                                        <th>Mã đơn hàng</th>
                                        <th>Tên khách hàng</th>
                                        <th>Số điện thoại</th>
                                        <th>Địa chỉ nhận hàng</th>
                                        <th>Trạng thái</th>
                                        <th>Ngày mua</th>
                                        <th>Tổng tiền</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>
                                            <input type="checkbox" name="checkall" class="checkall">
                                        </th>
                                        <th>Mã đơn hàng</th>
                                        <th>Tên khách hàng</th>
                                        <th>Số điện thoại</th>
                                        <th>Địa chỉ nhận hàng</th>
                                        <th>Trạng thái</th>
                                        <th>Ngày mua</th>
                                        <th>Tổng tiền</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php foreach ($order_delivery as $delivery) : ?>
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="id[]" id="" value="<?= $delivery['id'] ?>">
                                            </td>
                                            <td><?= $delivery['id'] ?></td>
                                            <td><?= $delivery['name'] ?></td>
                                            <td><?= $delivery['phone'] ?></td>
                                            <td><?= $delivery['address'] ?></td>
                                            <td><?= $delivery['status'] ?></td>
                                            <td><?= $delivery['created_at'] ?></td>
                                            <?php $detail = list_all_detail($delivery['id']);
                                            $total = 0;
                                            foreach ($detail as $d) {
                                                $price_new = $d['price'] - ($d['price'] * $d['sale']);
                                                $total += $d['quantity'] * $price_new;
                                            }
                                            ?>
                                            <td><?= number_format($total, 0, ',', '.') . ' đ'; ?></td>
                                            <td>
                                                <a href="<?= ROOT ?>admin/?page=order&action=edit&id=<?= $delivery['id'] ?>" class="btn btn-success d-block p-2 w-75 mb-2"><i class="far fa-edit"></i></a>
                                                <a href="<?= ROOT ?>admin/?page=order&action=detail&id=<?= $delivery['id'] ?>" class="btn btn-primary d-block p-2 w-75 mb-2"><i class="fas fa-info-circle"></i></a>
                                                <a href="<?= ROOT ?>admin/?page=order&id=<?= $delivery['id'] ?>" onclick="return confirm('Bạn có chắc muốn xóa không')" class="btn btn-danger d-block p-2 w-75 mb-2"><i class="far fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-primary" id="btndel-category" name="btn-del">Xóa mục đánh dấu</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="delivered" role="tabpanel" aria-labelledby="order-delivered">
        <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <form action="<?=ROOT?>/admin/?page=order" method="POST" class="col-md-12">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>
                                            <input type="checkbox" name="checkall" class="checkall">
                                        </th>
                                        <th>Mã đơn hàng</th>
                                        <th>Tên khách hàng</th>
                                        <th>Số điện thoại</th>
                                        <th>Địa chỉ nhận hàng</th>
                                        <th>Trạng thái</th>
                                        <th>Ngày mua</th>
                                        <th>Tổng tiền</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>
                                            <input type="checkbox" name="checkall" class="checkall">
                                        </th>
                                        <th>Mã đơn hàng</th>
                                        <th>Tên khách hàng</th>
                                        <th>Số điện thoại</th>
                                        <th>Địa chỉ nhận hàng</th>
                                        <th>Trạng thái</th>
                                        <th>Ngày mua</th>
                                        <th>Tổng tiền</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php foreach ($order_delivered as $delivered) : ?>
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="id[]" id="" value="<?= $delivered['id'] ?>">
                                            </td>
                                            <td><?= $delivered['id'] ?></td>
                                            <td><?= $delivered['name'] ?></td>
                                            <td><?= $delivered['phone'] ?></td>
                                            <td><?= $delivered['address'] ?></td>
                                            <td><?= $delivered['status'] ?></td>
                                            <td><?= $delivered['created_at'] ?></td>
                                            <?php $detail = list_all_detail($delivered['id']);
                                            $total = 0;
                                            foreach ($detail as $d) {
                                                $price_new = $d['price'] - ($d['price'] * $d['sale']);
                                                $total += $d['quantity'] * $price_new;
                                            }
                                            ?>
                                            <td><?= number_format($total, 0, ',', '.') . ' đ'; ?></td>
                                            <td>
                                                <a href="<?= ROOT ?>admin/?page=order&action=edit&id=<?= $delivered['id'] ?>" class="btn btn-success d-block p-2 w-75 mb-2"><i class="far fa-edit"></i></a>
                                                <a href="<?= ROOT ?>admin/?page=order&action=detail&id=<?= $delivered['id'] ?>" class="btn btn-primary d-block p-2 w-75 mb-2"><i class="fas fa-info-circle"></i></a>
                                                <a href="<?= ROOT ?>admin/?page=order&id=<?= $delivered['id'] ?>" onclick="return confirm('Bạn có chắc muốn xóa không')" class="btn btn-danger d-block p-2 w-75 mb-2"><i class="far fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-primary" id="btndel-category" name="btn-del">Xóa mục đánh dấu</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="cancelled" role="tabpanel" aria-labelledby="order-cancelled">
        <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <form action="<?=ROOT?>/admin/?page=order" method="POST" class="col-md-12">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>
                                            <input type="checkbox" name="checkall" class="checkall">
                                        </th>
                                        <th>Mã đơn hàng</th>
                                        <th>Tên khách hàng</th>
                                        <th>Số điện thoại</th>
                                        <th>Địa chỉ nhận hàng</th>
                                        <th>Trạng thái</th>
                                        <th>Ngày mua</th>
                                        <th>Tổng tiền</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>
                                            <input type="checkbox" name="checkall" class="checkall">
                                        </th>
                                        <th>Mã đơn hàng</th>
                                        <th>Tên khách hàng</th>
                                        <th>Số điện thoại</th>
                                        <th>Địa chỉ nhận hàng</th>
                                        <th>Trạng thái</th>
                                        <th>Ngày mua</th>
                                        <th>Tổng tiền</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php foreach ($order_cancelled as $cancelled) : ?>
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="id[]" id="" value="<?= $cancelled['id'] ?>">
                                            </td>
                                            <td><?= $cancelled['id'] ?></td>
                                            <td><?= $cancelled['name'] ?></td>
                                            <td><?= $cancelled['phone'] ?></td>
                                            <td><?= $cancelled['address'] ?></td>
                                            <td><?= $cancelled['status'] ?></td>
                                            <td><?= $cancelled['created_at'] ?></td>
                                            <?php $detail = list_all_detail($cancelled['id']);
                                            $total = 0;
                                            foreach ($detail as $d) {
                                                $price_new = $d['price'] - ($d['price'] * $d['sale']);
                                                $total += $d['quantity'] * $price_new;
                                            }
                                            ?>
                                            <td><?= number_format($total, 0, ',', '.') . ' đ'; ?></td>
                                            <td>
                                                <a href="<?= ROOT ?>admin/?page=order&action=edit&id=<?= $cancelled['id'] ?>" class="btn btn-success d-block p-2 w-75 mb-2"><i class="far fa-edit"></i></a>
                                                <a href="<?= ROOT ?>admin/?page=order&action=detail&id=<?= $cancelled['id'] ?>" class="btn btn-primary d-block p-2 w-75 mb-2"><i class="fas fa-info-circle"></i></a>
                                                <a href="<?= ROOT ?>admin/?page=order&id=<?= $cancelled['id'] ?>" onclick="return confirm('Bạn có chắc muốn xóa không')" class="btn btn-danger d-block p-2 w-75 mb-2"><i class="far fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-primary" id="btndel-category" name="btn-del">Xóa mục đánh dấu</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->