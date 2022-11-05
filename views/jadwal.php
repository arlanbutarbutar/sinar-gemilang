<?php require_once("../controller/script.php");
require_once("redirect.php");
if ($_SESSION['data-user']['role'] == 3) {
  header("Location: ./");
  exit();
}
$_SESSION['page-name'] = "Penjadwalan";
$_SESSION['page-url'] = "jadwal";
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
            <div class="col-lg-3">
              <div class="card rounded-0 shadow mt-3">
                <div class="card-body text-center">
                  <h5 class="card-title">Tambah Jadwal</h5>
                  <form action="" method="post">
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
                      <input type="date" name="tgl-jalan" class="form-control" id="tgl-jalan" placeholder="Tgl jalan" required>
                    </div>
                    <div class="mb-3">
                      <label for="waktu-jalan" class="form-label">Waktu jalan</label>
                      <input type="time" name="waktu-jalan" class="form-control" id="waktu-jalan" placeholder="Waktu jalan" required>
                    </div>
                    <div class="mb-3">
                      <label for="biaya" class="form-label">Biaya</label>
                      <input type="number" name="biaya" class="form-control" id="biaya" placeholder="Biaya" required>
                    </div>
                    <button type="submit" name="tambah-jadwal" class="btn mt-3 text-white" style="background-color: #009688;">Tambah</button>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-lg-9">
              <div class="home-tab">
                <div class="card rounded-0 shadow mt-3">
                  <div class="card-body">
                    <div class="table-responsive mt-1">
                      <table class="table select-table text-center">
                        <thead>
                          <tr>
                            <th>Bus</th>
                            <th>Rute dari</th>
                            <th>Rute ke</th>
                            <th>Tgl jalan</th>
                            <th>Waktu jalan</th>
                            <th>Biaya</th>
                            <th>Tgl Dibuat</th>
                            <th>Tgl Diubah</th>
                            <th colspan="2">Aksi</th>
                          </tr>
                        </thead>
                        <tbody id="search-page">
                          <?php if (mysqli_num_rows($jadwal) == 0) { ?>
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
                          } ?>
                        </tbody>
                      </table>
                      <?php if ($total_role3 > $data_role3) { ?>
                        <div class="d-flex justify-content-between mt-4 flex-wrap">
                          <p class="text-muted">Showing 1 to <?= $data_role3 ?> of <?= $total_role3 ?> entries</p>
                          <nav class="ml-auto">
                            <ul class="pagination separated pagination-info">
                              <?php if (isset($page_role3)) {
                                if (isset($total_page_role3)) {
                                  if ($page_role3 > 1) : ?>
                                    <li class="page-item">
                                      <a href="<?= $_SESSION['page-url'] ?>?page=<?= $page_role3 - 1; ?>/" class="btn btn-sm rounded-0 text-white" style="background-color: #009688;"><i class="icon-arrow-left"></i></a>
                                    </li>
                                    <?php endif;
                                  for ($i = 1; $i <= $total_page_role3; $i++) : if ($i <= 4) : if ($i == $page_role3) : ?>
                                        <li class="page-item active">
                                          <a href="<?= $_SESSION['page-url'] ?>?page=<?= $i; ?>/" class="btn btn-sm rounded-0 text-white" style="background-color: #009688;"><?= $i; ?></a>
                                        </li>
                                      <?php else : ?>
                                        <li class="page-item">
                                          <a href="<?= $_SESSION['page-url'] ?>?page=<?= $i; ?>/" class="btn btn-outline-success btn-sm rounded-0"><?= $i ?></a>
                                        </li>
                                    <?php endif;
                                    endif;
                                  endfor;
                                  if ($total_page_role3 >= 4) : ?>
                                    <li class="page-item">
                                      <a href="<?= $_SESSION['page-url'] ?>?page=<?php if ($page_role3 > 4) {
                                                                                    echo $page_role3;
                                                                                  } else if ($page_role3 <= 4) {
                                                                                    echo '5';
                                                                                  } ?>/" class="btn btn-<?php if ($page_role3 <= 4) {
                                                                                                          echo 'outline-';
                                                                                                        } ?>success btn-sm rounded-0"><?php if ($page_role3 > 4) {
                                                                                                                                        echo $page_role3;
                                                                                                                                      } else if ($page_role3 <= 4) {
                                                                                                                                        echo '5';
                                                                                                                                      } ?></a>
                                    </li>
                                  <?php endif;
                                  if ($page_role3 < $total_page_role3 && $total_page_role3 >= 4) : ?>
                                    <li class="page-item">
                                      <a href="<?= $_SESSION['page-url'] ?>?page=<?= $page_role3 + 1; ?>/" class="btn btn-sm rounded-0 text-white" style="background-color: #009688;"><i class="icon-arrow-right"></i></a>
                                    </li>
                              <?php endif;
                                }
                              } ?>
                            </ul>
                          </nav>
                        </div>
                      <?php } ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php require_once("../resources/dash-footer.php") ?>
</body>

</html>