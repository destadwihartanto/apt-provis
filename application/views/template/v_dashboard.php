<div class="col-sm-12">
    <h4 class="m-0">
    <img width="150px" src="<?= base_url() ?>assets/img/work.gif" alt="">Dashboard ... 
    </h4>
</div><!-- /.col -->

<!-- <?php foreach ($query as $key => $value) : ?>
<div class="col-lg-3">
    <div class="small-box <?=$value['class']?>">
        <div class="inner">
            <h3><?=$value['jumlah']?></h3>
            <p><?=$value['status']?></p>
        </div>
        <div class="icon">
            <i class="<?=$value['icon']?>"></i>
        </div>
        <a href="<?=$value['link']?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>

<?php endforeach ?> -->

<div class="col-lg-3">
<div class="small-box bg-danger">
    <div class="inner">
    <h3><?php echo $jml_belum_xpole; ?></h3>
    <p><i>BELUM XPOLE</i></p>
    </div>
    <div class="icon">
    <i class="fas fa-folder "></i>
    </div>
        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>

<div class="col-lg-3">
<div class="small-box bg-warning">
    <div class="inner">
    <h3><?php echo $jml_open; ?></h3>
    <p><i>OPEN</i></p>
    </div>
    <div class="icon">
    <i class="fas fa-book-open"></i>
    </div>
        <a href="<?= base_url('xpole/open') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>


<div class="col-lg-3">
<div class="small-box bg-success">
    <div class="inner">
    <h3><?php echo $jml_approve; ?></h3>
    <p><i>APPROVE</i></p>
    </div>
    <div class="icon">
    <i class="fas fa-check-circle"></i>
    </div>
        <a href="<?= base_url('xpole/disetujui') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>

<div class="col-lg-3">
<div class="small-box bg-info">
    <div class="inner">
    <h3><?php echo $jml_site; ?></h3>
    <p><i>SITE ALL</i></p>
    </div>
    <div class="icon">
    <i class="fas far fa-flag"></i>
    </div>
        <a href="<?= base_url('site/index') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>



<div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-gradient-danger">
              <span class="info-box-icon"><i class="nav-icon fa fa-id-badge"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Teknisi</span>
                <span class="info-box-number"><?php echo $jml_teknisi; ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->


          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-gradient-warning">
              <span class="info-box-icon"><i class="nav-icon fa fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">User</span>
                <span class="info-box-number"><?php echo $jml_users; ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-success">
              <span class="info-box-icon"><i class="far fa-building"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Vendor</span>
                <span class="info-box-number"><?php echo $jml_vendor; ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-success">
              <span class="info-box-icon"><i class="far fa-bookmark"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">PIC Provider</span>
                <span class="info-box-number"><?php echo $jml_pic_vendor; ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
