<?php

if (isset($_POST['btn-del'])) {
    extract($_REQUEST);
    foreach ($id as $id_contact) {
        contact_reply_delete($id_contact);
    }
    $_SESSION['message'] = "Xóa dữ liệu thành công";
    header('location:' . ROOT . 'admin/?page=contact');
    die;
}

$contact = list_reply_contact($_GET['id']);
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
                                <th>Tài khoản</th>
                                <th>Nội dung</th>
                                <th>Ngày gửi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                            <th>
                                <input type="checkbox" name="checkall" class="checkall">
                                </th>
                                <th>Mã liên hệ</th>
                                <th>Tài khoản</th>
                                <th>Nội dung</th>
                                <th>Ngày gửi</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php foreach ($contact as $c) : ?>
                                <tr>
                                    <td>
                                        <input type="checkbox" name="id[]" id="" value="<?= $c['id'] ?>">
                                    </td>
                                    <td><?= $c['id'] ?></td>
                                    <td><?= $c['account'] ?></td>
                                    <td><?=$c['content']?></td>
                                    <td><?=$c['created_at']?></td>
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