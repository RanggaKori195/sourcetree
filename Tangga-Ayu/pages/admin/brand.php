<div class="p-2">
  <button type="button" class="btn btn-info btn-sm" data-toggle='modal' data-target='#add-dialog'><i class="fas fa-plus"></i> Buat Baru</button>
</div>
<div class="p-2">
  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th width="5%" class="text-center">No.</th>
          <th class="text-center">Nama Brand</th>
          <th width="10%" class="text-center">Ubah</th>
          <th width="10%" class="text-center">Hapus</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $stmt = $conn->prepare("SELECT * FROM brand");
          $stmt->execute();
          $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
          $no = 1;
          foreach ($rows as $row) {
            echo "<tr>";
            echo "<th>".$no++."</th>";
            echo "<td>".$row['nama_brand']."</td>";
            echo "<td class='text-center'><button class='btn btn-warning btn-sm btn-edit' data-toggle='modal' data-target='#edit-dialog' data-id='".$row['id_brand']."' data-nama='".$row['nama_brand']."'><i class='fas fa-pencil-alt'></i></button></td>";
            echo "<td class='text-center'><button class='btn btn-danger btn-sm btn-delete' data-id='".$row['id_brand']."'><i class='far fa-trash-alt'></i></button></td>";
            echo "</tr>";
          }
        ?>
      </tbody>
    </table>
  </div>
</div>
<!-- Tambah -->
<div class="modal fade" id="add-dialog" tabindex="-1" role="dialog" aria-labelledby="add-dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form method="post">
        <div class="modal-header">
          <h5 class="modal-title" id="dialog-title">Tambah Brand Baru</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="text" class="form-control form-control-sm text-uppercase" name="nama_brand_baru" id="nama_brand_baru" maxlength="20" required>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-dark btn-sm" data-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
          <button type="submit" class="btn btn-outline-dark btn-sm"><i class="fas fa-save"></i> Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Ubah -->
<div class="modal fade" id="edit-dialog" tabindex="-1" role="dialog" aria-labelledby="edit-dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form method="post">
        <div class="modal-header">
          <h5 class="modal-title" id="edit-dialog-title"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id_brand" id="id_brand" value="">
          <input type="text" class="form-control form-control-sm text-uppercase" name="nama_brand" id="nama_brand" maxlength="20" required>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-dark btn-sm" data-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
          <button type="submit" class="btn btn-outline-dark btn-sm"><i class="fas fa-save"></i> Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
<form method="post" id="form-hapus-brand">
  <input type="hidden" name="id_brand_hapus" id="id_brand_hapus" value="">
</form>
<script>
  $('#content-title').html('Brand');
  $('#brand-link').addClass("active");
  $('.btn-edit').on('click', function(e) {
    $('#id_brand').val($(this).attr('data-id'));
    $('#edit-dialog-title').html($(this).attr('data-nama'));
  });
  $('.btn-delete').on('click', function(e) {
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
        $('#id_brand_hapus').val($(this).attr('data-id'));
        $('#form-hapus-brand').submit();
      }
    })
  });
  $('#add-dialog').on('shown.bs.modal', function (e) {
    $('#nama_brand_baru').focus();
  });
  $('#add-dialog').on('hidden.bs.modal', function (e) {
    $('#nama_brand_baru').val(null);
  });
  $('#edit-dialog').on('shown.bs.modal', function (e) {
    $('#nama_brand').focus();
  });
  $('#edit-dialog').on('hidden.bs.modal', function (e) {
    $('#nama_brand').val(null);
  });
</script>
<?php
  // Tambah
  if (isset($_POST['nama_brand_baru'])) {
    $conn->exec("INSERT INTO brand (nama_brand) VALUES ('".strtoupper($_POST['nama_brand_baru'])."')");
    ?>
      <script>
        location.href = "?page=Brand";
      </script>
    <?php
  }

  // Ubah
  if (isset($_POST['nama_brand'])) {
    $stmt =  $conn->prepare("UPDATE brand SET nama_brand = '".strtoupper($_POST['nama_brand'])."' WHERE id_brand = '".$_POST['id_brand']."'");
    $stmt->execute();
    ?>
      <script>
        location.href = "?page=Brand";
      </script>
    <?php
  }
  
  // Hapus
  if (isset($_POST['id_brand_hapus'])) {
    $conn->exec("DELETE FROM brand WHERE id_brand = '".$_POST['id_brand_hapus']."'");
    ?>
      <script>
        location.href = "?page=Brand";
      </script>
    <?php
  }
?>