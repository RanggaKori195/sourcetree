<?php
$id_brand = $_GET['id_brand'];
$id_kategori = $_GET['id_kategori'];
if (isset($_POST['search']['value'])) {
  $search = $_POST['search']['value'];
}
if ($id_brand != 'semua' && $id_kategori != 'semua') {
  if (isset($_POST['search']['value'])) {
$table = <<<EOT
(
  SELECT kosmetik.* FROM kosmetik
  INNER JOIN brand ON kosmetik.id_brand = brand.id_brand
  INNER JOIN kategori ON kosmetik.id_kategori = kategori.id_kategori
  WHERE kosmetik.id_brand = '$id_brand' AND kosmetik.id_kategori = '$id_kategori' AND nama_kosmetik LIKE '%$search%' OR
  kosmetik.id_brand = '$id_brand' AND kosmetik.id_kategori = '$id_kategori' AND satuan LIKE '%$search%' OR
  kosmetik.id_brand = '$id_brand' AND kosmetik.id_kategori = '$id_kategori' AND harga_kosmetik LIKE '%$search%' OR
  kosmetik.id_brand = '$id_brand' AND kosmetik.id_kategori = '$id_kategori' AND stok LIKE '%$search%'
) temp
EOT;
  } else {
$table = <<<EOT
(
  SELECT kosmetik.* FROM kosmetik INNER JOIN brand ON kosmetik.id_brand = brand.id_brand INNER JOIN kategori ON kosmetik.id_kategori = kategori.id_kategori WHERE kosmetik.id_brand = '$id_brand' AND kosmetik.id_kategori = '$id_kategori'
) temp
EOT;
  }
} elseif ($id_brand == 'semua' && $id_kategori != 'semua') {
  if (isset($_POST['search']['value'])) {
$table = <<<EOT
(
  SELECT kosmetik.* FROM kosmetik
  INNER JOIN kategori ON kosmetik.id_kategori = kategori.id_kategori
  WHERE kosmetik.id_kategori = '$id_kategori' AND nama_kosmetik LIKE '%$search%' OR
  kosmetik.id_kategori = '$id_kategori' AND satuan LIKE '%$search%' OR
  kosmetik.id_kategori = '$id_kategori' AND harga_kosmetik LIKE '%$search%' OR
  kosmetik.id_kategori = '$id_kategori' AND stok LIKE '%$search%'
) temp
EOT;
  } else {
$table = <<<EOT
(
  SELECT kosmetik.* FROM kosmetik INNER JOIN kategori ON kosmetik.id_kategori = kategori.id_kategori WHERE kosmetik.id_kategori = '$id_kategori'
) temp
EOT;
  }
} elseif ($id_brand != 'semua' && $id_kategori == 'semua') {
  if (isset($_POST['search']['value'])) {
$table = <<<EOT
(
  SELECT kosmetik.* FROM kosmetik
  INNER JOIN brand ON kosmetik.id_brand = brand.id_brand
  WHERE kosmetik.id_brand = '$id_brand' AND nama_kosmetik LIKE '%$search%' OR
  kosmetik.id_brand = '$id_brand' AND satuan LIKE '%$search%' OR
  kosmetik.id_brand = '$id_brand' AND harga_kosmetik LIKE '%$search%' OR
  kosmetik.id_brand = '$id_brand' AND stok LIKE '%$search%'
) temp
EOT;
  } else {
$table = <<<EOT
(
  SELECT kosmetik.* FROM kosmetik INNER JOIN brand ON kosmetik.id_brand = brand.id_brand WHERE kosmetik.id_brand = '$id_brand'
) temp
EOT;
  }
} else {
  if (isset($_POST['search']['value'])) {
$table = <<<EOT
(
  SELECT * FROM kosmetik
  WHERE nama_kosmetik LIKE '%$search%' OR
  satuan LIKE '%$search%' OR
  harga_kosmetik LIKE '%$search%' OR
  stok LIKE '%$search%'
) temp
EOT;
  } else {
$table = <<<EOT
(
  SELECT * FROM kosmetik
) temp
EOT;
  }
}

$primaryKey = 'id_kosmetik';
$columns = array(
  array( 'db' => 'id_kosmetik','dt' => 5 ),
  array( 'db' => 'nama_kosmetik','dt' => 1 ),
  array( 'db' => 'satuan','dt' => 2 ),
  array( 'db' => 'harga_kosmetik','dt' => 3 ),
  array( 'db' => 'stok','dt' => 4 )
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
