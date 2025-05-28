<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    contact_delete($id);
    $_SESSION['message'] = "Xóa dữ liệu thành công";
    header('location:' . ROOT . 'admin/?page=contact');
    die;
}
if (isset($_POST['btn-del'])) {
    extract($_REQUEST);
    foreach ($id as $id_contact) {
        contact_delete($id_contact);
    }
    $_SESSION['message'] = "Xóa dữ liệu thành công";
    header('location:' . ROOT . 'admin/?page=contact');
    die;
}

$contact = list_all_contact();
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
            <h6 class="m-0 font-weight-bold text-primary">Danh sách liên hệ</h6>
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
                                <th>Mã liên hệ</th>
                                <th>Họ tên</th>
                                <th>Số điện thoại</th>
                                <th>Email</th>
                                <th>Nội dung</th>
                                <th>Ngày gửi</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                            <th>
                                <input type="checkbox" name="checkall" class="checkall">
                                </th>
                                <th>Mã liên hệ</th>
                                <th>Họ tên</th>
                                <th>Số điện thoại</th>
                                <th>Email</th>
                                <th>Nội dung</th>
                                <th>Ngày gửi</th>
                                <th>Thao tác</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php foreach ($contact as $c) : ?>
                                <tr>
                                    <td>
                                        <input type="checkbox" name="id[]" id="" value="<?= $c['id'] ?>">
                                    </td>
                                    <td><?= $c['id'] ?></td>
                                    <td><?= $c['name'] ?></td>
                                    <td><?=$c['phone']?></td>
                                    <td><?=$c['email']?></td>
                                    <td><?=$c['content']?></td>
                                    <td><?=$c['created_at']?></td>
                                    <td>
                                    <a href="<?= ROOT ?>admin/?page=contact&action=reply&id=<?=$c['id'] ?>" class="btn btn-success d-block p-2 w-75 mb-2"><i class="fas fa-reply"></i></a>
                                    <a href="<?= ROOT ?>admin/?page=contact&action=detail&id=<?= $c['id'] ?>" class="btn btn-primary  d-block p-2 w-75 mb-2"><i class="fas fa-info-circle"></i></a>
                                    <a href="<?= ROOT ?>admin/?page=contact&id=<?= $c['id'] ?>" onclick="return confirm('Bạn có chắc muốn xóa không')" class="btn btn-danger d-block p-2 w-75 mb-2"><i class="far fa-trash-alt"></i></a>
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