<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Orbiter is a bootstrap minimal & clean admin template">
    <meta name="keywords" content="admin, admin panel, admin template, admin dashboard, responsive, bootstrap 4, ui kits, ecommerce, web app, crm, cms, html, sass support, scss">
    <meta name="author" content="Themesbox">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Karawang Peduli</title>
    <!-- Fevicon -->
    <link rel="shortcut icon" href="<?= BASEURL ?>/assets/images/karawang epduli.jpeg">
    <!-- Start css -->
    <link href="<?= BASEURL ?>/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?= BASEURL ?>/assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="<?= BASEURL ?>/assets/css/style.css" rel="stylesheet" type="text/css">
    <!-- End css -->
</head>

<body class="vertical-layout">
    <!-- Start Containerbar -->
    <div id="containerbar" class="containerbar authenticate-bg">
        <!-- Start Container -->
        <div class="container">
            <div class="auth-box login-box">
                <!-- Start row -->
                <div class="row no-gutters align-items-center justify-content-center">
                    <!-- Start col -->
                    <div class="col-md-6 col-lg-5">
                        <!-- Start Auth Box -->
                        <div class="auth-box-right">
                            <div class="card">
                                <div class="card-body">
                                    <form action="<?= BASEURL ?>/login/login_process" method="POST">
                                        <div class="form-head">
                                            <a href="index.html" class="logo"><img src="<?= BASEURL ?>/assets/images/karawang epduli.jpeg" class="img-fluid" alt="logo"></a>
                                        </div>
                                        <h4 class="text-primary my-4">Log in !</h4>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="username" placeholder="Enter Username here" required name="user_name">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" id="password" placeholder="Enter Password here" required name="password">
                                        </div>

                                        <button type="submit" class="btn btn-success btn-lg btn-block font-18">Log in</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <!-- End Auth Box -->
                    </div>
                    <!-- End col -->
                </div>
                <!-- End row -->
            </div>
        </div>
        <!-- End Container -->
    </div>
    <!-- End Containerbar -->
    <!-- Start js -->
    <script src="<?= BASEURL ?>/assets/js/jquery.min.js"></script>
    <script src="<?= BASEURL ?>/assets/js/popper.min.js"></script>
    <script src="<?= BASEURL ?>/assets/js/bootstrap.min.js"></script>
    <script src="<?= BASEURL ?>/assets/js/modernizr.min.js"></script>
    <script src="<?= BASEURL ?>/assets/js/detect.js"></script>
    <script src="<?= BASEURL ?>/assets/js/jquery.slimscroll.js"></script>
    <!-- End js -->
</body>

</html>