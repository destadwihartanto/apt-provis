<?php if($this->session->flashdata('success')): ?>
<div class="col-md-12">
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <i class="icon fas fa-check"></i> <?=$this->session->flashdata('success')?>
    </div>
</div>
<?php endif;?>

<?php if($this->session->flashdata('warning')): ?>
<div class="col-md-12">
    <div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <i class="icon fas fa-exclamation-triangle"></i> <?=$this->session->flashdata('warning')?>
    </div>
</div>
<?php endif;?>
