<?php require_once("../controller/script.php");
require_once("redirect.php");
$_SESSION['page-name'] = "Perjalanan";
$_SESSION['page-url'] = "perjalanan";
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
          <div class="row">
            <div class="col-md-12">
              <div class="card rounded-0 shadow" style="font-family: 'Montserrat', sans-serif;">
                <div class="row p-4">
                  <div class="col-12">
                    <h2 style="font-size: 42px;" class="font-weight-bold">Pemesanan Perjalanan</h2>
                  </div>
                  <div class="col-lg-6">
                    <img src="../assets/images/perjalanan.png" style="width: 100%;" alt="">
                  </div>
                  <div class="col-lg-6 m-auto">
                    <form action="" method="POST">
                      <h3>Pilih rute perjalanan <br>anda sekarang</h3>
                      <div class="mb-3">
                        <div class="d-flex">
                          <h6 class="font-weight-bold my-auto">Dari: </h6>
                          <select class="form-control ml-3" name="from" aria-label="Default select example" style="width: 250px;margin-left: 10px;" required>
                            <option selected value="">Berangkat dari...</option>
                            <?php foreach ($selectFrom as $row_from) : ?>
                              <option value="<?= $row_from['rute_dari'] ?>"><?= $row_from['rute_dari'] ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                      <div class="mb-3">
                        <div class="d-flex">
                          <h6 class="font-weight-bold my-auto">Ke: </h6>
                          <select class="form-control ml-3" name="to" aria-label="Default select example" style="width: 250px;margin-left: 10px;" required>
                            <option selected value="">Tujuan ke...</option>
                            <?php foreach ($selectTo as $row_to) : ?>
                              <option value="<?= $row_to['rute_ke'] ?>"><?= $row_to['rute_ke'] ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                      <div class="mb-3">
                        <div class="d-flex">
                          <h6 class="font-weight-bold my-auto">Tgl Berangkat: </h6>
                          <input type="date" name="tgl-berangkat" class="form-control ml-3" style="width: 250px;margin-left: 10px;" placeholder="Tanggal Berangkat" required>
                        </div>
                      </div>
                      <button class="btn shadow text-white mt-3" name="cari-jadwal" style="background-color: #009688;">Cari Bis</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <hr>
          <?php if (isset($_SESSION['data-perjalanan'])) { ?>
            <div class="row mt-3" id="tour">
              <div class="col-md-12">
                <h2>Jadwal perjalanan yang anda cari</h2>
                <?php if (mysqli_num_rows($jadwalCard) == 0) { ?>
                  <div class="card rounded-0 shadow border-0 mb-3 mt-4" style="max-width: 100%;">
                    <div class="card-body text-center">
                      <p>Maaf, belum ada jadwal perjalanan dari <?= $_SESSION['data-perjalanan']['dari'] ?> ke <?= $_SESSION['data-perjalanan']['ke'] ?> pada tanggal
                        <?php $dateUpdate = date_create($_SESSION['data-perjalanan']['tgl']);
                        echo date_format($dateUpdate, "d M Y"); ?></p>
                    </div>
                  </div>
                  <?php } else if (mysqli_num_rows($jadwalCard) > 0) {
                  while ($row_jadwal = mysqli_fetch_assoc($jadwalCard)) { ?>
                    <div class="card rounded-0 shadow border-0 mb-3 mt-4" style="max-width: 100%;">
                      <div class="row g-0">
                        <div class="col-md-4">
                          <img src="../assets/images/bus/<?= $row_jadwal['img_bus'] ?>" class="img-fluid rounded-0" alt="<?= $row_jadwal['nama_bus'] ?>">
                        </div>
                        <div class="col-md-8">
                          <div class="card-body">
                            <div class="row">
                              <div class="col-lg-8">
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
                              <div class="col-lg-4 m-auto">
                                <h4 class="font-weight-bold" style="color: #009688;">Rp. <?= number_format($row_jadwal['biaya']) ?><small>/Org</small></h4>
                                <form action="" method="post">
                                  <input type="hidden" name="id-jadwal" value="<?= $row_jadwal['id_jadwal'] ?>">
                                  <div class="d-flex flex-nowrap">
                                    <button type="submit" name="list-jadwal" class="btn btn-primary btn-sm rounded-0" data-bs-dismiss="modal">Masukan List</button>
                                    <button type="submit" name="pesan-jadwal" class="btn btn-success btn-sm rounded-0">Pesan Sekarang</button>
                                  </div>
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
          <?php } ?>
        </div>
        <?php require_once("../resources/dash-footer.php") ?>
</body>

</html>