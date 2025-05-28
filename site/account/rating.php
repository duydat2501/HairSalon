<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $service = service_list_one('id', $id);
    $booking = list_one_appointment($_GET['id_booking']);
}
if (isset($_POST['btnSave'])) {
    extract($_REQUEST);
    insert_evaluate($content, $rating, $_SESSION['user']['id'], $booking['id_user'], $service['id'], 0);
    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
        die();
    }
}

?>
<section>
    <h3 class="text-uppercase mb-5 text-center">Đánh giá dịch vụ</h3>
    <?php if (isset($_SESSION['user']) && $booking['cancel']==3) : ?>
        <form action="" method="post" class="needs-validation form-contact" novalidate>
            <div class="form-group">
                <input type="range" name="rating" min="0" max="5" value="0" step="0.5" id="backing3">
                <div class="rateit" data-rateit-backingfld="#backing3"></div>
                <textarea class="form-control" rows="3" minlength="5" name="content" placeholder="Nhận xét của bạn..." required></textarea>
                <div class="invalid-feedback">
                    Nhận xét có ít nhất 5 ký tự
                </div>
            </div>
            <button type="submit" class="boxed-btn3" name="btnSave">Gửi nhận xét</button>
        </form>
    <?php endif; ?>
    <div class="mt-5">
        <?php evaluate_recursive(0,1,$service['id'],$listArray);?>
        <?php if (!empty($listArray)) : ?>
<?php foreach ($listArray as $key => $value) : ?>

    <?php if ($value['level'] == 1) : ?>
        <div class="row">
            <div class="col-1">
                <div class="box-comment-figure"><img src="images/users/<?= $value['images'] ?>" alt="" width="50" height="50" class="rounded-circle"></div>
            </div>
            <div class="col-10  mb-3">
                <div class="comment">
                    <div class="rateit" data-rateit-value="<?= $value['rating'] ?>" data-rateit-readonly="true"></div>
                    <p class="box-comment-author m-0 font-weight-bold"> <?= $value['name'] ?></p>
                    <div class="box-comment-time font-italic">
                        <time datetime="<?= $value['created_at'] ?>"><?= $value['created_at'] ?></time>
                    </div>
                    <p class="box-comment-text mb-0"><?= $value['content'] ?></p>
                </div>
            </div>
        </div>
    <?php else : ?>
        <?php $padding = ($value['level'] - 1) * 90; ?>
        <div class="row" style="padding-left:<?= $padding ?>px">
            <div class="col-1">
                <div class="box-comment-figure"><img src="images/users/<?= $value['images'] ?>" alt="" width="50" height="50" class="rounded-circle"></div>
            </div>
            <div class="col-10 mb-3">
                <div class="comment">
                    <p class="box-comment-author m-0 font-weight-bold"><?= $value['name'] ?></p>
                    <div class="box-comment-time font-italic">
                        <time datetime="<?= $value['created_at'] ?>"><?= $value['created_at'] ?></time>
                    </div>
                    <p class="box-comment-text mb-0"><?= $value['content'] ?></p>
                </div>
            </div>
        </div>
    <?php endif; ?>

<?php endforeach; ?>
<?php endif; ?>
    </div>
</section>