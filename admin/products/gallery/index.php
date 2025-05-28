<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $gallery = gallery_list($id);
    $pro = product_list_one('id',$id);
}
if (isset($_POST['btn-del'])) {
    extract($_REQUEST);
    foreach ($id as $id_gallery) {
        gallery_delete($id_gallery);
    }
    $_SESSION['message'] = "Xóa dữ liệu thành công";
    header('location:' . ROOT . 'admin/?page=gallery&id='.$pro['id']);
    die;
}


?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <?php if (isset($_SESSION['message'])) : ?>
        <div class="card-header py-3 text-success">
            <h6 class="font-weight-bold"><?= $_SESSION['message'] ?></h6>
        </div>
    <?php endif; ?>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?=$pro['name']?> <a href="<?= ROOT ?>admin/?page=gallery&action=add&id_product=<?=$pro['id']?>" class="btn btn-primary ml-3">Thêm mới</a></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <form action="" method="POST" class="col-md-12">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" name="checkall" class="checkall">
                                </th>
                                <th>Mã ảnh sản phẩm</th>
                                <th>Tên ảnh sản phẩm</th>
                                <th>Hình ảnh</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                            <th>
                                <input type="checkbox" name="checkall" class="checkall">
                                </th>
                                <th>Mã ảnh sản phẩm</th>
                                <th>Tên ảnh sản phẩm</th>
                                <th>Hình ảnh</th>
                                <th>Thao tác</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php foreach ($gallery as $g) : ?>
                                <tr>
                                    <td>
                                        <input type="checkbox" name="id[]" id="" value="<?= $g['id'] ?>">
                                    </td>
                                    <td><?= $g['id'] ?></td>
                                    <td><?= $g['title'] ?></td>
                                    <td>
                                        <img src="../images/products/<?= $g['images'] ?>" width="120" alt="">
                                    </td>
                                    <td>
                                        <a href="<?= ROOT ?>admin/?page=gallery&action=edit&id=<?= $g['id'] ?>" class="btn btn-success"><i class="far fa-edit"></i></a>
                                        <a href="<?= ROOT ?>admin/?page=gallery&action=delete&id=<?= $g['id'] ?>&id_product=<?=$pro['id']?>" onclick="return confirm('Bạn có chắc muốn xóa không')" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-primary" id="btndel-category" name="btn-del">Xóa mục đánh dấu</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->