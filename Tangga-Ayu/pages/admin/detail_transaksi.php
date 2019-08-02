<?php
  $stmt = $conn->prepare("SELECT transaksi.*, users.nama_user FROM transaksi INNER JOIN users ON users.id_user = transaksi.id_user WHERE id_transaksi = '".$_GET['id']."'");
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  $nama_user = $row['nama_user'];
  $tgl_transaksi = $row['tgl_transaksi'];
  $grand_total = $row['grand_total'];
?>
<div class="p-2">
  <table>
    <tr>
      <th>ID Transaksi</th>
      <th>:</th>
      <th><?= $_GET['id']; ?></th>
    </tr>
    <tr>
      <th>Tgl. Transaksi</th>
      <th>:</th>
      <th><?= $tgl_transaksi; ?></th>
    </tr>
    <tr>
      <th>Kasir</th>
      <th>:</th>
      <th><?= $nama_user; ?></th>
    </tr>
    <tr>
      <th>Grand Total</th>
      <th>:</th>
      <th><?= $grand_total; ?></th>
    </tr>
  </table>
  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th width="5%" class="text-center">No.</th>
          <th class="text-center">Nama Produk</th>
          <th class="text-center">Brand</th>
          <th width="10%" class="text-center">Satuan</th>
          <th width="13%" class="text-center">Harga</th>
          <th width="10%" class="text-center">Qty</th>
          <th width="15%" class="text-center">Subtotal</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $stmt = $conn->prepare("SELECT detail_transaksi.*, kosmetik.*, brand.nama_brand FROM detail_transaksi INNER JOIN kosmetik ON kosmetik.id_kosmetik = detail_transaksi.id_kosmetik INNER JOIN brand ON brand.id_brand = kosmetik.id_brand WHERE id_transaksi = '".$_GET['id']."'");
          $stmt->execute();
          $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
          $no = 1;
          foreach ($rows as $row) {
            echo "<tr>";
            echo "<th>".$no++."</th>";
            echo "<td>".$row['nama_kosmetik']."</td>";
            echo "<td>".$row['nama_brand']."</td>";
            echo "<td>".$row['satuan']."</td>";
            echo "<td class='text-right'>".$row['harga_kosmetik']."</td>";
            echo "<td class='text-right'>".$row['qty']."</td>";
            echo "<td class='text-right'>".$row['sub_total']."</td>";
            echo "</tr>";
          }
        ?>
      </tbody>
    </table>
  </div>
</div>
<script>
  $('#content-title').html("<a href='?page=Transaksi' class='text-info'>Transaksi</a> / Detail");
  $('#transaksi-link').addClass("active");
</script>