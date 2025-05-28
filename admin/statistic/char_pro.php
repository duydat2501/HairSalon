<?php $items = statistical_product(); ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <?php if (isset($_SESSION['message'])) : ?>
        <div class="card-header py-3 text-success">
            <h6 class="font-weight-bold"><?= $_SESSION['message'] ?></h6>
        </div>
    <?php endif; ?>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Biểu đồ thống kê sản phẩm
            </h6>
        </div>
        <div class="card-body">
            <div id="piechart_3d" style="width: 1000px; height: 650px;"></div>
          <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
          <script type="text/javascript">
            google.charts.load("current", {
              packages: ["corechart"]
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
              var data = google.visualization.arrayToDataTable([
                ['Danh mục', 'Số lượng'],
                <?php
                foreach ($items as $item){
                    echo "['$item[name]',$item[so_luong]],";
                }
                ?>

              ]);

              var options = {
                title: 'Tỉ lệ hàng hóa',
                is3D: true,
              };

              var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
              chart.draw(data, options);
            }
          </script>
        </div>
    </div>
</div>
<!-- /.container-fluid -->