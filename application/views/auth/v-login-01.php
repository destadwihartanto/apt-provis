<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="<?= base_url('assets_login/img/favicon.png" ') ?>" />
    <title>
        LOGIN | AREA
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="<?= base_url('assets_login/css/nucleo-icons.css" rel="stylesheet" ') ?>" />
    <link href="<?= base_url('assets_login/css/nucleo-svg.css" rel="stylesheet" ') ?>" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="<?= base_url('assets_login/css/material-dashboard.css?v=3.0.4" rel="stylesheet" ') ?>" />
</head>

<body class="bg-gray-200">
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12">
            </div>
        </div>
    </div>
    <main class="main-content  mt-0">
        <div class="page-header align-items-start min-vh-100" style="background-image: url('https://images.unsplash.com/photo-1497294815431-9365093b7331?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1950&q=80');">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container my-auto">
                <div class="row">
                    <div class="col-lg-4 col-md-8 col-12 mx-auto">
                        <div class="card z-index-0 fadeIn3 fadeInBottom">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <center>
                                    <div class="bg-gradient-white shadow-danger border-radius-lg py-2 pe-1"><img src="<?= base_url('assets_login/img/angkasa-prima-teknologi-logo.png" ') ?>" width="200" height=70" alt="IMG" style="border-radius:100%"></div>
                                </center>
                            </div>
                            <div class="card-body">

                                <form role="form" method="post" action="<?= base_url('auth/login') ?>" enctype="multipart/form-data">
                                    <div class="input-group input-group-dynamic mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="text" name="<?= $identity['name'] ?>" id="<?= $identity['id'] ?>" class="form-control" aria-label="Name">
                                    </div>
                                    <div class="input-group input-group-dynamic mb-3">
                                        <label class="form-label">Password</label>
                                        <input type="password" name="<?= $password['name'] ?>" id="<?= $password['id'] ?>" class="form-control" aria-label="Password">
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn bg-gradient-info w-100 my-4 mb-2">Masuk</button>
                                    </div>
                                    <!-- <p class="mt-4 text-sm text-center">
                                        Buat akun anda, untuk menjadi donatur? &nbsp;
                                        <a href="../pages/sign-up.html" class="text-primary text-gradient font-weight-bold">Daftar</a>
                                    </p> -->
                                    <div class="alert alert-warning alert-dismissible text-white fade show" role="alert">
                                        <span class="alert-icon align-middle">
                                        </span>
                                        <span class="alert-text">Silahkan Login dengan email dan password terdaftar</span>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer position-absolute bottom-2 py-2 w-100">
                <div class="container">
                    <div class="row align-items-center justify-content-lg-between">
                        <div class="col-12 col-md-6 my-auto">
                            <div class="copyright text-center text-sm text-white text-lg-start">
                                APT © <script>
                                    document.write(new Date().getFullYear())
                                </script>
                              
                            </div>
                        </div>
                        
                    </div>
                </div>
            </footer>
        </div>
    </main>
    <!--   Core JS Files   -->
    <script src="<?= base_url('assets_login/js/core/popper.min.js" ') ?>"></script>
    <script src="<?= base_url('assets_login/js/core/bootstrap.min.js" ') ?>"></script>
    <script src="<?= base_url('assets_login/js/plugins/perfect-scrollbar.min.js" ') ?>"></script>
    <script src="<?= base_url('assets_login/js/plugins/smooth-scrollbar.min.js" ') ?>"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="<?= base_url('assets_login/js/material-dashboard.min.js?v=3.0.4"') ?>></script>
</body>

</html>