<?php require_once("controller/script.php");
$_SESSION['page-name'] = "Perjalanan";
$_SESSION['page-url'] = "perjalanan";
$_SESSION['actual-link'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>


<!DOCTYPE html>
<html lang="en">

<head><?php require_once("resources/header.php") ?></head>
<!-- body -->

<body class="main-layout" style="font-family: 'Montserrat', sans-serif;">
  <?php require_once("resources/navbar.php") ?>
  <!-- banner -->
  <section class="banner_main">
    <div class="row p-5" style="margin-top: -100px;max-width: 100%;">
      <div class="col-lg-5">
        <div class="text-bg">
          <h1>Perjalanan</h1>
        </div>
      </div>
      <div class="col-lg-7">
        <form class="transfot text-right mt-5" method="POST">
          <h3 class="text-right">Pilih rute perjalanan anda sekarang</h3>
          <div class="mb-3">
            <div class="d-flex justify-content-end">
              <p class="text-white font-weight-bold">Dari: </p>
              <select class="transfot_form ml-3" name="from" aria-label="Default select example" style="width: 250px;" required>
                <option selected value="">Berangkat dari...</option>
                <?php foreach ($selectFrom as $row_from) : ?>
                  <option value="<?= $row_from['rute_dari'] ?>"><?= $row_from['rute_dari'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="mb-3">
            <div class="d-flex justify-content-end">
              <p class="text-white font-weight-bold">Ke: </p>
              <select class="transfot_form ml-3" name="to" aria-label="Default select example" style="width: 250px;" required>
                <option selected value="">Tujuan ke...</option>
                <?php foreach ($selectTo as $row_to) : ?>
                  <option value="<?= $row_to['rute_ke'] ?>"><?= $row_to['rute_ke'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="mb-3">
            <div class="d-flex justify-content-end">
              <p class="text-white font-weight-bold">Tgl Berangkat: </p>
              <input type="date" name="tgl-berangkat" class="transfot_form ml-3" style="width: 250px;" placeholder="Tanggal Berangkat" required>
            </div>
          </div>
          <button class="get_now shadow" name="cari-perjalanan" style="background-color: #009688;">Cari Bis</button>
        </form>
      </div>
    </div>
  </section>
  <!-- end banner -->
  <!-- about section -->
  <?php if (isset($_SESSION['data-perjalanan'])) { ?>
    <div id="tour" class="about">
      <div class="container">
        <div class="col-md-12">
          <?php if (mysqli_num_rows($jadwalCard) == 0) { ?>
            <div class="card rounded-0 shadow border-0 mb-3" style="max-width: 100%;">
              <div class="card-body text-center">
                <p>Maaf, belum ada jadwal perjalanan dari <?= $_SESSION['data-perjalanan']['dari'] ?> ke <?= $_SESSION['data-perjalanan']['ke'] ?> pada tanggal
                  <?php $dateUpdate = date_create($_SESSION['data-perjalanan']['tgl']);
                  echo date_format($dateUpdate, "d M Y"); ?></p>
              </div>
            </div>
            <?php } else if (mysqli_num_rows($jadwalCard) > 0) {
            while ($row_jadwal = mysqli_fetch_assoc($jadwalCard)) { ?>
              <div class="card rounded-0 shadow border-0 mb-3" style="max-width: 100%;">
                <div class="row g-0">
                  <div class="col-md-4">
                    <img src="assets/images/bus/<?= $row_jadwal['img_bus'] ?>" class="img-fluid rounded-start" alt="<?= $row_jadwal['nama_bus'] ?>">
                  </div>
                  <div class="col-md-8">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-lg-9">
                          <h1 class="card-title">Bus <?= $row_jadwal['nama_bus'] ?></h1>
                          <div class="row">
                            <div class="col-lg-5">
                              <p class="card-text">Waktu berkangkat <br>jam <?= $row_jadwal['waktu_jalan'] ?></p>
                            </div>
                            <div class="col-lg-6">
                              <div class="d-flex justify-content-between">
                                <p class="card-text">Dari: <br><?= $row_jadwal['rute_dari'] ?></p>
                                <i class="bi bi-arrow-right font-weight-bold" style="font-size: 25px;color: #009688;"></i>
                                <p class="card-text">Ke: <br><?= $row_jadwal['rute_ke'] ?></p>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-3 m-auto">
                          <form action="" method="POST" class="mt-3">
                            <h3 class="font-weight-bold" style="color: #009688;">Rp. <?= number_format($row_jadwal['biaya']) ?><small>/Org</small></h3>
                            <input type="hidden" name="id-jadwal" value="<?= $row_jadwal['id_jadwal'] ?>">
                            <button type="submit" name="pesan" class="get_now shadow text-white" style="background-color: #009688;">Pilih</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          <?php }
          } ?>
        </div>
      </div>
    </div>
  <?php } ?>
  <!-- about section -->
  <!-- end vehicles section -->
  <?php require_once("resources/footer.php") ?>
</body>

</html>