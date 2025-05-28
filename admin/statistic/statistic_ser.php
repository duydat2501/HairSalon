<?php 
    $service = statistical_service(); 
    $recentServices = get_recent_services(); // Returns an array of recent orders
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
            <h5 class="mb-0 py-3">Thông tin dịch vụ</h5>
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
                  <div id="service-chart-2"></div>
                </div>
                <div class="tab-pane" id="chart-tab-home" role="tabpanel" aria-labelledby="chart-tab-home-tab"
                  tabindex="0">
                  <div id="service-chart-1"></div>
                </div>
                <div class="tab-pane show active" id="chart-tab-profile" role="tabpanel"
                  aria-labelledby="chart-tab-profile-tab" tabindex="0">
                  <div id="service-chart"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-12 col-xl-6">
          <h5 class="mb-3 py-3">Dịch vụ đặt gần đây</h5>
          <div class="card tbl-card">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-hover table-borderless mb-0">
                  <thead>
                    <tr>
                      <th>Mã dịch vụ</th>
                      <th>Thời gian</th>
                      <th>Tên nhân viên</th>
                      <th>Tên dịch vụ</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($recentServices as $item): ?>
                        <tr>
                        <td><a href="#" class="text-muted"><?= htmlspecialchars($item['appointment_id']) ?></a></td>
                        <td><?= htmlspecialchars($item['appointment_date']) ?></td>
                        <td><?= htmlspecialchars($item['barber_name']) ?></td>
                        <td><?= htmlspecialchars($item['service_name']) ?></td>
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
            <h6 class="m-0 font-weight-bold text-primary">Thống kê dịch vụ theo loại
            <a href="<?= ROOT ?>admin/?page=statistic&action=char_ser" class="btn btn-primary ml-5">Xem biểu đồ</a>
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <form action="" method="POST" class="col-md-12">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Tên loại dịch vụ</th>
                                <th>Số lượng dịch vụ</th>
                                <th>Giá thấp nhất</th>
                                <th>Giá cao nhất</th>
                                <th>Giá trung bình</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                            <th>Tên loại dịch vụ</th>
                                <th>Số lượng dịch vụ</th>
                                <th>Giá thấp nhất</th>
                                <th>Giá cao nhất</th>
                                <th>Giá trung bình</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php foreach ($service as $s) : ?>
                                <tr>
                                <td><?=$s['name'] ?></td>
                                <td><?=$s['so_luong'] ?></td>
                                <td><?=number_format($s['gia_min'],0,',','.').'đ' ?></td>
                                <td><?=number_format($s['gia_max'],0,',','.').'đ'?></td>
                                <td><?=number_format($s['gia_avg'],0,',','.').'đ' ?></td>
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