<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    product_delete($id);
    $_SESSION['message'] = "Xóa dữ liệu thành công";
    header('location:' . ROOT . 'admin/?page=product');
    die;
}
if (isset($_POST['btn-del'])) {
    extract($_REQUEST);
    foreach ($id as $id_pro) {
        product_delete($id_pro);
    }
    $_SESSION['message'] = "Xóa dữ liệu thành công";
    header('location:' . ROOT . 'admin/?page=product');
    die;
}
$result = product_list_all();
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <?php if (isset($_SESSION['message'])) : ?>
        <div class="alert alert-success alert-bold">
            <h6 class="font-weight-bold alert-text"><?= $_SESSION['message'] ?></h6>
        </div>
    <?php endif; ?>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách sản phẩm <a href="<?= ROOT ?>admin/?page=product&action=add" class="btn btn-primary ml-3">Thêm mới</a></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <form action="" method="POST" class="col-12">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" name="checkall" class="checkall">
                                </th>
                                <th>Mã sản phẩm</th>
                                <th>Tên danh mục</th>
                                <th>Tên sản phẩm</th>
                                <th>Ảnh sản phẩm</th>
                                <th>Trạng thái</th>
                                <th>Đơn giá</th>
                                <th>Giảm giá</th>
                                <th>Lượt xem</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                            <th>
                                    <input type="checkbox" name="checkall" class="checkall">
                                </th>
                                <th>Mã sản phẩm</th>
                                <th>Tên danh mục</th>
                                <th>Tên sản phẩm</th>
                                <th>Ảnh sản phẩm</th>
                                <th>Trạng thái</th>
                                <th>Đơn giá</th>
                                <th>Giảm giá</th>
                                <th>Lượt xem</th>
                                <th>Thao tác</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php foreach ($result as $r) : ?>
                                <tr>
                                    <td>
                                        <input type="checkbox" name="id[]"  value="<?= $r['id'] ?>">
                                    </td>
                                    <td><?= $r['id'] ?></td>
                                    <td><?= $r['name_cate'] ?></td>
                                    <td><?= $r['name'] ?></td>
                                    <td>
                                        <img src="../images/products/<?= $r['images'] ?>" width="90" alt="">
                                    </td>
                                    <td><?= ($r['status']) ? 'Có hàng' : 'Hết hàng' ?></td>
                                    <td><?= number_format($r['price'],0,',','.').'đ' ?></td>
                                    <td><?=($r['sale']*100).'%'?></td>
                                    <td><?=$r['views']?></td>
                                    <td>
                                        <a href="<?= ROOT ?>admin/?page=product&action=edit&id=<?= $r['id'] ?>" class="btn btn-warning d-block p-2 w-75 mb-2"><i class="far fa-edit"></i></a>
                                        <a href="<?= ROOT ?>admin/?page=gallery&id=<?= $r['id'] ?>" class="btn btn-success d-block p-2 w-75 mb-2"><i class="fas fa-images"></i></a>
                                        <a href="<?= ROOT ?>admin/?page=product&id=<?= $r['id'] ?>" onclick="return confirm('Bạn có chắc muốn xóa không')" class="btn btn-danger d-block p-2 w-75"><i class="far fa-trash-alt"></i></a>
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