<?php
$pilihan_waktu = $_GET['pilihan_waktu'];
$batas_bawah = $_GET['batas_bawah'];
$batas_atas = $_GET['batas_atas'];
if ($pilihan_waktu != 'keseluruhan') {
  if ($batas_bawah == $batas_atas) {
$table = <<<EOT
(
  SELECT transaksi.*, users.nama_user FROM transaksi
  INNER JOIN users ON users.id_user = transaksi.id_user
  WHERE tgl_transaksi = '$batas_bawah'
) temp
EOT;
  } else {
$table = <<<EOT
(
  SELECT transaksi.*, users.nama_user FROM transaksi
  INNER JOIN users ON users.id_user = transaksi.id_user
  WHERE tgl_transaksi >= '$batas_bawah' AND tgl_transaksi <= '$batas_atas'
) temp
EOT;
  }
} else {
$table = <<<EOT
(
  SELECT transaksi.*, users.nama_user FROM transaksi
  INNER JOIN users ON users.id_user = transaksi.id_user
) temp
EOT;
}

$primaryKey = 'id_transaksi';
$columns = array(
  array( 'db' => 'id_transaksi','dt' => 1 ),
  array( 'db' => 'nama_user','dt' => 2 ),
  array( 'db' => 'tgl_transaksi','dt' => 3 ),
  array( 'db' => 'grand_total','dt' => 4 )
);
$sql_details = array(
  'user' => 'root',
  'pass' => '',
  'db'   => 'tangga-ayu',
  'host' => 'localhost'
);
require( '../../config/datatables.php' );
$result=SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns);
$start=$_REQUEST['start']+1;
$idx=0;
foreach($result['data'] as &$res){
  $res[0]=(string)$start;
  $start++;
  $idx++;
}
echo json_encode($result);
