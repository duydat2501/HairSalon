<?php
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $user= list_one_user($id);
}
if (isset($_POST['btnsave'])) {
    extract($_REQUEST);
        user_update($id, $role);
        $_SESSION['message'] = "Cập nhật dữ liệu thành công";
        header('Location:' . ROOT . 'admin/?page=user');
        die();
}
?>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">

    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Thêm thành viên</h6>
        </div>
        <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                <div class="row">
                    <div class="col-md-6">
                    <div class="form-group">
                            <input type="hidden" name="id" id="id" class="form-control"  value="<?= $user['id'] ?>">
                        </div>
                    <div class="form-group">
                            <label for="account">Tên tài khoản</label>
                            <input type="text" name="account" id="account" class="form-control"  value="<?= $user['account'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="name">Họ tên</label>
                            <input type="text" name="name" id="name" class="form-control" 
                              value="<?= $user['name'] ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label for="phone">Số điện thoại</label>
                            <input type="tel" name="phone" id="phone" class="form-control" 
                             value="<?=$user['phone']?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" 
                             value="<?=$user['email'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="role">Vai trò</label>
                            <select name="role" id="role" required class="custom-select">
                                <option value="">Chọn vai trò</option>
                                <option value="1" <?=($user['role']==1)?'selected':''?>>Quản trị</option>
                                <option value="2" <?=($user['role']==2)?'selected':''?>>Lễ tân</option>
                                <option value="3" <?=($user['role']==3)?'selected':''?>>Khách hàng</option>
                            </select>
                            <div class="invalid-feedback">
                                Vui lòng chọn vai trò
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 pl-5">
                        <div class="form-group">
                            <label for="images" class="d-block">Ảnh đại diện</label>
                            <img src="../images/users/<?= $user['images'] ?>" width="150" alt="">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="address">Địa chỉ</label>
                    <textarea class="form-control" name="address" rows="5" readonly><?= $user['address'] ?></textarea>
                </div>
                <button type="submit" name="btnsave" class="btn btn-success">Ghi lại</button>
            </form>
        </div>
    </div>
</div>