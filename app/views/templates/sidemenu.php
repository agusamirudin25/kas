<body class="vertical-layout">
    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner"></div>
        </div>
    </div>
    <!-- Begin page -->
    <div id="containerbar" class="container-fluid">
        <!-- ========== Left Sidebar Start ========== -->
        <!-- Start Leftbar -->
        <div class="leftbar">
            <!-- Start Sidebar -->
            <div class="sidebar">
                <!-- Start Logobar -->
                <div class="logobar">
                    <a href="index.html" class="logo logo-large"><img src="<?= BASEURL ?>/assets/images/karawang epduli.jpeg" class="img-fluid" height="50" alt="logo"></a>
                </div>
                <!-- End Logobar -->
                <!-- Start Navigationbar -->
                <div class="navigationbar">
                    <?php
                    $sessionUserType = $_SESSION['login']['type'];
                    if ($sessionUserType == MASTER_USR) { ?>
                        <ul class="vertical-menu">
                            <li>
                                <a href="javaScript:void();">
                                    <img src="<?= BASEURL ?>/assets/images/svg-icon/dashboard.svg" class="img-fluid" alt="dashboard"><span>Kategori</span><i class="feather icon-chevron-right pull-right"></i>
                                </a>
                                <ul class="vertical-submenu">
                                    <li><a href="<?= BASEURL ?>/user">User</a></li>
                                    <li><a href="<?= BASEURL ?>/pengurus">Pengurus</a></li>
                                    <li><a href="<?= BASEURL ?>/donatur">Donatur</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javaScript:void();">
                                    <img src="<?= BASEURL ?>/assets/images/svg-icon/dashboard.svg" class="img-fluid" alt="dashboard"><span>main</span><i class="feather icon-chevron-right pull-right"></i>
                                </a>
                                <ul class="vertical-submenu">
                                    <li><a href="<?= BASEURL ?>/kegiatan">Kegiatan</a></li>
                                    <li><a href="<?= BASEURL ?>/pemasukan">Pemasukan</a></li>
                                    <li><a href="<?= BASEURL ?>/pengeluaran">Pengeluaran</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javaScript:void();">
                                    <img src="<?= BASEURL ?>/assets/images/svg-icon/form_elements.svg" class="img-fluid" alt="basic"><span>Laporan</span><i class="feather icon-chevron-right pull-right"></i>
                                </a>
                                <ul class="vertical-submenu">
                                    <li><a href="<?= BASEURL ?>/laporan/summary">Laporan</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javaScript:void();">
                                    <img src="<?= BASEURL ?>/assets/images/svg-icon/basic.svg" class="img-fluid" alt="basic"><span>Tentang</span><i class="feather icon-chevron-right pull-right"></i>
                                </a>
                                <ul class="vertical-submenu">
                                    <li><a href="<?= BASEURL ?>/tentang">tentang</a></li>
                                </ul>
                            </li>
                        </ul>
                    <?php } else if ($sessionUserType == KEPALA_USR) { ?>
                        <ul class="vertical-menu">
                            <li>
                                <a href="javaScript:void();">
                                    <img src="<?= BASEURL ?>/assets/images/svg-icon/form_elements.svg" class="img-fluid" alt="basic"><span>Laporan</span><i class="feather icon-chevron-right pull-right"></i>
                                </a>
                                <ul class="vertical-submenu">
                                    <li><a href="<?= BASEURL ?>/laporan/summary">Laporan</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javaScript:void();">
                                    <img src="<?= BASEURL ?>/assets/images/svg-icon/basic.svg" class="img-fluid" alt="basic"><span>Tentang</span><i class="feather icon-chevron-right pull-right"></i>
                                </a>
                                <ul class="vertical-submenu">
                                    <li><a href="<?= BASEURL ?>/tentang">tentang</a></li>
                                </ul>
                            </li>
                        </ul>
                    <?php } else if ($sessionUserType == BENDAHARA_USR) { ?>
                        <ul class="vertical-menu">
                            <li>
                                <a href="javaScript:void();">
                                    <img src="<?= BASEURL ?>/assets/images/svg-icon/dashboard.svg" class="img-fluid" alt="dashboard"><span>Kategori</span><i class="feather icon-chevron-right pull-right"></i>
                                </a>
                                <ul class="vertical-submenu">
                                    <li><a href="<?= BASEURL ?>/user">User</a></li>
                                    <li><a href="<?= BASEURL ?>/pengurus">Pengurus</a></li>
                                    <li><a href="<?= BASEURL ?>/donatur">Donatur</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javaScript:void();">
                                    <img src="<?= BASEURL ?>/assets/images/svg-icon/dashboard.svg" class="img-fluid" alt="dashboard"><span>main</span><i class="feather icon-chevron-right pull-right"></i>
                                </a>
                                <ul class="vertical-submenu">
                                    <li><a href="<?= BASEURL ?>/kegiatan">Kegiatan</a></li>
                                    <li><a href="<?= BASEURL ?>/pemasukan">Pemasukan</a></li>
                                    <li><a href="<?= BASEURL ?>/pengeluaran">Pengeluaran</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javaScript:void();">
                                    <img src="<?= BASEURL ?>/assets/images/svg-icon/form_elements.svg" class="img-fluid" alt="basic"><span>Laporan</span><i class="feather icon-chevron-right pull-right"></i>
                                </a>
                                <ul class="vertical-submenu">
                                    <li><a href="<?= BASEURL ?>/laporan/summary">Laporan</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javaScript:void();">
                                    <img src="<?= BASEURL ?>/assets/images/svg-icon/basic.svg" class="img-fluid" alt="basic"><span>Tentang</span><i class="feather icon-chevron-right pull-right"></i>
                                </a>
                                <ul class="vertical-submenu">
                                    <li><a href="<?= BASEURL ?>/tentang">tentang</a></li>
                                </ul>
                            </li>
                        </ul>
                    <?php } else if ($sessionUserType == ADMIN_USR) { ?>
                        <ul class="vertical-menu">
                            <li>
                                <a href="javaScript:void();">
                                    <img src="<?= BASEURL ?>/assets/images/svg-icon/dashboard.svg" class="img-fluid" alt="dashboard"><span>Kategori</span><i class="feather icon-chevron-right pull-right"></i>
                                </a>
                                <ul class="vertical-submenu">
                                    <li><a href="<?= BASEURL ?>/user">User</a></li>
                                    <li><a href="<?= BASEURL ?>/pengurus">Pengurus</a></li>
                                    <li><a href="<?= BASEURL ?>/donatur">Donatur</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javaScript:void();">
                                    <img src="<?= BASEURL ?>/assets/images/svg-icon/dashboard.svg" class="img-fluid" alt="dashboard"><span>main</span><i class="feather icon-chevron-right pull-right"></i>
                                </a>
                                <ul class="vertical-submenu">
                                    <li><a href="<?= BASEURL ?>/kegiatan">Kegiatan</a></li>
                                    <li><a href="<?= BASEURL ?>/pengeluaran">Pengeluaran</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javaScript:void();">
                                    <img src="<?= BASEURL ?>/assets/images/svg-icon/form_elements.svg" class="img-fluid" alt="basic"><span>Laporan</span><i class="feather icon-chevron-right pull-right"></i>
                                </a>
                                <ul class="vertical-submenu">
                                    <li><a href="<?= BASEURL ?>/laporan/summary">Laporan</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javaScript:void();">
                                    <img src="<?= BASEURL ?>/assets/images/svg-icon/basic.svg" class="img-fluid" alt="basic"><span>Tentang</span><i class="feather icon-chevron-right pull-right"></i>
                                </a>
                                <ul class="vertical-submenu">
                                    <li><a href="<?= BASEURL ?>/tentang">tentang</a></li>
                                </ul>
                            </li>
                        </ul>
                    <?php } else {
                        header("Location: " . BASEURL . "/login/logout");
                    } ?>
                </div>
                <!-- End Navigationbar -->
            </div>
            <!-- End Sidebar -->
        </div>
        <!-- End Leftbar -->
        <!-- Left Sidebar End -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <!-- Top Bar Start -->
                <div class="topbar ">
                    <nav class="navbar-custom">
                        <ul class="list-inline float-right mb-0">
                            <li class="list-inline-item dropdown notification-list">
                            </li>
                        </ul>
                        <ul class="list-inline menu-left mb-0">
                            <li class="float-left">
                                <button class="button-menu-mobile open-left waves-light waves-effect  bg-secondary">
                                    <i class="mdi mdi-menu"></i>
                                </button>
                            </li>
                        </ul>
                        <div class="clearfix bg-secondary"></div>
                    </nav>
                </div>
                <!-- Top Bar End -->
                <div class="rightbar">
                    <!-- Start Topbar Mobile -->
                    <div class="topbar-mobile">
                        <div class="row align-items-center">
                            <div class="col-md-12">
                                <div class="mobile-logobar">
                                    <a href="index.html" class="mobile-logo"><img src="<?= BASEURL ?>/assets/images/logo.svg" class="img-fluid" alt="logo"></a>
                                </div>
                                <div class="mobile-togglebar">
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item">
                                            <div class="topbar-toggle-icon">
                                                <a class="topbar-toggle-hamburger" href="javascript:void();">
                                                    <img src="<?= BASEURL ?>/assets/images/svg-icon/horizontal.svg" class="img-fluid menu-hamburger-horizontal" alt="horizontal">
                                                    <img src="<?= BASEURL ?>/assets/images/svg-icon/verticle.svg" class="img-fluid menu-hamburger-vertical" alt="verticle">
                                                </a>
                                            </div>
                                        </li>
                                        <li class="list-inline-item">
                                            <div class="menubar">
                                                <a class="menu-hamburger" href="javascript:void();">
                                                    <img src="<?= BASEURL ?>/assets/images/svg-icon/collapse.svg" class="img-fluid menu-hamburger-collapse" alt="collapse">
                                                    <img src="<?= BASEURL ?>/assets/images/svg-icon/close.svg" class="img-fluid menu-hamburger-close" alt="close">
                                                </a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Start Topbar -->
                    <div class="topbar">
                        <!-- Start row -->
                        <div class="row align-items-center">
                            <!-- Start col -->
                            <div class="col-md-12 align-self-center">
                                <div class="togglebar">
                                    <ul class="list-inline mb-0">

                                        <li class="list-inline-item">
                                            <h3>
                                                Perancangan sistem informasi buku kas umum berbasis web
                                            </h3>
                                        </li>
                                    </ul>
                                </div>
                                <div class="infobar">
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item">
                                            <div class="profilebar">
                                                <div class="dropdown">
                                                    <a class="dropdown-toggle" href="#" role="button" id="profilelink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?= BASEURL ?>/assets/images/users/profile.svg" class="img-fluid" alt="profile"><span class="feather icon-chevron-down live-icon"></span></a>
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profilelink">
                                                        <div class="dropdown-item">
                                                            <div class="profilename">
                                                                <h5>John Doe</h5>
                                                            </div>
                                                        </div>
                                                        <div class="userbox">
                                                            <ul class="list-unstyled mb-0">
                                                                <li class="media dropdown-item">
                                                                    <a href="<?= BASEURL ?>/login/logout" class="profile-icon"><img src="<?= BASEURL ?>/assets/images/svg-icon/logout.svg" class="img-fluid" alt="logout">Logout</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- End col -->
                        </div>
                        <!-- End row -->
                    </div>