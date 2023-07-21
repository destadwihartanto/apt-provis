<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item">
      <a href="<?= base_url('dashboard/index') ?>" class="nav-link <?= ($nav_link ?? false) == 'dashboard' ? 'active' : null ?>">
        <i class="nav-icon fa fa-home"></i>
        <p>Dashboard</p>
      </a>
    </li>
    <?php if ($this->ion_auth->is_admin()) : ?>

      <!-- master data -->
      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-database"></i>
          <p>
            Master Data
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="<?= base_url('masterdata/index') ?>" class="nav-link <?= ($nav_link ?? false) == 'pic_penyedia' ? 'active' : null ?>" class="nav-link">
              <i class="fas fa-angle-double-right nav-icon"></i>
              <p>PIC Penyedia</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('masterdata/nama_program') ?>" class="nav-link <?= ($nav_link ?? false) == 'nama_program' ? 'active' : null ?>" class="nav-link">
              <i class="fas fa-angle-double-right nav-icon"></i>
              <p>Nama Program</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('masterdata/penyedia_lc') ?>" class="nav-link <?= ($nav_link ?? false) == 'penyedia_lc' ? 'active' : null ?>" class="nav-link">
              <i class="fas fa-angle-double-right nav-icon"></i>
              <p>Provider</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('masterdata/listrik') ?>" class="nav-link <?= ($nav_link ?? false) == 'listrik' ? 'active' : null ?>" class="nav-link">
              <i class="fas fa-angle-double-right nav-icon"></i>
              <p>Sumber Listrik Utama</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('masterdata/obs') ?>" class="nav-link <?= ($nav_link ?? false) == 'obs' ? 'active' : null ?>" class="nav-link">
              <i class="fas fa-angle-double-right nav-icon"></i>
              <p>Operation Band VSAT</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= base_url('masterdata/beams') ?>" class="nav-link <?= ($nav_link ?? false) == 'beams' ? 'active' : null ?>" class="nav-link">
              <i class="fas fa-angle-double-right nav-icon"></i>
              <p>Beam</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('masterdata/satelit') ?>" class="nav-link <?= ($nav_link ?? false) == 'satelit' ? 'active' : null ?>" class="nav-link">
              <i class="fas fa-angle-double-right nav-icon"></i>
              <p>Satelit</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('masterdata/dish') ?>" class="nav-link <?= ($nav_link ?? false) == 'dish' ? 'active' : null ?>" class="nav-link">
              <i class="fas fa-angle-double-right nav-icon"></i>
              <p>Dish</p>
            </a>
          </li>
        </ul>
      </li>

    <?php endif ?>

    <li class="nav-item">
      <a href="<?= base_url('site/index') ?>" class="nav-link <?= ($nav_link ?? false) == 'site' ? 'active' : null ?>">
        <i class="nav-icon fas fa-flag"></i>
        <p>Lokasi</p>
      </a>
    </li>

    <li class="nav-item">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-satellite-dish"></i>
        <p>
          Crosspole
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="<?= base_url('xpole/open') ?>" class="nav-link <?= ($nav_link ?? false) == 'xpole_open' ? 'active' : null ?>" class="nav-link">
            <i class="fas fa-angle-double-right nav-icon"></i>
            <p>Open</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= base_url('xpole/disetujui') ?>" class="nav-link <?= ($nav_link ?? false) == 'xpole_approve' ? 'active' : null ?>" class="nav-link">
            <i class="fas fa-angle-double-right nav-icon"></i>
            <p>Approve</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= base_url('xpole/index') ?>" class="nav-link <?= ($nav_link ?? false) == 'xpole' ? 'active' : null ?>" class="nav-link">
            <i class="fas fa-angle-double-right nav-icon"></i>
            <p>All</p>
          </a>
        </li>


      </ul>
    </li>

    <li class="nav-item">
      <a href="<?= base_url('technician/index') ?>" class="nav-link <?= ($nav_link ?? false) == 'technician' ? 'active' : null ?>" class="nav-link">
        <i class="nav-icon fa fa-id-badge"></i>
        <p>Teknisi</p>
      </a>
    </li>
    <?php if ($this->ion_auth->is_admin()) : ?>
      <li class="nav-item">
        <a href="<?= base_url('user/index') ?>" class="nav-link <?= ($nav_link ?? false) == 'user' ? 'active' : null ?>">
          <i class="nav-icon fa fa-users"></i>
          <p>User</p>
        </a>
      </li>
    <?php endif ?>
    <li class="nav-item active">
      <a href="<?= base_url('auth/logout') ?>" class="nav-link <?= ($nav_link ?? false) == 'keluar' ? 'active' : null ?>">
        <i style="color:yellow" class="nav-icon fas fa-sign-out-alt"></i>
        <p>Logout</p>
      </a>
    </li>
  </ul>
</nav>


