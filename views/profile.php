<?php require_once("../controller/script.php");
require_once("redirect.php");
$_SESSION['page-name'] = "Kelola Akun";
$_SESSION['page-url'] = "profile";
?>

<!DOCTYPE html>
<html lang="en">

<head><?php require_once("../resources/dash-header.php") ?></head>

<body>
  <?php if (isset($_SESSION['message-success'])) { ?>
    <div class="message-success" data-message-success="<?= $_SESSION['message-success'] ?>"></div>
  <?php }
  if (isset($_SESSION['message-info'])) { ?>
    <div class="message-info" data-message-info="<?= $_SESSION['message-info'] ?>"></div>
  <?php }
  if (isset($_SESSION['message-warning'])) { ?>
    <div class="message-warning" data-message-warning="<?= $_SESSION['message-warning'] ?>"></div>
  <?php }
  if (isset($_SESSION['message-danger'])) { ?>
    <div class="message-danger" data-message-danger="<?= $_SESSION['message-danger'] ?>"></div>
  <?php } ?>
  <div class="container-scroller">
    <?php require_once("../resources/dash-topbar.php") ?>
    <div class="container-fluid page-body-wrapper">
      <?php require_once("../resources/dash-sidebar.php") ?>
      <div class="main-panel">
        <div class="content-wrapper">
          <?php if (mysqli_num_rows($profile) > 0) {
            while ($row = mysqli_fetch_assoc($profile)) { ?>
              <div class="row flex-row-reverse">
                <div class="col-lg-4">
                  <div class="card rounded-0 shadow">
                    <div class="card-body text-center">
                      <h2>Ubah Profil</h2>
                      <form action="" method="POST">
                        <div class="mb-3">
                          <label for="username" class="form-label">Nama</label>
                          <input type="text" name="username" value="<?= $row['username'] ?>" class="form-control" id="username" placeholder="Nama" pattern="^[a-zA-Z\s'-]{1,100}$" oninvalid="this.setCustomValidity('Nama tidak boleh ada karakter selain huruf!')" required>
                        </div>
                        <div class="mb-3">
                          <label for="alamat" class="form-label">Alamat</label>
                          <input type="text" name="alamat" value="<?= $row['alamat'] ?>" class="form-control" id="alamat" placeholder="Alamat" required>
                        </div>
                        <div class="mb-3">
                          <label for="telp" class="form-label">Telpon</label>
                          <input type="number" name="telp" value="<?= $row['telp'] ?>" class="form-control" id="telpon" placeholder="Telpon" required>
                        </div>
                        <div class="mb-3">
                          <label for="norek" class="form-label">Rekening Bank</label>
                          <input type="text" name="norek" value="<?= $row['norek'] ?>" class="form-control" id="norek" placeholder="No. Rekening" required>
                        </div>
                        <button type="submit" name="ubah-profile" class="btn btn-primary">Simpan</button>
                      </form>
                    </div>
                  </div>
                </div>
                <div class="col-lg-8">
                  <div class="card rounded-0 shadow">
                    <div class="card-body">
                      <h2>Profil Akun</h2>
                      <div class="table-responsive">
                        <table class="table table-borderless table-sm">
                          <tbody>
                            <tr>
                              <th scope="row">Nama</th>
                              <td>:</td>
                              <td class="w-75"><?= $row['username'] ?></td>
                            </tr>
                            <tr>
                              <th scope="row">Email</th>
                              <td>:</td>
                              <td class="w-75"><?= $row['email'] ?></td>
                            </tr>
                            <tr>
                              <th scope="row">Alamat</th>
                              <td>:</td>
                              <td class="w-75"><?= $row['alamat'] ?></td>
                            </tr>
                            <tr>
                              <th scope="row">Telpon</th>
                              <td>:</td>
                              <td class="w-75"><?= $row['telp'] ?></td>
                            </tr>
                            <tr>
                              <th scope="row">Rekening Bank</th>
                              <td>:</td>
                              <td class="w-75"><?= $row['norek'] ?></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          <?php }
          } ?>
        </div>
        <?php require_once("../resources/dash-footer.php") ?>
        <script>
          function validation() {
            var validasiAngka = /^[0-9 ]+$/;
            var nama = document.getElementById("username");
            if (nama.value.match(validasiAngka)) {
              Swal.fire({
                icon: 'error',
                title: 'Kesalahan',
                text: "Masukkan nama Anda!\nFormat hanya diperbolehkan huruf!",
              })
              nama.focus();
              return false;
            }
          }
        </script>
</body>

</html>