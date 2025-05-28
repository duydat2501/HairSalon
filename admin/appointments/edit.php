<?php
$errors = [];
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $app = list_one_appointment($id);
    $user = user_check('id', $app['id_user']);
    $app_detail = all_app_detail($app['id']);
}
if (isset($_POST['btnsave'])) {
    extract($_REQUEST);
    if (empty($id_service)) {
        $errors['errors_service'] = 'Vui lòng chọn dịch vụ';
    }
    if (array_filter($errors) == false) {
        appointment_update($id,$cancel);
        app_book_delete($id);
        foreach ($id_service as $s) {
            insert_app_detail($id,$s);
        }
        $_SESSION['message'] = "Cập nhật dữ liệu thành công";
        header('Location:' . ROOT . 'admin/?page=appointment');
        die();
    }
}
$service = service_list_all();

?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Đặt lịch hẹn</h6>
        </div>
        <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate onsubmit="return check()">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="phone">Số điện thoại</label>
                            <input name="phone" id="phone" value="<?= isset($user['phone']) ? $user['phone'] : '' ?>" class="form-control" readonly>
                        </div>
                        <input type="hidden" name="id" value="<?=$app['id']?>">
                        <div class="form-group">
                            <label for="cancel">Trạng thái</label>
                            <select name="cancel" id="multi-selectbox" class="form-control">
                                <option value="0" <?= $app['cancel'] == 0 ? 'selected' : '' ?>>Sắp tới</option>
                                <option value="1" <?= $app['cancel'] == 1 ? 'selected' : '' ?>>Chờ phục vụ</option>
                                <option value="2" <?= $app['cancel'] == 2 ? 'selected' : '' ?>>Đang phục vụ</option>
                                <option value="3" <?= $app['cancel'] == 3 ? 'selected' : '' ?>>Hoàn thành</option>
                                <option value="4" <?= $app['cancel'] == 4 ? 'selected' : '' ?>>Đã hủy lịch</option>
                            </select>
                        </div>

                    </div>
                    <div class="col-6">
                        <div class="form-group">
                        <label class="d-block">Chọn dịch vụ</label>
                        <select class="mul-select form-control" name="id_service[]" multiple="true" required>
                             <option value="">Chọn dịch vụ</option>
                             <?php foreach ($service as $s) : ?>
                                <?php foreach ($app_detail as $detail) : ?>
                                    <?php if($detail['id_service']==$s['id']): ?>
                                    <option value="<?= $s['id'] ?>" selected><?= $s['name'] ?></option>
                                 <?php endif; ?>
                                <?php endforeach; ?>
                                <?php if($detail['id_service'] !== $s['id']): ?>
                                    <option value="<?= $s['id'] ?>"><?= $s['name'] ?></option>
                                 <?php endif; ?>
                             <?php endforeach; ?>
                         </select>
                         <div class="invalid-feedback">
                             Vui lòng chọn dịch vụ
                         </div>
                        </div>
                    </div>
                </div>
                <button type="submit" name="btnsave" class="btn btn-primary">Ghi lại</button>
            </form>
        </div>
    </div>

</div>
