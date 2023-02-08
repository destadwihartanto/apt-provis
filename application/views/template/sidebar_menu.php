<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="<?=base_url('dashboard/index')?>" class="nav-link <?= ($nav_link ?? false) == 'dashboard' ? 'active' : null ?>">
                <i class="nav-icon fa fa-home"></i> <p>Dashboard</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?=base_url('site/index')?>" class="nav-link <?= ($nav_link ?? false) == 'site' ? 'active' : null ?>">
                <i class="nav-icon fas fa-flag"></i> <p>Lokasi</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Crosspole
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=base_url('xpole/open')?>" class="nav-link <?= ($nav_link ?? false) == 'xpole_open' ? 'active' : null ?>" class="nav-link">
                  <i class="fas fa-angle-double-right nav-icon"></i>
                  <p>Open</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url('xpole/disetujui')?>" class="nav-link <?= ($nav_link ?? false) == 'xpole_approve' ? 'active' : null ?>" class="nav-link">
                  <i class="fas fa-angle-double-right nav-icon"></i>
                  <p>Approve</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url('xpole/index')?>" class="nav-link <?= ($nav_link ?? false) == 'xpole_all' ? 'active' : null ?>" class="nav-link">
                  <i class="fas fa-angle-double-right nav-icon"></i>
                  <p>All</p>
                </a>
              </li>
              

            </ul>
          </li>

        <!-- <li class="nav-item">
            <a href="<?=base_url('xpole/index')?>" class="nav-link <?= ($nav_link ?? false) == 'xpole' ? 'active' : null ?>"class="nav-link">
                <i class="nav-icon far fa-image"></i> <p>Crosspole</p>
            </a>
        </li> -->
        <li class="nav-item">
            <a href="<?=base_url('technician/index')?>" class="nav-link <?= ($nav_link ?? false) == 'technician' ? 'active' : null ?>"class="nav-link">
                <i class="nav-icon fa fa-id-badge"></i> <p>Teknisi</p>
            </a>
        </li>
        <?php if($this->ion_auth->is_admin()) : ?>
        <li class="nav-item">
            <a href="<?=base_url('user/index')?>" class="nav-link <?= ($nav_link ?? false) == 'user' ? 'active' : null ?>">
                <i class="nav-icon fa fa-users"></i> <p>User</p>
            </a>
        </li>
        <?php endif ?>
    </ul>
</nav>