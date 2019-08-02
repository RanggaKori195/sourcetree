<?php
  $stmt = $conn->prepare("SELECT * FROM users WHERE id_user = '".$_SESSION['user']."'");
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<div class="p-2">
  <div class="text-center">
    <?php
      if ($row['foto_user'] != '') {
        echo "<img src='././dist/img/pegawai/".$row['foto_user']."' alt='User Image' class='img-thumbnail rounded w-200'>";
      } else {
        echo "<img src='././dist/img/pegawai/nopic.jpg' alt='User Image' class='img-thumbnail rounded w-200'>";
      }
    ?>
  </div>
  <hr>
  <form method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label for="nama_pegawai_baru">Nama Lengkap</label>
      <input type="text" class="form-control form-control-sm" name="nama_pegawai_baru" id="nama_pegawai_baru" maxlength="20" required value="<?= $row['nama_user']; ?>">
    </div>
    <div class="form-group">
      <label for="no_telp_baru">Nomer Telepon</label>
      <input type="text" class="form-control form-control-sm" name="no_telp_baru" id="no_telp_baru" maxlength="15" required value="<?= $row['tlp_user']; ?>">
    </div>
    <div class="form-group">
      <label for="alamat_baru">Alamat</label>
      <textarea name="alamat_baru" id="alamat_baru" cols="30" rows="3" class="form-control" required><?= $row['alamat_user']; ?></textarea>
    </div>
    <div class="form-group">
      <label for="email_baru">Email</label>
      <input type="email" class="form-control form-control-sm" name="email_baru" id="email_baru" maxlength="30" required value="<?= $row['email_user']; ?>">
    </div>
    <div class="form-group">
      <label for="foto_baru">Foto</label>
      <input type="file" class="form-control-file" name="foto_baru" id="foto_baru" accept="image/*">
    </div>
    <div class="text-right">
      <button type="submit" name="submit" class="btn btn-outline-dark btn-sm"><i class="fas fa-save"></i> Simpan</button>
    </div>
  </form>
</div>
<script>
  $('#content-title').html("Profil");
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
  if (isset($_POST['submit'])) {
    if ($_FILES['foto_baru']['size'] == 0) {
      $stmt = $conn->exec("UPDATE users SET 
      nama_user = '".$_POST['nama_pegawai_baru']."',
      tlp_user = '".$_POST['no_telp_baru']."',
      alamat_user = '".$_POST['alamat_baru']."',
      email_user = '".$_POST['email_baru']."'
      WHERE id_user = '".$_SESSION['user']."'
      ");
    } else {
      $target_dir = "././dist/img/pegawai/";
      $target_file = $target_dir . basename($_FILES["foto_baru"]["name"]);
      $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
      $foto_baru= $_SESSION['user'].".".$imageFileType;
      $new_name= $target_dir.$foto_baru;
      move_uploaded_file($_FILES["foto_baru"]["tmp_name"], $new_name);

      $stmt = $conn->exec("UPDATE users SET 
      nama_user = '".$_POST['nama_pegawai_baru']."',
      tlp_user = '".$_POST['no_telp_baru']."',
      alamat_user = '".$_POST['alamat_baru']."',
      email_user = '".$_POST['email_baru']."',
      foto_user = '".$foto_baru."'
      WHERE id_user = '".$_SESSION['user']."'
      ");
    }
    ?>
      <script>
        location.href = "?page=Profil";
      </script>
    <?php
  }
?>