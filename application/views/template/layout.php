<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OSS | <?= $title ?? false ?></title>
    <link rel="icon" href="<?= base_url() ?>assets/img/apt_logo.png" type="image/png" />
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url() ?>vendor/components/font-awesome/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/adminlte.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/_all-skins.min.css">

    <!-- jQuery -->
    <script src="<?= base_url() ?>vendor/components/jquery/jquery.min.js"></script>
    <!-- Select2 -->
    <script src="<?= base_url() ?>vendor/select2/select2/dist/js/select2.full.min.js"></script>
    <link rel="stylesheet" href="<?= base_url() ?>vendor/select2/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>vendor/ttskch/select2-bootstrap4-theme/dist/select2-bootstrap4.min.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/buttons.bootstrap4.min.css">

    <!-- Toastr -->
    <script src="<?= base_url() ?>assets/js/toastr.min.js"></script>
    <script src="<?= base_url() ?>assets/css/toastr.min.css"></script>

    <!-- DataTables  & Plugins -->
    <script src="<?= base_url() ?>assets/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>assets/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url() ?>assets/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url() ?>assets/js/responsive.bootstrap4.min.js"></script>
    <script src="<?= base_url() ?>assets/js/dataTables.buttons.min.js"></script>
    <script src="<?= base_url() ?>assets/js/buttons.bootstrap4.min.js"></script>
    <script src="<?= base_url() ?>assets/js/jszip.min.js"></script>
    <script src="<?= base_url() ?>assets/js/pdfmake.min.js"></script>
    <script src="<?= base_url() ?>assets/js/vfs_fonts.js"></script>
    <script src="<?= base_url() ?>assets/js/buttons.html5.min.js"></script>
    <script src="<?= base_url() ?>assets/js/buttons.print.min.js"></script>
    <script src="<?= base_url() ?>assets/js/buttons.colVis.min.js"></script>

</head>

<!-- <body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed"> -->
<body class="hold-transition dark-mode sidebar-mini">
    
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark navbar-dark">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i>
                    </a>
                </li>
            </ul>
            <img src="<?= base_url() ?>assets_login/img/angkasa-prima-teknologi-logo.png" alt="AdminLTE Logo" class="brand-image" width="120px">

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">

                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-user"></i>
                        <span class="badge badge-warning navbar-badge">0</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="<?= base_url('auth/logout') ?>" class="dropdown-item">
                            <i class="fas fa-power-off"></i> Logout
                        </a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav> <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-info elevation-4">
            <!-- Brand Logo -->
            <!-- <a href="<?= base_url() ?>" class="brand-link">
                <img src="<?= base_url() ?>assets_login/img/angkasa-prima-teknologi-logo.png" alt="AdminLTE Logo" class="brand-image elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light"> PROVISIONING </span>
            </a> -->

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?= base_url() ?>assets/img/default.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="<?= base_url('dashboard/index') ?>" class="d-block"><?= $this->ion_auth->user()->row()->first_name ?? 'Welcome' ?></a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <?php $this->load->view('template/sidebar_menu'); ?>

            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            <h1><?= isset($h1) ? $h1 : null ?></h1>
                        </div>

                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <section class="content">
                <!-- Main content -->
                <div class="container-fluid">
                    <div class="row">
                        <?php $this->load->view($content) ?>
                    </div> <!-- /.row -->

                </div> <!-- /.container-fluid -->
            </section> <!-- /.content -->

        </div> <!-- /.content-wrapper -->

        <footer class="main-footer bg-dark">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 2.0
            </div>
            <strong>Copyright &copy; <?= date("Y") ?> <a href="#" target="_blank">APT</a>.</strong>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->


    <!-- Bootstrap 4 -->
    <script src="<?= base_url() ?>vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- bs-custom-file-input -->
    <script src="<?= base_url() ?>vendor/twbs/bootstrap/site/assets/js/vendor/bs-custom-file-input.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url() ?>assets/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?= base_url() ?>assets/js/demo.js"></script>

    <script src="<?= base_url() ?>assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>

    <script>
        $(function() {
            bsCustomFileInput.init();
        });

        $(document).ready(function() {
            <?php if ($this->session->flashdata('alert_icon')) : ?>
                Swal.fire({
                    icon: '<?= $this->session->flashdata('alert_icon') ?>',
                    title: '<?= $this->session->flashdata('alert_message') ?>',
                    timer: 2500
                })
            <?php endif ?>
        });
    </script>
</body>

</html>