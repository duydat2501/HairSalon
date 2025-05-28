<?php 
extract($_REQUEST);
$products = search_product($keyword);
$count_pro = count($products);
if(empty($keyword)){
    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }else{
        header("Location: " .ROOT);
    }
}
    $category = list_all_category();
	$pro_sale = product_list_sale(0, 5);
	?>
 <!-- bradcam_area_start -->
 <div class="bradcam_area breadcam_bg overlay">
 	<h3>Tìm kiếm</h3>
 </div>
 <!-- bradcam_area_end -->
 <!-- Product Shop Section Begin -->
 <section class="product-shop spad">
 	<div class="container">
 		<div class="row">
 			<div class="col-lg-9 order-1 order-lg-2">
             <div class="text-center mb-5">
						 <h3>
                             <span>Có <strong><?=$count_pro?></strong> sản phẩm với từ khóa: <strong><?=isset($keyword)?$keyword:''?></strong></span>
                         </h3>
					 </div>
 				<div class="product-list">
 					<div class="row">
 						<!-- dùng vòng lăp -->
 						<?php foreach ($products as $p) : ?>
 							<div class="col-lg-4 col-sm-6">
 								<div class="product-item">
 									<div class="pi-pic">
 										<a href="<?=ROOT?>?page=product-detail&id=<?=$p['id']?>">
										 <img src="images/products/<?= $p['images'] ?>" alt="<?= $p['name'] ?>" width="270" height="303" title="<?= $p['name'] ?>">
										 </a>
 										<?php if ($p['sale'] > 0) : ?>
 											<div class="sale pp-sale">-<?= ($p['sale'] * 100) . '%' ?></div>
 										<?php endif; ?>
 										<ul>
											 <li class="w-icon active">
											 <form action="<?=ROOT?>?page=cart&id=<?=$p['id']?>&qty=1" method="post">
												 <button class="btn" name="add-to-cart"><i class="fa fa-shopping-bag" aria-hidden="true"></i></button>
												 </form>
											 </li>
 											<li class="quick-view"><a href="<?=ROOT?>?page=cart&id=<?=$p['id']?>&qty=1&add-to-cart">Mua ngay</a></li>
 											<li class="w-icon"><a href="<?=ROOT?>?page=product-detail&id=<?=$p['id']?>"><i class="fa fa-random"></i></a></li>
 										</ul>
 									</div>
 									<div class="pi-text">
 										<a href="<?=ROOT?>?page=product-detail&id=<?=$p['id']?>">
 											<h5><?= substr($p['name'], 0, 28) . $str = (strlen($p['name']) > 28 ? '...' : '') ?></h5>
 										</a>
 										<div class="product-price">
											 <?= number_format($p['price'], 0, ',', '.') . 'đ' ?>
											 <span><i class="fa fa-eye ml-3 mr-1" aria-hidden="true"></i><?=$p['views']?></span>
 										</div>
 									</div>
 								</div>
 							</div>
 						<?php endforeach; ?>
 					</div>
 				</div>
 			</div>
 			<div class="col-lg-3 pr-3">
 				<aside class="">
				<div class="search_pro">
				<form action="<?=ROOT?>?page=search" method="POST" class="form-contact needs-validation" novalidate>
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <input type="search" class="form-control" name="keyword" placeholder="Tìm kiếm sản phẩm" required>
                                    <div class="input-group-append">
                                        <button class="btn" type="submit"><i class="ti-search"></i></button>
									</div>
									<div class="invalid-feedback">
             Vui lòng nhập từ khóa tìm kiếm
            </div>
                                </div>
                            </div>
                        </form>
				</div>
 					<h4 class="category-widget">Danh mục</h4>
 					<ul class="list-cate">
 						<?php foreach ($category as $c) : ?>
 							<li>
 								<a href="<?=ROOT?>?page=pro-list&id=<?=$c['id']?>" class="d-flex">
 									<img src="images/categories/<?= $c['images'] ?>" alt="" width="30">
 									<p class="ml-3"><?= $c['name'] ?></p>
 								</a>
 							</li>
 						<?php endforeach; ?>
 					</ul>
 					<div class="list-group mb-3 mt-3">
					 <!-- sản phẩm yêu thích -->
 						<h4 class="category-widget mt-3 rounded">Sản phẩm nổi bật</h4>
 						<div class="pro-top">
 							<?php foreach ($pro_sale as $pv) : ?>
 								<div class="list-group-item-action">
 									<div class="row">
 										<div class="col-4">
 											<a href="<?= ROOT ?>?page=product-detail&id=<?= $pv['id'] ?>"><img src="images/products/<?= $pv['images'] ?>" class="img-fluid" alt="Responsive image" title="<?= $pv['name'] ?>"></a>
 										</div>
 										<div class="col-8">
 											<p class="top-name"><a href="<?= ROOT ?>?page=product-detail&id=<?= $pv['id'] ?>" title="<?= $pv['name'] ?>"><?= substr($pv['name'], 0, 30) . $str = (strlen($pv['name']) > 28 ? '...' : '') ?></a></p>
 											<p class="top-price"><?= number_format($pv['price'], 0, ',', '.') . 'đ' ?></p>
 										</div>
 									</div>
 								</div>
 							<?php endforeach; ?>
 						</div>
 					</div>
 				</aside>

 			</div>
 		</div>

 	</div>
 	</div>
 </section>
 <!-- Product Shop Section End -->