<?php require_once("../controller/script.php");
require_once("redirect.php");
$_SESSION['page-name'] = "Pemesanan";
$_SESSION['page-url'] = "pemesanan";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php require_once("../resources/dash-header.php") ?>
  <style>
    .cardWrap {
      width: 27em;
      margin: 3em auto;
      color: #fff;
      font-family: sans-serif;
    }

    .card-tiket {
      background: linear-gradient(to bottom, #009688 0%, #009688 26%, #ecedef 26%, #ecedef 100%);
      height: 11em;
      float: left;
      position: relative;
      padding: 1em;
      margin-top: 100px;
    }

    .cardLeft {
      border-top-left-radius: 8px;
      border-bottom-left-radius: 8px;
      width: 16em;
    }

    .cardRight {
      width: 6.5em;
      border-left: 0.18em dashed #fff;
      border-top-right-radius: 8px;
      border-bottom-right-radius: 8px;
    }

    .cardRight:before,
    .cardRight:after {
      content: "";
      position: absolute;
      display: block;
      width: 0.9em;
      height: 0.9em;
      background: #fff;
      border-radius: 50%;
      left: -0.5em;
    }

    .cardRight:before {
      top: -0.4em;
    }

    .cardRight:after {
      bottom: -0.4em;
    }

    .nama-bus {
      font-size: 1.1em;
      margin-top: 0;
    }

    .nama-bus span {
      font-weight: normal;
    }

    .title-tiket,
    .name-tiket,
    .seat-tiket,
    .time-tiket {
      text-transform: uppercase;
      font-weight: normal;
    }

    .title-tiket h2,
    .name-tiket h2,
    .seat-tiket h2,
    .time-tiket h2 {
      font-size: 0.9em;
      color: #525252;
      margin: 0;
    }

    .title-tiket span,
    .name-tiket span,
    .seat-tiket span,
    .time-tiket span {
      font-size: 0.7em;
      color: #a2aeae;
    }

    .title-tiket {
      margin: 2em 0 0 0;
    }

    .name-tiket,
    .seat-tiket {
      margin: 0.7em 0 0 0;
    }

    .time-tiket {
      margin: 0.7em 0 0 1em;
    }

    .seat-tiket,
    .time-tiket {
      float: left;
    }

    .eye-tiket {
      position: relative;
      width: 2em;
      height: 1.5em;
      background: #fff;
      margin: 0 auto;
      border-radius: 1em/0.6em;
      z-index: 1;
    }

    .eye-tiket:before,
    .eye-tiket:after {
      content: "";
      display: block;
      position: absolute;
      border-radius: 50%;
    }

    .eye-tiket:before {
      width: 1em;
      height: 1em;
      background: #009688;
      z-index: 2;
      left: 8px;
      top: 4px;
    }

    .eye-tiket:after {
      width: 0.5em;
      height: 0.5em;
      background: #fff;
      z-index: 3;
      left: 12px;
      top: 8px;
    }

    .number-tiket {
      margin-top: -10px;
      text-align: center;
      text-transform: uppercase;
    }

    .number-tiket h3 {
      color: #009688;
      margin: 0.9em 0 0 0;
      font-size: 2.5em;
    }

    .number-tiket span {
      display: block;
      color: #a2aeae;
      font-size: 12px;
    }

    .barcode {
      max-width: 100px;
      text-align: center;
    }

    .barcode img{
      margin-top: 10px;
      width: 70px;
    }

    @media print {
      body * {
        visibility: hidden;
      }

      #print,
      #print * {
        visibility: visible;
      }

      #print {
        position: absolute;
        left: 0;
        top: 0;
      }
    }
  </style>
</head>

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
            <div class="col-sm-12">
              <div class="home-tab">
                <?php if (isset($_SESSION['pesan-perjalanan'])) {
                  if (mysqli_num_rows($checkout) > 0) {
                    while ($row_co = mysqli_fetch_assoc($checkout)) { ?>
                      <div class="card rounded-0 shadow border-0 mb-3" style="max-width: 100%;">
                        <div class="row g-0">
                          <div class="col-md-4">
                            <img src="../assets/images/bus/<?= $row_co['img_bus'] ?>" class="img-fluid rounded-0" alt="<?= $row_co['nama_bus'] ?>">
                          </div>
                          <div class="col-md-8">
                            <div class="card-body">
                              <div class="row">
                                <div class="col-lg-9">
                                  <h1 class="card-title">Bus <?= $row_co['nama_bus'] ?></h1>
                                  <div class="row">
                                    <div class="col-lg-5">
                                      <p class="card-text">Waktu berkangkat <br>jam <?= $row_co['waktu_jalan'] ?></p>
                                    </div>
                                    <div class="col-lg-6">
                                      <div class="d-flex justify-content-between">
                                        <p class="card-text">Dari: <br><?= $row_co['rute_dari'] ?></p>
                                        <i class="bi bi-arrow-right font-weight-bold" style="font-size: 25px;color: #009688;"></i>
                                        <p class="card-text">Ke: <br><?= $row_co['rute_ke'] ?></p>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-lg-3 m-auto">
                                  <form action="" method="POST" class="mt-3">
                                    <h4 class="font-weight-bold" style="color: #009688;">Rp. <?= number_format($row_co['biaya']) ?><small>/Org</small></h4>
                                    <input type="hidden" name="id-jadwal" value="<?= $row_co['id_jadwal'] ?>">
                                    <input type="hidden" name="id-bus" value="<?= $row_co['id_bus'] ?>">
                                    <button type="submit" name="checkout" class="btn shadow text-white btn-lg" style="background-color: #009688;width: 100%;">Pesan</button>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                  <?php }
                  }
                }
                if (mysqli_num_rows($pemesanan) == 0) { ?>
                  <div class="card rounded-0 shadow border-0 mb-3" style="max-width: 100%;">
                    <div class="card-body text-center">
                      <p>Anda belum melakukan pemesanan apapun</p>
                    </div>
                  </div>
                  <?php } else if (mysqli_num_rows($pemesanan) > 0) {
                  while ($row = mysqli_fetch_assoc($pemesanan)) { ?>
                    <div class="card rounded-0 shadow border-0 mb-3" style="max-width: 100%;">
                      <div class="row g-0">
                        <div class="col-md-4">
                          <img src="../assets/images/bus/<?= $row['img_bus'] ?>" class="img-fluid rounded-0" alt="<?= $row['nama_bus'] ?>">
                        </div>
                        <div class="col-md-8">
                          <div class="card-body">
                            <h1 class="card-title">Bus <?= $row['nama_bus'] ?></h1>
                            <div class="row">
                              <div class="col-lg-4">
                                <p class="card-text">Waktu berkangkat <br>jam <strong><?= $row['waktu_jalan'] ?></strong></p>
                              </div>
                              <div class="col-lg-6">
                                <div class="d-flex justify-content-between">
                                  <p class="card-text">Dari: <br><strong><?= $row['rute_dari'] ?></strong></p>
                                  <i class="bi bi-arrow-right font-weight-bold" style="font-size: 25px;color: #009688;"></i>
                                  <p class="card-text">Ke: <br><strong><?= $row['rute_ke'] ?></strong></p>
                                  <p class="card-text border-right">Kursi no: <br><strong><?= $row['kursi'] ?></strong></p>
                                </div>
                              </div>
                            </div>
                            <hr>
                            <div class="row">
                              <div class="col-lg-6">
                                <h4>Biaya: Rp. <?= number_format($row['biaya']) ?></h4>
                              </div>
                              <div class="col-lg-6">
                                <div class="d-flex justify-content-end">
                                  <button type="button" class="btn shadow rounded-0 text-white" data-bs-toggle="modal" data-bs-target="#print-tiket<?= $row['id_pesan'] ?>" style="background-color: #009688;">
                                    <i class="mdi mdi-ticket-confirmation"></i> Print
                                  </button>
                                  <?php if ($row['status_bayar'] == 1) { ?>
                                    <button type="button" class="btn btn-warning rounded-0 shadow text-white" data-bs-toggle="modal" data-bs-target="#pembayaran-diproses<?= $row['id_pesan'] ?>">
                                      <i class="mdi mdi-clock-fast"></i> Pembayaran diproses
                                    </button>
                                  <?php } else if ($row['status_bayar'] == 2) { ?>
                                    <button type="button" class="btn btn-success rounded-0 shadow text-white" data-bs-toggle="modal" data-bs-target="#pembayaran-berhasil<?= $row['id_pesan'] ?>">
                                      <i class="mdi mdi-check-all"></i> Pembayaran berhasil
                                    </button>
                                  <?php } ?>
                                  <button type="button" class="btn btn-danger rounded-0 shadow text-white" data-bs-toggle="modal" data-bs-target="#batal<?= $row['id_pesan'] ?>">
                                    <i class="mdi mdi-close"></i> Pembatalan
                                  </button>
                                </div>
                              </div>
                            </div>

                            <!-- start modal -->
                            <div class="modal fade" id="print-tiket<?= $row['id_pesan'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header border-bottom-0">
                                    <h5 class="modal-title" id="exampleModalLabel">Tiket Bus <?= $row['nama_bus'] ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <form action="" method="post">
                                    <?php if ($row['status_bayar'] == 1) { ?>
                                      <div class="modal-body text-center">
                                        <p>Anda belum menyelesaikan proses pembayaran</p>
                                      </div>
                                    <?php } else if ($row['status_bayar'] == 2) { ?>
                                      <div class="modal-body text-center" style="overflow: auto;" id="print">
                                        <div class="cardWrap" style="height: 50px;margin-top: -100px;">
                                          <div class="card-tiket cardLeft" style="height: 220px;">
                                            <h1 class="nama-bus">Sinar <span>Gemilang</span></h1>
                                            <div class="d-flex justify-content-between">
                                              <div class="title-tiket" style="margin-left: 30px;">
                                                <h2><strong><?= $row['nama_bus'] ?></strong><br>
                                                  <div style="font-size: 10px;"><?= $row['no_plat'] ?></div>
                                                </h2>
                                                <span>Bus</span>
                                              </div>
                                              <div class="name-tiket" style="margin-right: 30px;margin-top: 32px;">
                                                <h2><strong><?= $row['username'] ?></strong></h2>
                                                <span>Nama</span>
                                              </div>
                                            </div>
                                            <div class="seat-tiket" style="text-align: left;">
                                              <h2><strong><?= $row['rute_dari'] . " - " . $row['rute_ke'] ?></strong></h2>
                                              <span>Tujuan</span>
                                            </div><br>
                                            <div class="time-tiket" style="margin-left: 0;text-align: left;">
                                              <h2><strong><?php $tglJln = date_create($row['tgl_jalan']);
                                                          echo date_format($tglJln, "d M Y") . " - " . $row['waktu_jalan'] ?></strong></h2>
                                              <span>Waktu</span>
                                            </div>
                                          </div>
                                          <div class="card-tiket cardRight" style="height: 220px;">
                                            <div class="eye-tiket"></div>
                                            <div class="number-tiket">
                                              <h3><?= $row['kursi'] ?></h3>
                                              <span>No. Kursi</span>
                                            </div>
                                            <div class="barcode">
                                              <img src="../assets/images/qrcode/<?= $row['id_pesan'] . ".jpg" ?>" alt="QR">
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="modal-footer border-top-0 justify-content-center">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="button" onClick="window.print();" class="btn btn-success text-white">Print</button>
                                      </div>
                                    <?php } ?>
                                  </form>
                                </div>
                              </div>
                            </div>

                            <div class="modal fade" id="pembayaran-diproses<?= $row['id_pesan'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header border-bottom-0">
                                    <h5 class="modal-title" id="exampleModalLabel">Proses pembayaran</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <form action="" method="post" enctype="multipart/form-data">
                                    <div class="modal-body">
                                      <p>Kamu dapat melakukan pembayaran di nomor rekening berikut:</p>
                                      <?php if (mysqli_num_rows($owner) > 0) {
                                        while ($row_owner = mysqli_fetch_assoc($owner)) { ?>
                                          <p class="text-left font-weight-bold"><strong><?= $row_owner['norek'] ?></strong></p>
                                      <?php }
                                      } ?>
                                      <p>Jika anda sudah melakukan pembayaran, anda tidak dapat lagi melakukan proses pembatalan perjalanan anda.</p>
                                      <hr>
                                      <?php if (!empty($row['bukti_bayar'])) { ?>
                                        <p class="text-danger">Maaf, pembayaran anda ditolak, silakan masukan bukti bayar anda dengan benar.</p>
                                      <?php } ?>
                                      <div class="mb-3 text-center">
                                        <label for="formFile" class="form-label">Upload bukti bayar</label>
                                        <input class="form-control" name="image" type="file" id="formFile" required>
                                      </div>
                                    </div>
                                    <div class="modal-footer border-top-0 justify-content-center">
                                      <input type="hidden" name="id-pesan" value="<?= $row['id_pesan'] ?>">
                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                      <button type="submit" name="save-bayar" class="btn btn-success text-white">Bayar</button>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>

                            <div class="modal fade" id="pembayaran-berhasil<?= $row['id_pesan'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-lg">
                                <div class="modal-content modal-lg">
                                  <div class="modal-header border-bottom-0">
                                    <h5 class="modal-title" id="exampleModalLabel">Pembayaran berhasil</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body text-center">
                                    <img src="../assets/images/bill/<?= $row['bukti_bayar'] ?>" alt="" style="width: 100%;">
                                  </div>
                                </div>
                              </div>
                            </div>

                            <?php if ($row['status_bayar'] == 1) { ?>
                              <div class="modal fade" id="batal<?= $row['id_pesan'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header border-bottom-0">
                                      <h5 class="modal-title" id="exampleModalLabel">Pembatalan</h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                      <p>Anda yakin ingin membatalkan perjalanan?</p>
                                    </div>
                                    <form action="" method="post">
                                      <div class="modal-footer border-top-0 justify-content-center">
                                        <input type="hidden" name="id-pesan" value="<?= $row['id_pesan'] ?>">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" name="batal-jalan" class="btn btn-danger text-white">Batalkan</button>
                                      </div>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            <?php } ?>

                          </div>
                        </div>
                      </div>
                    </div>
                <?php }
                } ?>
              </div>
            </div>
          </div>
        </div>
        <?php require_once("../resources/dash-footer.php") ?>
</body>

</html>