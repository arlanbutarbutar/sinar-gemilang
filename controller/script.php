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
      header("Location: ../views/");
      exit();
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
      header("Location: " . $_SESSION['page-url']);
      exit();
    }
  }

  if ($_SESSION['data-user']['role'] == 1) {
    $data_role1 = 25;
    $result_role1 = mysqli_query($conn, "SELECT * FROM users WHERE id_user!='$idUser'");
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
        $_SESSION['message-success'] = "Bus menambahkan armada bus baru.";
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

    $data_role3 = 1;
    $result_role3 = mysqli_query($conn, "SELECT * FROM jadwal");
    $total_role3 = mysqli_num_rows($result_role3);
    $total_page_role3 = ceil($total_role3 / $data_role3);
    $page_role3 = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
    $awal_data_role3 = ($page_role3 > 1) ? ($page_role3 * $data_role3) - $data_role3 : 0;
    $jadwal = mysqli_query($conn, "SELECT bus.id_bus, bus.img_bus, bus.nama_bus, bus.no_plat, jadwal.id_jadwal, jadwal.rute_dari,jadwal.rute_ke, jadwal.tgl_jalan, jadwal.waktu_jalan, jadwal.biaya, jadwal.created_at, jadwal.updated_at FROM jadwal JOIN bus ON jadwal.id_bus=bus.id_bus ORDER BY jadwal.id_jadwal DESC LIMIT $awal_data_role3, $data_role3");
    $selectBus = mysqli_query($conn, "SELECT * FROM bus");
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

    $data_role4 = 1;
    $result_role4 = mysqli_query($conn, "SELECT * FROM pemesanan 
      JOIN users ON pemesanan.id_user=users.id_user
      JOIN jadwal ON pemesanan.id_jadwal=jadwal.id_jadwal
      JOIN bus ON jadwal.id_bus=bus.id_bus
    ");
    $total_role4 = mysqli_num_rows($result_role4);
    $total_page_role4 = ceil($total_role4 / $data_role4);
    $page_role4 = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
    $awal_data_role4 = ($page_role4 > 1) ? ($page_role4 * $data_role4) - $data_role4 : 0;
    $pemesanan = mysqli_query($conn, "SELECT * FROM pemesanan 
      JOIN users ON pemesanan.id_user=users.id_user
      JOIN jadwal ON pemesanan.id_jadwal=jadwal.id_jadwal
      JOIN bus ON jadwal.id_bus=bus.id_bus
      ORDER BY pemesanan.id_pesan DESC LIMIT $awal_data_role4, $data_role4
    ");
  }
}
