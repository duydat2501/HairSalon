<?php
$today = date('Y-m-d'); // Today's date
$default_from = date('Y-m-d', strtotime('-49 days')); // Default 49 days ago
$default_to = $today; // Default today

// Get 'from_date' and 'to_date' from the GET request
$from_date = isset($_GET['from_date']) ? $_GET['from_date'] : $default_from;
$to_date = isset($_GET['to_date']) ? $_GET['to_date'] : $default_to;

// Ensure 'from_date' and 'to_date' are valid dates (yyyy-mm-dd format)
$from_date = date('Y-m-d', strtotime($from_date));
$to_date = date('Y-m-d', strtotime($to_date));

// Check: to_date should be >= from_date and <= today
if (strtotime($to_date) < strtotime($from_date) || strtotime($to_date) > strtotime($today)) {
    $from_date = $default_from;
    $to_date = $default_to;
}
$start_date = $from_date . " 00:00:00";
$dest_date = $to_date . " 23:59:59";
$items = statistical_service_range($start_date, $dest_date);
?>
<!-- Begin Page Content -->
<div class="container-fluid row">
    <?php if (isset($_SESSION['message'])) : ?>
        <div class="card-header py-3 text-success">
            <h6 class="font-weight-bold"><?= $_SESSION['message'] ?></h6>
        </div>
    <?php endif; ?>
    
    <!-- DataTales Example -->
    <div class="mb-4 col-8">
      <div class="card shadow overflow-hidden">
          <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Biểu đồ thống kê dịch vụ sử dụng theo khoảng thời gian (số lượng)</h6>
          </div>
          <div class="card-body">
            <form method="GET" class="d-flex align-items-end">
              <input type="hidden" name="page" value="statistic">
              <input type="hidden" name="action" value="char_ser">
              <div class="col-4">
                <label for="from_date" class="form-label">Từ ngày</label>
                <input type="date" class="form-control" id="from_date" name="from_date" value="<?= $from_date ?>" required>
              </div>
              <div class="col-4">
                <label for="to_date" class="form-label">Đến ngày</label>
                <input type="date" class="form-control" id="to_date" name="to_date" value="<?= $to_date ?>" required>
              </div>
              <button type="submit" class="btn btn-primary">Kiểm tra</button>
            </form>

            <div id="piechart_3d" style="width: 1000px; height: 650px;"></div>
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script type="text/javascript">
              google.charts.load("current", { packages: ["corechart"] });
              google.charts.setOnLoadCallback(drawChart);

              function drawChart() {
                var data = google.visualization.arrayToDataTable([
                  ['Danh mục', 'Số lượng'],
                  <?php
                  foreach ($items as $item){
                      echo "['$item[name]', $item[so_luong]],";
                  }
                  ?>
                ]);

                var options = {
                  title: 'Tỉ lệ dịch vụ',
                  is3D: true,
                };

                var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
                chart.draw(data, options);
              }
            </script>
          </div>
      </div>
    </div>

    <div class="mb-4 col-4">
      <div class="card shadow">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Thống kê dịch vụ (theo doanh thu)</h6>
          </div>
          <div class="card">
            <div class="card-body">
              <div id="income-overview-chart"></div>
              <script type="text/javascript">
                window.onload = function(){
                  var data = [
                  ['Danh mục', 'Số lượng'],
                  <?php
                  foreach ($items as $item){
                      echo "['$item[name]', $item[total]],";
                  }
                  ?>
                ];
                const result = {
                      labels: [],
                      values: [],
                  };
                for (let i = 1; i < data.length; i++) {
                    result.labels.push(data[i][0]);
                    result.values.push(data[i][1]);
                }
                var options = {
                  chart: {
                    type: 'bar',
                    height: 365,
                    toolbar: {
                      show: false
                    }
                  },
                  colors: ['#13c2c2'],
                  plotOptions: {
                    bar: {
                      columnWidth: '45%',
                      borderRadius: 4
                    }
                  },
                  dataLabels: {
                    enabled: false
                  },
                  series: [{
                    name: 'Doanh thu (nghìn đồng)',
                    data: result.values
                  }],
                  stroke: {
                    curve: 'smooth',
                    width: 2
                  },
                  xaxis: {
                    categories: result.labels,
                    axisBorder: {
                      show: false
                    },
                    axisTicks: {
                      show: false
                    }
                  },
                  yaxis: {
                    show: false
                  },
                  grid: {
                    show: false
                  }
                };
                var chart = new ApexCharts(document.querySelector('#income-overview-chart'), options);
                chart.render();
                }
              </script>
            </div>
          </div>
      </div>
    </div>
</div>
<!-- /.container-fluid -->
