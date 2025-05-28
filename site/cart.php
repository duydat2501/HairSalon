<?php
$id = isset($_GET['id']) ? $_GET['id'] : '';
$products = product_list_one('id',$id);
if(isset($_SESSION['user'])){
	if (isset($_REQUEST['add-to-cart'])) {
		$quantity = $_REQUEST['qty'];
		if (!isset($_SESSION['cartCustom'][$_SESSION['user']['id']][$id])) {
			$_SESSION['cartCustom'][$_SESSION['user']['id']][$id] = array(
				"id" => $products['id'],
				"name" => $products['name'],
				"images" => $products['images'],
				"quantity" => $quantity,
				"price" => $products['price'],
				"sale"=>$products['sale']
            );
           
		} else {
            $_SESSION['cartCustom'][$_SESSION['user']['id']][$id]['quantity'] += $quantity;
        }
        if(!isset($_REQUEST['checkout'])){
            if (isset($_SERVER["HTTP_REFERER"])) {
                $_SESSION['message']="Sản phẩm đã được thêm vào giỏ hàng";
                header("Location: " . $_SERVER["HTTP_REFERER"]);
                die();
            }
        }else{
            header("Location: " . ROOT.'?page=checkout');
            die();
        }
	}
	if (!empty($_SESSION['cartCustom'][$_SESSION['user']['id']])) {
		$cartCustom = $_SESSION['cartCustom'][$_SESSION['user']['id']];
    }
   
}else{
	if (isset($_REQUEST['add-to-cart'])) {
		$quantity = $_REQUEST['qty'];
		if (!isset($_SESSION['cart'][$id])) {
			$_SESSION['cart'][$id] = array(
				"id" => $products['id'],
				"name" => $products['name'],
				"images" => $products['images'],
				"quantity" => $quantity,
				"price" => $products['price'],
				"sale"=>$products['sale']
			);
		} else {
			$_SESSION['cart'][$id]['quantity'] += $quantity;
		}
        if(!isset($_REQUEST['checkout'])){
            if (isset($_SERVER["HTTP_REFERER"])) {
                $_SESSION['message']="Sản phẩm đã được thêm vào giỏ hàng";
                header("Location: " . $_SERVER["HTTP_REFERER"]);
                die();
            }
        }else{
            header("Location: " . ROOT.'?page=checkout');
            die();
        }
	}
	if (!empty($_SESSION['cart'])) {
		$cart = $_SESSION['cart'];
	}
}
?>
<!-- bradcam_area_start -->
<div class="bradcam_area breadcam_bg overlay">
    <h3>Giỏ hàng</h3>
</div>
<!-- bradcam_area_end -->
<!-- Shopping Cart Section Begin -->
<section class="shopping-cart spad">
    <div class="container">
        <div class="row">
            <?php if(isset($cartCustom) && isset($_SESSION['user'])): ?>
                <div class="col-lg-12">
                <form action="<?=ROOT?>?page=checkout" method="post">
                    <div class="cart-table">
                        <table>
                            <thead>
                                <tr>
                                    <th colspan="2">Sản phẩm</th>
                                    <th>Đơn giá</th>
                                    <th>Số lượng</th>
                                    <th>Thành tiền</th>
                                    <th>Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($cartCustom as $c): 
                                $price= $c['price']-($c['price']*$c['sale']);
                                $thanhTien = ($price * $c['quantity']);
                                ?>
                                <tr>
                                    <td class="cart-pic first-row">
                                        <a href="<?=ROOT?>?page=product-detail&id=<?=$c['id']?>"><img
                                                src="images/products/<?=$c['images']?>" alt="" width="146"
                                                height="132"></a>
                                    </td>
                                    <td class="cart-title first-row">
                                        <h5><a href="<?=ROOT?>?page=product-detail&id=<?=$c['id']?>"><?=$c['name']?></a>
                                        </h5>
                                    </td>

                                    <td class="p-price first-row old-price">
                                        <?php if($c['sale']>0): ?>
                                        <del><?=number_format($c['price'],0,',','.').' đ';?></del>
                                        <?php endif; ?>
                                        <?=number_format($price,0,',','.').' đ';?></td>
                                    <input type="hidden" class="price" name="" value="<?=$price?>">
                                    <td class="qua-col first-row">
                                        <div class="number-input">
                                            <input type="number" class="qty" min="1" id="qty<?=$c['id']?>" max="1000"
                                                name="quantity" value="<?= $c['quantity'] ?>" step="1" />
                                            <input type="hidden" class="id_pro" name="id_pro" value="<?= $c['id'] ?>">
                                        </div>
                                    </td>
                                    <td class="total-price sub-total first-row">
                                        <?=number_format($thanhTien, 0, ',', '.') . 'đ'?>
                                    </td>
                                    <td class="close-td first-row">
                                        <a href="<?= ROOT ?>?page=checkout&id=<?= $c['id'] ?>&btnXoa"
                                            onclick="return confirm('Bạn chắc chắn muốn bỏ sản phẩm này?')">
                                            <i class="ti-close"></i></a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <a href="<?=ROOT?>?page=product-list" class="button button-contactForm boxed-btn">Tiếp tục
                                mua</a>
                        </div>
                        <div class="col-lg-3">
                            <button type="submit" name="btnXoaCartCustom" class="button button-contactForm boxed-btn" onclick="return confirm('Bạn chắc chắn muốn xóa giỏ hàng?')">Xóa giỏ
                                hàng</button>
                        </div>
                        <div class="col-lg-4 offset-lg-2">
                            <div class="proceed-checkout">
                                <ul>
                                    <li class="cart-total">Tổng tiền
                                        <span
                                            id="total-price"><?=number_format(total_price($cartCustom), 0, ',', '.') . 'đ'?></span>
                                    </li>
                                </ul>
                                 <button type="submit" class="proceed-btn rounded-0 btn w-100">Đặt hàng</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <?php elseif (isset($cart)) : ?>
            <div class="col-lg-12">
                <form action="<?=ROOT?>?page=checkout" method="post">
                    <div class="cart-table">
                        <table>
                            <thead>
                                <tr>
                                    <th colspan="2">Sản phẩm</th>
                                    <th>Đơn giá</th>
                                    <th>Số lượng</th>
                                    <th>Thành tiền</th>
                                    <th>Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($cart as $c): 
                                $price= $c['price']-($c['price']*$c['sale']);
                                $thanhTien = ($price * $c['quantity']);
                                ?>
                                <tr>
                                    <td class="cart-pic first-row">
                                        <a href="<?=ROOT?>?page=product-detail&id=<?=$c['id']?>"><img
                                                src="images/products/<?=$c['images']?>" alt="" width="146"
                                                height="132"></a>
                                    </td>
                                    <td class="cart-title first-row">
                                        <h5><a href="<?=ROOT?>?page=product-detail&id=<?=$c['id']?>"><?=$c['name']?></a>
                                        </h5>
                                    </td>


                                    <td class="p-price first-row old-price">
                                        <?php if($c['sale']>0): ?>
                                        <del><?=number_format($c['price'],0,',','.').' đ';?></del>
                                        <?php endif; ?>
                                        <?=number_format($price,0,',','.').' đ';?></td>
                                    <input type="hidden" class="price" name="" value="<?=$price?>">
                                    <td class="qua-col first-row">
                                        <div class="number-input">
                                            <input type="number" class="qty" min="1" id="qty<?=$c['id']?>" max="1000"
                                                name="quantity" value="<?= $c['quantity'] ?>" step="1" />
                                            <input type="hidden" class="id_pro" name="id_pro" value="<?= $c['id'] ?>">
                                        </div>
                                    </td>
                                    <td class="total-price sub-total first-row">
                                        <?=number_format($thanhTien, 0, ',', '.') . 'đ'?>
                                    </td>
                                    <td class="close-td first-row">
                                        <a href="<?= ROOT ?>?page=checkout&id=<?= $c['id'] ?>&btnDelete"
                                            onclick="return confirm('Bạn chắc chắn muốn bỏ sản phẩm này?')">
                                            <i class="ti-close"></i></a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <a href="<?=ROOT?>?page=product-list" class="button button-contactForm boxed-btn">Tiếp tục
                                mua</a>
                        </div>
                        <div class="col-lg-3">
                            <button type="submit" name="btnXoaCart" class="button button-contactForm boxed-btn" onclick="return confirm('Bạn chắc chắn muốn xóa giỏ hàng?')">Xóa giỏ
                                hàng</button>
                        </div>
                        <div class="col-lg-4 offset-lg-2">
                            <div class="proceed-checkout">
                                <ul>
                                    <li class="cart-total">Tổng tiền
                                        <span
                                            id="total-price"><?=number_format(total_price($cart), 0, ',', '.') . 'đ'?></span>
                                    </li>
                                </ul>
                               
                                 <button type="submit" class="proceed-btn rounded-0 btn w-100">Đặt hàng</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <?php else: ?>
            <div class="empty-cart col-12">
                <div class="cart"></div>
                <div class="title">Giỏ hàng của bạn còn trống</div>
                <a href="<?=ROOT?>?page=product-list" class="boxed-btn">mua sắm ngay</a>
            </div>
            
            <?php endif; ?>
        </div>
    </div>
</section>
<!-- Shopping Cart Section End -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $('.qty').change(function() {
        var qty = $(this).val();
        var id_pro = $(this).closest('tr').find('.id_pro').val();
        var price = $(this).closest('tr').find('.price').val();
        $data = {
            qty: qty,
            id_pro: id_pro,
            price: price,
        };

        var me = this;
        $.ajax({
            url: "site/updateCart.php",
            method: 'POST',
            data: $data,
            dataType: 'json',
            success: function(data) {
                $(me).closest('tr').find('.sub-total').text(data.sub_total_new);
                $('#total-price').text(data.total_new);
            },
        });
    });
});
</script>