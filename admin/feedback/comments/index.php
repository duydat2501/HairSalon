<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    comment_delete($id);
    $_SESSION['message'] = "Xóa dữ liệu thành công";
    header('location:' . ROOT . 'admin/?page=comment');
    die;
}
if (isset($_POST['btn-del'])) {
    extract($_REQUEST);
    foreach ($id as $id_comment) {
        comment_delete($id_comment);
    }
    $_SESSION['message'] = "Xóa dữ liệu thành công";
    header('location:' . ROOT . 'admin/?page=comment');
    die;
}

$comment = list_all_comment();
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
            <h6 class="m-0 font-weight-bold text-primary">Danh sách bình luận </h6>
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
                                <th>Mã bình luận</th>
                                <th>Họ tên</th>
                                <th>Số điện thoại</th>
                                <th>Tên sản phẩm</th>
                                <th>Nội dung</th>
                                <th>Xếp hạng</th>
                                <th>Ngày bình luận</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>
                                    <input type="checkbox" name="checkall" class="checkall">
                                </th>
                                <th>Mã bình luận</th>
                                <th>Họ tên</th>
                                <th>Số điện thoại</th>
                                <th>Tên sản phẩm</th>
                                <th>Nội dung</th>
                                <th>Xếp hạng</th>
                                <th>Ngày bình luận</th>
                                <th>Thao tác</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php foreach ($comment as $c) : ?>
                                <tr>
                                    <td>
                                        <input type="checkbox" name="id[]" id="" value="<?= $c['id'] ?>">
                                    </td>
                                    <td><?= $c['id'] ?></td>
                                    <td><?= $c['name'] ?></td>
                                    <td><?= $c['phone'] ?></td>
                                    <td><?= $c['product_name'] ?></td>
                                    <td><?= $c['content'] ?></td>
                                    <td><?= $c['rating'] ?></td>
                                    <td><?= $c['created_at'] ?></td>
                                    <td>
                                        <?php if ($c['approve'] == 1) : ?>
                                            <a href="<?= ROOT ?>admin/?page=comment&action=reply&id=<?= $c['id'] ?>" class="btn btn-success d-block p-2 w-75 mb-2"><i class="fas fa-reply"></i></a>
                                        <?php else : ?>
                                            <a href="<?= ROOT ?>admin/?page=comment&action=edit&id=<?= $c['id'] ?>" class="btn btn-success d-block p-2 w-75 mb-2"><i class="fas fa-check"></i></a>
                                        <?php endif; ?>
                                        <a href="<?= ROOT ?>admin/?page=comment&action=detail&id=<?= $c['id'] ?>" class="btn btn-primary  d-block p-2 w-75 mb-2"><i class="fas fa-info-circle"></i></a>
                                        <a href="<?= ROOT ?>admin/?page=comment&id=<?= $c['id'] ?>" onclick="return confirm('Bạn có chắc muốn xóa không')" class="btn btn-danger d-block p-2 w-75 mb-2"><i class="far fa-trash-alt"></i></a>
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