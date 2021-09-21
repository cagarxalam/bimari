<?php
  // master active
  $master = (isset($master)) ? $master: null;

  // nav active
  $stok     = (isset($stok)) ? $stok: null;
  $kategori = (isset($kategori)) ? $kategori: null;
  $stockout = (isset($stockout)) ? $stockout: null;
  $lokasi   = (isset($lokasi)) ? $lokasi: null;
  $user     = (isset($user)) ? $user: null;
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-danger elevation-4">
  <!-- Brand Logo -->
  <a href="javascript:void(0)" class="brand-link">
    <img src="/img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">SMK PGRI WONOASRI</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="/" class="nav-link <?=$stok?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link <?=$master?>">
            <i class="nav-icon fas fa-database"></i>
            <p>
              Data Master
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/kategori" class="nav-link <?=$kategori?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Kategori</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/lokasi" class="nav-link <?=$lokasi?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Lokasi Aset</p>
              </a>
            </li>
            <?php if($_SESSION['role'] == 1):?>
              <li class="nav-item">
                <a href="/user" class="nav-link <?=$user?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>User</p>
                </a>
              </li>
            <?php endif;?>
          </ul>
        </li>
        <li class="nav-item">
          <a href="/pengajuan-barang" class="nav-link <?=$stockout?>">
            <i class="fa fa-boxes nav-icon"></i>
            <p>Pengajuan Barang</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/logout" class="nav-link">
            <i class="fa fa-sign-out-alt nav-icon"></i>
            <p>Logout</p>
          </a>
        </li>
        <!-- <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-circle"></i>
            <p>
              Level 1
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Level 2</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>
                  Level 2
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-dot-circle nav-icon"></i>
                    <p>Level 3</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-dot-circle nav-icon"></i>
                    <p>Level 3</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-dot-circle nav-icon"></i>
                    <p>Level 3</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Level 2</p>
              </a>
            </li>
          </ul>
        </li> -->
        <!-- <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="fas fa-circle nav-icon"></i>
            <p>Level 1</p>
          </a>
        </li> -->
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>