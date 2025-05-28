<?php
if (isset($_SESSION['user'])) {
  $user = list_one_user($_SESSION['user']['id']);
  $phone = $user['phone'];
  $name = $user['name'];
  $address = $user['address'];
  if (empty($_SESSION['cartCustom'])) {
    header('location: ' . ROOT . '?page=cart');
  }
}else{
  if (empty($_SESSION['cart'])) {
    header('location: ' . ROOT . '?page=cart');
  }
}
//nguoi dung chua dăng nhap
//Xoa 1 san pham trong gio
if (isset($_REQUEST['btnDelete'])) {
  extract($_REQUEST);
  unset($_SESSION['cart'][$id]);
  header('Location: ' . ROOT . '?page=cart');
  die();
}
//Xoa gio
if (isset($_REQUEST['btnXoaCart'])) {
  extract($_REQUEST);
  unset($_SESSION['cart']);
  header('Location: ' . ROOT . '?page=cart');
  die();
}

//nguoi dung da dang nhap
//Xoa 1 sp trong gio
if (isset($_REQUEST['btnXoa'])) {
  extract($_REQUEST);
  unset($_SESSION['cartCustom'][$_SESSION['user']['id']][$id]);
  header('Location: ' . ROOT . '?page=cart');
  die();
}
//xoa gio
if (isset($_REQUEST['btnXoaCartCustom'])) {
  extract($_REQUEST);
  unset($_SESSION['cartCustom'][$_SESSION['user']['id']]);
  header('Location: ' . ROOT . '?page=cart');
  die();
}

/////====================Dat hang===================

if (isset($_REQUEST['btnOrder'])) {
  extract($_REQUEST);
  if (isset($_SESSION['user'])) {
    $cart = $_SESSION['cartCustom'][$_SESSION['user']['id']];
      insert_order($_SESSION['user']['id'], $address, $phone);
      $order = list_top_order($_SESSION['user']['id']);
      foreach ($cart as $key => $value) {
        $pro = product_list_one('id', $value['id']);
        insert_detail($order['id'], $value['id'], $value['quantity']);
    }
    unset($_SESSION['cartCustom'][$_SESSION['user']['id']]);
    $_SESSION['message']= "Đặt hàng thành công";
  } else {
    $cart = $_SESSION['cart'];
    $user = user_check('phone', $phone);
    if ($user > 0) {
      if (empty($user['password'])) {
        user_update($user['id'], $name, $address, 'user.svg');
        $cus = user_check('phone', $phone);
        $id_user = $cus['id'];
      }
    } else {
      if(barber_check('phone',$phone)){
        $_SESSION['message']= "Đặt hàng thất bại";
        header('Location: ' . ROOT . '?page=cart');
        die();
      }else{
        $cu = guest_insert($name, $phone, $address, 'user.svg',3);
      $cus = user_check('phone', $phone);
      $id_user = $cus['id'];
      }
    }
    insert_order($id_user, $address, $phone);
    $order = list_top_order($id_user);
    foreach ($cart as $key => $value) {
      $pro = product_list_one('id', $value['id']);
      insert_detail($order['id'], $value['id'], $value['quantity']);
    }
    unset($_SESSION['cart']);
    $_SESSION['message']= "Đặt hàng thành công";
  }
  header('Location: ' . ROOT . '?page=cart');
  die();
}
?>
<!-- bradcam_area_start -->
<div class="bradcam_area breadcam_bg overlay">
  <h3>Thanh toán</h3>
</div>

<!-- bradcam_area_end -->
<section class="checkout section-padding">
  <div class="container">
    <div class="row">
      <div class="col-7">
        <div class="text-center">
          <h3>Thông tin thanh toán</h3>
        </div>
        <?php if (isset($_SESSION['user'])) : ?>
          <div class="row mb-5 mt-3">
            <div class="col-2">
              <img src="images/users/<?= $user['images'] ?>" alt="avatar" width="50">
            </div>
            <div class="col-10">
              <p><?= $_SESSION['user']['name'] ?> (<?= $_SESSION['user']['phone'] ?>)</p>
            </div>
          </div>
        <?php endif; ?>
        <form action="" method="post" class="form-contact needs-validation" novalidate>
          <div class="form-group">
            <label for="">Họ tên</label>
            <input type="text" name="name" value="<?= isset($name) ? $name : '' ?>" placeholder="Tên của bạn" class="form-control" title="Họ tên không bao gồm số" pattern="[a-zA-Z\s'-'\sáàảãạăâắằấầặẵẫậéèẻ ẽêẹếềểễệóòỏõọôốồổỗộ ơớờởỡợíìỉĩịđùúủũụưứ? ?ửữựÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠ ƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼ? ??ÊỀỂỄỆỈỊỌỎỐỒỔỖỘỚỜỞ ỠỢỤỨỪỬỮỰỲỴÝỶỸửữựỵ ỷỹ]{1,20}" required />
            <div class="invalid-feedback">
              Họ tên không đúng định dạng
            </div>
          </div>
          <div class="form-group">
            <label for="">Địa chỉ</label>
            <textarea name="address" class="form-control" minlength="5" cols="30" rows="5" required><?= isset($address) ? $address : '' ?></textarea>
            <div class="invalid-feedback">
              Địa chỉ có ít nhất 5 ký tự
            </div>
          </div>
          <div class="form-group">
            <label for="">Số điện thoại</label>
            <input type="text" name="phone" value="<?= isset($phone) ? $phone : '' ?>" placeholder="Số điện thoại" class="form-control" pattern="^\+?\d{1,3}?[- .]?\(?(?:\d{2,3})\)?[- .]?\d\d\d[- .]?\d\d\d\d$" required />
            <div class="invalid-feedback">
              SĐT không hợp lệ
            </div>
          </div>
          <a href="<?= ROOT ?>?page=cart" class="boxed-btn3 mr-5">Giỏ hàng</a>
          <button type="submit" name="btnOrder" class="boxed-btn3">Đặt hàng</button>
        </form>
      </div>


      <div class="col-5 checkout-table">
        <h4>Giỏ hàng</h4>
        <?php if (isset($_SESSION['user'])) : ?>
          <table>
            <tbody>
              <?php if (isset($_SESSION['cartCustom'][$_SESSION['user']['id']])) : ?>
                <?php foreach ($_SESSION['cartCustom'][$_SESSION['user']['id']] as $cartCustom) : ?>
                  <tr>
                    <td>
                      <img src="images/products/<?= $cartCustom['images'] ?>" alt="ảnh sản phẩm" width="50">
                    </td>
                    <td><?= $cartCustom['name'] ?></td>
                    <td>X<?=$cartCustom['quantity']?></td>
                    <td><?= number_format(($cartCustom['price'] - ($cartCustom['price'] * $cartCustom['sale'])) * $cartCustom['quantity'], 0, ',', '.') . 'đ' ?></td>
                  </tr>
                <?php endforeach; ?>
                <tr>
                  <td colspan="2">Tổng tiền</td>
                  <td><?= number_format(total_price($_SESSION['cartCustom'][$_SESSION['user']['id']]), 0, ',', '.') . 'đ' ?></td>
                </tr>
              <?php else : header('Location: ' . ROOT . '?page=cart'); ?>
              <?php endif; ?>
            </tbody>
          </table>
        <?php elseif (isset($_SESSION['cart'])) : ?>
          <table>
            <tbody>
              <?php foreach ($_SESSION['cart'] as $cart) : ?>
                <tr>
                  <td>
                    <img src="images/products/<?= $cart['images'] ?>" alt="ảnh sản phẩm" width="50">
                  </td>
                  <td><?= $cart['name'] ?></td>
                  <td>X<?=$cart['quantity']?></td>
                  <td><?= number_format(($cart['price'] - ($cart['price'] * $cart['sale'])) * $cart['quantity'], 0, ',', '.') . 'đ' ?></td>
                </tr>
              <?php endforeach; ?>
              <tr>
                <td colspan="2">Tổng tiền</td>
                <td><?= number_format(total_price($_SESSION['cart']), 0, ',', '.') . 'đ' ?></td>
              </tr>
            </tbody>
          </table>
        <?php else : header('Location: ' . ROOT . '?page=cart'); ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>