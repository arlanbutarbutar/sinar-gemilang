<?php require_once("controller/script.php");
$_SESSION['page-name'] = "";
$_SESSION['page-url'] = "./";
$_SESSION['actual-link'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
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
  <section class="banner_main">
    <div class="row p-5" style="margin-top: -100px;max-width: 100%;">
      <div class="col-lg-5">
        <div class="text-bg">
          <h1>Pemesanan Tiket Bus</h1>
          <span>Layanan penyedia transportasi umum antar kota dan kabupaten dengan rute dan tarif yang sesuai dengan perjalanan anda.</span>
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
  <div id="about" class="about">
    <div class="container">
      <div class="row d_flex">
        <div class="col-md-6">
          <div class="about_right">
            <figure><img src="assets/images/about.png" alt="#" /></figure>
          </div>
        </div>
        <div class="col-md-6">
          <div class="titlepage">
            <h2>Tentang Kami</h2>
            <p>PT. Sinar Gemilang merupakan salah satu perusahaan yang bergerak di bidang transportasi bus antar kabupaten. PT. Sinar Gemilang pertama kali didirikan pada tahun 1982 dengan kendaraan berjumlah 1 buah bus dan tujuan pertamanya dengan rute Dari Atambua menuju ke Dili. Dengan perkembangan perusahaan dari tahun ke tahun tujuan dari sinar gemilang bertambah rute yakni rute sebelumnya dari Atambua ke Dili bertambah rute dari Atambua ke Suai dengan jumlah 4 bus, rute dari Dili singgah Atambua lalu menuju ke Oekusi dengan jumah 4 bus, dan rute dari Atambua menuju Kupang dengan jumlah 2 Bus dalam pengoperasinya. Pada tahun 1999 terjadi peritiwa merdekanya Timor Timur dari Indonesia rute bus Sinar Gemilang mulai diubah yang rute sebelumnya ke Dili, Oekusi dan Suai kemudian rutenya berfokus dengan tujuan ke Kupang, hal tersebut berlanjut hingga saat ini dengan rute perjalanan dari Atambua ke kota kefa berlanjut kota Niki-Niki sebagai tempat peristirahatan dimana penumpang bisa sarapan berlanjut lagi ke kota Soe dan lokasi tujuan utama yaitu kota kupang begitu pun sebaliknya Rute dari Kupang ke Atambua. </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- about section -->
  <!-- service section -->
  <div id="service" class="service">
    <div class="container">
      <div class="row">
        <div class="col-md-10 offset-md-1">
          <div class="titlepage">
            <h2>Layanan</h2>
            <p>Layanan perjalanan yang kami berikan dengan menggunakan armada bus Sinar Gemilang</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="service_main justify-content-center">
            <div class="service_box yell_colo">
              <i><img src="assets/images/ser3.png" alt="#" /></i>
              <h4>Transportasi Antar Kota</h4>
            </div>
            <div class="service_box yelldark_colo">
              <i><img src="assets/images/ser4.png" alt="#" /></i>
              <h4>Penitipan Barang</h4>
            </div>
            <div class="service_box yell_colo">
              <i><img src="assets/images/ser5.png" alt="#" /></i>
              <h4>100% safe</h4>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end service section -->
  <!-- vehicles section -->
  <section id="vehicles" class="vehicles" style="margin-bottom: -200px;">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="titlepage">
            <h2>Ketersediaan Mobil Bus</h2>
            <p>Jumlah kendaraan bus yang dimiliki perusahaan PT. Sinar Gemilang saat ini Berjumlah <?= $count_bus ?> unit bus dengan jumlah supir <?= $count_bus ?> orang ditambah 1 orang supir cadangan dan kondektur berjumlah <?= $count_bus ?> orang</p>
          </div>
        </div>
      </div>
    </div>
    <div id="veh" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-slide-to="0" class="active"></li>
        <li data-slide-to="1"></li>
        <li data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <?php if (mysqli_num_rows($viewBus1) > 0) { ?>
          <div class="carousel-item active">
            <div class="container">
              <div class="carousel-caption">
                <div class="row">
                  <?php while ($row_bus1 = mysqli_fetch_assoc($viewBus1)) { ?>
                    <div class="col-md-4">
                      <div class="vehicles_truck">
                        <figure><img src="assets/images/bus/<?= $row_bus1['img_bus'] ?>" alt="<?= $row_bus1['nama_bus'] ?>" /></figure>
                      </div>
                    </div>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
        <?php }
        if (mysqli_num_rows($viewBus2) > 0) { ?>
          <div class="carousel-item">
            <div class="container">
              <div class="carousel-caption">
                <div class="row">
                  <?php while ($row_bus2 = mysqli_fetch_assoc($viewBus2)) { ?>
                    <div class="col-md-4">
                      <div class="vehicles_truck">
                        <figure><img src="assets/images/bus/<?= $row_bus2['img_bus'] ?>" alt="<?= $row_bus2['nama_bus'] ?>" /></figure>
                      </div>
                    </div>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
        <?php }
        if (mysqli_num_rows($viewBus3) > 0) { ?>
          <div class="carousel-item">
            <div class="container">
              <div class="carousel-caption">
                <div class="row">
                  <?php while ($row_bus3 = mysqli_fetch_assoc($viewBus3)) { ?>
                    <div class="col-md-4">
                      <div class="vehicles_truck">
                        <figure><img src="assets/images/bus/<?= $row_bus3['img_bus'] ?>" alt="<?= $row_bus3['nama_bus'] ?>" /></figure>
                      </div>
                    </div>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
      <?php if ($count_bus > 3) { ?>
        <a class="carousel-control-prev" href="#veh" role="button" data-slide="prev">
          <i class="fa fa-angle-left" aria-hidden="true"></i>
        </a>
        <a class="carousel-control-next" href="#veh" role="button" data-slide="next">
          <i class="fa fa-angle-right" aria-hidden="true"></i>
        </a>
      <?php } ?>
    </div>
  </section>
  <!-- end vehicles section -->
  <?php require_once("resources/footer.php") ?>
</body>

</html>