<?php
$errors = [];
$setting = list_limit_setting();
if (isset($_POST['btnsave'])) {
    extract($_REQUEST);
    if (empty($setting)) {
        $okUpload = false;
        if (
            checkType($_FILES['logo']['name'], array('jpg', 'png', 'gif', 'tiff')) && checkSize($_FILES['logo']['size'], 0, 5 * 1024 * 1024) &&
            checkType($_FILES['file_ico']['name'], array('ico')) && checkSize($_FILES['file_ico']['size'], 0, 5 * 1024 * 1024)
        ) {
            $okUpload = true;
            $logo = uniqid() . $_FILES['logo']['name'];
            $file_ico = uniqid() . $_FILES['file_ico']['name'];
        }
        if (checkType($_FILES['logo']['name'], array('jpg', 'png', 'gif', 'tiff')) == false && $_FILES['logo']['size'] > 0) {
            $errors['errors_logo'] = 'File không đúng định dạng';
        }
        if (!file_exists($_FILES["logo"]["tmp_name"])) {
            $errors['errors_logo'] = 'Vui lòng chọn ảnh';
        }
        if (checkType($_FILES['file_ico']['name'], array('ico')) == false && $_FILES['file_ico']['size'] > 0) {
            $errors['errors_ico'] = 'Vui lòng chọn file có đuôi .ico';
        }
        if (!file_exists($_FILES["file_ico"]["tmp_name"])) {
            $errors['errors_ico'] = 'Vui lòng chọn ảnh';
        }
        if (array_filter($errors) == false) {
            insert_setting($logo, $file_ico, $title, $introduce, $slogan);
            if ($okUpload) {
                move_uploaded_file($_FILES['logo']['tmp_name'], '../images/' . $logo);
                move_uploaded_file($_FILES['file_ico']['tmp_name'], '../images/' . $file_ico);
            }
            $_SESSION['message'] = "Thêm dữ liệu thành công";
            header('Location:' . ROOT . 'admin/?page=setting');
            die();
        }
    } else {
        $UploadLogo = false;
        $UploadIco = false;
        if (checkType($_FILES['logo']['name'], array('jpg', 'png', 'gif', 'tiff')) && checkSize($_FILES['logo']['size'], 0, 5 * 1024 * 1024)) {
            $UploadLogo = true;
            $logo = uniqid() . $_FILES['logo']['name'];
        }else{
            $logo = $image;
        }
        if (checkType($_FILES['file_ico']['name'], array('ico')) && checkSize($_FILES['file_ico']['size'], 0, 5 * 1024 * 1024)) {
            $UploadIco = true;
            $file_ico = uniqid() . $_FILES['file_ico']['name'];
        }else{
            $file_ico = $ico;
        }
        if (checkType($_FILES['logo']['name'], array('jpg', 'png', 'gif', 'tiff')) == false && $_FILES['logo']['size'] > 0) {
            $errors['errors_logo'] = 'File không đúng định dạng';
        }
        if (checkType($_FILES['file_ico']['name'], array('ico')) == false && $_FILES['file_ico']['size'] > 0) {
            $errors['errors_ico'] = 'Vui lòng chọn file có đuôi .ico';
        }
        if (array_filter($errors) == false) {
            setting_update($setting['id'], $logo, $file_ico, $title, $introduce, $slogan);
            if ($UploadLogo) {
                move_uploaded_file($_FILES['logo']['tmp_name'], '../images/' . $logo);
            }
            if ($UploadIco) {
                move_uploaded_file($_FILES['file_ico']['tmp_name'], '../images/' . $file_ico);
            }
            $_SESSION['message'] = "Cập nhật dữ liệu thành công";
            header('Location:' . ROOT . 'admin/?page=setting');
            die();
        }
    }
}
?>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Quản lý website</h6>
        </div>
        <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">Tiêu đề website</label>
                            <?php if (empty($setting)) : ?>
                                <input type="text" name="title" id="title" class="form-control" placeholder="Nhập tiêu đề" value="<?= isset($title) ? $title : '' ?>" required>
                            <?php else : ?>
                                <input type="text" name="title" id="title" class="form-control" placeholder="Nhập tiêu đề" value="<?= isset($title) ? $title : $setting['title'] ?>" required>
                            <?php endif; ?>
                            <div class="invalid-feedback">
                                Vui lòng nhập tiêu đề
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="logo">Logo website</label>
                            <?php if (empty($setting)) : ?>
                                <input type="file" class="form-control-file border" id="logo" name="logo" required>
                            <?php else: ?>
                                <input type="hidden" name="image" value="<?= $setting['logo'] ?>">
                            <input type="file" class="form-control-file border" id="logo" name="logo">
                            <div class="bg-gray-200 p-5 mt-3">
                                <img src="../images/<?= $setting['logo'] ?>" width="150" alt="">
                            </div>
                            <?php endif; ?>
                            <div class="invalid-feedback">
                                Vui lòng chọn ảnh logo
                            </div>
                            <?php if (isset($errors['errors_logo'])) : ?>
                                <p class="text-danger mt-2"><?= $errors['errors_logo'] ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="slogan">Khẩu hiệu website</label>
                            <?php if (empty($setting)) : ?>
                                <input type="text" name="slogan" id="slogan" class="form-control" placeholder="Nhập tiêu đề" value="<?= isset($slogan) ? $slogan : '' ?>" required>
                            <?php else : ?>
                                <input type="text" name="slogan" id="slogan" class="form-control" placeholder="Nhập tiêu đề" value="<?= isset($slogan) ? $slogan : $setting['slogan'] ?>" required>
                            <?php endif; ?>
                            <div class="invalid-feedback">
                                Vui lòng nhập khẩu hiệu
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="file_ico">File ico</label>
                            <?php if (empty($setting)) : ?>
                            <input type="file" class="form-control-file border" id="file_ico" name="file_ico" required>
                            <?php else: ?>
                                <input type="hidden" name="ico" value="<?= $setting['file_ico'] ?>">
                            <input type="file" class="form-control-file border" id="file_ico" name="file_ico">
                            <div class="bg-gray-200 p-5 mt-3">
                                <img src="../images/<?= $setting['file_ico'] ?>" width="150" alt="">
                            </div>
                            <?php endif; ?>
                            <div class="invalid-feedback">
                                Vui lòng chọn file có đuôi .ico
                            </div>
                            <?php if (isset($errors['errors_ico'])) : ?>
                                <p class="text-danger mt-2"><?= $errors['errors_ico'] ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="detail">Giới thiệu webite</label>
                    <?php if (empty($setting)) : ?>
                        <textarea class="form-control" id="detail" name="introduce" rows="25" required><?= isset($introduce) ? $introduce : '' ?></textarea>
                    <?php else : ?>
                        <textarea class="form-control" id="detail" name="introduce" rows="25" required><?= isset($introduce) ? $introduce : $setting['introduce'] ?></textarea>
                    <?php endif; ?>
                    <div class="invalid-feedback">
                        Vui lòng nhập giới thiệu
                    </div>
                </div>
                <button type="submit" name="btnsave" class="btn btn-success">Ghi lại</button>
            </form>
        </div>
    </div>
</div>