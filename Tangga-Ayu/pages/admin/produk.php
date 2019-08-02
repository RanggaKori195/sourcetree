<div class="p-2">
  <div class="row">
    <div class="col-md-2">
      <button type="button" class="btn btn-info btn-sm" data-toggle='modal' data-target='#add-dialog'><i class="fas fa-plus"></i> Buat Baru</button>
    </div>
    <div class="col-md-5">
      <div class="form-group row">
        <label for="brand" class="col-sm-2 col-form-label col-form-label-sm">Brand</label>
        <div class="col-sm-10">
          <select name="brand" id="brand" class="form-control form-control-sm produk-params">
            <option value="semua">SEMUA</option>
            <?php
              $stmt =  $conn->prepare("SELECT * FROM brand");
              $stmt->execute();
              $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
              foreach ($rows as $row) {
                echo "<option value='".$row['id_brand']."'>".$row['nama_brand']."</option>";
              }
            ?>
          </select>
        </div>
      </div>
    </div>
    <div class="col-md-5">
      <div class="form-group row">
        <label for="kategori" class="col-sm-2 col-form-label col-form-label-sm">Kategori</label>
        <div class="col-sm-10">
          <select name="kategori" id="kategori" class="form-control form-control-sm produk-params">
            <option value="semua">SEMUA</option>
            <?php
              $stmt =  $conn->prepare("SELECT * FROM kategori");
              $stmt->execute();
              $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
              foreach ($rows as $row) {
                echo "<option value='".$row['id_kategori']."'>".$row['nama_kategori']."</option>";
              }
            ?>
          </select>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="p-2">
  <div class="table-responsive">
    <table class="table" id="table-produk">
      <thead>
        <tr>
          <th width="5%" class="text-center">No.</th>
          <th class="text-center">Nama Produk</th>
          <th width="10%" class="text-center">Satuan</th>
          <th width="13%" class="text-center">Harga (Rp.)</th>
          <th width="10%" class="text-center">Stok</th>
          <th width="10%" class="text-center">Detail</th>
          <th width="10%" class="text-center">Hapus</th>
        </tr>
      </thead>
      <tbody>
        
      </tbody>
    </table>
  </div>
</div>
<!-- Tambah -->
<div class="modal fade" id="add-dialog" tabindex="-1" role="dialog" aria-labelledby="add-dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form method="post" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title" id="dialog-title">Tambah Produk Baru</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="brand_baru">Brand</label>
            <select class="form-control form-control-sm" name="brand_baru" id="brand_baru" required>
              <?php
                $stmt =  $conn->prepare("SELECT * FROM brand");
                $stmt->execute();
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($rows as $row) {
                  echo "<option value='".$row['id_brand']."'>".$row['nama_brand']."</option>";
                }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label for="kategori_baru">Kategori</label>
            <select class="form-control form-control-sm" name="kategori_baru" id="kategori_baru" required>
              <?php
                $stmt =  $conn->prepare("SELECT * FROM kategori");
                $stmt->execute();
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($rows as $row) {
                  echo "<option value='".$row['id_kategori']."'>".$row['nama_kategori']."</option>";
                }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label for="nama_produk_baru">Nama Produk</label>
            <input type="text" class="form-control form-control-sm form-element" name="nama_produk_baru" id="nama_produk_baru" maxlength="50" required>
          </div>
          <div class="form-group">
            <label for="satuan_baru">Satuan</label>
            <input type="text" class="form-control form-control-sm form-element" name="satuan_baru" id="satuan_baru" maxlength="10" required>
          </div>
          <div class="form-group">
            <label for="harga_baru">Harga</label>
            <input type="number" class="form-control form-control-sm form-element" name="harga_baru" id="harga_baru" min="0" required>
          </div>
          <div class="form-group">
            <label for="stok_baru">Stok</label>
            <input type="number" class="form-control form-control-sm form-element" name="stok_baru" id="stok_baru" min="0" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-dark btn-sm" data-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
          <button type="submit" name="submit" class="btn btn-outline-dark btn-sm"><i class="fas fa-save"></i> Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
<form method="post" id="form-hapus">
  <input type="hidden" name="id_kosmetik_hapus" id="id_kosmetik_hapus">
</form>
<script>
  $('#content-title').html('Produk');
  $('#produk-link').addClass("active");
  loadProduk();
  $('.produk-params').on('change', function(e) {
    loadProduk();
  });
  $('#add-dialog').on('shown.bs.modal', function (e) {
    $('#brand_baru').focus();
  });
  $('#add-dialog').on('hidden.bs.modal', function (e) {
    $('.form-element').val(null);
  });
  function loadProduk() {
    var table = $('#table-produk').DataTable({
      "destroy": true,
      "processing": true,
      "serverSide": true,
      "ajax": {
        url: "pages/admin/produk_loader.php",
        data: {"id_brand": $('#brand').val(), "id_kategori": $('#kategori').val()}
      },
      "aoColumns": [
        null,
        null,
        null,
        {"className": "text-right"},
        {"className": "text-right"},
        {
          "className": "text-center",
          "mData": "5",
          "mRender": function ( data, type, full ) {
          return "<a href='?page=Produk&id="+data+"' class='btn bg-transparent btn-sm text-dark'><i class='far fa-eye'></i></a>";
          }
        },
        {
          "className": "text-center",
          "mData": "5",
          "mRender": function ( data, type, full ) {
          return "<a href='javascript:void(0);' data-id='"+data+"' class='btn btn-danger btn-sm' onclick='deleteDialog(this);'><i class='far fa-trash-alt'></i></a>";
          }
        }
      ]
    });
  }
  function deleteDialog(elmnt) {
    Swal.fire({
      title: 'Anda yankin?',
      text: "Data yang telah dihapus tidak dapat dikembalikan",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Hapus',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.value) {
        $('#id_kosmetik_hapus').val(elmnt.getAttribute('data-id'));
        $('#form-hapus').submit();
      }
    })
  }
</script>
<?php
  // Tambah
  if (isset($_POST['submit'])) {
    $id_kosmetik_baru = getIdProdukBaru();
    $conn->exec("INSERT INTO kosmetik VALUES ('".$id_kosmetik_baru."', '".$_POST['kategori_baru']."', '".$_POST['brand_baru']."', '".$_POST['nama_produk_baru']."', '".$_POST['satuan_baru']."', '".$_POST['harga_baru']."', '".$_POST['stok_baru']."')");
    ?>
      <script>
        location.href = "?page=Produk";
      </script>
    <?php
  }

  // Hapus
  if (isset($_POST['id_kosmetik_hapus'])) {
    $conn->exec("DELETE FROM kosmetik WHERE id_kosmetik = '".$_POST['id_kosmetik_hapus']."'");
    ?>
      <script>
        location.href = "?page=Produk";
      </script>
    <?php
  }
?>