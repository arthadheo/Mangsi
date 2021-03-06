<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Mangsi Coffee & Grill</title>

    <!-- Bootstrap core CSS -->
    <link href="dist/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <!-- <link href="dist/css/shop-homepage.css" rel="stylesheet"> -->
    <link href="dist/css/simple-sidebar.css" rel="stylesheet">
    
    <link rel="shortcut icon" href="http://localhost/Mangsi/dist/images/logo/Logo-mangsi.ico">
</head>

<body>

    <div class="d-flex" id="wrapper">

        <!-- Sidebar -->
        <div class="bg-light border-right" id="sidebar-wrapper">
            <h4 class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-text mx-3"><?= $_SESSION['userData']['first_name'] ?></div>
            </h4>
            <h6 class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-text mx-3"><?= $_SESSION['userData']['email'] ?></div>
            </h6>
            <h6 class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-text mx-3"><?= $_SESSION['userData']['point'] ?></div>
            </h6>
            <div class="list-group list-group-flush">
                <a href="#" class="list-group-item list-group-item-action bg-light">My Account</a>
                <a href="#" class="list-group-item list-group-item-action bg-light">My Coupon</a>
                <a href="#" class="list-group-item list-group-item-action bg-light">Reserve Table</a>
                <a href="#" class="list-group-item list-group-item-action bg-light">Setting</a>
                <a href="<?= base_url('auth/signing_out'); ?>" class="list-group-item list-group-item-action bg-light">Sign out</a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">

            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <a href="#" id="menu-toggle">
                    <img id="avatar" src="<?= base_url('dist/'); ?>images/profile/default.png" alt="thumbnail" width="200px" />
                </a>

                <a class="navbar-brand mx-auto" href="#">Start Bootstrap</a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                        <li class="nav-item active">
                            <a class="nav-link" href="<?= base_url(''); ?>">Home </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('coupon'); ?>">Coupon</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('store'); ?>">Store</a>
                        </li>
                    </ul>
                </div>
            </nav>