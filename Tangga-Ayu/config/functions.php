<?php
  function getIdUserBaru() {
    include 'database.php';
    $stmt =  $conn->prepare("SELECT id_user FROM users ORDER BY id_user DESC LIMIT 1");
    $stmt->execute();
    if (intval($stmt->rowCount()) > 0) {
      // Sudah ada record
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      $lastId = substr($row['id_user'], 4);
      $nilai = $lastId + 1;
      $digit = 2 - (strlen($nilai));
      $newId = 'USR-'.substr_replace($lastId, $nilai, $digit);
    } else {
      // Belum ada record
      $newId = 'USR-01';
    }
    return $newId;
  }

  function getIdProdukBaru() {
    include 'database.php';
    $stmt =  $conn->prepare("SELECT id_kosmetik FROM kosmetik ORDER BY id_kosmetik DESC LIMIT 1");
    $stmt->execute();
    if (intval($stmt->rowCount()) > 0) {
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      $lastId = substr($row['id_kosmetik'], 2);
      $nilai = $lastId + 1;
      $digit = 4 - (strlen($nilai));
      $newId = 'PR'.substr_replace($lastId, $nilai, $digit);
    } else {
      $newId = 'PR0001';
    }
    return $newId;
  }

  function getIdTransaksiBaru() {
    include 'database.php';
    $stmt =  $conn->prepare("SELECT id_transaksi FROM transaksi ORDER BY id_transaksi DESC LIMIT 1");
    $stmt->execute();
    if (intval($stmt->rowCount()) > 0) {
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      $lastId = substr($row['id_transaksi'], 8);
      $nilai = $lastId + 1;
      $digit = 7 - (strlen($nilai));
      $newId = 'TR-'.date('md').'-'.substr_replace($lastId, $nilai, $digit);
    } else {
      $newId = 'TR-'.date('md').'-0000001';
    }
    return $newId;
  }

  function getNewUname($id) {
    return $id.date('m');
  }

  function getRandPwd() {
    $pwd = '';
    for ($i=0; $i < 8; $i++) { 
      $pwd .= mt_rand(0, 9);
    }

    return $pwd;
  }
?>