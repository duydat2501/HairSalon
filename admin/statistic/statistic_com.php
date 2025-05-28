<?php $comment = statistical_comment(); ?>
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
            <h6 class="m-0 font-weight-bold text-primary">Tổng hợp bình luận </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <form action="" method="POST" class="col-md-12">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Tên sản phẩm</th>
                                <th>Số bình luận</th>
                                <th>Mới nhất</th>
                                <th>Cũ nhất</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                            <th>Tên sản phẩm</th>
                                <th>Số bình luận</th>
                                <th>Mới nhất</th>
                                <th>Cũ nhất</th>
                                <th>Thao tác</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php foreach ($comment as $c) : ?>
                                <tr>
                                    <td><?= $c['name'] ?></td>
                                    <td><?= $c['so_luong'] ?></td>
                                    <td><?= $c['cu_nhat'] ?></td>
                                    <td><?= $c['moi_nhat'] ?></td>
                                    <td>
                                        <a href="<?= ROOT ?>admin/?page=statistic&action=detail_com&id=<?= $c['id'] ?>" class="btn btn-success">Chi tiết</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->