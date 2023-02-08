<!-- left column -->
<div class="col-md-6">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title"><?= $title ?></h3>
        </div>

        <!-- form start -->
        <form class="form" method="post" action="<?= site_url('xpole/update/' . $id); ?>" enctype="multipart/form-data">
            <div class="card-body">
                <?= validation_errors(); ?>
                <div class="form-group">
                    <label for="site_id">Lokasi</label>
                    <input type="text" name="site_id" class="form-control" value="<?= $query['nama_site'] ?>" disabled>
                    <input type="hidden" name="site_id" value="<?= $query['site_id'] ?>">
                    <?= form_error('site_id'); ?>
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <?php if ($is_admin) : ?>
                        <select name="status" class="form-control js-example-basic-single" id="status" style="width: 100%;" required>
                            <option value="">-- Pilih --</option>
                            <option value="approve" <?= $query['status'] == 'approve' ? 'selected' : '' ?>>Approve</option>
                            <option value="open" <?= $query['status'] == 'open' ? 'selected' : '' ?>>Open</option>
                        </select>
                    <?php else: ?>
                        <input type="text" name="status" class="form-control" value="<?= ucfirst($query['status']) ?>" disabled>
                        <input type="hidden" name="status" value="<?= $query['status'] ?>">
                    <?php endif ?>
                    <?= form_error('status'); ?>
                </div>

                <div class="form-group">
                    <label for="cpi">CPI</label>
                    <input type="text" name="cpi" class="form-control" value="<?=$query['cpi']?>" placeholder="CPI">
                    <?=form_error('cpi'); ?>
                </div>

                <div class="form-group">
                    <label for="c2n">C to N</label>
                    <input type="text" name="c2n" class="form-control" value="<?=$query['c2n']?>" placeholder="C to N">
                    <?=form_error('c2n'); ?>
                </div>

                <div class="form-group">
                    <label for="asi">ASI</label>
                    <input type="text" name="asi" class="form-control" value="<?=$query['asi']?>" placeholder="ASI" >
                    <?=form_error('asi'); ?>
                </div>

                <div class="form-group">
                    <label for="teknisi_id">Teknisi</label>
                    <select name="teknisi_id" class="form-control js-example-basic-single" id="teknisi_id" style="width: 100%;" >
                        <option value="">-- Pilih --</option>
                        <?php foreach ($teknisi as $key => $row) : ?>
                            <?php $selected = $row['id'] == $query['teknisi_id'] ? 'selected' : ''; ?>
                            <option value="<?= $row['id'] ?>" <?= ($selected) ?>><?= $row['technician_name'] ?> (<?= $row['telepon'] ?>)</option>
                        <?php endforeach; ?>
                    </select>
                    <?= form_error('teknisi_id'); ?>
                </div>

                <div class="form-group">
                    <label for="notes">Note</label>
                    <textarea class="form-control" name="notes" rows="3" placeholder="Alamat" ><?= $query['notes'] ?></textarea>
                    <?= form_error('notes'); ?>
                </div>

            </div> <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary" id="save-button"><i class="far fa-check-circle"></i> Simpan</button>
                <a href="<?= site_url('xpole/index') ?>" class="btn btn-danger"><i class="fa fa-times-circle"></i> Batal</a>
            </div>

    </div> <!-- /.card -->
</div>
<!--/.col (left) -->

<?php if ($query['status'] == 'approve'): ?>
<div class="col-md-6">
    <!-- right column -->
    <div class="card card-info">
        <!-- /.card -->
        <div class="card-header">
            <h3 class="card-title">Lampiran</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>

        <div class="card-body p-0">
            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 30%;">Nama Lampiran</th>
                        <th>Gambar</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($attachment as $key => $row) : ?>
                        <tr>
                            <td><?= $key ?></td>
                            <td>
                                <?php if ($query[$row] != null) : ?>
                                    <img src="<?= site_url('uploads/' . $query[$row]) ?>" class="img-fluid col-sm-6" alt="Hasil">
                                <?php else : ?>
                                    <p> <span class="badge badge-warning">Tidak ada Lampiran</span></p>
                                    <div class="form-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="<?= $row ?>">
                                            <label class="custom-file-label" for="<?= $row ?>"><?= $key ?></label>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td class="text-right py-0 align-middle">
                                <?php if ($query[$row] != null) : ?>
                                    <div class="btn-group btn-group-sm">
                                        <a href="#" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                        <a href="<?= base_url('xpole/hapus_attachment/' . $id . '/' . $row) ?>" data-type="<?= $key ?>" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                    </div>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            </form>
        </div> <!-- /.card-body -->
    </div>
</div> <!-- /.right column -->
<?php endif ?>
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();

        $('.btn-danger').on('click', function(e) {
        e.preventDefault();
        const href = $(this).attr('href');
        const siteName = $(this).attr('data-type');
        Swal.fire({
            title: 'Anda yakin?',
            text: "Lampiran " + siteName,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.isConfirmed) {
                document.location.href = href;
            }
        })
    });
    })
</script>