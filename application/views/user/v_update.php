<div class="col-md-6">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Update User</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form class="form" method="post" action="<?= site_url('user/update/' . $id); ?>" enctype="multipart/form-data">
            <div class="card-body">
                <?= validation_errors() ?>
                <?php foreach ($params as $key => $value) : ?>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?= $value['label'] ?></label>
                        <input type="<?= $value['type'] ?>" id="<?= $value['id'] ?>" name="<?= $value['field'] ?>" value="<?= ($value['value']); ?>" class="form-control" placeholder="<?= $value['field'] ?>" required>
                    </div>
                <?php endforeach ?>

                <div class="form-group">
                    <label for="group_id">Hak Akses</label>
                    <select name="group_id" class="form-control js-example-basic-single" id="group_id" style="width: 100%;" required>
                        <option value="">-- Pilih --</option>
                        <?php foreach ($groups as $key => $row) : ?>
                            <?php $selected = $current_groups['id'] == $row['id'] ? 'selected' :null ?>
                            <option value="<?= $row['id'] ?>" <?=$selected?>><?= ucfirst($row['name']) ?></option>
                        <?php endforeach ?>
                    </select>
                    <?= form_error('group_id'); ?>
                </div>

                <div class="form-group">
                    <label for="password">Password (Jika Ingin Ganti Password)</label>
                    <input type="password" name="password" class="form-control" placeholder="Password">
                </div>

                <div class="form-group">
                    <label for="password_confirm">Confirm Password (Jika Ingin Ganti Password)</label>
                    <input type="password" name="password_confirm" class="form-control" placeholder="Password">
                </div>
            </div>
            <!-- /.card-body -->

            <?php echo form_hidden('id', $id) ?>
            <?php echo form_hidden($csrf) ?>

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