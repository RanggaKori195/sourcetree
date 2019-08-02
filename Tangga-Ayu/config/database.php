<?php
  try {
    $conn = new PDO("mysql:host=localhost;dbname=tangga-ayu", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    ?>
      <script>
        console.log("Connected successfully");
      </script>
    <?php
  } catch(PDOException $e) {
    $PDOException = $e->getMessage();
    ?>
      <script>
        let PDOException = <?= json_encode($PDOException);?>;
        console.log("Connection failed: " + PDOException);
      </script>
    <?php
  }
?>