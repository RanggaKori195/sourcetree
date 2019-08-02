<div class="p-2">
  <div class="table-responsive">
    <table class="table" id="table-transaksi">
      <thead>
        <tr>
          <th width="5%" class="text-center">No.</th>
          <th class="text-center">ID Transaksi</th>
          <th class="text-center">Kasir</th>
          <th width="15%" class="text-center">Tgl. Transaksi</th>
          <th width="17%" class="text-center">Grand Total (Rp.)</th>
          <th width="10%" class="text-center">Detail</th>
        </tr>
      </thead>
      <tbody>
        
      </tbody>
    </table>
  </div>
</div>
<script>
  $('#content-title').html('Transaksi');
  $('#transaksi-link').addClass("active");
  loadTransaksi();
  function loadTransaksi() {
    var table = $('#table-transaksi').DataTable({
      "destroy": true,
      "processing": true,
      "serverSide": true,
      "ajax": {
        url: "pages/admin/transaksi_loader.php"
      },
      "aoColumns": [
        null,
        null,
        null,
        null,
        {"className": "text-right"},
        {
          "className": "text-center",
          "mData": "1",
          "mRender": function ( data, type, full ) {
          return "<a href='?page=Transaksi&id="+data+"' class='btn bg-transparent btn-sm text-dark'><i class='far fa-eye'></i></a>";
          }
        }
      ],
      dom: '<"toolbar">frtip',
      fnInitComplete: function(){
        $('div.toolbar').html("<a href='?page=Tambah-Transaksi' class='btn btn-info btn-sm float-left'><i class='fas fa-plus'></i> Buat Baru</a>");
      }
    });
  }
</script>