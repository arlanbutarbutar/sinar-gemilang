<?php require_once("controller/script.php");
$_SESSION['page-name'] = "";
$_SESSION['page-url'] = "./";
$_SESSION['actual-link'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>


<!DOCTYPE html>
<html lang="en">

<head><?php require_once("resources/header.php") ?></head>
<!-- body -->

<body class="main-layout">
  <?php require_once("resources/navbar.php") ?>
  <!-- banner -->
  <section class="banner_main">
    <div class="row">
      <div class="col-lg-5">
        <div class="text-bg">
          <h1>Pemesanan Tiket Bus</h1>
          <span>Layanan penyedia transportasi umum antar kota dan kabupaten dengan rute dan tarif yang sesuai dengan perjalanan anda.</span>
        </div>
      </div>
      <div class="col-lg-7">
        <div class="row">
          <div class="col-md-6">
            <div class="ban_track">
              <figure><img src="assets/images/track.png" alt="#" /></figure>
            </div>
          </div>
          <div class="col-md-6">
            <form class="transfot">
              <div class="col-md-12">
                <span>Layanan Transportasi umum</span>
                <h3>Dapatkan layanan transportasi terbaik anda</h3>
              </div>
              <div class="col-md-12">
                <input class="transfot_form" placeholder="Dari" type="text" name="Dari" />
              </div>
              <div class="col-md-12">
                <input class="transfot_form" placeholder="Ke" type="text" name="Ke" />
              </div>
              <div class="col-md-12">
                <input class="transfot_form" placeholder="Tanggal Berangkat" type="date" name="Tanggal_Berangkat" />
              </div>
              <div class="col-md-12">
                <button class="get_now">Cari Bis</button>
              </div>
            </form>
          </div>
        </div>
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
            <figure><img src="images/about.png" alt="#" /></figure>
          </div>
        </div>
        <div class="col-md-6">
          <div class="titlepage">
            <h2>Tentang Kami</h2>
            <p>PT. Sinar Gemilang merupakan salah satu perusahaan yang bergerak di bidang transportasi bus antar kabupaten. PT. Sinar Gemilang pertama kali didirikan pada tahun 1982 dengan kendaraan berjumlah 1 buah bus dan tujuan pertamanya dengan rute Dari Atambua menuju ke Dili. Dengan perkembangan perusahaan dari tahun ke tahun tujuan dari sinar gemilang bertambah rute yakni rute sebelumnya dari Atambua ke Dili bertambah rute dari Atambua ke Suai dengan jumlah 4 bus, rute dari Dili singgah Atambua lalu menuju ke Oekusi dengan jumah 4 bus, dan rute dari Atambua menuju Kupang dengan jumlah 2 Bus dalam pengoperasinya. Pada tahun 1999 terjadi peritiwa merdekanya Timor Timur dari Indonesia rute bus Sinar Gemilang mulai diubah yang rute sebelumnya ke Dili, Oekusi dan Suai kemudian rutenya berfokus dengan tujuan ke Kupang, hal tersebut berlanjut hingga saat ini dengan rute perjalanan dari Atambua ke kota kefa berlanjut kota Niki-Niki sebagai tempat peristirahatan dimana penumpang bisa sarapan berlanjut lagi ke kota Soe dan lokasi tujuan utama yaitu kota kupang begitu pun sebaliknya Rute dari Kupang ke Atambua. </p>
            <a class="read_more" href="#">Read More</a>
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
            <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, There</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="service_main">
            <div class="service_box yell_colo">
              <i><img src="images/ser3.png" alt="#" /></i>
              <h4>Transportasi Antar Kota</h4>
            </div>
            <div class="service_box yelldark_colo">
              <i><img src="images/ser4.png" alt="#" /></i>
              <h4>Penitipan Barang</h4>
            </div>
            <div class="service_box yell_colo">
              <i><img src="images/ser5.png" alt="#" /></i>
              <h4>100% safe</h4>
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <a class="read_more" href="#">Read More</a>
        </div>
      </div>
    </div>
  </div>
  <!-- end service section -->
  <!-- vehicles section -->
  <section id="vehicles" class="vehicles">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="titlepage">
            <h2>Ketersediaan Mobil Bis</h2>
            <p>Jumlah kendaraan bus yang dimiliki perusahaan PT. Sinar Gemilang saat ini Berjumlah 14 unit bus dengan jumlah supir 14 orang ditambah 1 orang supir cadangan dan kondektur berjumlah 14 orang</p>
          </div>
        </div>
      </div>
    </div>
    <div id="veh" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#veh" data-slide-to="0" class="active"></li>
        <li data-target="#veh" data-slide-to="1"></li>
        <li data-target="#veh" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <div class="container">
            <div class="carousel-caption">
              <div class="row">
                <div class="col-md-4">
                  <div class="vehicles_truck">
                    <figure><img src="images/truc1.png" alt="#" /></figure>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="vehicles_truck">
                    <figure><img src="images/truc2.png" alt="#" /></figure>
                  </div>
                  <h3 class="blac_co">BIS</h3>
                </div>
                <div class="col-md-4">
                  <div class="vehicles_truck">
                    <figure><img src="images/truc3.png" alt="#" /></figure>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <div class="container">
            <div class="carousel-caption">
              <div class="row">
                <div class="col-md-4">
                  <div class="vehicles_truck">
                    <figure><img src="images/truc1.png" alt="#" /></figure>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="vehicles_truck">
                    <figure><img src="images/truc2.png" alt="#" /></figure>
                  </div>
                  <h3 class="blac_co">BIS</h3>
                </div>
                <div class="col-md-4">
                  <div class="vehicles_truck">
                    <figure><img src="images/truc3.png" alt="#" /></figure>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <div class="container">
            <div class="carousel-caption">
              <div class="row">
                <div class="col-md-4">
                  <div class="vehicles_truck">
                    <figure><img src="images/truc1.png" alt="#" /></figure>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="vehicles_truck">
                    <figure><img src="images/truc2.png" alt="#" /></figure>
                  </div>
                  <h3 class="blac_co">BIS</h3>
                </div>
                <div class="col-md-4">
                  <div class="vehicles_truck">
                    <figure><img src="images/truc3.png" alt="#" /></figure>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <a class="carousel-control-prev" href="#veh" role="button" data-slide="prev">
        <i class="fa fa-angle-left" aria-hidden="true"></i>
      </a>
      <a class="carousel-control-next" href="#veh" role="button" data-slide="next">
        <i class="fa fa-angle-right" aria-hidden="true"></i>
      </a>
    </div>
    <div class="container">
      <div class="row">

      </div>
    </div>
  </section>
  <!-- end vehicles section -->
  <!-- testimonial section -->
  <div id="testimonial" class="testimonial bottom_cross bottom_cross2">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="titlepage">
            <h2>Testimonials</h2>
            <p>nternet. It uses a dictionary of over 200 Latin words, combined with .</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div id="myCarousel" class="carousel slide testimonial_Carousel" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
              <li data-target="#myCarousel" data-slide-to="1"></li>
              <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <div class="container">
                  <div class="carousel-caption">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="testimonial_box">
                          <figure><img src="images/our.png" alt="#" /></figure>
                          <h3>Luda Johnson <br /><span class="kisu">( Ceo)</span></h3>
                          <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 year</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="carousel-item">
                <div class="container">
                  <div class="carousel-caption">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="testimonial_box">
                          <figure><img src="images/our.png" alt="#" /></figure>
                          <h3>Luda Johnson <br /><span class="kisu">( Ceo)</span></h3>
                          <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 year</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="carousel-item">
                <div class="container">
                  <div class="carousel-caption">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="full cross_layout">
                          <div class="testimonial_box">
                            <figure><img src="images/our.png" alt="#" /></figure>
                            <h3>Luda Johnson <br /><span class="kisu">( Ceo)</span></h3>
                            <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 year</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
              <i class="fa fa-caret-left" aria-hidden="true"></i>
            </a>
            <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
              <i class="fa fa-caret-right" aria-hidden="true"></i>
            </a>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <a class="read_more" href="#">Read More</a>
        </div>
      </div>
    </div>
  </div>
  <!-- end testimonial section -->
  <!-- choose section -->
  <div class="choose">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="titlepage">
            <h2>Mengapa Memilih Kami</h2>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-5">
          <div class="choose_box">
            <i><img src="images/why1.png" alt="#" /></i>
            <h3>Visi Kami</h3>
            <p>Menyediakan layanan transportasi antar kota yang dapat mengantarkan ke tempat yang dituju</p>

          </div>
        </div>
        <div class="col-md-5 offset-md-2">
          <div class="choose_box">
            <i><img src="images/why2.png" alt="#" /></i>
            <h3>Misi Kami</h3>
            <p>Menyajikan layanan bis antar kota mulai dari pemesanan hingga lokasi pengantaran dengan berbagi layanan</p>

          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end choose section -->
  <!-- contact section -->
  <div id="contact" class="contact">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="titlepage">
            <h2>Saran</h2>
          </div>
        </div>
      </div>
    </div>
    <div class="con_bg">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-5">
            <form id="request" class="main_form">
              <div class="row">
                <div class="col-md-12">
                  <input class="contactus" placeholder="Name" type="type" name="Name" />
                </div>
                <div class="col-md-12">
                  <input class="contactus" placeholder="Email" type="type" name="Email" />
                </div>
                <div class="col-md-12">
                  <input class="contactus" placeholder="Phone Number" type="type" name="Phone Number" />
                </div>
                <div class="col-md-12">
                  <input class="contactusmess" placeholder="Message" type="type" Message="Name" />
                </div>
                <div class="col-md-12">
                  <button class="send_btn">Pesan</button>
                </div>
              </div>
            </form>
          </div>
          <div class="col-md-7">
            <div class="co_tru">
              <figure><img src="images/SINAR_GEMILANG-removebg-preview.png" alt="#" /></figure>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end contact section -->
  <!--  footer -->
  <footer>
    <div class="footer bottom_cross1">
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <ul class="location_icon">
              <li>
                <a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i></a> Alamat : Lorem Ipsum <br />
                is simply dummy
              </li>
              <li>
                <a href="#"><i class="fa fa-phone" aria-hidden="true"></i></a>No Telephone : +(1234) 567 890
              </li>
              <li>
                <a href="#"><i class="fa fa-envelope" aria-hidden="true"></i></a>Email : demo@gmail.com
              </li>
            </ul>
            <form class="bottom_form">
              <h3>Newsletter</h3>
              <input class="enter" placeholder="Enter your email" type="text" name="Enter your email" />
              <button class="sub_btn">subscribe</button>
            </form>
          </div>
          <div class="col-md-8">
            <div class="map">
              <figure><img src="images/map.png" alt="#" /></figure>
            </div>
          </div>
        </div>
      </div>
      <div class="copyright">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <p>© 2022 All Rights Reserved. Design by Mario Bere Taek</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- end footer -->
  <!-- Javascript files-->
  <script src="js/jquery.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/jquery-3.0.0.min.js"></script>
  <!-- sidebar -->
  <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
  <script src="js/custom.js"></script>
  <script>
    function openNav() {
      document.getElementById('mySidepanel').style.width = '250px';
    }

    function closeNav() {
      document.getElementById('mySidepanel').style.width = '0';
    }
  </script>
</body>

</html>