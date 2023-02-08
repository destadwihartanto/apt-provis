<?php $this->load->view('template/alert') ?>
<div class="col-12">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Data Teknisi</h3>
        </div>

        <div class="card-body">
            <p>
                <a href="<?= base_url('technician/create') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
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
                            <td><?= ($value['technician_name']) ?></td>
                            <td><?= $value['telepon'] ?></td>
                            <td><?= $value['company'] ?></td>
                            <td class="project-actions text-center">
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Aksi</button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                         <?php if ($this->ion_auth->is_admin() || $this->ion_auth->user()->row()->id == $value['user_id'] ) :  ?>
                                            <a class="dropdown-item" href="<?= base_url('technician/update/' . base64_encode($value['id'])) ?>">Update</a>
                                            <a class="dropdown-item delete" href="<?= base_url('technician/delete/' . base64_encode($value['id'])) ?>" data-site="<?= $value['technician_name'] ?>">Hapus</a>
                                        <?php endif ?>
                                    </div>
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
    $(document).ready(function() {
        // Setup - add a text input to each footer cell
        $('#example1 tfoot th').each(function() {
            var title = $(this).text();
            $(this).html('<input type="text" class="form-control" placeholder="Search ' + title + '" />');
        });

        // DataTable
        var table = $('#example1').DataTable({
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
        const technician_name = $(this).attr('data-site');
        Swal.fire({
            title: 'Anda yakin?',
            text: "Hapus teknisi " + technician_name,
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