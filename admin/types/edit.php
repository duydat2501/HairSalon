<?php
$errors = [];
$id = $_GET['id'];
$type = list_one_type('id',$id);
if (isset($_POST['btnUpdate'])) {
    extract($_REQUEST);
    $okUpload = false;
    if(checkType($_FILES['images']['name'],array('jpg','png','gif','tiff')) && checkSize($_FILES['images']['size'],0,5*1024*1024)){
        $okUpload = true;
        $images = uniqid() . $_FILES['images']['name'];
    }else{
        $images =$image;
    }
    if(checkType($_FILES['images']['name'], array('jpg', 'png', 'gif', 'tiff'))==false && $_FILES['images']['size']>0){
        $errors['errors_img'] = 'File không đúng định dạng';
    }if (list_one_type('name', $name) > 0) {
        if($type['name']!=$name){
        $errors['errors_name'] = 'Tên loại dịch vụ đã tồn tại';
        }
    }
    if(array_filter($errors)==false){
        type_update($id, $name, $images);
    if($okUpload){
        move_uploaded_file($_FILES['images']['tmp_name'], '../images/categories/'.$images);
    }
    $_SESSION['message']= 'Cập nhật dữ liệu thành công';
    header('Location:'. ROOT . 'admin/?page=type');
    die();
    }
}
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Cập nhật loại dịch vụ</h6>
        </div>
        <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data"  class="needs-validation" novalidate>
                <div class="form-group">
                    <label for="name">Tên loại dịch vụ</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Nhập tên loại dịch vụ" required value="<?=isset($name)?$name:$type['name']?>">
                    <div class="invalid-feedback">
                                Vui lòng nhập tên loại dịch vụ
                                </div>
                                <?php if (isset($errors['errors_name'])) : ?>
                                <p class="text-danger mt-2"><?= $errors['errors_name'] ?></p>
                            <?php endif; ?>
                </div>
                <?php if ($type['images'] != '') : ?>
                    <img src="../images/categories/<?= $type['images'] ?>" width="120" alt="">
                    <input type="hidden" name="image" value="<?= $type['images'] ?>">
                <?php endif; ?>

                <div class="form-group">
                    <input type="file" name="images" class="form-file-input border" id="">
                    <?php if (isset($errors['errors_img'])) : ?>
                                <p class="text-danger mt-2"><?= $errors['errors_img'] ?></p>
                            <?php endif; ?>
                </div>
                <input type="hidden" name="id" value="<?= $type['id'] ?>">
                <button type="submit" name="btnUpdate" class="btn btn-primary">Ghi lại</button>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->