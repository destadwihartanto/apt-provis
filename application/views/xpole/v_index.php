<?php $this->load->view('template/alert') ?>
<div class="col-12">
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong><i class="fas fa-exclamation-triangle"></i>&nbsp;Informasi :</strong>
        <p>1.Halaman ini menampilkan semua data menu Crosspole <br>
            2.Pada kolom aksi terdapat tombol info : untuk melihat detail, edit : untuk ubah data, hapus : untuk menghapus data , dan tombol cheklist untuk melakukan approve status </p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>


    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title"><?= $title ?></h3>
        </div>

        <div class="card-body">
            <p>
                <a href="<?= base_url('xpole/create') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Xpole</a>
            </p>

            <table id="example1" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <?php foreach ($rows as $key => $value) : ?>
                            <th><?= $value ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($query as $key => $value) : ?>
                        <tr>
                            <td>
                                <?= $value['nama_site'] ?>
                            </td>
                            <td>
                                <?= $value['company'] ?>
                            </td>
                            <td class="project-state">
                                <?php $bg = $value['status'] == 'approve' ? 'success' : 'warning'; ?>
                                <span class="badge badge-<?= $bg ?>"><?= $value['status'] ?></span>
                            </td>
                            <td>
                                <?= date('d F Y H:i', strtotime($value['last_update'])) ?>
                            </td>
                            <td><?= character_limiter($value['notes'], 50)  ?></td>
                            <td class="project-actions text-center">
                                <div class="btn-group btn-group-sm">
                                    <a href="<?= base_url('xpole/detail/' . base64_encode($value['id'])) ?>" class="btn btn-outline-info" data-toggle="tooltip" title="Detail Data"><i class="fas fa-info-circle"></i></a>
                                    <a href="<?= base_url('xpole/update/' . base64_encode($value['id'])) ?>" class="btn btn-outline-dark" data-toggle="tooltip" title="Edit Data"><i class="fas fa-edit"></i></a>
                                    <?php if ($is_admin && $value['status'] == 'open') :  ?>
                                        <a href="<?= base_url('xpole/approve/' . base64_encode($value['id'])) ?>" data-site="<?= $value['nama_site'] ?>" class="btn btn-outline-success approve" data-toggle="tooltip" title="Chek Data"><i class="fas fa-check"></i></a>
                                    <?php endif ?>
                                    <?php if ($is_admin) :  ?>
                                        <a href="<?= base_url('xpole/delete/' . base64_encode($value['id'])) ?>" data-site="<?= $value['nama_site'] ?>" class="btn btn-outline-danger delete" data-toggle="tooltip" title="Hapus Data"><i class="fas fa-trash"></i></a>
                                    <?php endif ?>

                                </div>
                            </td>

                            <!-- <td class="project-actions text-center">
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Aksi</button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="<?= base_url('xpole/detail/' . base64_encode($value['id'])) ?>">Detail</a>
                                        <a class="dropdown-item" href="<?= base_url('xpole/update/' . base64_encode($value['id'])) ?>">Update</a>
                                        <?php if ($is_admin && $value['status'] == 'open') :  ?>
                                            <a class="dropdown-item approve" href="<?= base_url('xpole/approve/' . base64_encode($value['id'])) ?>" data-site="<?= $value['nama_site'] ?>">Approve</a>
                                        <?php endif ?>
                                        <?php if ($is_admin) :  ?>
                                        <a class="dropdown-item delete" data-site="<?= $value['nama_site'] ?>" href="<?= base_url('xpole/delete/' . base64_encode($value['id'])) ?>">Hapus</a>
                                        <?php endif ?>
                                    </div>
                                </div>
                            </td> -->
                        </tr>
                    <?php endforeach; ?>
                </tbody>

                <tfoot>
                    <tr>
                        <?php foreach ($rows as $key => $value) : ?>
                            <th><?= $value ?></th>
                        <?php endforeach; ?>
                    </tr>
                </tfoot>
            </table>
        </div> <!-- /.card-body -->
    </div> <!-- /.card -->
</div>

<script>
    $(function() {
        $('#example1 tfoot th').each(function() {

            var title = $(this).text();
            $(this).html('<input type="text" class="form-control" placeholder="Search ' + title + '" />');
        });

        $("#example1").DataTable({
            "pageLength": 25,
            initComplete: function() {
                // Apply the search
                this.api().columns().every(function() {
                    var that = this;

                    $('input', this.footer()).on('keyup change clear', function() {
                        if (that.search() !== this.value) {
                            that
                                .search(this.value)
                                .draw();
                        }
                    });
                });
            },
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
        });
    });

    $('.approve').on('click', function(e) {
        e.preventDefault();
        const href = $(this).attr('href');
        const siteName = $(this).attr('data-site');
        Swal.fire({
            title: 'Anda Yakin Approve?',
            text: "Lokasi " + siteName,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Approve'
        }).then((result) => {
            if (result.isConfirmed) {
                document.location.href = href;
            }
        })
    });

    $('.delete').on('click', function(e) {
        e.preventDefault();
        const href = $(this).attr('href');
        const siteName = $(this).attr('data-site');
        Swal.fire({
            title: 'Anda Yakin Hapus?',
            text: "Lokasi " + siteName,
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
</script>