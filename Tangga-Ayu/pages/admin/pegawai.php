<div class="p-2">
  <button type="button" class="btn btn-info btn-sm" data-toggle='modal' data-target='#add-dialog'><i class="fas fa-plus"></i> Buat Baru</button>
</div>
<div class="p-2">
  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th width="5%" class="text-center">No.</th>
          <th class="text-center">Nama pegawai</th>
          <th width="15%" class="text-center">No. Telp.</th>
          <th width="15%" class="text-center">Jabatan</th>
          <th width="10%" class="text-center">Detail</th>
          <th width="10%" class="text-center">Hapus</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $stmt = $conn->prepare("SELECT * FROM users WHERE id_user != '".$_SESSION['user']."' AND level != '1'");
          $stmt->execute();
          $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
          $no = 1;
          foreach ($rows as $row) {
            echo "<tr>";
            echo "<th>".$no++."</th>";
            echo "<td>".$row['nama_user']."</td>";
            echo "<td>".$row['tlp_user']."</td>";
            if ($row['level'] == '2') {
              echo "<td>Admin</td>";
            } elseif ($row['level'] == '3') {
              echo "<td>Cashier</td>";
            }
            echo "<td class='text-center'><a href='?page=Pegawai&id=".$row['id_user']."' class='btn bg-transparent btn-sm text-dark'><i class='far fa-eye'></i></a></td>";
            echo "<td class='text-center'><button class='btn btn-danger btn-sm btn-delete' data-id='".$row['id_user']."'><i class='far fa-trash-alt'></i></button></td>";
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
      <form method="post" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title" id="dialog-title">Tambah Pegawai Baru</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="nama_pegawai_baru">Nama Lengkap</label>
            <input type="text" class="form-control form-control-sm form-element" name="nama_pegawai_baru" id="nama_pegawai_baru" maxlength="20" required>
          </div>
          <div class="form-group">
            <label for="no_telp_baru">Nomer Telepon</label>
            <input type="text" class="form-control form-control-sm form-element" name="no_telp_baru" id="no_telp_baru" maxlength="15" required>
          </div>
          <div class="form-group">
            <label for="alamat_baru">Alamat</label>
            <textarea name="alamat_baru" id="alamat_baru" cols="30" rows="3" class="form-control form-element" required></textarea>
          </div>
          <div class="form-group">
            <label for="email_baru">Email</label>
            <input type="email" class="form-control form-control-sm form-element" name="email_baru" id="email_baru" maxlength="30" required>
            <small class="form-text text-muted">Username dan Password akan dikirim ke email yang anda isi.</small>
          </div>
          <div class="form-group">
            <label for="foto_baru">Foto</label>
            <input type="file" class="form-control-file form-element" name="foto_baru" id="foto_baru" accept="image/*">
          </div>
          <div class="form-group">
            <label for="level_baru">Level</label>
            <select class="form-control form-control-sm" name="level_baru" id="level_baru" required>
              <option value="2">Admin</option>
              <option value="3">Cashier</option>
            </select>
          </div>
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
          <input type="hidden" name="id_pegawai" id="id_pegawai" value="">
          <input type="text" class="form-control form-control-sm text-uppercase" name="nama_pegawai" id="nama_pegawai" maxlength="20" required>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-dark btn-sm" data-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
          <button type="submit" class="btn btn-outline-dark btn-sm"><i class="fas fa-save"></i> Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
<form method="post" id="form-hapus-pegawai">
  <input type="hidden" name="id_pegawai_hapus" id="id_pegawai_hapus" value="">
</form>
<script>
  $('#content-title').html('Pegawai');
  $('#pegawai-link').addClass("active");
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
        $('#id_pegawai_hapus').val($(this).attr('data-id'));
        $('#form-hapus-pegawai').submit();
      }
    })
  });
  $('#add-dialog').on('shown.bs.modal', function (e) {
    $('#nama_pegawai_baru').focus();
  });
  $('#add-dialog').on('hidden.bs.modal', function (e) {
    $('.form-element').val(null);
  });
  // Input Filter
  function setInputFilter(textbox, inputFilter) {
    ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
      textbox.addEventListener(event, function() {
        if (inputFilter(this.value)) {
          this.oldValue = this.value;
          this.oldSelectionStart = this.selectionStart;
          this.oldSelectionEnd = this.selectionEnd;
        } else if (this.hasOwnProperty("oldValue")) {
          this.value = this.oldValue;
          this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
        }
      });
    });
  }
  setInputFilter(document.getElementById("no_telp_baru"), function(value) {
    return /^\d*\.?\d*$/.test(value);
  });
</script>
<?php
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
  // Tambah
  if (isset($_POST['nama_pegawai_baru'])) {
    try {
      $id_baru = getIdUserBaru();
      $username_baru = getNewUname($id_baru);
      $password_baru = getRandPwd();
      $mail=new PHPMailer(true);$mail->SMTPDebug=0;$mail->isSMTP();$mail->Host='smtp.gmail.com';$mail->SMTPAuth=true;$mail->Username='dev.sys.email@gmail.com';$mail->Password='12-qwerty';$mail->SMTPSecure='tls';$mail->Port=587;
      $mail->setFrom('admin@tangga-ayu.com', 'Tangga Ayu');
      $mail->addAddress($_POST['email_baru']);
      $mail->isHTML(true);
      $mail->Subject = 'Tangga Ayu Username & Password';
      $mail->Body    = 'Username : <b>'.$username_baru.'</b><br>Password : <b>'.$password_baru.'</b>';
      $mail->send();
      if ($_FILES['foto_baru']['size'] == 0) {
        $conn->exec("INSERT INTO users VALUES (
        '".$id_baru."',
        '".$username_baru."',
        '".sha1($password_baru)."',
        '".$_POST['nama_pegawai_baru']."',
        '".$_POST['no_telp_baru']."',
        '".$_POST['alamat_baru']."',
        '".$_POST['email_baru']."',
        '',
        '".$_POST['level_baru']."'
        )");
      } else {
        $target_dir = "././dist/img/pegawai/";
        $target_file = $target_dir . basename($_FILES["foto_baru"]["name"]);
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        $foto_baru= $id_baru.".".$imageFileType;
        $new_name= $target_dir.$foto_baru;
        move_uploaded_file($_FILES["foto_baru"]["tmp_name"], $new_name);
        $conn->exec("INSERT INTO users VALUES (
        '".$id_baru."',
        '".$username_baru."',
        '".sha1($password_baru)."',
        '".$_POST['nama_pegawai_baru']."',
        '".$_POST['no_telp_baru']."',
        '".$_POST['alamat_baru']."',
        '".$_POST['email_baru']."',
        '".$foto_baru."',
        '".$_POST['level_baru']."'
        )");
      }
      ?>
        <script>
          location.href = "?page=Pegawai";
        </script>
      <?php
    } catch (Exception $e) {
      ?>
        <script>
          swal.fire({
            'text': 'Silahkan periksa jaringan internet dan email yang anda masukan.'
          })
        </script>
      <?php
    }
  }
  
  // Hapus
  if (isset($_POST['id_pegawai_hapus'])) {
    $conn->exec("DELETE FROM users WHERE id_user = '".$_POST['id_pegawai_hapus']."'");
    ?>
      <script>
        location.href = "?page=Pegawai";
      </script>
    <?php
  }
?>