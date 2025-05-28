<?php
$errors = [];
//Làm việc với csdl
//Viết câu lệnh truy vấn đến bảng categories
$categories = list_all_category();
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
        $errors['errors_img'] = 'Vui lòng chọn ảnh sản phẩm';
    }if (product_list_one('name', $name) > 0) {
        $errors['errors_name'] = 'Tên sản phẩm đã tồn tại';
    }
    if(array_filter($errors)==false){
        $status = isset($status) ? true : false;
        product_insert($name, $price, $sale, $images, $id_category, $status, $description);
    if ($okUpload) {
        move_uploaded_file($_FILES['images']['tmp_name'], '../images/products/' . $images);
    }
    $_SESSION['message'] = "Thêm dữ liệu thành công";
    header('Location:' . ROOT . 'admin/?page=product');
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
            <h6 class="m-0 font-weight-bold text-primary">Thêm sản phẩm</h6>
        </div>
        <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <!--Load categories (danh mục sản phẩm)-->
                            <label for="cate_id">Chọn danh mục sản phẩm</label>
                            <select name="id_category" id="id_category" class="form-control" required>
                            <option value="">Danh mục sản phẩm</option>
                                <?php foreach ($categories as $cate) : ?>
                                        <option value="<?= $cate['id'] ?>"><?= $cate['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">
                                Vui lòng chọn danh mục sản phẩm
                                </div>
                        </div>
                        <div class="form-group">
                            <label for="name">Tên sản phẩm</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Tên sản phẩm" value="<?=isset($name)?$name:''?>" required>
                            <div class="invalid-feedback">
                                Vui lòng nhập tên sản phẩm
                                </div>
                                <?php if (isset($errors['errors_name'])) : ?>
                                <p class="text-danger mt-2"><?= $errors['errors_name'] ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" name="status" class="form-check-input status" id="status"> 
                            <label for="status" class="status-title">Trạng thái <span id="span"></span></label>
                        </div>
                        <div class="form-group">
                            <label for="price">Giá sản phẩm</label>
                            <input type="number" name="price" min="0" id="price" class="form-control" title="Đơn giá là số dương" pattern="[-+]?[0-9]" placeholder="Nhập giá sản phẩm" value="<?=isset($price)?$price:''?>" required>
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
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="images">Ảnh sản phẩm</label>
                            <input type="file" class="form-control-file border" id="images" name="images" required>
                            <div class="invalid-feedback">
                                Vui lòng chọn ảnh sản phẩm
                                </div>
                                <?php if (isset($errors['errors_img'])) : ?>
                                <p class="text-danger mt-2"><?= $errors['errors_img'] ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="detail">Mô tả sản phẩm</label>
                    <textarea class="form-control" id="detail" name="description" rows="25" required><?=isset($description)?$description:''?></textarea>
                    <div class="invalid-feedback">
                                Vui lòng nhập mô tả sản phẩm
                                </div>
                </div>
                <button type="submit" name="btnsave" class="btn btn-success">Ghi lại</button>
            </form>
        </div>
    </div>
</div>
