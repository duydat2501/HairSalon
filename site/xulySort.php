<?php
require_once "../golbal.php";
require_once "../libs/products.php";
extract($_REQUEST);
if($sort=='new'){
    $products = product_list_all();
} elseif($sort=='sale'){
    $products =product_list_all_sale();
}elseif($sort=='view'){
    $products =product_list_all_view();
}elseif($sort=='price_low'){
    $products =product_list_price_low();
}elseif($sort=='price_high'){
    $products =product_list_price_high();
}else{
    $products = product_list_all();
}
?>
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
 											<div class="sale pp-sale"><?= ($p['sale'] * 100) . '%' ?></div>
 										<?php endif; ?>
 										<ul>
 											<li class="w-icon active">
											 <form action="<?=ROOT?>?page=cart&id=<?=$p['id']?>&qty=1" method="post">
												 <button class="btn" name="add-to-cart"><i class="fa fa-shopping-bag" aria-hidden="true"></i></button>
												 </form>
											 </li>
 											<li class="quick-view"><a href="<?=ROOT?>?page=cart&id=<?=$p['id']?>&qty=1&add-to-cart&checkout">Mua ngay</a></li>
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