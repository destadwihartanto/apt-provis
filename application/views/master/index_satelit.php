<?php $this->load->view('template/alert') ?>
<div class="col-7">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title"><?= $title ?></h3>
        </div>

        <div class="card-body">
            <p>
                <a href="<?= base_url('masterdata/create_satelit') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
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
                            <td><?= ($value['nama']) ?></td>
                            <td>
                                <?php
                                switch ($value['active']) {
                                    case 1:
                                        echo '<span class="badge badge-info">Aktif</span>';
                                        break;
                                    default:
                                        echo '<span class="badge badge-danger">Non Aktif</span>';
                                        break;
                                }
                                ?></td>
                            <td><a class="btn btn-success update" href="<?= base_url('masterdata/update_satelite/' . base64_encode($value['id'])) ?>"><i class="fas fa-edit"></i>Edit</a>
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
        const nama = $(this).attr('data-nama');
        Swal.fire({
            title: 'Anda yakin?',
            text: "Hapus " + nama,
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