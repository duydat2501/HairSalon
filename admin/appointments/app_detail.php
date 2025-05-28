<?php

if (isset($_POST['btn-del'])) {
    extract($_REQUEST);
    foreach ($id as $id_app) {
        app_detail_delete($id_app);
    }
    $_SESSION['message'] = "Xóa dữ liệu thành công";
    header('location:' . ROOT . 'admin/?page=appointment');
    die;
}
if(isset($_GET['id'])){
    $detail = all_app_detail($_GET['id']);
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
            <h6 class="m-0 font-weight-bold text-primary">Chi tiết lịch hẹn</h6>
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
                                <th>Mã lịch hẹn chi tiết</th>
                                <th>Mã lịch hẹn</th>
                                <th>Tên dịch vụ</th>
                                <th>Ảnh dịch vụ</th>
                                <th>Đơn giá</th>
                                <th>Thời gian phục vụ</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                            <th>
                                <input type="checkbox" name="checkall" class="checkall">
                                </th>
                                <th>Mã lịch hẹn chi tiết</th>
                                <th>Mã lịch hẹn</th>
                                <th>Tên dịch vụ</th>
                                <th>Ảnh dịch vụ</th>
                                <th>Đơn giá</th>
                                <th>Thời gian phục vụ</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php foreach ($detail as $d) : ?>
                                <tr>
                                    <td>
                                        <input type="checkbox" name="id[]" id="" value="<?= $d['id'] ?>">
                                    </td>
                                    <td><?= $d['id'] ?></td>
                                    <td><?= $d['id_appointment'] ?></td>
                                    <td><?= $d['name'] ?></td>
                                    <td><img src="../images/products/<?=$d['images'] ?>" alt="" width="100"></td>
                                    <td><?php if($d['sale']>0): ?>
                                        <del class="text-gray-500"><?=number_format($d['price'],0,',','.').' đ';?></del>
                                    <?php endif; ?>
                                     <?=number_format($price= $d['price']-($d['price']*$d['sale']),0,',','.').' đ';?></td>
                                    <td><?= $d['time'] ?></td>
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