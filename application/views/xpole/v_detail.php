<?php $this->load->view('template/alert') ?>
<!-- left column -->
<div class="col-md-12">
    <p>
        <a href="<?= base_url('xpole/update/' . base64_encode($query['id'])) ?>" class="btn btn-primary">
            <i class="far fa-edit"></i> Update
        </a>
    </p>

    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Detail Crosspole</h3>
        </div>

        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>Site ID</th>
                    <td><?= $query['nama_site'] ?></td>
                </tr>
                <tr>
                    <th>Nama Lokasi</th>
                    <td><?= $query['nama_site'] ?></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <?php $bg = $query['status'] == 'approve' ? 'success' : 'warning'; ?>
                    <td><span class="badge bg-<?= $bg ?>"><?= $query['status'] ?></span></td>
                </tr>
                <tr>
                    <th>Nama Teknisi</th>
                    <td><?= $query['nama_teknisi'] ?></td>
                </tr>
                <tr>
                    <th>Telp. Teknisi</th>
                    <td><?= $query['telepon'] ?></td>
                </tr>
                <tr>
                    <th>CPI</th>
                    <td><?= $query['cpi'] ?></td>
                </tr>
                <tr>
                    <th>C to N</th>
                    <td><?= $query['c2n'] ?></td>
                </tr>
                <tr>
                    <th>ASI</th>
                    <td><?= $query['asi'] ?></td>
                </tr>
                <tr>
                    <th>Note</th>
                    <td><?= $query['notes'] ?></td>
                </tr>
                <tr>
                    <th>Tanggal Dibuat</th>
                    <td><?= date('d F Y H:i', strtotime($query['last_update'])) ?></td>
                </tr>
            </tbody>
        </table>
    </div> <!-- /.card -->
</div>
<!--/.col (left) -->

<div class="row">
    <div class="col-12">
        <!-- Custom Tabs -->
        <div class="card">
            <div class="card-header d-flex p-0">
                <h3 class="card-title p-3">Lampiran</h3>
                <ul class="nav nav-pills ml-auto p-2">
                    <li class="nav-item"><a class="nav-link active" href="#FirstModem" data-toggle="tab">Modem #1</a></li>
                    <li class="nav-item"><a class="nav-link" href="#SecondModem" data-toggle="tab">Modem #2</a></li>
                    <li class="nav-item"><a class="nav-link" href="#xpole" data-toggle="tab">Hasil Crosspole</a></li>
                    <li class="nav-item"><a class="nav-link" href="#SpeedTest" data-toggle="tab">Speed Test</a></li>
                    <li class="nav-item"><a class="nav-link" href="#Ethernet" data-toggle="tab">Parameter Ethernet</a></li>
                    <li class="nav-item"><a class="nav-link" href="#Plang" data-toggle="tab">Plang Instansi</a></li>
                    <li class="nav-item"><a class="nav-link" href="#Antenna" data-toggle="tab">Antena</a></li>
                </ul>
            </div><!-- /.card-header -->

            <div class="card-body">
                <div class="tab-content">
                    <!-- /.tab-pane -->
                    <div class="tab-pane active" id="FirstModem">
                        <a target="_blank" href="<?= site_url('uploads/' . $query['url_img_first_modem']) ?>">
                            <img width="50%" src="<?= site_url('uploads/' . $query['url_img_first_modem']) ?>" class="img-fluid mb-2" alt="Modem #1" />
                        </a>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="SecondModem">
                        <a target="_blank" href="<?= site_url('uploads/' . $query['url_img_second_modem']) ?>">
                            <img width="50%" src="<?= site_url('uploads/' . $query['url_img_second_modem']) ?>" class="img-fluid mb-2" alt="Modem #2" />
                        </a>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="xpole">
                        <a target="_blank" href="<?= site_url('uploads/' . $query['url_img_xpole']) ?>">
                            <img width="50%" src="<?= site_url('uploads/' . $query['url_img_xpole']) ?>" class="img-fluid mb-2" alt="Hasil Xpole" />
                        </a>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="SpeedTest">
                        <a target="_blank" href="<?= site_url('uploads/' . $query['url_img_speedtest']) ?>">
                            <img width="50%" src="<?= site_url('uploads/' . $query['url_img_speedtest']) ?>" class="img-fluid mb-2" alt="Speed Test" />
                        </a>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="Ethernet">
                        <a target="_blank" href="<?= site_url('uploads/' . $query['url_img_ethernet']) ?>">
                            <img width="50%" src="<?= site_url('uploads/' . $query['url_img_ethernet']) ?>" class="img-fluid mb-2" alt="Lampiran Ethernet" />
                        </a>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="Plang">
                        <a target="_blank" href="<?= site_url('uploads/' . $query['url_img_plang']) ?>">
                            <img width="50%" src="<?= site_url('uploads/' . $query['url_img_plang']) ?>" class="img-fluid mb-2" alt="Plang Instansi" />
                        </a>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="Antenna">
                        <a target="_blank" href="<?= site_url('uploads/' . $query['url_img_antenna']) ?>">
                            <img width="50%" src="<?= site_url('uploads/' . $query['url_img_antenna']) ?>" class="img-fluid mb-2" alt="Antenna" />
                        </a>
                    </div>

                </div> <!-- /.tab-content -->
            </div> <!-- /.card-body -->
        </div> <!-- ./card -->
    </div> <!-- /.col-12 -->
</div>