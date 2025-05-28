<?php
$errors = [];
//Làm việc với csdl
//Viết câu lệnh truy vấn đến bảng types
$types = list_all_type();
if (isset($_POST['btnsave'])) {
    extract($_REQUEST);
    $okUpload = false;
    if (checkType($_FILES['images']['name'],array('jpg','png','gif','tiff')) && checkSize($_FILES['images']['size'],0,5*1024*1024)){
        $okUpload = true;
        $images = uniqid() . $_FILES['images']['name'];
    } 
    if(checkType($_FILES['images']['name'], array('jpg', 'png', 'gif', 'tiff'))==false && $_FILES['images']['size']>0){
        $errors['errors_img'] = 'File không đúng định dạng';
    }
    if (!file_exists($_FILES["images"]["tmp_name"])){
        $errors['errors_img'] = 'Vui lòng chọn ảnh dịch vụ';
    }
    if (service_list_one('name', $name) > 0) {
        $errors['errors_name'] = 'Tên dịch vụ đã tồn tại';
    }
    if(array_filter($errors)==false){
        service_insert($name, $price,$sale, $images, $id_type, $detail, $time);
    if ($okUpload) {
        move_uploaded_file($_FILES['images']['tmp_name'], '../images/products/' . $images);
    }
    $_SESSION['message'] = "Thêm dữ liệu thành công";
    header('Location:' . ROOT . 'admin/?page=service');
    die();
}
}
?>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">

    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Thêm dịch vụ</h6>
        </div>
        <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <!--Load types (loại dịch vụ)-->
                            <label for="id_type">Chọn loại dịch vụ</label>
                            <select name="id_type" id="id_type" class="form-control" required>
                            <option value="">Loại dịch vụ</option>
                                <?php foreach ($types as $t) : ?>
                                        <option value="<?= $t['id'] ?>"><?= $t['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">
                                Vui lòng chọn loại dịch vụ
                                </div>
                        </div>
                        <div class="form-group">
                            <label for="name">Tên dịch vụ</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Tên dịch vụ" value="<?=isset($name)?$name:''?>" required>
                            <div class="invalid-feedback">
                                Vui lòng nhập tên dịch vụ
                                </div>
                                <?php if (isset($errors['errors_name'])) : ?>
                                <p class="text-danger mt-2"><?= $errors['errors_name'] ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="price">Giá dịch vụ</label>
                            <input type="number" name="price" min="0" id="price" class="form-control" title="Đơn giá là số dương" pattern="[-+]?[0-9]" placeholder="Nhập giá dịch vụ" value="<?=isset($price)?$price:''?>" required>
                            <div class="invalid-feedback">
                            Đơn giá không đúng định dang
                                </div>
                        </div>
                        <div class="form-group">
                            <label for="sale">Giá giảm</label>
                            <input type="number" name="sale" id="sale" step="0.01" min="0" max="1" pattern="[-+]?[0-9]*[.,]?[0-9]+" title="Giảm giá là số thập phân từ 0 đến 1" class="form-control" placeholder="Nhập giảm giá" value="<?=isset($sale)?$sale:''?>" required>
                            <div class="invalid-feedback">
                            Giảm giá không đúng định dạng
                                </div>
                        </div>
                        <div class="form-group">
                            <label for="time">Thời gian</label>
                            <input type="text" name="time" id="time" class="form-control" placeholder="Thời gian của dịch vụ" value="<?=isset($time)?$time:''?>" required>
                            <div class="invalid-feedback">
                                Vui lòng nhập thời gian
                                </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="images">Ảnh dịch vụ</label>
                            <input type="file" class="form-control-file border" id="images" name="images" required>
                            <div class="invalid-feedback">
                                Vui lòng chọn ảnh dịch vụ
                                </div>
                                <?php if (isset($errors['errors_img'])) : ?>
                                <p class="text-danger mt-2"><?= $errors['errors_img'] ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="detail">Chi tiết dịch vụ</label>
                    <textarea class="form-control" id="detail" name="detail" rows="25" required><?=isset($detail)?$detail:''?></textarea>
                    <div class="invalid-feedback">
                                Vui lòng nhập chi tiết dịch vụ
                                </div>
                </div>
                <button type="submit" name="btnsave" class="btn btn-success">Ghi lại</button>
            </form>
        </div>
    </div>
</div>
