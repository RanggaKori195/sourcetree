<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-user-cog fa-2x"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="?page=Profil" class="dropdown-item">
            <i class="far fa-dot-circle mr-2"></i> Sunting Profil
            <span class="float-right text-muted"><i class="fas fa-user-edit"></i></span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="javascript:void(0);" class="dropdown-item" data-toggle="modal" data-target="#password-dialog">
            <i class="far fa-dot-circle mr-2"></i> Ubah Password
            <span class="float-right text-muted"><i class="fas fa-key"></i></span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="pages/logout.php" class="dropdown-item">
            <i class="far fa-dot-circle mr-2"></i> Keluar
            <span class="float-right text-muted"><i class="fas fa-sign-out-alt"></i></span>
          </a>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="?page=Profil" class="brand-link">
      <?php
        $stmt =  $conn->prepare("SELECT * FROM users WHERE id_user = '".$_SESSION['user']."'");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row['foto_user'] != null) {
          echo "<img src='dist/img/pegawai/".$row['foto_user']."' alt='User Image' class='brand-image img-circle elevation-3'>";
        } else {
          echo "<img src='dist/img/pegawai/nopic.jpg' alt='User Image' class='brand-image img-circle elevation-3'>";
        }
      ?>
      <span class="brand-text font-weight-light"><?= $row['nama_user']; ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="?page=Dashboard" class="nav-link" id="dashboard-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="?page=Brand" class="nav-link" id="brand-link">
              <i class="nav-icon fas fa-tags"></i>
              <p>
                Brand
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="?page=Kategori" class="nav-link" id="kategori-link">
              <i class="nav-icon fas fa-search"></i>
              <p>
                Kategori
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="?page=Produk" class="nav-link" id="produk-link">
              <i class="nav-icon fas fa-box"></i>
              <p>
                Produk
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="?page=Pegawai" class="nav-link" id="pegawai-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Pegawai
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview" id="laporan-root">
            <a href="#" class="nav-link" id="laporan-link">
              <i class="nav-icon fas fa-chart-bar"></i>
              <p>
                Laporan
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="?page=Laporan-Penjualan" class="nav-link" id="laporan-penjualan-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Penjualan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?page=Laporan-Produk" class="nav-link" id="laporan-produk-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Produk</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark" id="content-title"></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <?php
                if (!isset($_GET['page'])) {
                  include "dashboard.php";
                } else {
                  switch ($_GET['page']) {
                    case 'Dashboard':
                      include "dashboard.php";
                      break;
                    case 'Brand':
                      include "brand.php";
                      break;
                    case 'Kategori':
                      include "kategori.php";
                      break;
                    case 'Produk':
                      if (!isset($_GET['id'])) {
                        include "produk.php";
                      } else {
                        include "detail_produk.php";
                      }
                      break;
                    case 'Pegawai':
                      if (!isset($_GET['id'])) {
                        include "pegawai.php";
                      } else {
                        include "detail_pegawai.php";
                      }
                      break;
                    case 'Laporan-Penjualan':
                      include "laporan_penjualan.php";
                      break;
                    case 'Laporan-Produk':
                      include "laporan_produk.php";
                      break;
                    case 'Profil':
                      include "profil.php";
                      break;
                    
                    default:
                      ?>
                        <script>
                          location.href = "?page=Dashboard";
                        </script>
                      <?php
                      break;
                  }
                }
              ?>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-sm-block-down">
      Point Of Sales
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2019 <a href="index.php">Tangga Ayu</a>.</strong>
  </footer>
</div>
<!-- ./wrapper -->
<!-- Ubah password -->
<div class="modal fade" id="password-dialog" tabindex="-1" role="dialog" aria-labelledby="password-dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form method="post">
        <div class="modal-header">
          <h5 class="modal-title" id="password-dialog-title">Ubah Password</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="password_lama">Password Anda Saat Ini</label>
            <input type="password" class="form-control form-control-sm" name="password_lama" id="password_lama" maxlength="8" required>
          </div>
          <div class="form-group">
            <label for="password_baru_1">Password Baru Anda</label>
            <input type="password" class="form-control form-control-sm password_baru" name="password_baru_1" id="password_baru_1" maxlength="8" required>
          </div>
          <div class="form-group">
            <label for="password_baru_2">Ketik Ulang Password Baru Anda</label>
            <input type="password" class="form-control form-control-sm password_baru" name="password_baru_2" id="password_baru_2" maxlength="8" required>
            <small id="wrong-retype-alert" class="form-text text-danger" style="display:none">Anda harus mengetik ulang password baru dengan benar !</small>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-dark btn-sm" data-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
          <button type="submit" name="submit" id="btn-submit" class="btn btn-outline-dark btn-sm"><i class="fas fa-save"></i> Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
  $('.password_baru').on('keyup', function(e) {
    if ($('#password_baru_2').val() != $('#password_baru_1').val()) {
      $('#btn-submit').hide();
      $('#wrong-retype-alert').show();
    } else {
      $('#btn-submit').show();
      $('#wrong-retype-alert').hide();
    }
  });
</script>
<?php
  if (isset($_POST['submit'])) {
    $stmt =  $conn->prepare("SELECT * FROM users WHERE id_user = '".$_SESSION['user']."' AND password = '".sha1($_POST['password_lama'])."'");
    $stmt->execute();
    if (intval($stmt->rowCount()) > 0) {
      $conn->exec("UPDATE users SET password = '".sha1($_POST['password_baru_1'])."' WHERE id_user = '".$_SESSION['user']."'");
      ?>
        <script>
          location.href = 'pages/logout.php';
        </script>
      <?php
    } else {
      ?>
        <script>
          swal.fire({
            'text': 'Password lama yang anda masukan salah.'
          })
        </script>
      <?php
    }
  }
?>