<!-- left column -->
<div class="col-md-12">
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong><i class="fas fa-exclamation-triangle"></i>&nbsp;Informasi :</strong> Kolom Wajib diisi dropdwon
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>


    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title"><?= $title ?></h3>
        </div>

        <!-- form start -->
        <form class="form" method="post" action="<?= site_url('xpole/create'); ?>" enctype="multipart/form-data">
            <div class="card-body">

                <?php echo validation_errors(); ?>

                <div class="form-group row">
                    <div class="col-lg-6  mt-2 mb-2">
                        <label for="user_id">Customer</label>
                        <select name="user_id" class="form-control js-example-basic-single" id="user_id" style="width: 100%;" required>
                            <option value="">-- Pilih --</option>
                            <?php foreach ($companies as $key => $row) : ?>
                                <option value="<?= $row['id'] ?>"><?= $row['company'] ?> (<?= $row['phone'] ?>)</option>
                            <?php endforeach ?>
                        </select>
                        <?= form_error('user_id'); ?>
                    </div>

                    <div class="col-lg-6  mt-2 mb-2">
                        <label for="site_id">Lokasi</label>
                        <select name="site_id" class="form-control js-example-basic-single" id="site_id" style="width: 100%;" required>
                            <option value="">-- Pilih --</option>
                        </select>
                        <?= form_error('site_id'); ?>
                    </div>

                    <div class="col-lg-6  mt-2 mb-2">
                        <label for="teknisi_id">Teknisi</label>
                        <select name="teknisi_id" class="form-control js-example-basic-single" id="teknisi_id" style="width: 100%;">
                            <option value="">-- Pilih --</option>
                        </select>
                        <?= form_error('teknisi_id'); ?>
                    <br>
                    <a href="<?= site_url('technician/create') ?>" class="btn btn-warning"><i class="fa fa-plus"></i> Teknisi</a>
                    
                    </div>
                    
                    <!-- <div class="col-lg-6  mt-2 mb-2">
                        <label for="manual_teknisi">Input Teknisi Manual</label>
                        <input class="form-control" type="text" placeholder="Opsi Input Teknisi">
                        <input type="hidden" name="manual_teknisi">
                        <?= form_error('manual_teknisi'); ?>
                    </div> -->
                    <div class="col-lg-6  mt-2 mb-2">
                        <label for="manual_teknisi">Input Teknisi Manual</label>
                        <input class="form-control" name="manual_teknisi" rows="3" placeholder="Opsi Input Manual Teknisi"><?= set_value('manual_teknisi') ?>
                        <?= form_error('manual_teknisi'); ?>
                    </div>
                    
                    <div class="col-lg-6  mt-2 mb-2">
                        <label for="status">Status</label>
                        <input class="form-control" type="text" placeholder="Open" readonly>
                        <input type="hidden" name="status" value="open">
                        <?= form_error('status'); ?>
                    </div>

                    <div class="col-lg-6  mt-2 mb-2">
                        <label for="notes">Note</label>
                        <textarea class="form-control" name="notes" rows="3" placeholder="Note"><?= set_value('notes') ?></textarea>
                        <?= form_error('notes'); ?>
                    </div>


                </div> <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary" id="save-button"><i class="far fa-check-circle"></i> Simpan</button>
                    <a href="<?= site_url('xpole/index') ?>" class="btn btn-danger"><i class="fa fa-times-circle"></i> Batal</a>
                </div>
        </form>
    </div> <!-- /.card -->
</div>
<!--/.col (left) -->

<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
        $("#site_id").hide();
        $("#teknisi_id").hide();

        <?php if (set_value('user_id') != null) : ?>
            setTimeout(function() {
                $("#user_id").val('<?= set_value('user_id') ?>').change();
            }, 0);
        <?php endif ?>

        $('body').on("change", "#user_id", function() {
            var user_id = $(this).val();
            var data = "user_id=" + user_id;
            $.ajax({
                type: 'POST',
                url: "<?php echo base_url('site/show_dropdown') ?>",
                data: data,
                success: function(hasil) {
                    $("#site_id").html(hasil);
                    $("#site_id").show();

                    <?php if (set_value('site_id') != null) : ?>
                        setTimeout(function() {
                            $("#site_id").val('<?= set_value('site_id') ?>').change();
                        }, 0);
                    <?php endif ?>
                }
            });
            $.ajax({
                type: 'POST',
                url: "<?php echo base_url('technician/show_dropdown') ?>",
                data: data,
                success: function(hasil) {
                    $("#teknisi_id").html(hasil);
                    $("#teknisi_id").show();

                    <?php if (set_value('teknisi_id') != null) : ?>
                        setTimeout(function() {
                            $("#teknisi_id").val('<?= set_value('teknisi_id') ?>').change();
                        }, 0);
                    <?php endif ?>
                }
            });
        });

    })
</script>