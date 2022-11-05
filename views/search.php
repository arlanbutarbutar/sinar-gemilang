<?php require_once('../controller/script.php');
if ($_SESSION['page-url'] == "users") {
  if (isset($_GET['key']) && $_GET['key'] != "") {
    $key = addslashes(trim($_GET['key']));
    $keys = explode(" ", $key);
    $quer = "";
    foreach ($keys as $no => $data) {
      $data = strtolower($data);
      $quer .= "users.username LIKE '%$data%' OR users.id_user!='$idUser' AND users.email LIKE '%$data%'";
      if ($no + 1 < count($keys)) {
        $quer .= " OR ";
      }
    }
    $query = "SELECT * FROM users JOIN users_role ON users.id_role=users_role.id_role WHERE users.id_user!='$idUser' AND $quer ORDER BY users.id_user DESC LIMIT 100";
    $users = mysqli_query($conn, $query);
  }
  if (mysqli_num_rows($users) == 0) { ?>
    <tr>
      <td colspan="8">Belum ada data pengguna</td>
    </tr>
    <?php } else if (mysqli_num_rows($users) > 0) {
    while ($row = mysqli_fetch_assoc($users)) { ?>
      <tr>
        <td>
          <div class="d-flex">
            <img src="../assets/images/user.png" alt="">
            <div class="my-auto">
              <h6><?= $row['username'] ?></h6>
              <p><?= $row['role'] ?></p>
            </div>
          </div>
        </td>
        <td><?= $row['email'] ?></td>
        <td><?= $row['alamat'] ?></td>
        <td><?= $row['telp'] ?></td>
        <td>
          <div class="badge badge-opacity-success">
            <?php $dateCreate = date_create($row['created_at']);
            echo date_format($dateCreate, "l, d M Y h:i a"); ?>
          </div>
        </td>
        <td>
          <div class="badge badge-opacity-warning">
            <?php $dateUpdate = date_create($row['updated_at']);
            echo date_format($dateUpdate, "l, d M Y h:i a"); ?>
          </div>
        </td>
        <td>
          <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#ubah<?= $row['id_user'] ?>">
            <i class="mdi mdi-table-edit"></i>
          </button>
          <div class="modal fade" id="ubah<?= $row['id_user'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header border-bottom-0">
                  <h5 class="modal-title" id="exampleModalLabel">Ubah Role <?= $row['username'] ?></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" enctype="multipart/form-data">
                  <div class="modal-body">
                    <div class="mb-3">
                      <label for="role" class="form-label">Role</label>
                      <select name="role" class="form-select" aria-label="Default select example" required>
                        <option selected value="">Pilih Role</option>
                        <?php foreach ($users_role as $row_role) : ?>
                          <option value="<?= $row_role['id_role'] ?>"><?= $row_role['role'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="modal-footer justify-content-center border-top-0">
                    <input type="hidden" name="id-user" value="<?= $row['id_user'] ?>">
                    <input type="hidden" name="username" value="<?= $row['username'] ?>">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" name="ubah-user" class="btn btn-warning">Ubah</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </td>
        <td>
          <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapus<?= $row['id_user'] ?>">
            <i class="mdi mdi-delete"></i>
          </button>
          <div class="modal fade" id="hapus<?= $row['id_user'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header border-bottom-0">
                  <h5 class="modal-title" id="exampleModalLabel"><?= $row['username'] ?></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  Anda yakin ingin menghapus <?= $row['username'] ?> ini?
                </div>
                <div class="modal-footer justify-content-center border-top-0">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                  <form action="" method="POST">
                    <input type="hidden" name="id-user" value="<?= $row['id_user'] ?>">
                    <input type="hidden" name="username" value="<?= $row['username'] ?>">
                    <button type="submit" name="hapus-user" class="btn btn-danger">Hapus</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </td>
      </tr>
    <?php }
  }
}
if ($_SESSION['page-url'] == "bus") {
  if (isset($_GET['key']) && $_GET['key'] != "") {
    $key = addslashes(trim($_GET['key']));
    $keys = explode(" ", $key);
    $quer = "";
    foreach ($keys as $no => $data) {
      $data = strtolower($data);
      $quer .= "nama_bus LIKE '%$data%' OR no_plat LIKE '%$data%'";
      if ($no + 1 < count($keys)) {
        $quer .= " OR ";
      }
    }
    $query = "SELECT * FROM bus WHERE $quer ORDER BY id_bus DESC LIMIT 100";
    $bus = mysqli_query($conn, $query);
  }
  if (mysqli_num_rows($bus) == 0) { ?>
    <tr>
      <td colspan="5">Belum ada data bus</td>
    </tr>
    <?php } else if (mysqli_num_rows($bus) > 0) {
    while ($row = mysqli_fetch_assoc($bus)) { ?>
      <tr>
        <td>
          <div class="d-flex">
            <img src="../assets/images/bus/<?= $row['img_bus'] ?>" alt="">
            <div class="my-auto">
              <h6><?= $row['nama_bus'] ?></h6>
            </div>
          </div>
        </td>
        <td><?= $row['no_plat'] ?></td>
        <td><?= $row['jumlah_kursi'] ?></td>
        <td><?= $row['pabrikan'] ?></td>
        <td>
          <div class="badge badge-opacity-success">
            <?php $dateCreate = date_create($row['created_at']);
            echo date_format($dateCreate, "l, d M Y h:i a"); ?>
          </div>
        </td>
        <td>
          <div class="badge badge-opacity-warning">
            <?php $dateUpdate = date_create($row['updated_at']);
            echo date_format($dateUpdate, "l, d M Y h:i a"); ?>
          </div>
        </td>
        <td>
          <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#ubah<?= $row['id_bus'] ?>">
            <i class="mdi mdi-table-edit"></i>
          </button>
          <div class="modal fade" id="ubah<?= $row['id_bus'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header border-bottom-0">
                  <h5 class="modal-title" id="exampleModalLabel">Ubah bus <?= $row['nama_bus'] ?></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" enctype="multipart/form-data">
                  <div class="modal-body">
                    <div class="mb-3">
                      <label for="image" class="form-label">Upload Gambar</label>
                      <input class="form-control" type="file" name="image" id="image">
                    </div>
                    <div class="mb-3">
                      <label for="nama" class="form-label">Nama Bus</label>
                      <input type="text" name="nama" value="<?= $row['nama_bus'] ?>" class="form-control" id="nama" placeholder="Nama Bus" required>
                    </div>
                    <div class="mb-3">
                      <label for="no-plat" class="form-label">TNKB</label>
                      <input type="text" name="no-plat" value="<?= $row['no_plat'] ?>" class="form-control" id="no-plat" placeholder="TNKB" required>
                    </div>
                    <div class="mb-3">
                      <label for="jumlah-kursi" class="form-label">Jumlah Kursi</label>
                      <input type="number" name="jumlah-kursi" value="<?= $row['jumlah_kursi'] ?>" class="form-control" id="jumlah-kursi" placeholder="Jumlah Kursi" required>
                    </div>
                    <div class="mb-3">
                      <label for="pabrikan" class="form-label">Pabrikan</label>
                      <input type="text" name="pabrikan" value="<?= $row['pabrikan'] ?>" class="form-control" id="pabrikan" placeholder="Pabrikan" required>
                    </div>
                  </div>
                  <div class="modal-footer justify-content-center border-top-0">
                    <input type="hidden" name="id-bus" value="<?= $row['id_bus'] ?>">
                    <input type="hidden" name="namaOld" value="<?= $row['nama_bus'] ?>">
                    <input type="hidden" name="img-bus" value="<?= $row['img_bus'] ?>">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" name="ubah-bus" class="btn btn-warning">Ubah</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </td>
        <td>
          <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapus<?= $row['id_bus'] ?>">
            <i class="mdi mdi-delete"></i>
          </button>
          <div class="modal fade" id="hapus<?= $row['id_bus'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header border-bottom-0">
                  <h5 class="modal-title" id="exampleModalLabel"><?= $row['nama_bus'] ?></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  Anda yakin ingin menghapus <?= $row['nama_bus'] ?> ini?
                </div>
                <div class="modal-footer justify-content-center border-top-0">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                  <form action="" method="POST">
                    <input type="hidden" name="id-bus" value="<?= $row['id_bus'] ?>">
                    <input type="hidden" name="namaOld" value="<?= $row['nama_bus'] ?>">
                    <input type="hidden" name="img-bus" value="<?= $row['img_bus'] ?>">
                    <button type="submit" name="hapus-bus" class="btn btn-danger">Hapus</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </td>
      </tr>
    <?php }
  }
}
if ($_SESSION['page-url'] == "jadwal") {
  if (isset($_GET['key']) && $_GET['key'] != "") {
    $key = addslashes(trim($_GET['key']));
    $keys = explode(" ", $key);
    $quer = "";
    foreach ($keys as $no => $data) {
      $data = strtolower($data);
      $quer .= "bus.nama_bus LIKE '%$data%' OR bus.no_plat LIKE '%$data%' OR jadwal.rute_dari LIKE '%$data%' OR jadwal.rute_ke LIKE '%$data%'";
      if ($no + 1 < count($keys)) {
        $quer .= " OR ";
      }
    }
    $query = "SELECT bus.id_bus, bus.img_bus, bus.nama_bus, bus.no_plat, jadwal.id_jadwal, jadwal.rute_dari,jadwal.rute_ke, jadwal.tgl_jalan, jadwal.waktu_jalan, jadwal.biaya, jadwal.created_at, jadwal.updated_at FROM jadwal JOIN bus ON jadwal.id_bus=bus.id_bus WHERE $quer ORDER BY jadwal.id_jadwal DESC LIMIT 100";
    $jadwal = mysqli_query($conn, $query);
  }
  if (mysqli_num_rows($jadwal) == 0) { ?>
    <tr>
      <td colspan="10">Belum ada data jadwal</td>
    </tr>
    <?php } else if (mysqli_num_rows($jadwal) > 0) {
    while ($row = mysqli_fetch_assoc($jadwal)) { ?>
      <tr>
        <td>
          <div class="d-flex">
            <img src="../assets/images/bus/<?= $row['img_bus'] ?>" alt="">
            <div class="my-auto">
              <h6><?= $row['nama_bus'] ?></h6>
              <p><?= $row['no_plat'] ?></p>
            </div>
          </div>
        </td>
        <td><?= $row['rute_dari'] ?></td>
        <td><?= $row['rute_ke'] ?></td>
        <td>
          <div class="badge badge-opacity-success">
            <?php $tgl_jalan = date_create($row['tgl_jalan']);
            echo date_format($tgl_jalan, "d M Y"); ?>
          </div>
        </td>
        <td><?= $row['waktu_jalan'] ?></td>
        <td>Rp. <?= number_format($row['biaya']) ?></td>
        <td>
          <div class="badge badge-opacity-success">
            <?php $dateCreate = date_create($row['created_at']);
            echo date_format($dateCreate, "l, d M Y h:i a"); ?>
          </div>
        </td>
        <td>
          <div class="badge badge-opacity-warning">
            <?php $dateUpdate = date_create($row['updated_at']);
            echo date_format($dateUpdate, "l, d M Y h:i a"); ?>
          </div>
        </td>
        <td>
          <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#ubah<?= $row['id_jadwal'] ?>">
            <i class="mdi mdi-table-edit"></i>
          </button>
          <div class="modal fade" id="ubah<?= $row['id_jadwal'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header border-bottom-0">
                  <h5 class="modal-title" id="exampleModalLabel">Ubah jadwal <?= $row['nama_bus'] ?></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" enctype="multipart/form-data">
                  <div class="modal-body">
                    <div class="mb-3">
                      <label for="id-bus" class="form-label">Bus</label>
                      <select class="form-select" name="id-bus" id="id-bus" aria-label="Default select example" required>
                        <option selected value="">Pilih Bus</option>
                        <?php foreach ($selectBus as $row_selbus) : ?>
                          <option value="<?= $row_selbus['id_bus'] ?>"><?= $row_selbus['nama_bus'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="rute" class="form-label">Rute</label>
                      <select class="form-select" name="id-rute" id="rute" aria-label="Default select example" required>
                        <option selected value="">Pilih Rute</option>
                        <?php foreach ($selectRute as $row_rute) : ?>
                          <option value="<?= $row_rute['id_rute'] ?>"><?= $row_rute['rute_dari'] . " - " . $row_rute['rute_ke'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="tgl-jalan" class="form-label">Tgl jalan</label>
                      <input type="date" name="tgl-jalan" value="<?= $row['tgl_jalan'] ?>" class="form-control" id="tgl-jalan" placeholder="Tgl jalan" required>
                    </div>
                    <div class="mb-3">
                      <label for="waktu-jalan" class="form-label">Waktu jalan</label>
                      <input type="time" name="waktu-jalan" value="<?= $row['waktu_jalan'] ?>" class="form-control" id="waktu-jalan" placeholder="Waktu jalan" required>
                    </div>
                    <div class="mb-3">
                      <label for="biaya" class="form-label">Biaya</label>
                      <input type="number" name="biaya" value="<?= $row['biaya'] ?>" class="form-control" id="biaya" placeholder="Biaya" required>
                    </div>
                  </div>
                  <div class="modal-footer justify-content-center border-top-0">
                    <input type="hidden" name="id-jadwal" value="<?= $row['id_jadwal'] ?>">
                    <input type="hidden" name="id-busOld" value="<?= $row['id_bus'] ?>">
                    <input type="hidden" name="namaOld" value="<?= $row['nama_bus'] ?>">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" name="ubah-jadwal" class="btn btn-warning">Ubah</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </td>
        <td>
          <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapus<?= $row['id_jadwal'] ?>">
            <i class="mdi mdi-delete"></i>
          </button>
          <div class="modal fade" id="hapus<?= $row['id_jadwal'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header border-bottom-0">
                  <h5 class="modal-title" id="exampleModalLabel"><?= $row['nama_bus'] ?></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  Anda yakin ingin menghapus jadwal bus <?= $row['nama_bus'] ?> ini?
                </div>
                <div class="modal-footer justify-content-center border-top-0">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                  <form action="" method="POST">
                    <input type="hidden" name="id-jadwal" value="<?= $row['id_jadwal'] ?>">
                    <input type="hidden" name="namaOld" value="<?= $row['nama_bus'] ?>">
                    <button type="submit" name="hapus-jadwal" class="btn btn-danger">Hapus</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </td>
      </tr>
<?php }
  }
} ?>