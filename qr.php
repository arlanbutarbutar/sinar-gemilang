<?php require_once("controller/script.php");
$_SESSION['page-name'] = "Data Perjalanan";
$_SESSION['page-url'] = "qr";
$_SESSION['actual-link'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

if (!isset($_GET['perjalanan'])) {
  header("Location: ./");
  exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head><?php require_once("resources/header.php") ?></head>
<!-- body -->

<body class="main-layout" style="font-family: 'Montserrat', sans-serif;">
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
  <?php }
  require_once("resources/navbar.php") ?>
  <!-- banner -->
  <section class="banner_main" style="margin-bottom: -300px;">
    <div class="row p-5" style="margin-top: -200px;max-width: 100%;">
      <div class="col-lg-5">
        <div class="text-bg">
          <?php if (isset($_GET['perjalanan'])) {
            $id_pesan = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_GET['perjalanan']))));
            $perjalanan = mysqli_query($conn, "SELECT * FROM pemesanan JOIN users ON pemesanan.id_user=users.id_user JOIN jadwal ON pemesanan.id_jadwal=jadwal.id_jadwal JOIN rute ON jadwal.id_rute=rute.id_rute JOIN bus ON jadwal.id_bus=bus.id_bus WHERE pemesanan.id_pesan='$id_pesan'");
            if (mysqli_num_rows($perjalanan) > 0) {
              while ($row = mysqli_fetch_assoc($perjalanan)) { ?>
                <h1>Data Perjalanan</h1>
                <span><?php $tgl_jalan = date_create($row['tgl_jalan']);
                      $tgl_jalan = date_format($tgl_jalan, "l, d M Y");
                      $data_qr = $row['username'] . " (" . $row['email'] . "/" . $row['telp'] . ") <br> No. Kursi " . $row['kursi'] . " <br>Bus " . $row['nama_bus'] . " (" . $row['no_plat'] . ") <br>Tujuan " . $row['rute_dari'] . " - " . $row['rute_ke'] . " <br>Jadwal " . $tgl_jalan;
                      echo $data_qr; ?></span>
          <?php }
            }
          } ?>
        </div>
      </div>
      <div class="col-lg-7 text-center">
        <img src="assets/images/bus.png" style="width: 500px;" alt="Bus Perjalanan">
      </div>
    </div>
  </section>
  <!-- end banner -->
  <?php require_once("resources/footer.php") ?>
</body>

</html>