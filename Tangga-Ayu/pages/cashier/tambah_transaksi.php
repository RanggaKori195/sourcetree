<div class="p-2">
  <button type="button" class="btn btn-info btn-sm w-200" id="btn-simpan"><i class="fas fa-save"></i> Simpan</button>
  <button type="button" class="btn btn-danger btn-sm w-200" id="btn-batal"><i class="fas fa-times"></i> Batal</button>
</div>
<div class="p-2">
  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th width="5%" class="text-center">No.</th>
          <th class="text-center">Nama Produk</th>
          <th class="text-center">Brand</th>
          <th class="text-center">Satuan</th>
          <th class="text-center">Harga (Rp.)</th>
          <th width="10%" class="text-center">Qty</th>
          <th class="text-center">Sub Total (Rp.)</th>
          <th width="10%" class="text-center">Hapus</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $stmt = $conn->prepare("SELECT tmp_table.*,kosmetik.*,brand.nama_brand FROM tmp_table INNER JOIN kosmetik ON kosmetik.id_kosmetik=tmp_table.id_kosmetik INNER JOIN brand ON brand.id_brand = kosmetik.id_brand");
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
            echo "<td class='text-center'><button class='btn btn-danger btn-sm btn-delete' data-id='".$row['id_kosmetik']."'><i class='far fa-trash-alt'></i></button></td>";
            echo "</tr>";
          }
        ?>
      </tbody>
    </table>
  </div>
  <hr>
  <div class="row">
    <div class="col-10 text-right"><strong>Grand Total : Rp. </strong></div>
    <div class="col-2">
      <span id="grand_total">
        <?php
          $stmt = $conn->prepare("SELECT * FROM tmp_table");
          $stmt->execute();
          if (intval($stmt->rowCount()) > 0) {
            $stmt_1 = $conn->prepare("SELECT SUM(sub_total) AS grand_total FROM tmp_table");
            $stmt_1->execute();
            $row = $stmt_1->fetch(PDO::FETCH_ASSOC);
            echo $row['grand_total'];
          } else {
            echo 0;
          }
        ?>
      </span>
    </div>
  </div>
  <form method="post" id='form-simpan-transaksi'>
    <input type="hidden" name='simpan' id='simpan'>
    <input type="hidden" name='input_tunai' id='input_tunai'>
    <input type="hidden" name='input_kembali' id='input_kembali'>
    <div class="row">
      <div class="col-10 text-right"><strong>Tunai : Rp. </strong></div>
      <div class="col-2">
        <input type="number" id="tunai" class="form-control form-control-sm" min="0" required>
      </div>
    </div>
    <div class="row">
      <div class="col-10 text-right"><strong>Kembali : Rp. </strong></div>
      <div class="col-2" id='kembali'>
      </div>
    </div>
  </form>
</div>
<div class="p-2"><hr></div>
<div class="p-2">
  <div class="table-responsive">
    <table class="table" id="table-produk">
      <thead>
        <tr>
          <th class="text-center">ID</th>
          <th class="text-center">Nama Produk</th>
          <th class="text-center">Brand</th>
          <th width="15%" class="text-center">Satuan</th>
          <th width="10%" class="text-center">Pilih</th>
        </tr>
      </thead>
      
      <tbody id="table-produk-body">
      </tbody>
    </table>
  </div>
</div>
<!-- Tambah barang dialog -->
<div class="modal fade" id="add-produk-dialog" tabindex="-1" role="dialog" aria-labelledby="add-produk-dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form method="post">
        <div class="modal-header">
          <h5 class="modal-title" id="dialog-title"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" name='id_kosmetik' id='id_kosmetik'>
          <div class="text-center"><label for="qty" id='nama_kosmetik'></label></div>
          <div class="form-group row">
            <div class="col-sm-2">
              <label for="qty" class="col-form-label col-form-label-sm">Qty</label>
            </div>
            <input type="number" class="form-control form-control-sm col-sm-8" name="qty" id="qty" min="1" required>
            <div class="col-sm-2">
              <label class="col-form-label col-form-label-sm" id='satuan'></label>
            </div>
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
<!-- Struk barang dialog -->
<div class="modal fade" id="struk-dialog" tabindex="-1" role="dialog" aria-labelledby="struk-dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form method="post">
        <div class="modal-header">
          <h5 class="modal-title" id="struk-dialog-title"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div style="width:8cm" class="text-center mx-auto" id="printThis">
            <strong>Tangga Ayu Kosmetik</strong><img src='dist/img/logo_black.png' alt='Logo' class='' style='width:50px;'>
            <br>
            <span class="struk-font">Pasar Jatiasih Blok A1 No. 8A</span>
            <br>
            <span class="struk-font"><i class="fas fa-phone"></i> 082213448885</span>
            <br>
            <?php
              for ($i=0; $i < 60; $i++) { 
                echo '-';
              }
            ?>
            <br>
            <div class="row">
              <div class="col-6 text-left">
                <small class="struk-font" id='id_transaksi_struk'></small>
              </div>
              <div class="col-6 text-right">
                <small class="struk-font" id="tgl_transaksi_struk"></small>
              </div>
            </div>
            <?php
              for ($i=0; $i < 60; $i++) { 
                echo '-';
              }
            ?>
            <table id="table-struk">
              
            </table>
            <?php
              for ($i=0; $i < 60; $i++) { 
                echo '-';
              }
            ?>
            <br>
            <div class="row">
              <div class="col-8 text-right">
                <small class="struk-font">Grand Total :</small>
              </div>
              <div class="col-4 text-right">
                <small class="struk-font" id="grand_total_struk"></small>
              </div>
            </div>
            <div class="row">
              <div class="col-8 text-right">
                <small class="struk-font">Tunai       :</small>
              </div>
              <div class="col-4 text-right">
                <small class="struk-font" id="tunai_struk"></small>
              </div>
            </div>
            <div class="row">
              <div class="col-8 text-right">
                <small class="struk-font">Kembali     :</small>
              </div>
              <div class="col-4 text-right">
                <small class="struk-font" id="kembali_struk"></small>
              </div>
            </div>
            <?php
              for ($i=0; $i < 60; $i++) { 
                echo '-';
              }
            ?>
            <br>
            <div class="text-center">
              <small class="struk-font">.:Terima Kasih:.</small>
            </div>
            <div class="text-center">
              <small class="struk-font">Kasir : 
                <?php
                  $stmt = $conn->prepare("SELECT nama_user FROM users WHERE id_user = '".$_SESSION['user']."'");
                  $stmt->execute();
                  $row = $stmt->fetch(PDO::FETCH_ASSOC);
                  echo $row['nama_user'];
                ?>
              </small>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-dark btn-sm" data-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
          <button type="button" class="btn btn-outline-dark btn-sm" id='btn-print'><i class="fas fa-print"></i> Cetak</button>
        </div>
      </form>
    </div>
  </div>
</div>
<form method="post" id='form-hapus-barang'>
  <input type="hidden" name='id_kosmetik_hapus' id='id_kosmetik_hapus'>
</form>
<form method="post" id='form-batal-transaksi'>
  <input type="hidden" name='batal' id='batal'>
</form>

<script>
  $('#content-title').html("<a href='?page=Transaksi' class='text-info'>Transaksi</a> / Transaksi Baru");
  $('#transaksi-link').addClass("active");
  loadTransaksi();
  $('.dataTables_filter input')
  .off()
  .on('keyup', function() {
    if ($(this).val() != '') {
      $('#table-produk').DataTable().search(this.value, false, false).draw();
      $('#table-produk-body').show();
      $('#qty').val(null);
    } else {
      $('#table-produk-body').hide();
      $('#qty').val(null);
    }
  });
  function loadTransaksi() {
    $('#table-produk-body').hide();
    var table = $('#table-produk').DataTable({
      "destroy": true,
      "processing": true,
      "serverSide": true,
      "lengthChange": false,
      "ordering": false,
      "info": false,
      "paging": false,
      "ajax": {
        url: "pages/cashier/produk_loader_2.php"
      },
      "aoColumns": [
        null,
        null,
        null,
        null,
        {
          "className": "text-center",
          "mData": "[]",
          "mRender": function ( data, type, full ) {
          return "<a href='javascript:void(0);' type='button' class='btn btn-info btn-sm' data-id='"+data[0]+"' data-nama='"+data[1]+"' data-satuan='"+data[3]+"' onclick='addFunction(this);'><i class='fas fa-plus'></i></a>";
          }
        }
      ],
      dom: '<"toolbar">frtip',
      fnInitComplete: function(){
        $('div.toolbar').html("<b class='float-left'>List Produk</b>");
      }
    });
  }
  function addFunction(elmnt) {
    $('#id_kosmetik').val(elmnt.getAttribute('data-id'));
    $('#nama_kosmetik').html(elmnt.getAttribute('data-nama'));
    $('#satuan').html(elmnt.getAttribute('data-satuan'));
    $('#add-produk-dialog').modal('show');
  }
  $('#add-produk-dialog').on('shown.bs.modal', function (e) {
    $('#qty').focus();
  });
  $('#add-produk-dialog').on('hidden.bs.modal', function (e) {
    $('#qty').val(null);
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
        $('#id_kosmetik_hapus').val($(this).attr('data-id'));
        $('#form-hapus-barang').submit();
      }
    })
  });
  $('#btn-batal').on('click', function(e) {
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
        $('#batal').val('1');
        $('#form-batal-transaksi').submit();
      }
    })
  });
  $('#btn-simpan').on('click', function(e) {
    if ($('#grand_total').html() == 0) {
      swal.fire({"text": "Silahkan pilih produk terlebih dahulu !"});
    } else {
      if ($('#input_kembali').val() == '' || $('#input_kembali').val() < 0) {
        swal.fire({"text": "Uang bayar minimal adalah sama dengan jumlah grand total !"});
      } else {
        $('#simpan').val('1');
        $('#form-simpan-transaksi').submit();
      }
    }
  });
  $('#tunai').on('keyup', function(e) {
    let grand_total = $('#grand_total').html();
    let tunai = $('#tunai').val();
    let kembali = tunai - grand_total;
    $('#kembali').html(kembali);
    $('#input_tunai').val($('#tunai').val());
    $('#input_kembali').val(kembali);
  });

  document.getElementById("btn-print").onclick = function () {
    printElement(document.getElementById("printThis"));
  }

  function printElement(elem) {
    var domClone = elem.cloneNode(true);
    
    var $printSection = document.getElementById("printSection");
    
    if (!$printSection) {
        var $printSection = document.createElement("div");
        $printSection.id = "printSection";
        document.body.appendChild($printSection);
    }
    
    $printSection.innerHTML = "";
    $printSection.appendChild(domClone);
    window.print();
  }

  $('#struk-dialog').on('hidden.bs.modal', function (e) {
    location.href = "?page=Tambah-Transaksi";
  });
</script>
<?php
  // Tambah barang
  if (isset($_POST['id_kosmetik'])) {
    $stmt = $conn->prepare("SELECT harga_kosmetik FROM kosmetik WHERE id_kosmetik = '".$_POST['id_kosmetik']."'");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $sub_total = intval($row['harga_kosmetik']) * intval($_POST['qty']);
    $stmt_2 = $conn->prepare("SELECT * FROM tmp_table WHERE id_kosmetik = '".$_POST['id_kosmetik']."'");
    $stmt_2->execute();
    if (intval($stmt_2->rowCount()) > 0) {
      $conn->exec("UPDATE tmp_table SET qty = '".$_POST['qty']."', sub_total = '$sub_total' WHERE id_kosmetik = '".$_POST['id_kosmetik']."'");
    } else {
      $id_transaksi = getIdTransaksiBaru();
      $conn->exec("INSERT INTO tmp_table VALUES ('$id_transaksi', '".$_POST['id_kosmetik']."', '".$_POST['qty']."', '$sub_total')");
    }
    ?>
      <script>location.href = "?page=Tambah-Transaksi";</script>
    <?php
  }

  // Hapus
  if (isset($_POST['id_kosmetik_hapus'])) {
    $conn->exec("DELETE FROM tmp_table WHERE id_kosmetik = '".$_POST['id_kosmetik_hapus']."'");
    ?>
      <script>location.href = "?page=Tambah-Transaksi";</script>
    <?php
  }

  // Batal
  if (isset($_POST['batal'])) {
    $conn->exec("TRUNCATE TABLE tmp_table");
    ?>
      <script>location.href = "?page=Tambah-Transaksi";</script>
    <?php
  }

  // Simpan Transaksi
  if (isset($_POST['simpan'])) {
    $stmt = $conn->prepare("SELECT * FROM tmp_table");
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($rows as $row) {
      $conn->exec("UPDATE kosmetik SET stok = stok - '".$row['qty']."' WHERE id_kosmetik = '".$row['id_kosmetik']."'");
    }
    $stmt_2 = $conn->prepare("SELECT SUM(sub_total) AS grand_total FROM tmp_table");
    $stmt_2->execute();
    $row = $stmt_2->fetch(PDO::FETCH_ASSOC);
    $grand_total = $row['grand_total'];
    $id_transaksi = getIdTransaksiBaru();
    $conn->exec("INSERT INTO transaksi VALUES ('$id_transaksi', '".$_SESSION['user']."', '".date('Y-m-d')."', '$grand_total')");
    $conn->exec("INSERT INTO detail_transaksi SELECT * FROM tmp_table");
    $conn->exec("TRUNCATE TABLE tmp_table");
    $tgl_transaksi = date('Y-m-d');
    $stmt_3 = $conn->prepare("SELECT
      detail_transaksi.*,
      kosmetik.nama_kosmetik,
      kosmetik.harga_kosmetik
      FROM detail_transaksi
      INNER JOIN kosmetik ON kosmetik.id_kosmetik=detail_transaksi.id_kosmetik
      WHERE id_transaksi = '$id_transaksi'");
    $stmt_3->execute();
    $rows_1 = $stmt_3->fetchAll(PDO::FETCH_ASSOC);
    $table_struk = '';
    $tunai = $_POST['input_tunai'];
    $kembali = $_POST['input_kembali'];
    foreach ($rows_1 as $row) {
      $table_struk .= "
        <tr>
          <td><small class='struk-font'>".$row['nama_kosmetik']."</small></td>
          <td><small class='struk-font'>".$row['qty']."</small></td>
          <td><small class='struk-font'>".$row['harga_kosmetik']."</small></td>
          <td><small class='struk-font'>".$row['sub_total']."</small></td>
        </tr>
      ";
    }
    ?>
      <script>
        $('#id_transaksi_struk').html(<?= json_encode($id_transaksi); ?>);
        $('#tgl_transaksi_struk').html(<?= json_encode($tgl_transaksi); ?>);
        $('#table-struk').html(<?= json_encode($table_struk); ?>);
        $('#grand_total_struk').html(<?= json_encode($grand_total); ?>);
        $('#tunai_struk').html(<?= json_encode($tunai); ?>);
        $('#kembali_struk').html(<?= json_encode($kembali); ?>);
        $('#struk-dialog').modal('show');
      </script>
    <?php
  }
?>