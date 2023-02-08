<div class="col-sm-12">
    <h4 class="m-0">Site Summary</h4>
</div><!-- /.col -->


<?php foreach ($query as $key => $value) : ?>
<div class="col-lg-4 col-6">
    <div class="small-box <?=$value['class']?>">
        <div class="inner">
            <h3><?=$value['jumlah']?></h3>
            <p><?=$value['status']?></p>
        </div>
        <div class="icon">
            <i class="<?=$value['icon']?>"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
<?php endforeach ?>
