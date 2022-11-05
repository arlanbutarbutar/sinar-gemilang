<?php require_once("../controller/script.php");
require_once("redirect.php");
if ($_SESSION['data-user']['role'] == 3) {
  header("Location: ./");
  exit();
}
$_SESSION['page-name'] = "Rute Perjalanan";
$_SESSION['page-url'] = "rute";
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
                  <h5 class="card-title">Tambah Rute</h5>
                  <form action="" method="post">
                    <div class="mb-3">
                      <label for="rute-dari" class="form-label">Rute dari</label>
                      <input type="text" name="rute-dari" class="form-control" id="rute-dari" placeholder="Rute dari" required>
                    </div>
                    <div class="mb-3">
                      <label for="rute-ke" class="form-label">Rute ke</label>
                      <input type="text" name="rute-ke" class="form-control" id="rute-ke" placeholder="Rute ke" required>
                    </div>
                    <button type="submit" name="tambah-rute" class="btn mt-3 text-white" style="background-color: #009688;">Tambah</button>
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
                            <th>Rute dari</th>
                            <th>Rute ke</th>
                            <th colspan="2">Aksi</th>
                          </tr>
                        </thead>
                        <tbody id="search-page">
                          <?php if (mysqli_num_rows($rute) == 0) { ?>
                            <tr>
                              <td colspan="10">Belum ada data rute</td>
                            </tr>
                            <?php } else if (mysqli_num_rows($rute) > 0) {
                            while ($row = mysqli_fetch_assoc($rute)) { ?>
                              <tr>
                                <td><?= $row['rute_dari'] ?></td>
                                <td><?= $row['rute_ke'] ?></td>
                                <td>
                                  <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#ubah<?= $row['id_rute'] ?>">
                                    <i class="mdi mdi-table-edit"></i>
                                  </button>
                                  <div class="modal fade" id="ubah<?= $row['id_rute'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header border-bottom-0">
                                          <h5 class="modal-title" id="exampleModalLabel">Ubah rute</h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="" method="POST">
                                          <div class="modal-body">
                                            <div class="mb-3">
                                              <label for="rute-dari" class="form-label">Rute dari</label>
                                              <input type="text" name="rute-dari" value="<?= $row['rute_dari'] ?>" class="form-control" id="rute-dari" placeholder="Rute dari" required>
                                            </div>
                                            <div class="mb-3">
                                              <label for="rute-ke" class="form-label">Rute ke</label>
                                              <input type="text" name="rute-ke" value="<?= $row['rute_ke'] ?>" class="form-control" id="rute-ke" placeholder="Rute ke" required>
                                            </div>
                                          </div>
                                          <div class="modal-footer justify-content-center border-top-0">
                                            <input type="hidden" name="id-rute" value="<?= $row['id_rute'] ?>">
                                            <input type="hidden" name="rute-dariOld" value="<?= $row['rute_dari'] ?>">
                                            <input type="hidden" name="rute-keOld" value="<?= $row['rute_ke'] ?>">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" name="ubah-rute" class="btn btn-warning">Ubah</button>
                                          </div>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                </td>
                                <td>
                                  <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapus<?= $row['id_rute'] ?>">
                                    <i class="mdi mdi-delete"></i>
                                  </button>
                                  <div class="modal fade" id="hapus<?= $row['id_rute'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header border-bottom-0">
                                          <h5 class="modal-title" id="exampleModalLabel">Hapus</h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                          Anda yakin ingin menghapus rute bus ini?
                                        </div>
                                        <div class="modal-footer justify-content-center border-top-0">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                          <form action="" method="POST">
                                            <input type="hidden" name="id-rute" value="<?= $row['id_rute'] ?>">
                                            <button type="submit" name="hapus-rute" class="btn btn-danger">Hapus</button>
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
                      <?php if ($total_role5 > $data_role5) { ?>
                        <div class="d-flex justify-content-between mt-4 flex-wrap">
                          <p class="text-muted">Showing 1 to <?= $data_role5 ?> of <?= $total_role5 ?> entries</p>
                          <nav class="ml-auto">
                            <ul class="pagination separated pagination-info">
                              <?php if (isset($page_role5)) {
                                if (isset($total_page_role5)) {
                                  if ($page_role5 > 1) : ?>
                                    <li class="page-item">
                                      <a href="<?= $_SESSION['page-url'] ?>?page=<?= $page_role5 - 1; ?>/" class="btn btn-sm rounded-0 text-white" style="background-color: #009688;"><i class="icon-arrow-left"></i></a>
                                    </li>
                                    <?php endif;
                                  for ($i = 1; $i <= $total_page_role5; $i++) : if ($i <= 4) : if ($i == $page_role5) : ?>
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
                                  if ($total_page_role5 >= 4) : ?>
                                    <li class="page-item">
                                      <a href="<?= $_SESSION['page-url'] ?>?page=<?php if ($page_role5 > 4) {
                                                                                    echo $page_role5;
                                                                                  } else if ($page_role5 <= 4) {
                                                                                    echo '5';
                                                                                  } ?>/" class="btn btn-<?php if ($page_role5 <= 4) {
                                                                                                          echo 'outline-';
                                                                                                        } ?>success btn-sm rounded-0"><?php if ($page_role5 > 4) {
                                                                                                                                        echo $page_role5;
                                                                                                                                      } else if ($page_role5 <= 4) {
                                                                                                                                        echo '5';
                                                                                                                                      } ?></a>
                                    </li>
                                  <?php endif;
                                  if ($page_role5 < $total_page_role5 && $total_page_role5 >= 4) : ?>
                                    <li class="page-item">
                                      <a href="<?= $_SESSION['page-url'] ?>?page=<?= $page_role5 + 1; ?>/" class="btn btn-sm rounded-0 text-white" style="background-color: #009688;"><i class="icon-arrow-right"></i></a>
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