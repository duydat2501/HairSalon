<?php
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $category = list_all_category();
	$pro_sale = product_list_sale(0, 5);
	$cate = list_one_category('id',$id);

	$num_row = num_row($id);
	$current_page = isset($_GET['p']) ? $_GET['p'] : 0;
	$limit = 9;
	//tổng số trang
	$total_page = ceil($num_row / $limit);
	// Giới hạn current_page trong khoảng 1 đến total_page
	if ($current_page > $total_page) {
		$current_page = $total_page;
	} else if ($current_page < 1) {
		$current_page = 1;
	}
	// Tìm Start
	$start = ($current_page - 1) * $limit;
	$products =  product_list_categories($id,$start, $limit);
}

	?>
 <!-- bradcam_area_start -->
 <div class="bradcam_area breadcam_bg overlay">
 	<h3>Sản phẩm</h3>
 </div>
 <!-- bradcam_area_end -->
 <!-- Product Shop Section Begin -->
 <section class="product-shop spad">
 	<div class="container">
 		<div class="row">
 			<div class="col-lg-9 order-1 order-lg-2">
				 <div class="row mb-5">
					 <div class="col-8">
						 <h2><?=$cate['name']?></h2>
					 </div>
					 <div class="col-4">
						<form action="" method="post" class="form-contact">
							<input type="hidden" name="id" id="id_cate" value="<?=$id?>">
						<select name="sortCate" class="form-control" id="sortCate">
							 <option value="">Sắp xếp theo</option>
							 <option value="new">Mới nhất</option>
							 <option value="sale">Khuyến mãi</option>
							 <option value="price_low">Giá từ thấp tới cao</option>
							 <option value="price_high">Giá từ cao tới thấp</option>
							 <option value="view">Xem nhiều</option>
						 </select>
						</form>
					 </div>
				 </div>
 				<div class="product-list" id="list_pro_cate">
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
					 <!-- phan trang -->
 					<nav class="blog-pagination justify-content-center d-flex">
 						<ul class="pagination">
 							<?php if ($current_page > 1 && $total_page > 1) : ?>
 								<li class="page-item">
 									<a href="<?= ROOT ?>?page=pro-list&id=<?=$cate['id']?>&p=<?= ($current_page - 1) ?>" class="page-link" aria-label="Previous">
 										<i class="ti-angle-left"></i>
 									</a>
 								</li>
 							<?php endif; ?>
 							<?php
								for ($i = 1; $i <= $total_page; $i++) : ?>
 								<!-- // Nếu là trang hiện tại thì hiển thị active
                    // ngược lại hiển thị thẻ a -->
 								<?php if ($i == $current_page) : ?>
 									<li class="page-item active">
 										<a href="<?= ROOT ?>?page=pro-list&id=<?=$cate['id']?>&p=<?= $i ?>" class="page-link"><?= $i ?></a>
 									</li>
 								<?php else : ?>
 									<li class="page-item">
 										<a href="<?= ROOT ?>?page=pro-list&id=<?=$cate['id']?>&p=<?= $i ?>" class="page-link"><?= $i ?></a>
 									</li>
 								<?php endif; ?>
 							<?php endfor;  ?>
 							<?php if ($current_page < $total_page && $total_page > 1) : ?>
 								<li class="page-item">
 									<a href="<?= ROOT ?>?page=pro-list&id=<?=$cate['id']?>&p=<?= ($current_page + 1) ?>" class="page-link" aria-label="Next">
 										<i class="ti-angle-right"></i>
 									</a>
 								</li>
 							<?php endif; ?>
 						</ul>
 					</nav>
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