<?php 
  $product = statistical_product();
  $recentOrders = get_recent_orders(); // Returns an array of recent orders
?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <?php if (isset($_SESSION['message'])) : ?>
        <div class="card-header py-3 text-success">
            <h6 class="font-weight-bold"><?= $_SESSION['message'] ?></h6>
        </div>
    <?php endif; ?>
    <div class="row my-4">
        <div class="col-md-12 col-xl-6">
          <div class="d-flex align-items-center justify-content-between mb-3">
            <h5 class="mb-0 py-3">Số đơn</h5>
            <ul class="nav nav-pills justify-content-end mb-0" id="chart-tab-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="chart-tab-year-tab" data-bs-toggle="pill" data-bs-target="#chart-year-home"
                  type="button" role="tab" aria-controls="chart-year-home" aria-selected="true"
                  style="border: 0;outline: 0;">Năm</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="chart-tab-home-tab" data-bs-toggle="pill" data-bs-target="#chart-tab-home"
                  type="button" role="tab" aria-controls="chart-tab-home" aria-selected="true"
                  style="border: 0;outline: 0;">Tháng</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="chart-tab-profile-tab" data-bs-toggle="pill"
                  data-bs-target="#chart-tab-profile" type="button" role="tab" aria-controls="chart-tab-profile"
                  aria-selected="false" style="border: 0;outline: 0;">Tuần</button>
              </li>
            </ul>
          </div>
          <div class="card">
            <div class="card-body">
              <div class="tab-content" id="chart-tab-tabContent">
              <div class="tab-pane" id="chart-year-home" role="tabpanel" aria-labelledby="chart-tab-year-tab"
                  tabindex="0">
                  <div id="visitor-chart-2"></div>
                </div>
                <div class="tab-pane" id="chart-tab-home" role="tabpanel" aria-labelledby="chart-tab-home-tab"
                  tabindex="0">
                  <div id="visitor-chart-1"></div>
                </div>
                <div class="tab-pane show active" id="chart-tab-profile" role="tabpanel"
                  aria-labelledby="chart-tab-profile-tab" tabindex="0">
                  <div id="visitor-chart"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-12 col-xl-6">
          <h5 class="mb-3 py-3">Đơn gần đây</h5>
          <div class="card tbl-card">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-hover table-borderless mb-0">
                  <thead>
                    <tr>
                      <th>Mã đơn</th>
                      <th>Thời gian</th>
                      <th>Tên sản phẩm</th>
                      <th>Số lượng</th>
                      <th>Trạng thái</th>
                      <th class="text-end">Tổng</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($recentOrders as $order): ?>
                      <tr>
                        <td><a href="#" class="text-muted"><?= htmlspecialchars($order['id']) ?></a></td>
                        <td><?= time_ago($order['created_at']) ?></td>
                        <td><?= htmlspecialchars($order['product_name']) ?></td>
                        <td><?= (int)$order['quantity'] ?></td>
                        <td>
                          <span class="d-flex align-items-center gap-2">
                            <?= htmlspecialchars($order['status']) ?>
                          </span>
                        </td>
                        <td class="text-end"><?= number_format($order['total'], 2) ?></td>
                      </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Thống kê sản phẩm theo danh mục 
            <a href="<?= ROOT ?>admin/?page=statistic&action=char_pro" class="btn btn-primary ml-5">Xem biểu đồ</a>
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <form action="" method="POST" class="col-md-12">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Tên danh mục</th>
                                <th>Số lượng sản phẩm</th>
                                <th>Giá thấp nhất</th>
                                <th>Giá cao nhất</th>
                                <th>Giá trung bình</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                            <th>Tên danh mục</th>
                                <th>Số lượng sản phẩm</th>
                                <th>Giá thấp nhất</th>
                                <th>Giá cao nhất</th>
                                <th>Giá trung bình</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php foreach ($product as $p) : ?>
                                <tr>
                                <td><?=$p['name'] ?></td>
                                <td><?=$p['so_luong'] ?></td>
                                <td><?=number_format($p['gia_min'],0,',','.').'đ' ?></td>
                                <td><?=number_format($p['gia_max'],0,',','.').'đ'?></td>
                                <td><?=number_format($p['gia_avg'],0,',','.').'đ' ?></td>
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