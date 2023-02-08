
<div class="col-lg-12">
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong><i class="fas fa-exclamation-triangle"></i>&nbsp;Informasi :</strong> <p>1.Halaman ini menampilkan data menu lokasi/site <br>
  2.Pada kolom aksi terdapat tombol info : untuk melihat detail, edit : untuk ubah data, hapus : untuk menghapus data , dan tombol print untuk mencetak ketika telah approve status Xpole </p>
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
                <a href="<?= base_url('site/create') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Site</a>
            </p>
            <div id="flashData" data-flashdata="<?= $this->session->flashdata('alert') ?>"></div>
            <table id="example1" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <?php foreach ($rows as $key => $value) : ?>
                            <th><?= $value ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>

                <tbody>
                    <?php
                  
                    foreach ($query as $key => $value) :?>
                        <tr>
                            
                            <td><a href="<?= base_url('site/detail/' . base64_encode($value['id'])) ?>"><?= $value['sid'] ?></a> </td>
                            <td><?= $value['nama_kontrak'] ?></td>
                            <td>
                                <?php $bg = $value['status'] == 'Request' ? 'warning' : 'success'; ?>
                                <span class="badge badge-<?= $bg ?>"><?= $value['status'] ?></span>
                            </td>
                            <td>
                                <?php $bg = $value['xpole'] == 'approve' ? 'success' : 'warning'; ?>
                                <span class="badge badge-<?= $bg ?>"><?= $value['xpole'] ?></span>
                            </td>
                            <td><?= $value['company'] ?></td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                        <a class="btn btn-outline-info" href="<?= base_url('site/detail/' . base64_encode($value['id'])) ?>" data-toggle="tooltip" title="Detail Data"><i class="fas fa-info-circle"></i></a>
                                        <a class="btn btn-outline-primary" href="<?= base_url('site/update/' . base64_encode($value['id'])) ?>"data-toggle="tooltip" title="Edit Data"><i class="fas fa-edit"></i></a>
                                        <?php if ($value['xpole'] == 'approve') : ?>
                                            <a class="btn btn-outline-warning" href="<?= base_url('baa/print/' . base64_encode($value['id'])) ?>" target="_blank" data-toggle="tooltip" title="Print Data"><i class="fas fa-print"></i></a>
                                        <?php endif ?>
                                        <a class="btn btn-outline-danger delete" href="<?= base_url('site/delete/' . base64_encode($value['id'])) ?>" data-site="<?= $value['nama_kontrak'] ?>" data-toggle="tooltip" title="Hapus Data"><i class="fas fa-trash"></i></a>
                                    </div>
                            </td>
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
            "pageLength": 20,
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

    $('.delete').on('click', function(e) {
        e.preventDefault();
        const href = $(this).attr('href');
        const siteName = $(this).attr('data-site');
        Swal.fire({
            title: 'Anda yakin?',
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