<!DOCTYPE html>
<html lang="en">

<head>
    <base href="<?= base_url() ?>">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= $title ?></title>

    <link rel="shortcut icon" href="dist/assets/compiled/svg/favicon.svg" type="image/x-icon" />
    <link rel="stylesheet" href="dist/assets/extensions/flatpickr/flatpickr.min.css">
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/flatpickr-year-select-plugin/dist/yearSelectPlugin.min.css" />
    <link rel="stylesheet" href="dist/assets/compiled/css/app.css" />
    <link rel="stylesheet" href="dist/assets/compiled/css/app-dark.css" />

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" />

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

    <style>
        html,
        body {
            height: 100%;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        #main {
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        #main-content {
            flex: 1;
        }

        footer {
            margin-top: auto;
        }
    </style>
</head>

<body>
    <script src="dist/assets/static/js/initTheme.js"></script>

    <div id="app" class="d-flex flex-column flex-grow-1">
        <!-- Sidebar -->
        <?= $this->include('dashboard/sidebar') ?>
        <!-- End Sidebar -->

        <div id="main" class="layout-navbar navbar-fixed flex-grow-1 d-flex flex-column">
            <header>
                <nav class="navbar navbar-expand navbar-light navbar-top">
                    <div class="container-fluid">
                        <a href="javascript:void(0)" class="burger-btn d-block" aria-expanded="false">
                            <i class="bi bi-justify fs-3"></i>
                        </a>

                        <button
                            class="navbar-toggler"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent"
                            aria-controls="navbarSupportedContent"
                            aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto mb-lg-0">
                                <!-- <li class="nav-item dropdown me-1">
                                    <a class="nav-link active dropdown-toggle text-gray-600" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-envelope bi-sub fs-4"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                        <li>
                                            <h6 class="dropdown-header">Mail</h6>
                                        </li>
                                        <li><a class="dropdown-item" href="#">No new mail</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown me-3">
                                    <a class="nav-link active dropdown-toggle text-gray-600" href="#" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                        <i class="bi bi-bell bi-sub fs-4"></i>
                                        <span class="badge badge-notification bg-danger">7</span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end notification-dropdown" aria-labelledby="dropdownMenuButton">
                                        <li class="dropdown-header">
                                            <h6>Notifications</h6>
                                        </li>
                                        <li class="dropdown-item notification-item">
                                            <a class="d-flex align-items-center" href="#">
                                                <div class="notification-icon bg-primary"><i class="bi bi-cart-check"></i></div>
                                                <div class="notification-text ms-4">
                                                    <p class="notification-title font-bold">Successfully check out</p>
                                                    <p class="notification-subtitle font-thin text-sm">Order ID #256</p>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="dropdown-item notification-item">
                                            <a class="d-flex align-items-center" href="#">
                                                <div class="notification-icon bg-success"><i class="bi bi-file-earmark-check"></i></div>
                                                <div class="notification-text ms-4">
                                                    <p class="notification-title font-bold">Homework submitted</p>
                                                    <p class="notification-subtitle font-thin text-sm">Algebra math homework</p>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <p class="text-center py-2 mb-0"><a href="#">See all notification</a></p>
                                        </li>
                                    </ul>
                                </li> -->
                            </ul>
                            <div class="dropdown">
                                <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="user-menu d-flex">
                                        <div class="user-name text-end me-3">
                                            <h6 class="mb-0 text-gray-600"><?= session()->get('nama') ?></h6>
                                            <p class="mb-0 text-sm text-gray-600">
                                                <?= ucwords(str_replace('_', ' ', session()->get('role'))) ?>
                                            </p>
                                        </div>
                                        <div class="user-img d-flex align-items-center">
                                            <div class="avatar avatar-md">
                                                <img src="dist/assets/compiled/jpg/1.jpg" />
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton" style="min-width: 11rem">
                                    <li>
                                        <h6 class="dropdown-header">Hello, <?= session()->get('nama') ?>!</h6>
                                    </li>
                                    <!-- <li><a class="dropdown-item" href="#"><i class="icon-mid bi bi-person me-2"></i> My Profile</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="icon-mid bi bi-gear me-2"></i> Settings</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="icon-mid bi bi-wallet me-2"></i> Wallet</a></li> -->
                                    <li>
                                        <hr class="dropdown-divider" />
                                    </li>
                                    <li><a class="dropdown-item" href="<?= site_url('logout') ?>"><i class="icon-mid bi bi-box-arrow-left me-2"></i> Logout</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
            </header>

            <div id="main-content" class="flex-grow-1">
                <?= $this->renderSection('content') ?>
            </div>

            <footer>
                <div class="footer text-muted py-3 d-flex justify-content-between align-items-center flex-wrap">
                    <p class="m-0 footer-left">
                        <?= date('Y') ?> &copy; V-MARS
                    </p>

                    <p class="m-0 footer-right">
                        Created with <span class="text-danger"><i class="bi bi-heart-fill"></i></span>
                        by <a href="https://fajarajikusuma.vercel.app">Fajar Aji Kusuma, S.Kom.</a>
                    </p>
                </div>
            </footer>

        </div>
    </div>

    <!-- Toast Error -->
    <?php if (session()->getFlashdata('toast_error')) : ?>
        <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index:9999">
            <div class="toast align-items-center text-bg-danger border-0 show">
                <div class="d-flex">
                    <div class="toast-body">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <?= session()->getFlashdata('toast_error') ?>
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto"
                        data-bs-dismiss="toast"></button>
                </div>
            </div>
        </div>

        <script>
            setTimeout(() => {
                document.querySelector('.toast')?.classList.remove('show');
            }, 4000);
        </script>
    <?php endif; ?>
    <!-- End Toast Error -->

    <script src="dist/assets/static/js/components/dark.js"></script>
    <script src="dist/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="dist/assets/compiled/js/app.js"></script>
    <script src="dist/assets/extensions/flatpickr/flatpickr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr-year-select-plugin/dist/flatpickr-year-select-plugin.umd.js"></script>
    <script src="dist/assets/static/js/pages/date-picker.js"></script>
    <script src="custom.js"></script>
</body>

</html>