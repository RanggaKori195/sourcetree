<div class="p-2">
  <div class="row">
    <div class="col-md-3">
      <button type="button" class="btn btn-info btn-sm form-control form-control-sm" id="btn-print"><i class="fas fa-print"></i> Cetak</button>
    </div>
    <div class="col-md-3">
      <div class="form-group row">
        <label for="pilihan_waktu" class="col-sm-4 col-form-label col-form-label-sm text-right">Waktu</label>
        <div class="col-sm-8">
          <select id="pilihan_waktu" class="form-control form-control-sm laporan-params">
            <option value="keseluruhan">Keseluruhan</option>
            <option value="periode">Periode</option>
          </select>
        </div>
      </div>
    </div>
    <div class="col-md-3 laporan-params-wrapper" style="display:none">
      <div class="form-group row">
        <label for="batas_bawah" class="col-sm-4 col-form-label col-form-label-sm text-right">Dari</label>
        <div class="col-sm-8">
          <input type="date" id="batas_bawah" class="form-control form-control-sm laporan-params">
        </div>
      </div>
    </div>
    <div class="col-md-3 laporan-params-wrapper" style="display:none">
      <div class="form-group row">
        <label for="batas_atas" class="col-sm-4 col-form-label col-form-label-sm text-right">Hingga</label>
        <div class="col-sm-8">
          <input type="date" id="batas_atas" class="form-control form-control-sm laporan-params">
        </div>
      </div>
    </div>
  </div>
</div>
<div class="p-2" id="printThis">
  <div class="text-center">
    <h3>Laporan Penjualan Tangga Ayu</h3>
    <h3 id="laporan-params"></h3>
  </div>
  <div class="table-responsive">
    <table class="table" id="table-transaksi">
      <thead>
        <tr>
          <th width="5%" class="text-center">No.</th>
          <th class="text-center">ID Transaksi</th>
          <th class="text-center">Kasir</th>
          <th width="15%" class="text-center">Tgl. Transaksi</th>
          <th width="17%" class="text-center">Grand Total (Rp.)</th>
        </tr>
      </thead>
      <tbody>
        
      </tbody>
    </table>
  </div>
</div>
<script>
  $('#content-title').html('Laporan Penjualan');
  $('#laporan-root').addClass('menu-open');
  $('#laporan-link').addClass("active");
  $('#laporan-penjualan-link').addClass("active");
  loadTransaksi();
  function loadTransaksi() {
    var table = $('#table-transaksi').DataTable({
      "destroy": true,
      "processing": true,
      "serverSide": true,
      "lengthChange": false,
      "ordering": false,
      "searching": false,
      "info": false,
      "paging": false,
      "ajax": {
        url: "pages/owner/laporan_penjualan_loader.php",
        data: {
          "pilihan_waktu": $('#pilihan_waktu').val(),
          "batas_bawah": $('#batas_bawah').val(),
          "batas_atas": $('#batas_atas').val()
        }
      },
      "aoColumns": [
        null,
        null,
        null,
        null,
        {"className": "text-right"}
      ]
    });
  }
  $('.laporan-params').on('change', function(e) {
    loadTransaksi();
    $('#laporan-params').html($('#batas_bawah').val()+' S.D. '+$('#batas_atas').val());
  });
  $('#pilihan_waktu').on('change', function(e) {
    if ($(this).val() == 'periode') {
      $('.laporan-params-wrapper').show();
    } else {
      $('.laporan-params-wrapper').hide();
      $('#laporan-params').html('');
    }
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
</script>