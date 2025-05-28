<?php

if (isset($_POST['btn-del'])) {
    extract($_REQUEST);
    foreach ($id as $id_order) {
        detail_delete($id_order);
    }
    $_SESSION['message'] = "Xóa dữ liệu thành công";
    header('location:' . ROOT . 'admin/?page=order');
    die;
}
if(isset($_GET['id'])){
    $detail = list_all_detail($_GET['id']);
}

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
            <h6 class="m-0 font-weight-bold text-primary">Chi tiết đơn hàng</h6>
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
                                <th>Mã đơn hàng chi tiết</th>
                                <th>Mã đơn hàng</th>
                                <th>Tên sản phẩm</th>
                                <th>Ảnh sản phẩm</th>
                                <th>Đơn giá</th>
                                <th>Giảm giá</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                            <th>
                                <input type="checkbox" name="checkall" class="checkall">
                                </th>
                                <th>Mã đơn hàng chi tiết</th>
                                <th>Mã đơn hàng</th>
                                <th>Tên sản phẩm</th>
                                <th>Ảnh sản phẩm</th>
                                <th>Đơn giá</th>
                                <th>Giảm giá</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php foreach ($detail as $o) : ?>
                                <tr>
                                    <td>
                                        <input type="checkbox" name="id[]" id="" value="<?= $o['id'] ?>">
                                    </td>
                                    <td><?= $o['id'] ?></td>
                                    <td><?= $o['id_order'] ?></td>
                                    <td><?= $o['name'] ?></td>
                                    <td><img src="../images/products/<?=$o['images'] ?>" alt="" width="100"></td>
                                    <td><?php if($o['sale']>0): ?>
                                        <del class="text-gray-500"><?=number_format($o['price'],0,',','.').' đ';?></del>
                                    <?php endif; ?>
                                     <?=number_format($price= $o['price']-($o['price']*$o['sale']),0,',','.').' đ';?></td>
                                    <td><?=($o['sale']*100).'%' ?></td>
                                    <td><?= $o['quantity'] ?></td>
                                    <td><?=number_format($o['quantity']*$price,0,',','.').' đ';?></td>
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