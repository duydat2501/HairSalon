<?php
$id = $_GET['id'];
$order = list_one_order('id',$id);
if (isset($_POST['btnUpdate'])) {
    extract($_REQUEST);
    order_update($id, $status);
    $_SESSION['message']= 'Cập nhật dữ liệu thành công';
    header('Location:'. ROOT . 'admin/?page=order');
    die();
}
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Cập nhật đơn hàng</h6>
        </div>
        <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data"  class="needs-validation" novalidate>
                <div class="form-group">
                    <label for="status">Trạng thái đơn hàng</label>
                    <input type="text" name="status" id="status" class="form-control" placeholder="Nhập trạng thái" required value="<?=isset($status)?$status:$order['status']?>">
                    <div class="invalid-feedback">
                                Vui lòng nhập trạng thái đơn hàng
                                </div>
                </div>
                <input type="hidden" name="id" value="<?= $order['id'] ?>">
                <button type="submit" name="btnUpdate" class="btn btn-primary">Ghi lại</button>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->