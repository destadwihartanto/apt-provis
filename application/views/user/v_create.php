<div class="col-md-6">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Create New User</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form class="form" method="post" action="<?= site_url('user/create'); ?>" enctype="multipart/form-data">
            <div class="card-body">
                <?php echo validation_errors() ?>
                <?php foreach ($params as $key => $value) : ?>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?= $value['label'] ?></label>
                        <input type="<?= $value['type'] ?>" name="<?= $value['name'] ?>" id="<?= $value['id'] ?>" value="<?php echo set_value($value['name']); ?>" class="form-control" placeholder="<?= $value['label'] ?>" required>
                    </div>
                <?php endforeach ?>
                <div class="form-group">
                    <label for="group_id">Hak Akses</label>
                    <select name="group_id" class="form-control js-example-basic-single" id="group_id" style="width: 100%;" required>
                        <option value="">-- Pilih --</option>
                        <?php foreach ($groups as $key => $row) : ?>
                            <option value="<?= $row['id'] ?>"><?= ucfirst($row['name']) ?></option>
                        <?php endforeach ?>
                    </select>
                    <?= form_error('group_id') ?>
                </div>
                <?php echo form_hidden($csrf) ?>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary" id="save-button"><i class="far fa-check-circle"></i> Simpan</button>
                <a href="<?= site_url('user/index') ?>" class="btn btn-default"><i class="fa fa-times-circle"></i> Batal</a>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    })
</script>