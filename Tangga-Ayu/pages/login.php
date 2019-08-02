<div class="container-fluid">
  <div class="pt-3 px-3" id="login-wrapper">
    <div class="text-center">
      <img src="dist/img/logo.png" alt="Logo" class="rounded-circle img-fluid w-200">
    </div>
    <form method="post">
      <div class="form-group">
        <div class="input-group input-group-sm mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-sm" style="background-color:white;"><i class="fas fa-user"></i></span>
          </div>
          <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" name="uname" placeholder="Username" maxlength="8" required>
        </div>
      </div>
      <div class="form-group">
        <div class="input-group input-group-sm mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-sm" style="background-color:white;"><i class="fas fa-key"></i></span>
          </div>
          <input type="password" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" name="pwd" placeholder="Password" maxlength="8" required>
        </div>
      </div>
      <div class="form-group">
        <button type="submit" name="submit" class="btn btn-sm form-control btn-outline-info"><i class='fas fa-sign-in-alt'></i> Login</button>
      </div>
    </form>
  </div>
</div>
<?php
  if (isset($_POST['uname'])) {
    // Cek username
    $stmt =  $conn->prepare("SELECT * FROM users WHERE username = '".$_POST['uname']."'");
    $stmt->execute();
    if (intval($stmt->rowCount()) > 0) {
      // Username benar
      // Cek username & password
      $stmt =  $conn->prepare("SELECT * FROM users WHERE username = '".$_POST['uname']."' AND password = '".sha1($_POST['pwd'])."'");
      $stmt->execute();
      if (intval($stmt->rowCount()) > 0) {
        // Menampung record dalam bentuk array associative
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['user'] = $row['id_user'];
        $_SESSION['level'] = $row['level'];
        header("location:./");
      } else {
        ?>
          <script>
            Swal.fire({
              type: 'error',
              title: 'Terjadi Kesalahan',
              text: 'Password yang anda masukan salah'
            })
          </script>
        <?php
      }
    } else {
      // Username salah
      ?>
        <script>
          Swal.fire({
            type: 'error',
            title: 'Terjadi Kesalahan',
            text: 'Username yang anda masukan salah'
          })
        </script>
      <?php
    }
  }
?>
