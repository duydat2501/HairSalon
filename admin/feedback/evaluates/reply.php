<?php
$errors = [];
$eval = list_one_evaluate('id',$_GET['id']);
if (isset($_POST['btnsave'])) {
    extract($_REQUEST);
    if (empty($content)) {
        $errors['errors-content'] = 'Vui lòng nhập nội dung';
    }if(array_filter($errors)==false){
        insert_evaluate($content,'',$_SESSION['user']['id'],$eval['id_appointment'],$eval['id_service'],$eval['id']);
    $_SESSION['message'] = "Trả lời đánh giá thành công";
    header('Location:' . ROOT . 'admin/?page=evaluate');
    die();
    }
}
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Trả lời đánh giá </h6>
        </div>
        <div class="card-body">
        <form action="" method="post" class="needs-validation" novalidate>
                        <div class="form-group">
                            <label for="content">Nội dung</label>
                            <textarea name="content" id="detail" class="form-control" rows="5" required></textarea>
                            <div class="invalid-feedback">
                            Vui lòng nhập nội dung
                                </div>
                            <?php if(isset($errors['errors-content'])): ?>
                            <p class="text-danger mt-2"><?=$errors['errors-content']?></p>
                            <?php endif; ?>
                        </div>
                        <button type="submit" name="btnsave" class="btn btn-primary">Ghi lại</button>
                    </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->