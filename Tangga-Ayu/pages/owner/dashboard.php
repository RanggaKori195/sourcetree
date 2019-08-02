<div class="p-2">
  <div class="row">
    <div class="col-lg-6 col-6">
      <!-- small box -->
      <div class="small-box bg-info">
        <div class="inner">
          <h3>
            <?php
              $stmt = $conn->prepare("SELECT COUNT(id_transaksi) AS jumlah FROM transaksi WHERE tgl_transaksi = '".date('Y-m-d')."'");
              $stmt->execute();
              $row = $stmt->fetch(PDO::FETCH_ASSOC);
              echo $row['jumlah'];
            ?>
          </h3>

          <p>Transaksi Hari Ini</p>
        </div>
        <div class="icon">
          <i class="fas fa-shopping-basket"></i>
        </div>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-6 col-6">
      <!-- small box -->
      <div class="small-box bg-success">
        <div class="inner">
          <h3>
            <?php
              $stmt = $conn->prepare("SELECT SUM(detail_transaksi.qty) AS jumlah FROM transaksi INNER JOIN detail_transaksi ON detail_transaksi.id_transaksi = transaksi.id_transaksi WHERE tgl_transaksi = '".date('Y-m-d')."'");
              $stmt->execute();
              $row = $stmt->fetch(PDO::FETCH_ASSOC);
              echo $row['jumlah'];
            ?>
          </h3>

          <p>Produk Terjual Hari ini</p>
        </div>
        <div class="icon">
          <i class="fas fa-box"></i>
        </div>
      </div>
    </div>
    <!-- ./col -->
  </div>
  <div class="row">
    <div class="col-md-6">
      <!-- AREA CHART -->
      <div class="card card-info">
        <div class="card-header">
          <h3 class="card-title">Jumlah Produk Berdasarkan Brand</h3>
        </div>
        <div class="card-body">
          <div class="chart">
            <canvas id="produk-chart" style="height:250px"></canvas>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col (LEFT) -->
    <div class="col-md-6">
      <!-- LINE CHART -->
      <div class="card card-success">
        <div class="card-header">
          <h3 class="card-title">Brand Terlaris</h3>
        </div>
        <div class="card-body">
          <div class="chart">
            <canvas id="brand-terlaris-chart" style="height:250px"></canvas>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
</div>
<?php
  $stmt = $conn->prepare("SELECT id_brand, nama_brand FROM brand");
  $stmt->execute();
  $rows_brand = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $nama_brand = [];
  $jumlah_produk = [];
  $jumlah_penjualan = [];
  $brand_bg_color = [];
  $brand_bd_color = [];
  $penjualan_bg_color = [];
  $penjualan_bd_color = [];
  foreach ($rows_brand as $row) {
    $nama_brand[] .= $row['nama_brand'];
    $brand_bg_color[] .= "rgba(54, 162, 235, 0.2)";
    $brand_bd_color[] .= "rgba(54, 162, 235, 1)";
    $stmt_1 = $conn->prepare("SELECT SUM(stok) AS jumlah FROM kosmetik WHERE id_brand = '".$row['id_brand']."'");
    $stmt_1->execute();
    $row_sum = $stmt_1->fetch(PDO::FETCH_ASSOC);
    $jumlah_produk[] .= $row_sum['jumlah'];
    $stmt_2 = $conn->prepare("
      SELECT SUM(qty) as jumlah
      FROM detail_transaksi
      INNER JOIN kosmetik ON kosmetik.id_kosmetik = detail_transaksi.id_kosmetik
      INNER JOIN brand ON brand.id_brand = kosmetik.id_brand
      WHERE brand.id_brand = '".$row['id_brand']."'
      ");
    $stmt_2->execute();
    $row_sum_1 = $stmt_2->fetch(PDO::FETCH_ASSOC);
    $jumlah_penjualan[] .= $row_sum_1['jumlah'];
    $penjualan_bg_color[] .= "rgba(75, 192, 192, 0.2)";
    $penjualan_bd_color[] .= "rgba(75, 192, 192, 1)";
  }
  ?>
  <script>
    console.log(<?= json_encode($nama_brand); ?>);
  </script>
  <?php
?>
<script>
  $('#content-title').html('Dashboard');
  $('#dashboard-link').addClass("active");
  var ctx_produk = document.getElementById('produk-chart');
  var produk_chart = new Chart(ctx_produk, {
    type: 'bar',
    data: {
        labels: <?= json_encode($nama_brand); ?>,
        datasets: [{
            label: '',
            data: <?= json_encode($jumlah_produk); ?>,
            backgroundColor: <?= json_encode($brand_bg_color); ?>,
            borderColor: <?= json_encode($brand_bg_color); ?>,
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        },
        legend: {
          display: false
        }
    }
  });

  var ctx_produk_terlaris = document.getElementById('brand-terlaris-chart');
  var brand_chart = new Chart(ctx_produk_terlaris, {
    type: 'bar',
    data: {
        labels: <?= json_encode($nama_brand); ?>,
        datasets: [{
            label: '',
            data: <?= json_encode($jumlah_penjualan); ?>,
            backgroundColor: <?= json_encode($penjualan_bg_color); ?>,
            borderColor: <?= json_encode($penjualan_bd_color); ?>,
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        },
        legend: {
          display: false
        }
    }
  });
</script>