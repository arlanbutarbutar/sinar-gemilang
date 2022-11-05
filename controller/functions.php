<?php
if (!isset($_SESSION['data-user'])) {
  function daftar($data)
  {
    global $conn;
    $username = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['username']))));
    $email = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['email']))));
    $checkMail = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($checkMail) > 0) {
      $_SESSION['message-danger'] = "Maaf, akun yang kamu masukan sudah terdaftar.";
      $_SESSION['time-message'] = time();
      return false;
    }
    $password = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['password']))));
    $telpon = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['telpon']))));
    $alamat = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['alamat']))));
    $password = password_hash($password, PASSWORD_DEFAULT);
    mysqli_query($conn, "INSERT INTO users(username,email,password,telp,alamat) VALUES('$username','$email','$password','$telpon','$alamat')");
    return mysqli_affected_rows($conn);
  }
  function masuk($data)
  {
    global $conn;
    $email = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['email']))));
    $password = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['password']))));

    // check account
    $checkAccount = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($checkAccount) == 0) {
      $_SESSION['message-danger'] = "Maaf, akun yang anda masukan belum terdaftar.";
      $_SESSION['time-message'] = time();
      return false;
    } else if (mysqli_num_rows($checkAccount) > 0) {
      $row = mysqli_fetch_assoc($checkAccount);
      if (password_verify($password, $row['password'])) {
        $_SESSION['data-user'] = [
          'id' => $row['id_user'],
          'role' => $row['id_role'],
          'username' => $row['username'],
          'email' => $row['email'],
        ];
        if (!isset($_SESSION['pesan-perjalanan'])) {
          header("Location: ../views/");
          exit();
        } else if (isset($_SESSION['pesan-perjalanan'])) {
          header("Location: ../views/pemesanan");
          exit();
        }
      } else {
        $_SESSION['message-danger'] = "Maaf, kata sandi yang anda masukan salah.";
        $_SESSION['time-message'] = time();
        return false;
      }
    }
  }
}

if (isset($_SESSION['data-user'])) {
  function ubah_profile($data)
  {
    global $conn, $idUser;
    $username = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['username']))));
    $telp = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['telp']))));
    $alamat = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['alamat']))));
    $norek = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['norek']))));
    mysqli_query($conn, "UPDATE users SET username='$username', telp='$telp', alamat='$alamat', norek='$norek' WHERE id_user='$idUser'");
    return mysqli_affected_rows($conn);
  }

  if ($_SESSION['data-user']['role'] == 1) {
    function ubah_user($data)
    {
      global $conn, $time;
      $id_user = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-user']))));
      $role = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['role']))));
      $updated_at = date("Y-m-d " . $time);
      mysqli_query($conn, "UPDATE users SET id_role='$role', updated_at='$updated_at' WHERE id_user='$id_user'");
      return mysqli_affected_rows($conn);
    }
    function hapus_user($data)
    {
      global $conn;
      $id_user = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-user']))));
      mysqli_query($conn, "DELETE FROM users WHERE id_user='$id_user'");
      return mysqli_affected_rows($conn);
    }
  }

  if ($_SESSION['data-user']['role'] <= 2) {
    function imageBus()
    {
      $namaFile = $_FILES["image"]["name"];
      $ukuranFile = $_FILES["image"]["size"];
      $error = $_FILES["image"]["error"];
      $tmpName = $_FILES["image"]["tmp_name"];
      if ($error === 4) {
        $_SESSION['message-danger'] = "Pilih gambar terlebih dahulu!";
        $_SESSION['time-message'] = time();
        return false;
      }
      $ekstensiGambarValid = ['jpg', 'png', 'jpeg', 'heic'];
      $ekstensiGambar = explode('.', $namaFile);
      $ekstensiGambar = strtolower(end($ekstensiGambar));
      if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        $_SESSION['message-danger'] = "Maaf, file kamu bukan gambar!";
        $_SESSION['time-message'] = time();
        return false;
      }
      if ($ukuranFile > 2000000) {
        $_SESSION['message-danger'] = "Maaf, ukuran gambar terlalu besar! (2 MB)";
        $_SESSION['time-message'] = time();
        return false;
      }
      $namaFile_encrypt = crc32($namaFile);
      $encrypt = $namaFile_encrypt . "." . $ekstensiGambar;
      move_uploaded_file($tmpName, '../assets/images/bus/' . $encrypt);
      return $encrypt;
    }
    function tambah_bus($data)
    {
      global $conn;
      $nama = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['nama']))));
      $checkNama = mysqli_query($conn, "SELECT * FROM bus WHERE nama_bus='$nama'");
      if (mysqli_num_rows($checkNama) > 0) {
        $_SESSION['message-danger'] = "Maaf, nama bus sudah ada!";
        $_SESSION['time-message'] = time();
        return false;
      }
      $no_plat = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['no-plat']))));
      $jumlah_kursi = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['jumlah-kursi']))));
      $pabrikan = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['pabrikan']))));
      $image = imageBus();
      if (!$image) {
        return false;
      }
      mysqli_query($conn, "INSERT INTO bus(img_bus,nama_bus,no_plat,jumlah_kursi,pabrikan) VALUES('$image','$nama','$no_plat','$jumlah_kursi','$pabrikan')");
      return mysqli_affected_rows($conn);
    }
    function ubah_bus($data)
    {
      global $conn, $time;
      $id_bus = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-bus']))));
      $nama = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['nama']))));
      $namaOld = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['namaOld']))));
      if ($nama != $namaOld) {
        $checkNama = mysqli_query($conn, "SELECT * FROM bus WHERE nama_bus='$nama'");
        if (mysqli_num_rows($checkNama) > 0) {
          $_SESSION['message-danger'] = "Maaf, nama bus sudah ada!";
          $_SESSION['time-message'] = time();
          return false;
        }
      }
      $no_plat = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['no-plat']))));
      $jumlah_kursi = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['jumlah-kursi']))));
      $pabrikan = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['pabrikan']))));
      $img_bus = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['img-bus']))));
      if (!empty($_FILES['image']['name'])) {
        $image = imageBus();
        if (!$image) {
          return false;
        } else {
          unlink('../assets/images/bus/' . $img_bus);
        }
      } else {
        $image = $img_bus;
      }
      $updated_at = date("Y-m-d " . $time);
      mysqli_query($conn, "UPDATE bus SET img_bus='$img_bus', nama_bus='$nama', no_plat='$no_plat', jumlah_kursi='$jumlah_kursi', pabrikan='$pabrikan', updated_at='$updated_at' WHERE id_bus='$id_bus'");
      return mysqli_affected_rows($conn);
    }
    function hapus_bus($data)
    {
      global $conn;
      $id_bus = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-bus']))));
      $img_bus = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['img-bus']))));
      unlink('../assets/images/bus/' . $img_bus);
      mysqli_query($conn, "DELETE FROM bus WHERE id_bus='$id_bus'");
      return mysqli_affected_rows($conn);
    }
    function tambah_rute($data)
    {
      global $conn;
      $rute_dari = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['rute-dari']))));
      $rute_ke = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['rute-ke']))));
      $checkRute = mysqli_query($conn, "SELECT * FROM rute WHERE rute_dari='$rute_dari' AND rute_ke='$rute_ke'");
      if (mysqli_num_rows($checkRute) > 0) {
        $_SESSION['message-danger'] = "Maaf, rute yang anda masukan sudah ada!";
        $_SESSION['time-message'] = time();
        return false;
      }
      mysqli_query($conn, "INSERT INTO rute(rute_dari,rute_ke) VALUES('$rute_dari','$rute_ke')");
      return mysqli_affected_rows($conn);
    }
    function ubah_rute($data)
    {
      global $conn;
      $id_rute = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-rute']))));
      $rute_dari = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['rute-dari']))));
      $rute_dariOld = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['rute-dariOld']))));
      $rute_ke = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['rute-ke']))));
      $rute_keOld = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['rute-keOld']))));
      if ($rute_dari != $rute_dariOld && $rute_ke != $rute_keOld) {
        $checkRute = mysqli_query($conn, "SELECT * FROM rute WHERE rute_dari='$rute_dari' AND rute_ke='$rute_ke'");
        if (mysqli_num_rows($checkRute) > 0) {
          $_SESSION['message-danger'] = "Maaf, rute yang anda masukan sudah ada!";
          $_SESSION['time-message'] = time();
          return false;
        }
      }
      mysqli_query($conn, "UPDATE rute SET rute_dari='$rute_dari', rute_ke='$rute_ke' WHERE id_rute='$id_rute'");
      return mysqli_affected_rows($conn);
    }
    function hapus_rute($data)
    {
      global $conn;
      $id_rute = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-rute']))));
      mysqli_query($conn, "DELETE FROM rute WHERE id_rute='$id_rute'");
      return mysqli_affected_rows($conn);
    }
    function tambah_jadwal($data)
    {
      global $conn;
      $id_bus = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-bus']))));
      // $checkBus = mysqli_query($conn, "SELECT * FROM jadwal JOIN bus ON jadwal.id_bus=bus.id_bus WHERE jadwal.id_bus='$id_bus'");
      // if (mysqli_num_rows($checkBus) > 0) {
      //   $row = mysqli_fetch_assoc($checkBus);
      //   $_SESSION['message-danger'] = "Maaf, jadwal bus " . $row['nama_bus'] . " sudah ada!";
      //   $_SESSION['time-message'] = time();
      //   return false;
      // }
      $id_rute = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-rute']))));
      $tgl_jalan = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['tgl-jalan']))));
      $waktu_jalan = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['waktu-jalan']))));
      $biaya = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['biaya']))));
      mysqli_query($conn, "INSERT INTO jadwal(id_bus,id_rute,tgl_jalan,waktu_jalan,biaya) VALUES('$id_bus','$id_rute','$tgl_jalan','$waktu_jalan','$biaya')");
      return mysqli_affected_rows($conn);
    }
    function ubah_jadwal($data)
    {
      global $conn, $time;
      $id_jadwal = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-jadwal']))));
      $id_bus = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-bus']))));
      // $id_busOld = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-busOld']))));
      // if ($id_bus != $id_busOld) {
      //   $checkBus = mysqli_query($conn, "SELECT * FROM jadwal JOIN bus ON jadwal.id_bus=bus.id_bus WHERE jadwal.id_bus='$id_bus'");
      //   if (mysqli_num_rows($checkBus) > 0) {
      //     $row = mysqli_fetch_assoc($checkBus);
      //     $_SESSION['message-danger'] = "Maaf, jadwal bus " . $row['nama_bus'] . " sudah ada!";
      //     $_SESSION['time-message'] = time();
      //     return false;
      //   }
      // }
      $id_rute = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-rute']))));
      $tgl_jalan = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['tgl-jalan']))));
      $waktu_jalan = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['waktu-jalan']))));
      $biaya = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['biaya']))));
      $updated_at = date("Y-m-d " . $time);
      mysqli_query($conn, "UPDATE jadwal SET id_bus='$id_bus', id_rute='$id_rute', tgl_jalan='$tgl_jalan', waktu_jalan='$waktu_jalan', biaya='$biaya', updated_at='$updated_at' WHERE id_jadwal='$id_jadwal'");
      return mysqli_affected_rows($conn);
    }
    function hapus_jadwal($data)
    {
      global $conn;
      $id_jadwal = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-jadwal']))));
      mysqli_query($conn, "DELETE FROM jadwal WHERE id_jadwal='$id_jadwal'");
      return mysqli_affected_rows($conn);
    }
  }
  if ($_SESSION['data-user']['role'] == 3) {
    function checkout($data)
    {
      global $conn, $idUser;
      $id_jadwal = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-jadwal']))));
      $id_bus = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-bus']))));
      $checkJadwal = mysqli_query($conn, "SELECT * FROM pemesanan WHERE id_jadwal='$id_jadwal'");
      $kursi = mysqli_num_rows($checkJadwal);
      $checkKursi = mysqli_query($conn, "SELECT * FROM bus WHERE id_bus='$id_bus' AND jumlah_kursi<'$kursi'");
      if (mysqli_num_rows($checkKursi) > 0) {
        $_SESSION['message-warning'] = "Maaf, kursi sudah penuh. Silakan memilih bus yang lainnya";
        $_SESSION['time-message'] = time();
        return false;
      }
      $seat = $kursi + 1;
      mysqli_query($conn, "INSERT INTO pemesanan(id_user,id_jadwal,kursi) VALUES('$idUser','$id_jadwal','$seat')");
      return mysqli_affected_rows($conn);
    }
    function imageBayar()
    {
      $namaFile = $_FILES["image"]["name"];
      $ukuranFile = $_FILES["image"]["size"];
      $error = $_FILES["image"]["error"];
      $tmpName = $_FILES["image"]["tmp_name"];
      if ($error === 4) {
        $_SESSION['message-danger'] = "Pilih gambar terlebih dahulu!";
        $_SESSION['time-message'] = time();
        return false;
      }
      $ekstensiGambarValid = ['jpg', 'png', 'jpeg', 'heic'];
      $ekstensiGambar = explode('.', $namaFile);
      $ekstensiGambar = strtolower(end($ekstensiGambar));
      if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        $_SESSION['message-danger'] = "Maaf, file kamu bukan gambar!";
        $_SESSION['time-message'] = time();
        return false;
      }
      if ($ukuranFile > 2000000) {
        $_SESSION['message-danger'] = "Maaf, ukuran gambar terlalu besar! (2 MB)";
        $_SESSION['time-message'] = time();
        return false;
      }
      $namaFile_encrypt = crc32($namaFile);
      $encrypt = $namaFile_encrypt . "." . $ekstensiGambar;
      move_uploaded_file($tmpName, '../assets/images/bill/' . $encrypt);
      return $encrypt;
    }
    function save_bayar($data)
    {
      global $conn;
      $id_pesan = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-pesan']))));
      $image = imageBayar();
      if (!$image) {
        return false;
      }
      $query = mysqli_query($conn, "UPDATE pemesanan SET status_bayar='2', bukti_bayar='$image' WHERE id_pesan='$id_pesan'");
      var_dump($query);
      return mysqli_affected_rows($conn);
    }
    function batal_jalan($data)
    {
      global $conn;
      $id_pesan = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-pesan']))));
      mysqli_query($conn, "DELETE FROM pemesanan WHERE id_pesan='$id_pesan'");
      return mysqli_affected_rows($conn);
    }
  }
}
