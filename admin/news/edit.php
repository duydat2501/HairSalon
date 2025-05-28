<?php
$errors = [];
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $new = list_one_new($id);
}
if (isset($_POST['btnSave'])) {
    extract($_REQUEST);
    $okUpload = false;
    if (checkType($_FILES['images']['name'], array('jpg', 'png', 'gif', 'tiff')) && checkSize($_FILES['images']['size'], 0, 5 * 1024 * 1024)) {
        $okUpload = true;
        $images = uniqid() . $_FILES['images']['name'];
    } else {
        $images = $image;
    }
    if (checkType($_FILES['images']['name'], array('jpg', 'png', 'gif', 'tiff')) == false && $_FILES['images']['size'] > 0) {
        $errors['errors_img'] = 'File không đúng định dạng';
    }if(check_new('title',$title)>0){
        if($new['title']!=$title){
            $errors['errors_title'] = 'Tiêu đề tin tức đã tồn tại';
        }
    }
    if (array_filter($errors) == false) {
        new_update($id, $title, $content, $images);
        if ($okUpload) {
            move_uploaded_file($_FILES['images']['tmp_name'], '../images/sliders/' . $images);
        }
        $_SESSION['message'] = "Cập nhật dữ liệu thành công";
        header('Location:' . ROOT . 'admin/?page=new');
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
            <h6 class="m-0 font-weight-bold text-primary">Cập nhật tin tức</h6>
        </div>
        <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data" class="needs-validation col-md-12" novalidate>
                <input type="hidden" name="id" value="<?= $new['id'] ?>" id="">
                <div class="row">
                    <div class="col-md-6">
                    <div class="form-group">
                            <input type="hidden" name="id" id="id" class="form-control"  value="<?= $new['id']?>">
                        </div>
                        <div class="form-group">
                            <label for="title">Tiêu đề</label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="Nhập tiêu đề" value="<?= isset($title) ? $title : $new['title'] ?>" required>
                            <div class="invalid-feedback">
                                Vui lòng nhập tiêu đề
                            </div>
                            <?php if (isset($errors['errors_title'])) : ?>
                                <p class="text-danger mt-2"><?= $errors['errors_title'] ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="images">Ảnh sản phẩm</label>
                            <input type="hidden" name="image" value="<?= $new['images'] ?>">
                            <input type="file" class="form-control-file border" id="images" name="images">
                            <img src="../images/sliders/<?= $new['images'] ?>" width="150" alt="">
                            <?php if (isset($errors['errors_img'])) : ?>
                                <p class="text-danger mt-2"><?= $errors['errors_img'] ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="detail">Chi tiết</label>
                    <textarea class="form-control" id="detail" name="content" rows="25" required><?= isset($content) ? $content : $new['content'] ?></textarea>
                    <div class="invalid-feedback">
                        Vui lòng nhập chi tiết tin tức
                    </div>
                </div>
                <button type="submit" name="btnSave" class="btn btn-success">Ghi lại</button>
            </form>
        </div>
    </div>
</div>