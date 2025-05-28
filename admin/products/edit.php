<?php
$errors = [];
//Làm việc với csdl
//Viết câu lệnh truy vấn đến bảng categories
$categories = list_all_category();
//Lấy id từ url để sửa sản phẩm
$id = $_GET['id'];
//Câu lệnh sql lấy ra sản phẩm
$product = product_list_one('id',$id);
if (isset($_POST['btnSave'])) {
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
    }if (product_list_one('name', $name) > 0) {
        if($product['name']!=$name){
            $errors['errors_name'] = 'Tên sản phẩm đã tồn tại';
        }
    }
    if(array_filter($errors)==false){
        $status = isset($status) ? true : false;
        product_update($id, $name, $price, $sale, $images, $id_category, $status, $description);
    if ($okUpload) {
        move_uploaded_file($_FILES['images']['tmp_name'], '../images/products/' . $images);
    }
    $_SESSION['message'] = "Cập nhật dữ liệu thành công";
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
            <h6 class="m-0 font-weight-bold text-primary">Cập nhật sản phẩm</h6>
        </div>
        <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data" class="needs-validation col-md-12" novalidate>
                <input type="hidden" name="id" value="<?= $product['id'] ?>" id="">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <!--Load categories (danh mục sản phẩm)-->
                            <label for="id_category">Chọn danh mục sản phẩm</label>
                            <select name="id_category" id="id_category" class="form-control">
                                <?php foreach ($categories as $cate) : ?>
                                    <?php if ($cate['id'] == $product['id_category']) : ?>
                                        <option value="<?= $cate['id'] ?>" selected><?= $cate['name'] ?></option>
                                    <?php else : ?>
                                        <option value="<?= $cate['id'] ?>"><?= $cate['name'] ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Tên sản phẩm</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Tên sản phẩm" value="<?=isset($name)?$name:$product['name']?>" required>
                            <div class="invalid-feedback">
                                Vui lòng nhập tên sản phẩm
                                </div>
                                <?php if (isset($errors['errors_name'])) : ?>
                                <p class="text-danger mt-2"><?= $errors['errors_name'] ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" name="status" class="form-check-input status" id="" <?= ($product['status'] == 1) ? 'checked' : '' ?>>
                             <label for="status" class="status-title">Trạng thái <span id="span"><?= ($product['status'] == 1) ? 'Có hàng' : 'Hết hàng' ?></span></label>
                        </div>
                        <div class="form-group">
                            <label for="price">Giá sản phẩm</label>
                            <input type="number" name="price" id="price" min="0" class="form-control" title="Đơn giá là số dương" pattern="[-+]?[0-9]" value="<?=isset($price)?$price:$product['price']?>"
                                placeholder="Nhập giá sản phẩm" required>
                                <div class="invalid-feedback">
                                Đơn giá không đúng định dạng
                                </div>
                        </div>
                        <div class="form-group">
                            <label for="sale">Giá giảm</label>
                            <input type="number" name="sale" id="sale" step="0.01" min="0" max="1" class="form-control" pattern="[-+]?[0-9]*[.,]?[0-9]+" 
                            title="Giảm giá là số thập phân từ 0 đến 1" value="<?=isset($sale)?$sale:$product['sale']?>"
                                placeholder="Nhập giảm giá" required>
                                <div class="invalid-feedback">
                                Giảm giá không đúng định dạng
                                </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="images">Ảnh sản phẩm</label>
                            <input type="hidden" name="image" value="<?= $product['images'] ?>">
                            <input type="file" class="form-control-file border" id="images" name="images">
                            <img src="../images/products/<?= $product['images'] ?>" width="150" alt="">
                            <?php if (isset($errors['errors_img'])) : ?>
                                <p class="text-danger mt-2"><?= $errors['errors_img'] ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="detail">Mô tả</label>
                    <textarea class="form-control" id="detail" name="description" rows="25" required><?=isset($description)?$description:$product['description']?></textarea>
                    <div class="invalid-feedback">
                                Vui lòng nhập mô tả sản phẩm
                                </div>
                </div>
                <button type="submit" name="btnSave" class="btn btn-success">Ghi lại</button>
            </form>
        </div>
    </div>
</div>
