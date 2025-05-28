<?php
$errors = [];
$blog = list_all_new();
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $hair = list_one_library($id);
}
if (isset($_POST['btnsave'])) {
    extract($_REQUEST);
    $okUpload = false;
    if (checkType($_FILES['images']['name'],array('jpg','png','gif','tiff')) && checkSize($_FILES['images']['size'],0,5*1024*1024)){
        $okUpload = true;
        $images = uniqid() . $_FILES['images']['name'];
    }else{
        $images =$image;
    } 
    if(checkType($_FILES['images']['name'], array('jpg', 'png', 'gif', 'tiff'))==false && $_FILES['images']['size']>0){
        $errors['errors_img'] = 'File không đúng định dạng';
    }
    if(array_filter($errors)==false){
        library_update($id, $name, $images,$link);
    if ($okUpload) {
        move_uploaded_file($_FILES['images']['tmp_name'], '../images/sliders/' . $images);
    }
    $_SESSION['message'] = "Cập nhật liệu thành công";
    header('Location:' . ROOT . 'admin/?page=hair');
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
            <h6 class="m-0 font-weight-bold text-primary">Thêm slider</h6>
        </div>
        <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Tiêu đề</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Nhập tiêu đề" value="<?=isset($name)?$name:$hair['name']?>" required>
                            <div class="invalid-feedback">
                                Vui lòng nhập tiêu đề
                                </div>
                        </div>
                        <div class="form-group">
                            <label for="link">Đường dẫn</label>
                            <select name="link" id="link" class="form-control" required>
                                <?php foreach ($blog as $b) : ?>
                                    <?php if ($b['id'] == $hair['link']) : ?>
                                        <option value="<?= $b['id'] ?>" selected><?= $b['title'] ?></option>
                                    <?php else : ?>
                                        <option value="<?= $b['id'] ?>"><?= $b['title'] ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">
                                Vui lòng nhập đường dẫn
                                </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                            <label for="images">Hình ảnh</label>
                            <input type="hidden" name="image" value="<?= $hair['images'] ?>">
                            <input type="file" class="form-control-file border" id="images" name="images">
                            <img src="../images/sliders/<?= $hair['images'] ?>" width="150" alt="">
                            <?php if (isset($errors['errors_img'])) : ?>
                                <p class="text-danger mt-2"><?= $errors['errors_img'] ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
               
                <button type="submit" name="btnsave" class="btn btn-success">Ghi lại</button>
            </form>
        </div>
    </div>
</div>
