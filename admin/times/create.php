<?php
$errors = [];
if (isset($_POST['btnsave'])) {
    extract($_REQUEST);
    if (check_time('time', $time)) {
        $errors['errors_time'] = 'Khung giờ đã tồn tại';
    }if(array_filter($errors)==false){
    insert_time($time);
    $_SESSION['message'] = "Thêm dữ liệu thành công";
    header('Location:' . ROOT . 'admin/?page=time');
    die();
    }
}
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Thêm khung giờ </h6>
        </div>
        <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                <div class="form-group">
                    <label for="time">Khung giờ</label>
                    <input type="text" name="time" id="time" value="<?= isset($time) ? $time : '' ?>" class="form-control" placeholder="Nhập khung giờ" required>
                    <div class="invalid-feedback">
                        Vui lòng nhập khung giờ
                    </div>
                    <?php if (isset($errors['errors_time'])) : ?>
                        <p class="text-danger mt-2"><?= $errors['errors_time'] ?></p>
                    <?php endif; ?>
                </div>
                <button type="submit" name="btnsave" class="btn btn-primary">Ghi lại</button>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->