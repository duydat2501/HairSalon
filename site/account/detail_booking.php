<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $booking_detail =  all_app_detail($id);
    $total = 0;
}
?>
<section>
    <h3 class="text-uppercase mb-5 text-center">thông tin chi tiết</h3>
    <div class="row mb-3">
        <div class="col-3">
            <strong>Tên dịch vụ</strong>
        </div>
        <div class="col-3">
            <strong>Ảnh dịch vụ</strong>
        </div>
        <div class="col-3">
            <strong>Giá dịch vụ</strong>
        </div>
        <div class="col-3">
            <strong>Thời gian phục vụ</p>
        </div>
    </div>
    <?php foreach ($booking_detail as $bd) : ?>
        <div class="row mb-3">
            <div class="col-3">
                <p><?= $bd['name'] ?></p>
            </div>
            <div class="col-3">
                <img class="rounded-circle" src="images/products/<?= $bd['images'] ?>" alt="" width="50" height="50">
            </div>
            <div class="col-3">
                <?php if ($bd['sale'] > 0) : ?>
                    <div class="old-price">
                        <del><?= number_format($bd['price'], 0, ',', '.') . 'đ' ?></del>
                    </div>
                <?php endif; ?>
                <p class="new-price"><?= number_format(($bd['price'] - ($bd['price'] * $bd['sale'])), 0, ',', '.') . 'đ' ?></p>
            </div>
            <div class="col-3">
                <p><?= $bd['time'] ?></p>
            </div>
        </div>
        <div class="row mb-5">
                <div class="col-12 text-right align-content-end">
                    <a href="<?= ROOT ?>?page=profile&action=rating&id=<?= $bd['id_service'] ?>&id_booking=<?=$id?>" class="btn btn-outline-danger text-uppercase pl-4 pr-4 rounded-0">Xem đánh giá</a>
                </div>
        </div>
        <?php
        $price_new = $bd['price'] - ($bd['price'] * $bd['sale']);
        $total += $price_new;
        ?>
    <?php endforeach; ?>
    <div class="row mb-5">
        <div class="col-12 text-right align-content-end">
            <p class="total">Tổng số tiền: <span class="total-price"><?= number_format($total, 0, ',', '.') . 'đ' ?></span></p>
        </div>
    </div>
</section>