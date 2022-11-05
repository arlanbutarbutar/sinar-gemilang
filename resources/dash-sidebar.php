<nav class="sidebar sidebar-offcanvas shadow" id="sidebar" style="background-color: #009688;">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='./'">
        <i class="mdi mdi-speedometer menu-icon text-white"></i>
        <span class="menu-title text-white">Dashboard</span>
      </a>
    </li>
    <?php if ($_SESSION['data-user']['role'] == 1) { ?>
      <li class="nav-item">
        <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='users'">
          <i class="mdi mdi-account-multiple-outline menu-icon text-white"></i>
          <span class="menu-title text-white">Users</span>
        </a>
      </li>
    <?php }
    if ($_SESSION['data-user']['role'] <= 2) { ?>
      <li class="nav-item">
        <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='bus'">
          <i class="mdi mdi-car menu-icon text-white"></i>
          <span class="menu-title text-white">Bus</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='rute'">
          <i class="mdi mdi-map menu-icon text-white"></i>
          <span class="menu-title text-white">Rute</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='jadwal'">
          <i class="mdi mdi-calendar-clock menu-icon text-white"></i>
          <span class="menu-title text-white">Jadwal</span>
        </a>
      </li>
    <?php }
    if ($_SESSION['data-user']['role'] == 3) { ?>
      <li class="nav-item">
        <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='perjalanan'">
          <i class="mdi mdi-car menu-icon text-white"></i>
          <span class="menu-title text-white">Perjalanan</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='pemesanan'">
          <i class="mdi mdi-cart menu-icon text-white"></i>
          <span class="menu-title text-white">Pemesanan</span>
        </a>
      </li>
    <?php } ?>
  </ul>
</nav>