<?php
if (user_check('phone', $user['phone'])) {
  $users = user_check('phone', $user['phone']);
  $order = list_user_order($users['id']);
  $order_wait = status_all_order('Chờ lấy hàng', $users['id']);
  $order_delivery = status_all_order('Đang giao', $users['id']);
  $order_delivered = status_all_order('Đã giao', $users['id']);
  $order_cancel = status_all_order('Đã hủy', $users['id']);
}
if (isset($_REQUEST['btnUpdate'])) {
  extract($_REQUEST);
  order_update($id, 'Đã hủy');
  header('location:' . ROOT . '?page=profile&action=purchase');
}
?>
<div class="nav-order">
  <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="pills-all-tab" data-toggle="pill" href="#pills-all" role="tab" aria-controls="pills-all" aria-selected="false">Tất cả</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Chờ lấy hàng</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="false">Đang giao</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Đã giao</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="pills-cancel-tab" data-toggle="pill" href="#pills-cancel" role="tab" aria-controls="pills-cancel" aria-selected="false">Đã hủy</a>
    </li>
  </ul>
</div>
<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade show active" id="pills-all" role="tabpanel" aria-labelledby="pills-all-tab">
    <?php if (user_check('phone', $user['phone'])) : ?>
      <?php if (!empty($order)) : ?>
        <div class="order mt-5">
          <?php foreach ($order as $o) : ?>
            <div class="text-right align-content-end text-capitalize mb-5 bg-light p-3"><?= $o['status'] ?></div>
            <?php foreach (list_all_purchase($users['id'], $o['id']) as $all) : ?>
              <div class="row border-bottom pb-2 mb-3">
                <div class="col-2">
                  <a href="<?= ROOT ?>?page=detail&id=<?= $all['id_product'] ?>"> <img src="<?= ROOT ?>images/products/<?= $all['images'] ?>" alt="" width="80" height="80"></a>
                </div>
                <div class="col-7">
                  <a href="<?= ROOT ?>?page=detail&id=<?= $all['id_product'] ?>" class="order-name"><?= $all['name'] ?></a>
                  <p>x<?= $all['quantity'] ?></p>
                </div>

                <div class="col-3 text-right">
                  <?php if ($all['sale'] > 0) : ?>
                    <div class="old-price">
                      <del><?= number_format($all['price'], 0, ',', '.') . 'đ' ?></del>
                    </div>
                  <?php endif; ?>
                  <p class="new-price"><?= number_format(($all['price'] - ($all['price'] * $all['sale'])), 0, ',', '.') . 'đ' ?></p>
                </div>
              </div>
            <?php endforeach; ?>
            <?php $detail = list_all_detail($o['id']);
            $total = 0;
            foreach ($detail as $d) {
              $price_new = $d['price'] - ($d['price'] * $d['sale']);
              $total += $d['quantity'] * $price_new;
            }
            ?>
            <div class="row mb-5">
              <div class="col-12 text-right align-content-end">
                <p class="total">Tổng số tiền: <span class="total-price"><?= number_format($total, 0, ',', '.') . 'đ' ?></span></p>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php else : ?>
        <div class="empty-purchase mt-5 mb-3 pt-5">
          <div class="purchase"></div>
          <div class="title text-center">Chưa có đơn hàng</div>
        </div>
      <?php endif; ?>
    <?php else : ?>
      <div class="empty-purchase mt-5 mb-3 pt-5">
        <div class="purchase"></div>
        <div class="title text-center">Chưa có đơn hàng</div>
      </div>
    <?php endif; ?>
  </div>
  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
    <?php if (user_check('phone', $user['phone'])) : ?>
      <?php if (!empty(user_order_status($users['id'], 'Chờ lấy hàng'))) : ?>
        <div class="order mt-5">
          <?php foreach ($order_wait as $o) : ?>
            <?php foreach (order_status($users['id'], $o['id'], 'Chờ lấy hàng') as $all) : ?>
              <div class="row border-bottom pb-2 mb-3">
                <div class="col-2">
                  <a href="<?= ROOT ?>?page=detail&id=<?= $all['id_product'] ?>"> <img src="<?= ROOT ?>images/products/<?= $all['images'] ?>" alt="" width="80" height="80"></a>
                </div>
                <div class="col-7">
                  <a href="<?= ROOT ?>?page=detail&id=<?= $all['id_product'] ?>" class="order-name"><?= $all['name'] ?></a>
                  <p>x<?= $all['quantity'] ?></p>
                </div>
                <div class="col-3 text-right">
                  <?php if ($all['sale'] > 0) : ?>
                    <div class="old-price">
                      <del><?= number_format($all['price'], 0, ',', '.') . 'đ' ?></del>
                    </div>
                  <?php endif; ?>
                  <p class="new-price"><?= number_format(($all['price'] - ($all['price'] * $all['sale'])), 0, ',', '.') . 'đ' ?></p>
                </div>
              </div>
            <?php endforeach; ?>
            <?php $detail = list_all_detail($o['id']);
            $total = 0;
            foreach ($detail as $d) {
              $price_new = $d['price'] - ($d['price'] * $d['sale']);
              $total += $d['quantity'] * $price_new;
            }
            ?>
            <div class="row mb-5">
              <div class="col-8 text-right align-content-end">
                <a href="<?= ROOT ?>?page=profile&action=purchase&btnUpdate&id=<?= $o['id'] ?>" class="btn btn-outline-danger text-uppercase pl-4 pr-4 rounded-0">Hủy đơn</a>
              </div>
              <div class="col-4 text-right align-content-end">
                <p class="total">Tổng số tiền: <span class="total-price"><?= number_format($total, 0, ',', '.') . 'đ' ?></span></p>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php else : ?>
        <div class="empty-purchase mt-5 mb-3 pt-5">
          <div class="purchase"></div>
          <div class="title text-center">Chưa có đơn hàng</div>
        </div>
      <?php endif; ?>
    <?php else : ?>
      <div class="empty-purchase mt-5 mb-3 pt-5">
        <div class="purchase"></div>
        <div class="title text-center">Chưa có đơn hàng</div>
      </div>
    <?php endif; ?>
  </div>
  <div class="tab-pane fade" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
    <?php if (user_check('phone', $user['phone'])) : ?>
      <?php if (!empty(user_order_status($users['id'], 'Đang giao'))) : ?>
        <div class="order mt-5">
          <?php foreach ($order_delivery as $o) : ?>
            <?php foreach (order_status($users['id'], $o['id'], 'Đang giao') as $all) : ?>
              <div class="row border-bottom pb-2 mb-3">
                <div class="col-2">
                  <a href="<?= ROOT ?>?page=detail&id=<?= $all['id_product'] ?>"> <img src="<?= ROOT ?>images/products/<?= $all['images'] ?>" alt="" width="80" height="80"></a>
                </div>
                <div class="col-7">
                  <a href="<?= ROOT ?>?page=detail&id=<?= $all['id_product'] ?>" class="order-name"><?= $all['name'] ?></a>
                  <p>x<?= $all['quantity'] ?></p>
                </div>
                <div class="col-3 text-right">
                  <?php if ($all['sale'] > 0) : ?>
                    <div class="old-price">
                      <del><?= number_format($all['price'], 0, ',', '.') . 'đ' ?></del>
                    </div>
                  <?php endif; ?>
                  <p class="new-price"><?= number_format(($all['price'] - ($all['price'] * $all['sale'])), 0, ',', '.') . 'đ' ?></p>
                </div>
              </div>
            <?php endforeach; ?>
            <?php $detail = list_all_detail($o['id']);
            $total = 0;
            foreach ($detail as $d) {
              $price_new = $d['price'] - ($d['price'] * $d['sale']);
              $total += $d['quantity'] * $price_new;
            }
            ?>
            <div class="row mb-5">
              <div class="col-12 text-right align-content-end">
                <p class="total">Tổng số tiền: <span class="total-price"><?= number_format($total, 0, ',', '.') . 'đ' ?></span></p>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php else : ?>
        <div class="empty-purchase mt-5 mb-3 pt-5">
          <div class="purchase"></div>
          <div class="title text-center">Chưa có đơn hàng</div>
        </div>
      <?php endif; ?>
    <?php else : ?>
      <div class="empty-purchase mt-5 mb-3 pt-5">
        <div class="purchase"></div>
        <div class="title text-center">Chưa có đơn hàng</div>
      </div>
    <?php endif; ?>
  </div>
  <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
    <?php if (user_check('phone', $user['phone'])) : ?>
      <?php if (!empty(user_order_status($users['id'], 'Đã giao'))) : ?>
        <div class="order mt-5">
          <?php foreach ($order_delivered as $o) : ?>
            <?php foreach (order_status($users['id'], $o['id'], 'Đã giao') as $all) : ?>
              <div class="row border-bottom pb-2 mb-3">
                <div class="col-2">
                  <a href="<?= ROOT ?>?page=detail&id=<?= $all['id_product'] ?>"> <img src="<?= ROOT ?>images/products/<?= $all['images'] ?>" alt="" width="80" height="80"></a>
                </div>
                <div class="col-7">
                  <a href="<?= ROOT ?>?page=detail&id=<?= $all['id_product'] ?>" class="order-name"><?= $all['name'] ?></a>
                  <p>x<?= $all['quantity'] ?></p>
                </div>
                <div class="col-3 text-right">
                  <?php if ($all['sale'] > 0) : ?>
                    <div class="old-price">
                      <del><?= number_format($all['price'], 0, ',', '.') . 'đ' ?></del>
                    </div>
                  <?php endif; ?>
                  <p class="new-price"><?= number_format(($all['price'] - ($all['price'] * $all['sale'])), 0, ',', '.') . 'đ' ?></p>
                </div>
              </div>
            <?php endforeach; ?>
            <?php $detail = list_all_detail($o['id']);
            $total = 0;
            foreach ($detail as $d) {
              $price_new = $d['price'] - ($d['price'] * $d['sale']);
              $total += $d['quantity'] * $price_new;
            }
            ?>
            <div class="row mb-5">
              <div class="col-12 text-right align-content-end">
                <p class="total">Tổng số tiền: <span class="total-price"><?= number_format($total, 0, ',', '.') . 'đ' ?></span></p>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php else : ?>
        <div class="empty-purchase mt-5 mb-3 pt-5">
          <div class="purchase"></div>
          <div class="title text-center">Chưa có đơn hàng</div>
        </div>
      <?php endif; ?>
    <?php else : ?>
      <div class="empty-purchase mt-5 mb-3 pt-5">
        <div class="purchase"></div>
        <div class="title text-center">Chưa có đơn hàng</div>
      </div>
    <?php endif; ?>
  </div>
  <div class="tab-pane fade" id="pills-cancel" role="tabpanel" aria-labelledby="pills-cancel-tab">
    <?php if (user_check('phone', $user['phone'])) : ?>
      <?php if (!empty(user_order_status($users['id'], 'Đã hủy'))) : ?>
        <div class="order mt-5">
          <?php foreach ($order_cancel as $o) : ?>
            <?php foreach (order_status($users['id'], $o['id'], 'Đã hủy') as $all) : ?>
              <div class="row border-bottom pb-2 mb-3">
                <div class="col-2">
                  <a href="<?= ROOT ?>?page=detail&id=<?= $all['id_product'] ?>"> <img src="<?= ROOT ?>images/products/<?= $all['images'] ?>" alt="" width="80" height="80"></a>
                </div>
                <div class="col-7">
                  <a href="<?= ROOT ?>?page=detail&id=<?= $all['id_product'] ?>" class="order-name"><?= $all['name'] ?></a>
                  <p>x<?= $all['quantity'] ?></p>
                </div>
                <div class="col-3 text-right">
                  <?php if ($all['sale'] > 0) : ?>
                    <div class="old-price">
                      <del><?= number_format($all['price'], 0, ',', '.') . 'đ' ?></del>
                    </div>
                  <?php endif; ?>
                  <p class="new-price"><?= number_format(($all['price'] - ($all['price'] * $all['sale'])), 0, ',', '.') . 'đ' ?></p>
                </div>
              </div>
            <?php endforeach; ?>
            <?php $detail = list_all_detail($o['id']);
            $total = 0;
            foreach ($detail as $d) {
              $price_new = $d['price'] - ($d['price'] * $d['sale']);
              $total += $d['quantity'] * $price_new;
            }
            ?>
            <div class="row mb-5">
              <div class="col-12 text-right align-content-end">
                <p class="total">Tổng số tiền: <span class="total-price"><?= number_format($total, 0, ',', '.') . 'đ' ?></span></p>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php else : ?>
        <div class="empty-purchase mt-5 mb-3 pt-5">
          <div class="purchase"></div>
          <div class="title text-center">Chưa có đơn hàng</div>
        </div>
      <?php endif; ?>
    <?php else : ?>
      <div class="empty-purchase mt-5 mb-3 pt-5">
        <div class="purchase"></div>
        <div class="title text-center">Chưa có đơn hàng</div>
      </div>
    <?php endif; ?>
  </div>
</div>