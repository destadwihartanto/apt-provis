<!-- left column -->
<div class="col-md-12">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title"><?= $title ?></h3>
        </div>

        <!-- form start -->
        <form class="form" method="post" action="<?= site_url('site/update/' . $encode_id); ?>" enctype="multipart/form-data">
            <div class="card-body">
                <?= validation_errors() ?>

                <div class="form-group row">
                <div class="col-lg-6  mt-2 mb-2">
                    <label for="nama_kontrak">Nama Lokasi</label>
                    <input type="text" name="nama_kontrak" class="form-control" value="<?= $query['nama_site'] ?>" placeholder="Nama Lokasi" required>
                    <?= form_error('nama_kontrak'); ?>
                </div>
                
                <div class="col-lg-6  mt-2 mb-2">
                    <label for="status">Status Site</label>
                    <?php if ($is_admin) : ?>
                        <select name="status" class="form-control js-example-basic-single" required>
                            <option value="">-- Pilih --</option>
                            <?php foreach ($dropdown_status as $key => $row) : ?>
                                <option value="<?= $row ?>" <?= $query['status'] == $row ? 'selected' : null ?>><?= $row ?></option>
                            <?php endforeach; ?>
                        </select>
                    <?php else : ?>
                        <input type="text" name="status" class="form-control" value="<?= $query['status'] ?>" disabled>
                        <input type="hidden" name="status" value="<?= $query['status'] ?>">
                    <?php endif; ?>
                    <?= form_error('status'); ?>
                </div>

                <div class="col-lg-4  mt-2 mb-2">
                    <label for="user_id">Nama Customer</label>
                    <?php if ($is_admin) : ?>
                        <select name="user_id" class="form-control js-example-basic-single" style="width: 100%;" required>
                            <option value="">-- Pilih --</option>
                            <?php foreach ($dropdown_users as $key => $row) : ?>
                                <option value="<?= $row['user_id'] ?>" <?= $query['user_id'] == $row['user_id'] ? 'selected' : null ?>><?= $row['company'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    <?php else : ?>
                        <input type="text" name="user_id" class="form-control" value="<?= $query['company'] ?>" disabled>
                        <input type="hidden" name="user_id" value="<?= $query['user_id'] ?>">
                    <?php endif; ?>
                    <?= form_error('user_id'); ?>
                </div>

                <div class="col-lg-4  mt-2 mb-2">
                    <label for="ip_modem">IP Modem</label>
                    <input type="text" name="ip_modem" class="form-control" value="<?= $query['ip_modem'] ?>" placeholder="IP Modem">
                    <?= form_error('ip_modem'); ?>
                </div>

                <div class="col-lg-4  mt-2 mb-2">
                    <label for="ip_mikrotik">IP Mikrotik</label>
                    <input type="text" name="ip_mikrotik" class="form-control" value="<?= $query['ip_mikrotik'] ?>" placeholder="IP Mikrotik">
                    <?= form_error('ip_mikrotik'); ?>
                </div>

                <div class="col-lg-4  mt-2 mb-2">
                    <label for="ip_lan">IP LAN</label>
                    <input type="text" name="ip_lan" class="form-control" value="<?= $query['ip_lan'] ?>" placeholder="IP LAN">
                    <?= form_error('ip_lan'); ?>
                </div>

                <div class="col-lg-4  mt-2 mb-2">
                    <label for="ip_router">IP Router</label>
                    <input type="text" name="ip_router" class="form-control" value="<?= $query['ip_router'] ?>" placeholder="IP Router">
                    <?= form_error('ip_router'); ?>
                </div>

                <div class="col-lg-4  mt-2 mb-2">
                    <label for="airmac_modem">Airmac Modem</label>
                    <input type="text" name="airmac_modem" class="form-control" value="<?= $query['airmac_modem'] ?>" placeholder="Airmac Modem">
                    <?= form_error('airmac_modem'); ?>
                </div>

                <div class="col-lg-4  mt-2 mb-2">
                    <label for="vlan_oam_mikrotik">VLAN Oam Mikrotik</label>
                    <input type="text" name="vlan_oam_mikrotik" class="form-control" value="<?= $query['vlan_oam_mikrotik'] ?>" placeholder="VLAN Oam Mikrotik">
                    <?= form_error('vlan_oam_mikrotik'); ?>
                </div>

                <div class="col-lg-4  mt-2 mb-2">
                    <label for="vlan_oam_nodeb">VLAN Oam e nodeB</label>
                    <input type="text" name="vlan_oam_nodeb" class="form-control" value="<?= $query['vlan_oam_nodeb'] ?>" placeholder="VLAN Oam e nodeB">
                    <?= form_error('vlan_oam_nodeb'); ?>
                </div>

                <div class="col-lg-4  mt-2 mb-2">
                    <label for="vlan_oam_cctv">VLAN Oam CCTV</label>
                    <input type="text" name="vlan_oam_cctv" class="form-control" value="<?= $query['vlan_oam_cctv'] ?>" placeholder="VLAN Oam CCTV">
                    <?= form_error('vlan_oam_cctv'); ?>
                </div>

                <div class="col-lg-4  mt-2 mb-2">
                    <label for="vlan_oam_power">VLAN Oam Power</label>
                    <input type="text" name="vlan_oam_power" class="form-control" value="<?= $query['vlan_oam_power'] ?>" placeholder="VLAN Oam Power">
                    <?= form_error('vlan_oam_power'); ?>
                </div>

                <div class="col-lg-4  mt-2 mb-2">
                    <label for="vlan_s1c">VLAN s1-C</label>
                    <input type="text" name="vlan_s1c" class="form-control" value="<?= $query['vlan_s1c'] ?>" placeholder="VLAN s1-C">
                    <?= form_error('vlan_s1c'); ?>
                </div>

                <div class="col-lg-4  mt-2 mb-2">
                    <label for="vlan_s1u">VLAN s1-U</label>
                    <input type="text" name="vlan_s1u" class="form-control" value="<?= $query['vlan_s1u'] ?>" placeholder="VLAN s1-U">
                    <?= form_error('vlan_s1u'); ?>
                </div>

                <div class="col-lg-4  mt-2 mb-2">
                    <label for="sid">Site ID</label>
                    <input type="text" name="sid" class="form-control" value="<?= $query['sid'] ?>" placeholder="Site ID" required>
                    <?= form_error('sid'); ?>
                </div>

                <div class="col-lg-4  mt-2 mb-2">
                    <label for="snmp_community">Community String SNMP Router dan AP</label>
                    <input type="text" name="snmp_community" class="form-control" value="<?= $query['snmp_community'] ?>" placeholder="Community String SNMP Router dan AP">
                    <?= form_error('snmp_community'); ?>
                </div>

                <div class="col-lg-4  mt-2 mb-2">
                    <label for="batch">Batch</label>
                    <input type="text" name="batch" class="form-control" value="<?= $query['batch'] ?>" placeholder="Batch" required>
                    <?= form_error('batch'); ?>
                </div>

                <div class="col-lg-4  mt-2 mb-2">
                    <label for="nama_pic_lokasi">Nama PIC Lokasi</label>
                    <input type="text" name="nama_pic_lokasi" class="form-control" value="<?= $query['nama_pic_lokasi'] ?>" placeholder="Nama PIC Lokasi" required>
                    <?= form_error('nama_pic_lokasi'); ?>
                </div>

                <div class="col-lg-4  mt-2 mb-2">
                    <label for="telp_pic_lokasi">Telepon PIC Lokasi</label>
                    <input type="text" name="telp_pic_lokasi" class="form-control" value="<?= $query['telp_pic_lokasi'] ?>" placeholder="Telepon PIC Lokasi" required>
                    <?= form_error('telp_pic_lokasi'); ?>
                </div>

                <div class="col-lg-4  mt-2 mb-2">
                    <label for="longitude">Longitude</label>
                    <input type="text" name="longitude" class="form-control" value="<?= $query['longitude'] ?>" placeholder="Longitude" required>
                    <?= form_error('longitude'); ?>
                </div>

                <div class="col-lg-4  mt-2 mb-2">
                    <label for="latitude">Latitude</label>
                    <input type="text" name="latitude" class="form-control" value="<?= $query['latitude'] ?>" placeholder="Latitude" required>
                    <?= form_error('latitude'); ?>
                </div>

                <div class="col-lg-4  mt-2 mb-2">
                    <label for="pic_penyedia_id">PIC Penyedia</label>
                    <select name="pic_penyedia_id" class="form-control js-example-basic-single" style="width: 100%;" required>
                        <option value="">-- Pilih --</option>
                        <?php foreach ($dropdown_providers as $key => $row) : ?>
                            <option value="<?= $row['id'] ?>" <?= $query['pic_penyedia_id'] == $row['id'] ? 'selected' : null ?>><?= $row['nama'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?= form_error('pic_penyedia_id'); ?>
                </div>

                <div class="col-lg-4  mt-2 mb-2">
                    <label for="vendor_id">Nama Vendor</label>
                    <select name="vendor_id" class="form-control js-example-basic-single" style="width: 100%;" required>
                        <option value="">-- Pilih --</option>
                        <?php foreach ($dropdown_vendors as $key => $row) : ?>
                            <option value="<?= $row['id'] ?>" <?= $query['vendor_id'] == $row['id'] ? 'selected' : null ?>><?= $row['nama'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?= form_error('vendor_id'); ?>
                </div>

                <div class="col-lg-4  mt-2 mb-2">
                    <label for="program_id">Nama Program</label>
                    <select name="program_id" class="form-control js-example-basic-single" style="width: 100%;" required>
                        <option value="">-- Pilih --</option>
                        <?php foreach ($dropdown_programs as $key => $row) : ?>
                            <option value="<?= $row['id'] ?>" <?= $query['program_id'] == $row['id'] ? 'selected' : null ?>><?= $row['nama'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?= form_error('program_id'); ?>
                </div>

                <div class="col-lg-4  mt-2 mb-2">
                    <label for="penyedia_lc_id">Penyedia LC</label>
                    <select name="penyedia_lc_id" class="form-control js-example-basic-single" style="width: 100%;" required>
                        <option value="">-- Pilih --</option>
                        <?php foreach ($dropdown_lc as $key => $row) : ?>
                            <option value="<?= $row['id'] ?>" <?= $query['penyedia_lc_id'] == $row['id'] ? 'selected' : null ?>><?= $row['nama'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?= form_error('penyedia_lc_id'); ?>
                </div>

                <div class="col-lg-4  mt-2 mb-2">
                    <label for="source_power_id">Sumber Listrik Utama</label>
                    <select name="source_power_id" class="form-control js-example-basic-single" style="width: 100%;" required>
                        <option value="">-- Pilih --</option>
                        <?php foreach ($dropdown_power as $key => $row) : ?>
                            <option value="<?= $row['id'] ?>" <?= $query['source_power_id'] == $row['id'] ? 'selected' : null ?>><?= $row['nama'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?= form_error('source_power_id'); ?>
                </div>

                <div class="col-lg-4  mt-2 mb-2">
                    <label for="operation_band_id">Operation Band VSAT</label>
                    <select name="operation_band_id" class="form-control js-example-basic-single" style="width: 100%;" required>
                        <option value="">-- Pilih --</option>
                        <?php foreach ($dropdown_band as $key => $row) : ?>
                            <option value="<?= $row['id'] ?>" <?= $query['operation_band_id'] == $row['id'] ? 'selected' : null ?>><?= $row['nama'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?= form_error('operation_band_id'); ?>
                </div>

                <div class="col-lg-4  mt-2 mb-2">
                    <label for="spotbeam_id">Beam</label>
                    <select name="spotbeam_id" class="form-control js-example-basic-single" style="width: 100%;" required>
                        <option value="">-- Pilih --</option>
                        <?php foreach ($dropdown_beam as $key => $row) : ?>
                            <option value="<?= $row['id'] ?>" <?= $query['spotbeam_id'] == $row['id'] ? 'selected' : null ?>><?= $row['nama'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?= form_error('spotbeam_id'); ?>
                </div>

                <div class="col-lg-4  mt-2 mb-2">
                    <label for="satelit_id">Satelit</label>
                    <select name="satelit_id" class="form-control js-example-basic-single" style="width: 100%;" required>
                        <option value="">-- Pilih --</option>
                        <?php foreach ($dropdown_satelit as $key => $row) : ?>
                            <option value="<?= $row['id'] ?>" <?= $query['satelit_id'] == $row['id'] ? 'selected' : null ?>><?= $row['nama'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?= form_error('satelit_id'); ?>
                </div>

                <div class="col-lg-4  mt-2 mb-2">
                    <label for="dish_id">Dish</label>
                    <select name="dish_id" class="form-control js-example-basic-single" style="width: 100%;" required>
                        <option value="">-- Pilih --</option>
                        <?php foreach ($dropdown_dish as $key => $row) : ?>
                            <option value="<?= $row['id'] ?>" <?= $query['dish_id'] == $row['id'] ? 'selected' : null ?>><?= $row['nama'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?= form_error('dish_id'); ?>
                </div>

                <div class="col-lg-4  mt-2 mb-2">
                    <label for="exampleInputEmail1">Propinsi</label>
                    <select name="province_id" class="form-control js-example-basic-single" id="province_id" style="width: 100%;" required>
                        <option value="">-- Pilih --</option>
                        <?php foreach ($provinces as $key => $row) : ?>
                            <option value="<?= $row['id'] ?>" <?= $query['province_id'] == $row['id'] ? 'selected' : null ?>><?= $row['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?= form_error('province_id'); ?>
                </div>

                <div class="col-lg-4  mt-2 mb-2">
                    <label for="exampleInputEmail1">Kota/Kabupaten</label>
                    <select name="regency_id" class="form-control js-example-basic-single" id="regency_id" style="width: 100%;" required>
                        <option value="">-- Pilih --</option>
                        <?php foreach ($regencies as $key => $row) : ?>
                            <option value="<?= $row['id'] ?>" <?= $query['regency_id'] == $row['id'] ? 'selected' : null ?>><?= $row['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?= form_error('regency_id'); ?>
                </div>

                <div class="col-lg-4  mt-2 mb-2">
                    <label for="exampleInputEmail1">Kecamatan</label>
                    <select name="district_id" class="form-control js-example-basic-single" id="district_id" style="width: 100%;" required>
                        <option value="">-- Pilih --</option>
                        <?php foreach ($districts as $key => $row) : ?>
                            <option value="<?= $row['id'] ?>" <?= $query['district_id'] == $row['id'] ? 'selected' : null ?>><?= $row['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?= form_error('district_id'); ?>
                </div>

                <div class="col-lg-4  mt-2 mb-2">
                    <label for="exampleInputEmail1">Desa/Kelurahan</label>
                    <select name="village_id" class="form-control js-example-basic-single" id="village_id" style="width: 100%;" required>
                        <option value="">-- Pilih --</option>
                        <?php foreach ($villages as $key => $row) : ?>
                            <option value="<?= $row['id'] ?>" <?= $query['village_id'] == $row['id'] ? 'selected' : null ?>><?= $row['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?= form_error('village_id'); ?>
                </div>

                <div class="col-lg-4  mt-2 mb-2">
                    <label for="operational_date">Tanggal Operasional</label>
                    <input type="date" class="form-control" name="operational_date" value="<?= date('Y-m-d', strtotime($query['operational_date'])) ?>" required>
                    <?= form_error('operational_date'); ?>
                </div>

                <div class="col-lg-12  mt-2 mb-2">
                    <label for="exampleInputEmail1">Alamat</label>
                    <textarea class="form-control" name="alamat" rows="3" placeholder="Alamat"><?= $query['alamat'] ?></textarea>
                    <?= form_error('alamat'); ?>
                </div>

            </div> <!-- /.card-body -->


            <div class="card-footer">
                <button type="submit" class="btn btn-primary" id="save-button"><i class="far fa-check-circle"></i> Simpan</button>
                <a href="<?= site_url('site/index') ?>" class="btn btn-danger"><i class="fa fa-times-circle"></i> Batal</a>
            </div>
        </form>
    </div> <!-- /.card -->
</div>
<!--/.col (left) -->

<script>
    $(document).ready(function() {
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