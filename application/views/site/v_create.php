<!-- left column -->
<div class="col-md-9">
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong><i class="fas fa-exclamation-triangle"></i>&nbsp;Informasi :</strong> Kolom Wajib diisi Site ID,Site Name, Batch, Nama PIC Lokasi,Telepon PIC,Lokasi,Latitude,Longitude, dan dropdwon
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Tambah Site</h3>
        </div>

        <!-- form start -->
        <form class="form" method="post" action="<?= site_url('site/create'); ?>" enctype="multipart/form-data">
            <div class="card-body">

                <?php echo validation_errors(); ?>

                <?php foreach ($inputs as $key => $value) : ?>

                    <div class="form-group">
                        <?php if ($value['field'] != 'operational_date') : ?>
                            <label for="exampleInputEmail1"><?= $value['label'] ?></label>
                        <?php endif; ?>

                        <?php if ($value['category'] == 'text') : ?>
                            <input type="text" name="<?= $value['field'] ?>" class="form-control" value="<?= set_value($value['field']) ?>" placeholder="<?= $value['label'] ?>">
                            <?= form_error($value['field']); ?>
                        <?php endif; ?>

                        <?php if ($value['category'] == 'option') : ?>
                            <select name="<?= $value['field'] ?>" class="form-control js-example-basic-single" style="width: 100%;" required>
                                <option value="">-- Pilih --</option>
                                <?php foreach ($value['options'] as $key => $row) : ?>
                                    <option value="<?= $row['id'] ?>"><?= $row['nama'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        <?php endif; ?>

                        <?php if ($is_admin && $value['category'] == 'dropdown_status') : ?>
                            <select name="<?= $value['field'] ?>" class="form-control js-example-basic-single" style="width: 100%;" required>
                                <option value="">-- Pilih --</option>
                                <?php foreach ($value['options'] as $key => $row) : ?>
                                    <option value="<?= $row ?>"><?= $row ?></option>
                                <?php endforeach; ?>
                            </select>
                        <?php elseif (!$is_admin && $value['category'] == 'dropdown_status') : ?>
                            <input class="form-control" type="text" placeholder="Request" readonly>
                            <input type="hidden" name="<?= $value['field'] ?>" value="Request">
                        <?php endif; ?>

                        <?php if ($is_admin && $value['category'] == 'dropdown_user') : ?>
                            <select name="<?= $value['field'] ?>" class="form-control js-example-basic-single" style="width: 100%;" required>
                                <option value="">-- Pilih --</option>
                                <?php foreach ($value['options'] as $key => $row) : ?>
                                    <option value="<?= $row['user_id'] ?>"><?= $row['company'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        <?php elseif (!$is_admin && $value['category'] == 'dropdown_user') : ?>
                            <input class="form-control" type="text" placeholder="<?= $company ?>" readonly>
                            <input type="hidden" name="<?= $value['field'] ?>" value="<?= $value['user_id'] ?>">
                        <?php endif; ?>

                        <?= form_error($value['label']); ?>
                    </div>

                <?php endforeach; ?>

                <div class="form-group row">
                    <div class="col-lg-3  mt-2 mb-2">
                        <label for="exampleInputEmail1">Propinsi</label>
                        <select name="province_id" class="form-control js-example-basic-single" id="province_id" style="width: 100%;" required>
                            <option value="">-- Pilih --</option>
                            <?php foreach ($provinces as $key => $row) : ?>
                                <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?= form_error('province_id'); ?>
                    </div>

                    <div class="col-lg-3  mt-2 mb-2">
                        <label for="exampleInputEmail1">Kota/Kabupaten</label>
                        <select name="regency_id" class="form-control js-example-basic-single" id="regency_id" style="width: 100%;" required>
                            <option value="">-- Pilih --</option>
                        </select>
                        <?= form_error('regency_id'); ?>
                    </div>

                    <div class="col-lg-3  mt-2 mb-2">
                        <label for="exampleInputEmail1">Kecamatan</label>
                        <select name="district_id" class="form-control js-example-basic-single" id="district_id" style="width: 100%;" required>
                            <option value="">-- Pilih --</option>
                        </select>
                        <?= form_error('district_id'); ?>
                    </div>

                    <div class="col-lg-3  mt-2 mb-2">
                        <label for="exampleInputEmail1">Desa/Kelurahan</label>
                        <select name="village_id" class="form-control js-example-basic-single" id="village_id" style="width: 100%;" required>
                            <option value="">-- Pilih --</option>
                        </select>
                        <?= form_error('village_id'); ?>
                    </div>

                    <div class="col-lg-7  mt-2 mb-2">
                        <label for="exampleInputEmail1">Alamat</label>
                        <textarea class="form-control" name="alamat" rows="3" placeholder="Alamat"><?= set_value('alamat') ?></textarea>
                        <?= form_error('alamat'); ?>
                    </div>

                    <div class="col-lg-5  mt-2 mb-2">
                        <label for="exampleInputEmail1">Tanggal Integrasi</label>
                        <input type="date" class="form-control" name="operational_date" id="operational_date">
                        <?= form_error('alamat'); ?>
                    </div>

                </div> <!-- /.card-body -->


                <div class="card-footer">
                    <button type="submit" class="btn btn-primary" id="save-button"><i class="far fa-check-circle"></i> Simpan</button>
                    <a href="<?= site_url('site/index') ?>" class="btn btn-danger" id="cancel"><i class="fa fa-times-circle"></i> Batal</a>
                </div>
        </form>
    </div> <!-- /.card -->
</div>
<!--/.col (left) -->

<script>
    $(document).ready(function() {
        $('#cancel').on('click', function(e) {
            e.preventDefault();
            const href = $(this).attr('href');
            Swal.fire({
                title: 'Batalkan Proses ini?',
                // text: "Lokasi " + siteName,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#ddd',
                confirmButtonText: 'Ya, Batalkan'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.location.href = href;
                }
            })
        });
        $('.js-example-basic-single').select2();
        $("#regency_id").hide();
        $("#district_id").hide();
        $("#village_id").hide();

        $('body').on("change", "#province_id", function() {
            var province_id = $(this).val();
            var data = "province_id=" + province_id;
            $.ajax({
                type: 'POST',
                url: "<?php echo base_url('regency/show_dropdown') ?>",
                data: data,
                success: function(hasil) {
                    $("#regency_id").html(hasil);
                    $("#regency_id").show();
                }
            });
        });

        $('body').on("change", "#regency_id", function() {
            var regency_id = $(this).val();
            var data = "regency_id=" + regency_id;
            $.ajax({
                type: 'POST',
                url: "<?php echo base_url('district/show_dropdown') ?>",
                data: data,
                success: function(hasil) {
                    $("#district_id").html(hasil);
                    $("#district_id").show();
                }
            });
        });

        $('body').on("change", "#district_id", function() {
            var district_id = $(this).val();
            var data = "district_id=" + district_id;
            $.ajax({
                type: 'POST',
                url: "<?php echo base_url('village/show_dropdown') ?>",
                data: data,
                success: function(hasil) {
                    $("#village_id").html(hasil);
                    $("#village_id").show();
                }
            });
        });
    })
</script>