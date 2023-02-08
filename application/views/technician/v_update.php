<!-- left column -->
<div class="col-md-6">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title"><?= $title ?></h3>
        </div>

        <!-- form start -->
        <form class="form" method="post" action="<?= site_url('technician/update/' . $id); ?>" enctype="multipart/form-data">
            <div class="card-body">
                <?= validation_errors() ?>
                <div class="form-group">
                    <label for="status">Customer</label>
                    <?php if ($this->ion_auth->is_admin()) : ?>
                        <select name="user_id" class="form-control js-example-basic-single" id="user_id" style="width: 100%;" required>
                            <option value="">-- Pilih --</option>
                            <?php foreach ($customers as $key => $row) : ?>
                                <?php $selected = $row['user_id'] == $query['user_id'] ? 'selected' : null ?>
                                <option value="<?= $row['user_id'] ?>" <?= $selected ?>><?= $row['company'] ?></option>
                            <?php endforeach ?>
                        </select>
                    <?php else : ?>
                        <input class="form-control" type="text" placeholder="<?= $company ?>" readonly>
                        <input type="hidden" name="user_id" value="<?= $user_id ?>">
                    <?php endif ?>
                </div>

                <div class="form-group">
                    <label for="nama">Nama Teknisi</label>
                    <input type="text" name="nama" class="form-control" value="<?= $query['technician_name'] ?>" placeholder="Nama Teknisi" required>
                </div>
                <div class="form-group">
                    <label for="telepon">No. Telepon</label>
                    <input type="text" name="telepon" class="form-control" value="<?= $query['telepon'] ?>" placeholder="No. Telepon" required>
                </div>
                <?php echo form_hidden('id', $id) ?>
                <?php echo form_hidden($csrf) ?>
            </div> <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary" id="save-button"><i class="far fa-check-circle"></i> Simpan</button>
                <a href="<?= site_url('technician/index') ?>" class="btn btn-default"><i class="fa fa-times-circle"></i> Batal</a>
            </div>
        </form>
    </div> <!-- /.card -->
</div>
<!--/.col (left) -->

<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    })
</script>