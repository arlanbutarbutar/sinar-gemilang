<?php require_once("../controller/script.php");
require_once("redirect.php");
if ($_SESSION['data-user']['role'] == 3) {
  header("Location: ./");
  exit();
}
$_SESSION['page-name'] = "Kelola Bus";
$_SESSION['page-url'] = "bus";
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
                  <h5 class="card-title">Tambah Bus</h5>
                  <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                      <label for="image" class="form-label">Upload Gambar</label>
                      <input class="form-control" type="file" name="image" id="image" required>
                    </div>
                    <div class="mb-3">
                      <label for="nama" class="form-label">Nama Bus</label>
                      <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Bus" required>
                    </div>
                    <div class="mb-3">
                      <label for="no-plat" class="form-label">TNKB</label>
                      <input type="text" name="no-plat" class="form-control" id="no-plat" placeholder="TNKB" required>
                    </div>
                    <div class="mb-3">
                      <label for="jumlah-kursi" class="form-label">Jumlah Kursi</label>
                      <input type="number" name="jumlah-kursi" class="form-control" id="jumlah-kursi" placeholder="Jumlah Kursi" required>
                    </div>
                    <div class="mb-3">
                      <label for="pabrikan" class="form-label">Pabrikan</label>
                      <input type="text" name="pabrikan" class="form-control" id="pabrikan" placeholder="Pabrikan" required>
                    </div>
                    <button type="submit" name="tambah-bus" class="btn mt-3 text-white" style="background-color: #009688;">Tambah</button>
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
                            <th>TNKB</th>
                            <th>Jumlah Kursi</th>
                            <th>Pabrikan</th>
                            <th>Tgl Dibuat</th>
                            <th>Tgl Diubah</th>
                            <th colspan="2">Aksi</th>
                          </tr>
                        </thead>
                        <tbody id="search-page">
                          <?php if (mysqli_num_rows($bus) == 0) { ?>
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
                          } ?>
                        </tbody>
                      </table>
                      <?php if ($total_role2 > $data_role2) { ?>
                        <div class="d-flex justify-content-between mt-4 flex-wrap">
                          <p class="text-muted">Showing 1 to <?= $data_role2 ?> of <?= $total_role2 ?> entries</p>
                          <nav class="ml-auto">
                            <ul class="pagination separated pagination-info">
                              <?php if (isset($page_role2)) {
                                if (isset($total_page_role2)) {
                                  if ($page_role2 > 1) : ?>
                                    <li class="page-item">
                                      <a href="<?= $_SESSION['page-url'] ?>?page=<?= $page_role2 - 1; ?>/" class="btn btn-sm rounded-0 text-white" style="background-color: #009688;"><i class="icon-arrow-left"></i></a>
                                    </li>
                                    <?php endif;
                                  for ($i = 1; $i <= $total_page_role2; $i++) : if ($i <= 4) : if ($i == $page_role2) : ?>
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
                                  if ($total_page_role2 >= 4) : ?>
                                    <li class="page-item">
                                      <a href="<?= $_SESSION['page-url'] ?>?page=<?php if ($page_role2 > 4) {
                                                                                    echo $page_role2;
                                                                                  } else if ($page_role2 <= 4) {
                                                                                    echo '5';
                                                                                  } ?>/" class="btn btn-<?php if ($page_role2 <= 4) {
                                                                                                          echo 'outline-';
                                                                                                        } ?>success btn-sm rounded-0"><?php if ($page_role2 > 4) {
                                                                                                                                        echo $page_role2;
                                                                                                                                      } else if ($page_role2 <= 4) {
                                                                                                                                        echo '5';
                                                                                                                                      } ?></a>
                                    </li>
                                  <?php endif;
                                  if ($page_role2 < $total_page_role2 && $total_page_role2 >= 4) : ?>
                                    <li class="page-item">
                                      <a href="<?= $_SESSION['page-url'] ?>?page=<?= $page_role2 + 1; ?>/" class="btn btn-sm rounded-0 text-white" style="background-color: #009688;"><i class="icon-arrow-right"></i></a>
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