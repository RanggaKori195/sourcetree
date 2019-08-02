<div class="p-2">
<div class="row">
    <div class="col-md-2">
      <button type="button" class="btn btn-info btn-sm form-control form-control-sm" id="btn-print"><i class="fas fa-print"></i> Cetak</button>
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
<div class="p-2" id="printThis">
  <div class="text-center">
    <h3>Laporan Produk Tangga Ayu</h3>
    <h3 id="laporan-params"></h3>
  </div>
  <div class="table-responsive">
    <table class="table" id="table-produk">
      <thead>
        <tr>
          <th width="5%" class="text-center">No.</th>
          <th class="text-center">Nama Produk</th>
          <th width="10%" class="text-center">Satuan</th>
          <th width="13%" class="text-center">Harga (Rp.)</th>
          <th width="10%" class="text-center">Stok</th>
        </tr>
      </thead>
      <tbody>
        
      </tbody>
    </table>
  </div>
</div>
<script>
  $('#content-title').html('Laporan Produk');
  $('#laporan-root').addClass('menu-open');
  $('#laporan-link').addClass("active");
  $('#laporan-produk-link').addClass("active");
  loadProduk();
  $('.produk-params').on('change', function(e) {
    loadProduk();
    let brand = $('#brand').val();
    let kategori = $('#kategori').val();
    if (brand != 'semua' && kategori != 'semua') {
      $('#laporan-params').html('Brand '+$('#brand option:selected').html()+' Kategori '+$('#kategori option:selected').html());
    } else if(brand != 'semua' && kategori == 'semua') {
      $('#laporan-params').html('Brand '+$('#brand option:selected').html());
    } else if(brand == 'semua' && kategori == 'semua') {
      $('#laporan-params').html('');
    }
  });
  function loadProduk() {
    var table = $('#table-produk').DataTable({
      "destroy": true,
      "processing": true,
      "serverSide": true,
      "lengthChange": false,
      "ordering": false,
      "searching": false,
      "info": false,
      "paging": false,
      "ajax": {
        url: "pages/admin/laporan_produk_loader.php",
        data: {"id_brand": $('#brand').val(), "id_kategori": $('#kategori').val()}
      },
      "aoColumns": [
        null,
        null,
        null,
        {"className": "text-right"},
        {"className": "text-right"}
      ]
    });
  }

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
</script>