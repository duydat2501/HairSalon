<?php
$blog = list_limit_new(0, 5);
$gallery = library_list_limit(0, 10);
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $detail = list_one_new($id);
    $user =  user_check('id',$detail['id_user']);
    update_view_blog($id);
    if (empty($detail)) {
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
            die();
        } else {
            header("Location: " . ROOT);
            die();
        }
    }
}
?>
<!-- bradcam_area_start -->
<div class="bradcam_area breadcam_bg overlay">
    <h3>Bài viết chi tiết</h3>
</div>
<!-- bradcam_area_end -->

<!--================Blog Area =================-->
<section class="blog_area single-post-area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 posts-list">
                <div class="single-post">
                    <div class="feature-img">
                        <img class="img-fluid card-img rounded-0" src="images/sliders/<?= $detail['images'] ?>" alt="">
                    </div>
                    <div class="blog_details">
                        <h2><?= $detail['title'] ?></h2>
                        <ul class="blog-info-link mt-3 mb-4">
                            <li><a href="#"><i class="fa fa-user"></i><?=$user['name']?></a></li>
                            <li><a href="#"><i class="fa fa-eye mr-1" aria-hidden="true"></i> <?= $detail['views'] ?></a></li>
                        </ul>
                        <p>
                            <?= $detail['content'] ?>
                        </p>

                    </div>
                </div>

            </div>
            <div class="col-lg-4">
                <div class="blog_right_sidebar">
                    <aside class="single_sidebar_widget search_widget">
                        <form action="<?=ROOT?>?page=search_blog" class="needs-validation" method="POST" novalidate>
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <input type="text" name="keyword" class="form-control" placeholder="Tìm kiếm bài viết" required>
                                    <div class="input-group-append">
                                        <button class="btn" type="submit"><i class="ti-search"></i></button>
                                    </div>
                                    <div class="invalid-feedback">
             Vui lòng nhập từ khóa tìm kiếm
            </div>
                                </div>
                            </div>
                            <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn" type="submit">Tìm kiếm</button>
                        </form>
                    </aside>
                    <!-- bài viết mới nhất -->
                    <aside class="single_sidebar_widget popular_post_widget">
                        <h3 class="widget_title">Bài viết mới nhất</h3>
                        <?php foreach ($blog as $bl) : ?>
                            <div class="media post_item">
                                <a href="<?= ROOT ?>?page=blog-detail&id=<?= $bl['id'] ?>"><img src="images/sliders/<?= $bl['images'] ?>" alt="post" width="80" height="80"></a>
                                <div class="media-body">
                                    <a href="<?= ROOT ?>?page=blog-detail&id=<?= $bl['id'] ?>">
                                        <h3><?= substr($bl['title'], 0, 24) . $str = (strlen($bl['title']) > 24 ? '...' : '') ?></h3>
                                    </a>
                                    <?php
                                    $day = $bl['created_at'];
                                    $date = strtotime("$day"); ?>
                                    <p><?= date("F j, Y", $date) ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </aside>
                    <!-- Mẫu tóc  -->
                    <aside class="single_sidebar_widget instagram_feeds">
                        <h4 class="widget_title">Thư viện </h4>
                        <ul class="instagram_row flex-wrap">
                            <?php foreach ($gallery as $g) : ?>
                                <li>
                                    <a href="<?=ROOT?>?page=blog-detail&id=<?=$g['link']?>">
                                        <img class="img-fluid" src="images/sliders/<?= $g['images'] ?>" alt="">
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </aside>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================ Blog Area end =================-->