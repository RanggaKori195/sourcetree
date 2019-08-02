<?php
$table = <<<EOT
(
  SELECT kosmetik.*, brand.nama_brand FROM kosmetik
  INNER JOIN brand ON brand.id_brand = kosmetik.id_brand
) temp
EOT;
$primaryKey = 'id_kosmetik';
$columns = array(
  array( 'db' => 'id_kosmetik','dt' => 0 ),
  array( 'db' => 'nama_kosmetik','dt' => 1 ),
  array( 'db' => 'nama_brand','dt' => 2 ),
  array( 'db' => 'satuan','dt' => 3 )
);
$sql_details = array(
  'user' => 'root',
  'pass' => '',
  'db'   => 'tangga-ayu',
  'host' => 'localhost'
);
require( '../../config/datatables.php' );
$result=SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns);
echo json_encode($result);
