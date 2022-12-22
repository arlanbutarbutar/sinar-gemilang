<?php
if (!isset($_SESSION[''])) {
  session_start();
}
require_once("db_connect.php");
require_once("time.php");
require_once("functions.php");

if (isset($_SESSION['time-message'])) {
  if ((time() - $_SESSION['time-message']) > 2) {
    if (isset($_SESSION['message-success'])) {
      unset($_SESSION['message-success']);
    }
    if (isset($_SESSION['message-info'])) {
      unset($_SESSION['message-info']);
    }
    if (isset($_SESSION['message-warning'])) {
      unset($_SESSION['message-warning']);
    }
    if (isset($_SESSION['message-danger'])) {
      unset($_SESSION['message-danger']);
    }
    if (isset($_SESSION['message-dark'])) {
      unset($_SESSION['message-dark']);
    }
    unset($_SESSION['time-alert']);
  }
}

$baseURL = "http://$_SERVER[HTTP_HOST]/apps/sinar-gemilang/";

$selectFrom = mysqli_query($conn, "SELECT DISTINCT rute_dari FROM rute");
$selectTo = mysqli_query($conn, "SELECT DISTINCT rute_ke FROM rute");
if (isset($_POST['cari-perjalanan'])) {
  $from = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['from']))));
  $to = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['to']))));
  $tgl = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['tgl-berangkat']))));
  if ($from == $to) {
    $_SESSION['message-danger'] = "Maaf, sepertinya anda memilih destinasi yang salah. Harap periksa kembali tujuan anda";
    $_SESSION['time-message'] = time();
    return false;
  } else if ($from != $to) {
    $_SESSION['data-perjalanan'] = [
      'dari' => $from,
      'ke' => $to,
      'tgl' => $tgl,
    ];
    header("Location: perjalanan#tour");
    exit();
  }
}
if (isset($_SESSION['data-perjalanan'])) {
  $dari = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_SESSION['data-perjalanan']['dari']))));
  $ke = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_SESSION['data-perjalanan']['ke']))));
  $tgl = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_SESSION['data-perjalanan']['tgl']))));
  $jadwalCard = mysqli_query($conn, "SELECT * FROM jadwal JOIN rute ON jadwal.id_rute=rute.id_rute JOIN bus ON jadwal.id_bus=bus.id_bus WHERE rute.rute_dari='$dari' AND rute.rute_ke='$ke' AND date(jadwal.tgl_jalan)='$tgl'");
  if (isset($_POST['pesan'])) {
    $id_jadwal = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['id-jadwal']))));
    $_SESSION['pesan-perjalanan'] = $id_jadwal;
    if (isset($_SESSION['data-user'])) {
      header("Location: views/pemesanan");
      exit();
    } else if (!isset($_SESSION['data-user'])) {
      header("Location: auth/");
      exit();
    }
  }
}

$count_bus = mysqli_query($conn, "SELECT * FROM bus");
$count_bus = mysqli_num_rows($count_bus);
$viewBus1 = mysqli_query($conn, "SELECT * FROM bus ORDER BY id_bus DESC LIMIT 0, 2");
$viewBus2 = mysqli_query($conn, "SELECT * FROM bus ORDER BY id_bus DESC LIMIT 3, 5");
$viewBus3 = mysqli_query($conn, "SELECT * FROM bus ORDER BY id_bus DESC LIMIT 6, 8");

if (!isset($_SESSION['data-user'])) {
  if (isset($_POST['daftar'])) {
    if (daftar($_POST) > 0) {
      $_SESSION['message-success'] = "Akun kamu berhasil didaftarkan, silakan masuk untuk mulai berbelanja.";
      $_SESSION['time-message'] = time();
      header("Location: ./");
      exit();
    }
  }
  if (isset($_POST['masuk'])) {
    if (masuk($_POST) > 0) {
    }
  }
}

if (isset($_SESSION['data-user'])) {
  $idUser = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_SESSION['data-user']['id']))));
  $users_role = mysqli_query($conn, "SELECT * FROM users_role");

  $profile = mysqli_query($conn, "SELECT * FROM users WHERE id_user='$idUser'");
  if (isset($_POST['ubah-profile'])) {
    if (ubah_profile($_POST) > 0) {
      $_SESSION['message-success'] = "Profil akun anda berhasil di ubah.";
      $_SESSION['time-message'] = time();
      header("Location: profile");
      exit();
    }
  }

  if ($_SESSION['data-user']['role'] == 1) {
    $data_role1 = 25;
    $result_role1 = mysqli_query($conn, "SELECT * FROM users JOIN users_role ON users.id_role=users_role.id_role WHERE id_user!='$idUser'");
    $total_role1 = mysqli_num_rows($result_role1);
    $total_page_role1 = ceil($total_role1 / $data_role1);
    $page_role1 = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
    $awal_data_role1 = ($page_role1 > 1) ? ($page_role1 * $data_role1) - $data_role1 : 0;
    $users = mysqli_query($conn, "SELECT * FROM users JOIN users_role ON users.id_role=users_role.id_role WHERE users.id_user!='$idUser' ORDER BY users.id_user DESC LIMIT $awal_data_role1, $data_role1");
    if (isset($_POST['ubah-user'])) {
      if (ubah_user($_POST) > 0) {
        $_SESSION['message-success'] = "Pengguna " . $_POST['username'] . " berhasil di ubah.";
        $_SESSION['time-message'] = time();
        header("Location: users");
        exit();
      }
    }
    if (isset($_POST['hapus-user'])) {
      if (hapus_user($_POST) > 0) {
        $_SESSION['message-success'] = "Pengguna " . $_POST['username'] . " berhasil di hapus.";
        $_SESSION['time-message'] = time();
        header("Location: users");
        exit();
      }
    }
  }

  if ($_SESSION['data-user']['role'] <= 2) {
    $data_role2 = 25;
    $result_role2 = mysqli_query($conn, "SELECT * FROM bus");
    $total_role2 = mysqli_num_rows($result_role2);
    $total_page_role2 = ceil($total_role2 / $data_role2);
    $page_role2 = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
    $awal_data_role2 = ($page_role2 > 1) ? ($page_role2 * $data_role2) - $data_role2 : 0;
    $bus = mysqli_query($conn, "SELECT * FROM bus ORDER BY bus.id_bus DESC LIMIT $awal_data_role2, $data_role2");
    if (isset($_POST['tambah-bus'])) {
      if (tambah_bus($_POST) > 0) {
        $_SESSION['message-success'] = "Berhasil menambahkan armada bus baru.";
        $_SESSION['time-message'] = time();
        header("Location: bus");
        exit();
      }
    }
    if (isset($_POST['ubah-bus'])) {
      if (ubah_bus($_POST) > 0) {
        $_SESSION['message-success'] = "Bus " . $_POST['namaOld'] . " berhasil di ubah.";
        $_SESSION['time-message'] = time();
        header("Location: bus");
        exit();
      }
    }
    if (isset($_POST['hapus-bus'])) {
      if (hapus_bus($_POST) > 0) {
        $_SESSION['message-success'] = "Bus " . $_POST['namaOld'] . " berhasil di hapus.";
        $_SESSION['time-message'] = time();
        header("Location: bus");
        exit();
      }
    }

    $data_role3 = 25;
    $result_role3 = mysqli_query($conn, "SELECT bus.id_bus, bus.img_bus, bus.nama_bus, bus.no_plat, jadwal.id_jadwal, jadwal.id_rute, jadwal.tgl_jalan, jadwal.waktu_jalan, jadwal.biaya, jadwal.created_at, jadwal.updated_at, rute.rute_dari, rute.rute_ke FROM jadwal JOIN bus ON jadwal.id_bus=bus.id_bus JOIN rute ON jadwal.id_rute=rute.id_rute");
    $total_role3 = mysqli_num_rows($result_role3);
    $total_page_role3 = ceil($total_role3 / $data_role3);
    $page_role3 = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
    $awal_data_role3 = ($page_role3 > 1) ? ($page_role3 * $data_role3) - $data_role3 : 0;
    $jadwal = mysqli_query($conn, "SELECT bus.id_bus, bus.img_bus, bus.nama_bus, bus.no_plat, jadwal.id_jadwal, jadwal.id_rute, jadwal.tgl_jalan, jadwal.waktu_jalan, jadwal.biaya, jadwal.created_at, jadwal.updated_at, rute.rute_dari, rute.rute_ke FROM jadwal JOIN bus ON jadwal.id_bus=bus.id_bus JOIN rute ON jadwal.id_rute=rute.id_rute ORDER BY jadwal.id_jadwal DESC LIMIT $awal_data_role3, $data_role3");
    $selectBus = mysqli_query($conn, "SELECT * FROM bus");
    $selectRute = mysqli_query($conn, "SELECT * FROM rute");
    if (isset($_POST['tambah-jadwal'])) {
      if (tambah_jadwal($_POST) > 0) {
        $_SESSION['message-success'] = "Berhasil menambahkan jadwal baru.";
        $_SESSION['time-message'] = time();
        header("Location: jadwal");
        exit();
      }
    }
    if (isset($_POST['ubah-jadwal'])) {
      if (ubah_jadwal($_POST) > 0) {
        $_SESSION['message-success'] = "Jadwal bus " . $_POST['namaOld'] . " berhasil di ubah.";
        $_SESSION['time-message'] = time();
        header("Location: jadwal");
        exit();
      }
    }
    if (isset($_POST['hapus-jadwal'])) {
      if (hapus_jadwal($_POST) > 0) {
        $_SESSION['message-success'] = "Jadwal bus " . $_POST['namaOld'] . " berhasil di hapus.";
        $_SESSION['time-message'] = time();
        header("Location: jadwal");
        exit();
      }
    }

    $data_role5 = 25;
    $result_role5 = mysqli_query($conn, "SELECT * FROM rute");
    $total_role5 = mysqli_num_rows($result_role5);
    $total_page_role5 = ceil($total_role5 / $data_role5);
    $page_role5 = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
    $awal_data_role5 = ($page_role5 > 1) ? ($page_role5 * $data_role5) - $data_role5 : 0;
    $rute = mysqli_query($conn, "SELECT * FROM rute ORDER BY rute.id_rute DESC LIMIT $awal_data_role5, $data_role5");
    if (isset($_POST['tambah-rute'])) {
      if (tambah_rute($_POST) > 0) {
        $_SESSION['message-success'] = "Berhasil menambahkan rute baru.";
        $_SESSION['time-message'] = time();
        header("Location: rute");
        exit();
      }
    }
    if (isset($_POST['ubah-rute'])) {
      if (ubah_rute($_POST) > 0) {
        $_SESSION['message-success'] = "Rute berhasil di ubah.";
        $_SESSION['time-message'] = time();
        header("Location: rute");
        exit();
      }
    }
    if (isset($_POST['hapus-rute'])) {
      if (hapus_rute($_POST) > 0) {
        $_SESSION['message-success'] = "Rute berhasil di hapus.";
        $_SESSION['time-message'] = time();
        header("Location: rute");
        exit();
      }
    }

    $countUser = mysqli_query($conn, "SELECT * FROM users WHERE id_user!='$idUser'");
    $countUser = mysqli_num_rows($countUser);
    $countBus = mysqli_query($conn, "SELECT * FROM bus");
    $countBus = mysqli_num_rows($countBus);
    $countJadwal = mysqli_query($conn, "SELECT * FROM jadwal");
    $countJadwal = mysqli_num_rows($countJadwal);
    $countPemesanan = mysqli_query($conn, "SELECT * FROM pemesanan");
    $countPemesanan = mysqli_num_rows($countPemesanan);

    $datatable_pemesanan = mysqli_query($conn, "SELECT * FROM pemesanan
      JOIN users ON pemesanan.id_user=users.id_user
      JOIN jadwal ON pemesanan.id_jadwal=jadwal.id_jadwal
      JOIN rute ON jadwal.id_rute=rute.id_rute
      JOIN bus ON jadwal.id_bus=bus.id_bus
      ORDER BY pemesanan.id_pesan DESC
    ");

    if (isset($_POST['tolak-bayar'])) {
      if (tolak_bayar($_POST) > 0) {
        $_SESSION['message-success'] = "Pembayaran telah ditolak.";
        $_SESSION['time-message'] = time();
        header("Location: ./");
        exit();
      }
    }
    if (isset($_POST['terima-bayar'])) {
      if (terima_bayar($_POST) > 0) {
        $_SESSION['message-success'] = "Pembayaran telah diterima.";
        $_SESSION['time-message'] = time();
        header("Location: ./");
        exit();
      }
    }
  }

  if ($_SESSION['data-user']['role'] == 3) {
    $pemesanan = mysqli_query($conn, "SELECT * FROM pemesanan 
      JOIN users ON pemesanan.id_user=users.id_user
      JOIN jadwal ON pemesanan.id_jadwal=jadwal.id_jadwal
      JOIN rute ON jadwal.id_rute=rute.id_rute
      JOIN bus ON jadwal.id_bus=bus.id_bus
      WHERE pemesanan.id_user='$idUser'
      ORDER BY pemesanan.id_pesan DESC
    ");

    if (isset($_SESSION['pesan-perjalanan'])) {
      $id_jadwal = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_SESSION['pesan-perjalanan']))));
      $checkout = mysqli_query($conn, "SELECT * FROM jadwal JOIN rute ON jadwal.id_rute=rute.id_rute JOIN bus ON jadwal.id_bus=bus.id_bus WHERE jadwal.id_jadwal='$id_jadwal'");
      if (isset($_POST['checkout'])) {
        if (checkout($_POST) > 0) {
          $_SESSION['message-success'] = "Anda berhasil melakukan pemesanan tiket bus Sinar Gemilang. Silakan lakukan pembayaran anda untuk mendapatkan tiker bus.";
          $_SESSION['time-message'] = time();
          unset($_SESSION['pesan-perjalanan']);
          unset($_SESSION['data-perjalanan']);
          header("Location: pemesanan");
          exit();
        }
      }
      if (isset($_POST['checkout-batal'])) {
        unset($_SESSION['pesan-perjalanan']);
        unset($_SESSION['data-perjalanan']);
        header("Location: pemesanan");
        exit();
      }
    }

    if (isset($_POST['cari-jadwal'])) {
      $from = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['from']))));
      $to = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['to']))));
      $tgl = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['tgl-berangkat']))));
      if ($from == $to) {
        $_SESSION['message-danger'] = "Maaf, sepertinya anda memilih destinasi yang salah. Harap periksa kembali tujuan anda";
        $_SESSION['time-message'] = time();
        return false;
      } else if ($from != $to) {
        $_SESSION['data-perjalanan'] = [
          'dari' => $from,
          'ke' => $to,
          'tgl' => $tgl,
        ];
        header("Location: perjalanan#tour");
        exit();
      }
    }
    $keranjang = mysqli_query($conn, "SELECT * FROM keranjang JOIN  jadwal ON keranjang.id_jadwal=jadwal.id_jadwal JOIN rute ON jadwal.id_rute=rute.id_rute JOIN bus ON jadwal.id_bus=bus.id_bus WHERE keranjang.id_user='$idUser'");
    if (isset($_POST['list-jadwal'])) {
      if (list_jadwal($_POST) > 0) {
        $_SESSION['message-success'] = "Pesanan anda berhasil dimasukan ke list pemesanan.";
        $_SESSION['time-message'] = time();
        header("Location: perjalanan#tour");
        exit();
      }
    }
    if (isset($_POST['checkout-list'])) {
      if (checkout_list($_POST) > 0) {
        $_SESSION['message-success'] = "Anda berhasil melakukan pemesanan tiket bus Sinar Gemilang. Silakan lakukan pembayaran anda untuk mendapatkan tiker bus.";
        $_SESSION['time-message'] = time();
        header("Location: pemesanan");
        exit();
      }
    }
    if (isset($_SESSION['data-perjalanan'])) {
      $dari = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_SESSION['data-perjalanan']['dari']))));
      $ke = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_SESSION['data-perjalanan']['ke']))));
      $tgl = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_SESSION['data-perjalanan']['tgl']))));
      $jadwalCard = mysqli_query($conn, "SELECT * FROM jadwal JOIN rute ON jadwal.id_rute=rute.id_rute JOIN bus ON jadwal.id_bus=bus.id_bus WHERE rute.rute_dari='$dari' AND rute.rute_ke='$ke' AND date(jadwal.tgl_jalan)='$tgl'");
      if (isset($_POST['pesan-jadwal'])) {
        $id_jadwal = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['id-jadwal']))));
        $_SESSION['pesan-perjalanan'] = $id_jadwal;
        header("Location: pemesanan");
        exit();
      }
    }

    $owner = mysqli_query($conn, "SELECT norek FROM users WHERE id_role='2'");
    if (isset($_POST['save-bayar'])) {
      if (save_bayar($_POST) > 0) {
        $_SESSION['message-success'] = "Pembayaran berhasil di konfirmasi. Silakan menunggu beberapa saat untuk pengecekan oleh admin Sinar Gemilang";
        $_SESSION['time-message'] = time();
        header("Location: pemesanan");
        exit();
      }
    }
    if (isset($_POST['batal-jalan'])) {
      if (batal_jalan($_POST) > 0) {
        $_SESSION['message-success'] = "Berhasil melakukan pembatalan perjalanan";
        $_SESSION['time-message'] = time();
        header("Location: pemesanan");
        exit();
      }
    }
  }
}
