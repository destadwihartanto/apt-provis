<!-- left column -->
<div class="col-md-6">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title"><?= $title ?></h3>
        </div>

        <!-- form start -->
        <form class="form" method="post" action="<?= site_url('masterdata/create_dish'); ?>" enctype="multipart/form-data">
            <div class="card-body">
                <?= validation_errors() ?>
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" class="form-control" value="<?= set_value('nama') ?>" placeholder="" required>
                </div>

            </div> <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary" id="save-button"><i class="far fa-check-circle"></i> Simpan</button>
                <a href="<?= site_url('masterdata/dish') ?>" class="btn btn-danger"><i class="fa fa-times-circle"></i> Batal</a>
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