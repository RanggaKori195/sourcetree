<div class="p-2">
  <button type="button" class="btn btn-info btn-sm" data-toggle='modal' data-target='#add-dialog'><i class="fas fa-plus"></i> Buat Baru</button>
</div>
<div class="p-2">
  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th width="5%" class="text-center">No.</th>
          <th class="text-center">Nama Kategori</th>
          <th width="10%" class="text-center">Ubah</th>
          <th width="10%" class="text-center">Hapus</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $stmt = $conn->prepare("SELECT * FROM kategori");
          $stmt->execute();
          $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
          $no = 1;
          foreach ($rows as $row) {
            echo "<tr>";
            echo "<th>".$no++."</th>";
            echo "<td>".$row['nama_kategori']."</td>";
            echo "<td class='text-center'><button class='btn btn-warning btn-sm btn-edit' data-toggle='modal' data-target='#edit-dialog' data-id='".$row['id_kategori']."' data-nama='".$row['nama_kategori']."'><i class='fas fa-pencil-alt'></i></button></td>";
            echo "<td class='text-center'><button class='btn btn-danger btn-sm btn-delete' data-id='".$row['id_kategori']."'><i class='far fa-trash-alt'></i></button></td>";
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
          <h5 class="modal-title" id="dialog-title">Tambah Kategori Baru</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="text" class="form-control form-control-sm text-uppercase" name="nama_kategori_baru" id="nama_kategori_baru" maxlength="20" required>
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
          <input type="hidden" name="id_kategori" id="id_kategori" value="">
          <input type="text" class="form-control form-control-sm text-uppercase" name="nama_kategori" id="nama_kategori" maxlength="20" required>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-dark btn-sm" data-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
          <button type="submit" class="btn btn-outline-dark btn-sm"><i class="fas fa-save"></i> Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
<form method="post" id="form-hapus-kategori">
  <input type="hidden" name="id_kategori_hapus" id="id_kategori_hapus" value="">
</form>
<script>
  $('#content-title').html('Kategori');
  $('#kategori-link').addClass("active");
  $('.btn-edit').on('click', function(e) {
    $('#id_kategori').val($(this).attr('data-id'));
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
        $('#id_kategori_hapus').val($(this).attr('data-id'));
        $('#form-hapus-kategori').submit();
      }
    })
  });
  $('#add-dialog').on('shown.bs.modal', function (e) {
    $('#nama_kategori_baru').focus();
  });
  $('#add-dialog').on('hidden.bs.modal', function (e) {
    $('#nama_kategori_baru').val(null);
  });
  $('#edit-dialog').on('shown.bs.modal', function (e) {
    $('#nama_kategori').focus();
  });
  $('#edit-dialog').on('hidden.bs.modal', function (e) {
    $('#nama_kategori').val(null);
  });
</script>
<?php
  // Tambah
  if (isset($_POST['nama_kategori_baru'])) {
    $conn->exec("INSERT INTO kategori (nama_kategori) VALUES ('".strtoupper($_POST['nama_kategori_baru'])."')");
    ?>
      <script>
        location.href = "?page=Kategori";
      </script>
    <?php
  }

  // Ubah
  if (isset($_POST['nama_kategori'])) {
    $stmt =  $conn->prepare("UPDATE kategori SET nama_kategori = '".strtoupper($_POST['nama_kategori'])."' WHERE id_kategori = '".$_POST['id_kategori']."'");
    $stmt->execute();
    ?>
      <script>
        location.href = "?page=Kategori";
      </script>
    <?php
  }
  
  // Hapus
  if (isset($_POST['id_kategori_hapus'])) {
    $conn->exec("DELETE FROM kategori WHERE id_kategori = '".$_POST['id_kategori_hapus']."'");
    ?>
      <script>
        location.href = "?page=Kategori";
      </script>
    <?php
  }
?>