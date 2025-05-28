<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    order_delete($id);
    detail_delete_order($id);
    $_SESSION['message'] = "Xóa dữ liệu thành công";
    header('location:' . ROOT . 'admin/?page=order');
    die;
}
if (isset($_POST['btn-del'])) {
    extract($_REQUEST);
    foreach ($id as $id_order) {
        order_delete($id_order);
        detail_delete_order($id_order);
    }
    $_SESSION['message'] = "Xóa dữ liệu thành công";
    header('location:' . ROOT . 'admin/?page=order');
    die;
}

$order = list_all_order();
?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <?php if (isset($_SESSION['message'])) : ?>
        <div class="card-header py-3 text-success">
            <h6 class="font-weight-bold"><?= $_SESSION['message'] ?></h6>
        </div>
    <?php endif; ?>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách đơn hàng</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <form action="" method="POST" class="col-md-12">
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
                                    <?php  $detail = list_all_detail($o['id']);
                                    $total=0;
                                    foreach($detail as $d){
                                        $price_new=$d['price']-($d['price']*$d['sale']);
                                        $total += $d['quantity']*$price_new;
                                    }
                                    ?>
                                    <td><?=number_format($total,0,',','.').' đ';?></td>
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
    </div>
</div>
<!-- /.container-fluid -->