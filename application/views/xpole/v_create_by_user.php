<!-- left column -->
<div class="col-md-6">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title"><?= $title ?></h3>
        </div>

        <!-- form start -->
        <form class="form" method="post" action="<?= site_url('xpole/create'); ?>" enctype="multipart/form-data">
            <div class="card-body">

                <?php echo validation_errors(); ?>

                <div class="form-group">
                    <label for="user_id">Customer</label>
                    <input class="form-control" type="text" placeholder="<?= $company ?>" readonly>
                    <input type="hidden" name="user_id" value="<?= $user_id ?>">
                    <?= form_error('user_id'); ?>
                </div>

                <div class="form-group">
                    <label for="site_id">Lokasi</label>
                    <select name="site_id" class="form-control js-example-basic-single" id="site_id" style="width: 100%;" required>
                        <option value="">-- Pilih --</option>
                        <?php foreach ($sites as $key => $row) : ?>
                            <option value="<?= $row['id'] ?>"><?= $row['nama_kontrak'] ?></option>
                        <?php endforeach ?>
                    </select>
                    <?= form_error('site_id'); ?>
                </div>

                <div class="form-group">
                    <label for="teknisi_id">Teknisi</label>
                    <select name="teknisi_id" class="form-control js-example-basic-single" id="teknisi_id" style="width: 100%;" required>
                        <option value="">-- Pilih --</option>
                        <?php foreach ($technicians as $key => $row) : ?>
                            <option value="<?= $row['id'] ?>"><?= $row['technician_name'] ?> (<?= $row['telepon'] ?>)</option>
                        <?php endforeach ?>
                    </select>
                    <?= form_error('teknisi_id'); ?>
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <input class="form-control" type="text" placeholder="Open" readonly>
                    <input type="hidden" name="status" value="open">
                    <?= form_error('status'); ?>
                </div>

                <div class="form-group">
                    <label for="notes">Note</label>
                    <textarea class="form-control" name="notes" rows="3" placeholder="Note" required><?= set_value('notes') ?></textarea>
                    <?= form_error('notes'); ?>
                </div>

            </div> <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary" id="save-button"><i class="far fa-check-circle"></i> Simpan</button>
                <a href="<?= site_url('xpole/index') ?>" class="btn btn-default"><i class="fa fa-times-circle"></i> Batal</a>
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