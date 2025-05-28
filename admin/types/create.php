<?php
$errors = [];
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
        $errors['errors_img'] = 'Vui lòng chọn ảnh loại dịch vụ';
    }if (list_one_type('name', $name) > 0) {
        $errors['errors_name'] = 'Tên loại dịch vụ đã tồn tại';
    }
    if(array_filter($errors)==false){
        insert_type($name, $images);
    if ($okUpload) {
        move_uploaded_file($_FILES['images']['tmp_name'], '../images/categories/' . $images);
    }
    $_SESSION['message'] = "Thêm dữ liệu thành công";
    header('Location:' . ROOT . 'admin/?page=type');
    die();
}
}
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Thêm loại dịch vụ </h6>
        </div>
        <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data"  class="needs-validation" novalidate>
                <div class="form-group">
                    <label for="name">Tên loại dịch vụ</label>
                    <input type="text" name="name" id="name"  value="<?=isset($name)?$name:''?>" class="form-control" placeholder="Nhập tên loại dịch vụ" required>
                    <div class="invalid-feedback">
                                Vui lòng nhập tên loại dịch vụ
                                </div>
                                <?php if (isset($errors['errors_name'])) : ?>
                                <p class="text-danger mt-2"><?= $errors['errors_name'] ?></p>
                            <?php endif; ?>
                </div>
                <div class="form-group">
                            <label for="images">Ảnh loại dịch vụ</label>
                            <input type="file" class="form-control-file border" id="images" name="images" required>
                            <div class="invalid-feedback">
                                Vui lòng chọn ảnh loại dịch vụ
                                </div>
                                <?php if (isset($errors['errors_img'])) : ?>
                                <p class="text-danger mt-2"><?= $errors['errors_img'] ?></p>
                            <?php endif; ?>
                        </div>
                <button type="submit" name="btnsave" class="btn btn-primary">Ghi lại</button>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->