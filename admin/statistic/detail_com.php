<?php
if (isset($_GET['id']) && isset($_GET['del'])) {
    $id = $_GET['id'];
    comment_delete($id);
    $_SESSION['message'] = "Xóa dữ liệu thành công";
    header('location:' . ROOT . 'admin/?page=statistic&action=comment');
    die;
}
if (isset($_POST['btn-del'])) {
    extract($_REQUEST);
    foreach ($id as $id_comment) {
        comment_delete($id_comment);
    }
    $_SESSION['message'] = 'Xóa liệu thành công';
    header('Location: ' . ROOT . 'admin/?page=statistic&action=comment');
    die();
}
if (isset($_GET['id'])) {
    $id_product = $_GET['id'];
    $pro = product_list_one('id', $id_product);
    $comment =  comment_by_pro($id_product);
}

if (empty($pro)) {
    header('Location: ' . ROOT . 'admin/?page=statistic&action=comment');
    die();
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
                                <th>Nội dung</th>
                                <th>Ngày bình luận</th>
                                <th>Người bình luận</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>
                                    <input type="checkbox" name="checkall" class="checkall">
                                </th>
                                <th>Nội dung</th>
                                <th>Ngày bình luận</th>
                                <th>Người bình luận</th>
                                <th>Thao tác</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php foreach ($comment as $c) : ?>
                                <tr>
                                    <td>
                                        <input type="checkbox" name="id[]" id="" value="<?= $c['id'] ?>">
                                    </td>
                                    <td><?= $c['content'] ?></td>
                                    <td><?= $c['created_at'] ?></td>
                                    <td><?= $c['name'] ?></td>
                                    <td>
                                        <a href="<?= ROOT ?>admin/?page=statistic&action=detail_com&id=<?= $c['id'] ?>&del" onclick="return confirm('Bạn có chắc muốn xóa không')" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
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