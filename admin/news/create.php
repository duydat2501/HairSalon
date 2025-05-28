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
        $errors['errors_img'] = 'Vui lòng chọn ảnh tin tức';
    }if(check_new('title',$title)>0){
        $errors['errors_title'] = 'Tiêu đề tin tức đã tồn tại';
    }
    if(array_filter($errors)==false){
        $id_user =$_SESSION['user']['id']; //lấy session user
        insert_new($title,$content,$images,$id_user);
    if ($okUpload) {
        move_uploaded_file($_FILES['images']['tmp_name'], '../images/sliders/' . $images);
    }
    $_SESSION['message'] = "Thêm dữ liệu thành công";
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
            <h6 class="m-0 font-weight-bold text-primary">Thêm tin tức</h6>
        </div>
        <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">Tiêu đề</label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="Nhập tiêu đề" value="<?=isset($title)?$title:''?>" required>
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
                            <label for="images">Ảnh tin tức</label>
                            <input type="file" class="form-control-file border" id="images" name="images" required>
                            <div class="invalid-feedback">
                                Vui lòng chọn ảnh
                                </div>
                                <?php if (isset($errors['errors_img'])) : ?>
                                <p class="text-danger mt-2"><?= $errors['errors_img'] ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="detail">Chi tiết</label>
                    <textarea class="form-control" id="detail" name="content" rows="25" required><?=isset($content)?$content:''?></textarea>
                    <div class="invalid-feedback">
                                Vui lòng nhập chi tiết
                                </div>
                </div>
                <button type="submit" name="btnsave" class="btn btn-success">Ghi lại</button>
            </form>
        </div>
    </div>
</div>
