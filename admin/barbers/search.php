<?php
extract($_REQUEST);
$result = search_barber($keyword);
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    barber_delete($id);
    $_SESSION['message'] = "Xóa dữ liệu thành công";
    header('location:' . ROOT . 'admin/?page=barber');
    die;
}
if (isset($_POST['btn-del'])) {
    extract($_REQUEST);
    foreach ($id as $id_barber) {
        barber_delete($id_barber);
    }
    $_SESSION['message'] = "Xóa dữ liệu thành công";
    header('location:' . ROOT . 'admin/?page=barber');
    die;
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách thợ cắt tìm được với từ khóa "<?=isset($keyword)?$keyword:''?>"</h6>
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
                                <th>Mã thợ cắt</th>
                                <th>Tên tài khoản</th>
                                <th>Họ tên</th>
                                <th>Số điện thoại</th>
                                <th>Ảnh đại diện</th>
                                <th>Email</th>
                                <th>Địa chỉ</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                            <th>
                                    <input type="checkbox" name="checkall" class="checkall">
                                </th>
                                <th>Mã thợ cắt</th>
                                <th>Tên tài khoản</th>
                                <th>Họ tên</th>
                                <th>Số điện thoại</th>
                                <th>Ảnh đại diện</th>
                                <th>Email</th>
                                <th>Địa chỉ</th>
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
                                    <td><?=$r['account']?></td>
                                    <td><?= $r['name'] ?></td>
                                    <td><?= $r['phone'] ?></td>
                                    <td>
                                        <img src="../images/users/<?= $r['images'] ?>" width="90" alt="">
                                    </td>
                                    <td><?=$r['email']?></td>
                                    <td><?=$r['address']?></td>
                                    <td>
                                        <a href="<?= ROOT ?>admin/?page=barber&id=<?= $r['id'] ?>" onclick="return confirm('Bạn có chắc muốn xóa không')" class="btn btn-danger d-block p-2 w-75"><i class="far fa-trash-alt"></i></a>
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