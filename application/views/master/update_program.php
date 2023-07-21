<!-- left column -->
<div class="col-md-6">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title"><?= $title ?></h3>
        </div>

        <!-- form start -->
        <form class="form" method="post" action="<?= site_url('masterdata/update_program/' . $id); ?>" enctype="multipart/form-data">
            <div class="card-body">
                <?= validation_errors() ?>
                <div class="form-group">
                    <?php if ($this->ion_auth->is_admin()) : ?>
                    <?php else : ?>
                        <input type="hidden" name="id" value="<?= $id ?>">
                    <?php endif ?>
                </div>

                <div class="form-group">
                    <label for="nama">Nama Program</label>
                    <input type="text" name="nama" class="form-control" value="<?= $query['nama'] ?>" placeholder="" required>
                </div>
                <div class="col-lg-12">
                    <div class="form-group" for="largeSelect"><label>Status</label>
                        <select class="form-control" name="active" id="active">
                            <option <?php if ($query['active'] == '1') {
                                        echo "selected";
                                    } ?> value="1">Aktif</option>
                            <option value="" disabled>==========================</option>
                            <option <?php if ($query['active'] == '0') {
                                        echo "selected";
                                    } ?> value="0">Non Aktif</option>
                        </select>
                    </div>
                </div>

                <?php echo form_hidden('id', $id) ?>
                <?php echo form_hidden($csrf) ?>
            </div> <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary" id="save-button"><i class="far fa-check-circle"></i> Simpan</button>
                <a href="<?= site_url('masterdata/nama_program') ?>" class="btn btn-danger"><i class="fa fa-times-circle"></i> Batal</a>
            </div>
        </form>
    </div> <!-- /.card -->
</div>
<!--/.col (left) -->