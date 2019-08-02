<div class="p-2">
  <form method="post" enctype="multipart/form-data">
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
    <?php
      $stmt = $conn->prepare("SELECT * FROM kosmetik WHERE id_kosmetik = '".$_GET['id']."'");
      $stmt->execute();
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      $id_brand = $row['id_brand'];
      $id_kategori = $row['id_kategori'];
    ?>
    <div class="form-group">
      <label for="nama_produk_baru">Nama Produk</label>
      <input type="text" class="form-control form-control-sm form-element" name="nama_produk_baru" id="nama_produk_baru" maxlength="50" required value="<?= $row['nama_kosmetik'];?>">
    </div>
    <div class="form-group">
      <label for="satuan_baru">Satuan</label>
      <input type="text" class="form-control form-control-sm form-element" name="satuan_baru" id="satuan_baru" maxlength="10" required value="<?= $row['satuan'];?>">
    </div>
    <div class="form-group">
      <label for="harga_baru">Harga</label>
      <input type="number" class="form-control form-control-sm form-element" name="harga_baru" id="harga_baru" min="0" required value="<?= $row['harga_kosmetik'];?>">
    </div>
    <div class="form-group">
      <label for="stok_baru">Stok</label>
      <input type="number" class="form-control form-control-sm form-element" name="stok_baru" id="stok_baru" min="0" required value="<?= $row['stok'];?>">
    </div>
    <div class="text-right">
      <button type="submit" name="submit" class="btn btn-outline-dark btn-sm"><i class="fas fa-save"></i> Simpan</button>
    </div>
  </form>
</div>
<script>
  $('#content-title').html("<a href='?page=Produk' class='text-info'>Produk</a> / Detail");
  $('#produk-link').addClass("active");
  $('#brand_baru').val(<?= json_encode($id_brand); ?>);
  $('#kategori_baru').val(<?= json_encode($id_kategori); ?>);
</script>
<?php
  if (isset($_POST['submit'])) {
    $stmt = $conn->exec("UPDATE kosmetik SET 
    id_kategori = '".$_POST['kategori_baru']."',
    id_brand = '".$_POST['brand_baru']."',
    nama_kosmetik = '".$_POST['nama_produk_baru']."',
    satuan = '".$_POST['satuan_baru']."',
    harga_kosmetik = '".$_POST['harga_baru']."',
    stok = '".$_POST['stok_baru']."'
    WHERE id_kosmetik = '".$_GET['id']."'
    ");
    ?>
      <script>
        location.href = "?page=Produk";
      </script>
    <?php
  }
?>