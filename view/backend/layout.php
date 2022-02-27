<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/css/style_backend.css ">
    <!-- Tell the browser to be responsive to screen width -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/node_modules/slick-1.8.1/slick/slick.css" />
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/datatables-responsive/css/responsive.bootstrap4.min.css">
    <!-- slide use slick -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/node_modules/slick-1.8.1/slick/slick-theme.css" />
    <!-- Select2 -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/fontawesome-free/css/all.min.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- summernote -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/summernote/summernote-bs4.css">

    <link rel="stylesheet" href="<?= BASE_URL ?>/public/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini layout-fixed">

    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?= BASE_URL ?>/?module=backend" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li>
            </ul>

            <!-- SEARCH FORM -->
            <form class="form-inline ml-3">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-comments"></i>
                        <span class="badge badge-danger navbar-badge">3</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Brad Diesel
                                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">Call me whenever you can...</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        John Pierce
                                        <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">I got your message bro</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Nora Silvester
                                        <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">The subject goes here</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                    </div>
                </li>
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"><i class="fas fa-th-large"></i></a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?= BASE_URL ?>/public/content/images/user/<?= $_SESSION['ma_kh']['hinh'] ?>" class="img-circle elevation-2 alt=" User Image">
                    </div>
                    <div class="info">
                        <a href="<?= BASE_URL ?>?module=backend&controller=user&action=view&id=<?= $_SESSION['ma_kh']['ma_kh'] ?>" class="d-block"><?= $_SESSION['ma_kh']['ho_ten'] ?></a>
                    </div>
                </div>

                <!-- Sidebar Menu -->

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <!-- user -->
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                        <li class="nav-item has-treeview">
                            <a href="" class="nav-link">
                                <i class="nav-icon fas fa-user-tie"></i>
                                <p>
                                    User
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="?module=backend&controller=user&action=list" class="nav-link">
                                        <i class="fas fa-list-ul"></i>
                                        <p>LIST USER</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="?module=backend&controller=user&action=add" class="nav-link">
                                        <i class="fas fa-user-plus"></i>
                                        <p>ADD USER</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <!-- end-user -->
                    <!-- product -->
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                        <li class="nav-item has-treeview">
                            <a href="" class="nav-link">
                                <i class="nav-icon fas fa-folder-plus"></i>
                                <p>
                                    Product
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="?module=backend&controller=product&action=list" class="nav-link">
                                        <i class="fas fa-list-ul"></i>
                                        <p>LIST PRODUCT</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="?module=backend&controller=product&action=add" class="nav-link">
                                        <i class="fas fa-plus-circle"></i>
                                        <p>ADD PRODUCT</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <!-- end product -->
                    <!-- cateogries -->
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                        <li class="nav-item has-treeview">
                            <a href="" class="nav-link">
                                <i class="nav-icon fas fa-clipboard-list"></i>
                                <p>
                                    Categories
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="?module=backend&controller=categories&action=list" class="nav-link">
                                        <i class="fas fa-list-ul"></i>
                                        <p>LIST CATEGORIES</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="?module=backend&controller=categories&action=add" class="nav-link">
                                        <i class="fas fa-plus-circle"></i>
                                        <p>ADD CATEGORIES</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <!-- end categories -->
                    <!-- trademark -->
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                        <li class="nav-item has-treeview">
                            <a href="" class="nav-link">
                                <i class="nav-icon fas fa-trademark"></i>
                                <p>
                                    Trademark
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="?module=backend&controller=trademark&action=list" class="nav-link">
                                        <i class="fas fa-list-ul"></i>
                                        <p>LIST TRADEMARK</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="?module=backend&controller=trademark&action=add" class="nav-link">
                                        <i class="fas fa-plus-circle"></i>
                                        <p>ADD TRADEMARK</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <!-- end trademark -->
                    <!-- comment -->
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                        <li class="nav-item has-treeview">
                            <a href="" class="nav-link">
                                <i class="fas fa-comments"></i>
                                <p>
                                    Comment
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="?module=backend&controller=comment&action=list" class="nav-link">
                                        <i class="fas fa-list-ul"></i>
                                        <p>LIST COMMENT</p>
                                    </a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a href="?module=backend&controller=categories&action=add" class="nav-link">
                                        <i class="fas fa-plus-circle"></i>
                                        <p>ADD CATEGORIES</p>
                                    </a>
                                </li> -->
                            </ul>
                        </li>
                    </ul>
                    <!-- end comment -->
                    <!-- posts -->
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item has-treeview">
                            <a href="" class="nav-link">
                                <i class="fas fa-pen-nib"></i>
                                <p>
                                    Posts
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="?module=backend&controller=posts&action=list" class="nav-link">
                                        <i class="fas fa-list-ul"></i>
                                        <p>LIST POSTS</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="?module=backend&controller=posts&action=add" class="nav-link">
                                        <i class="fas fa-plus-circle"></i>
                                        <p>ADD POST</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <!-- end posts -->
                    <!-- slide -->
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item has-treeview">
                            <a href="" class="nav-link">

                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="?module=backend&controller=slide&action=list" class="nav-link">
                                        <i class="fas fa-list-ul"></i>
                                        <p>LIST SLIDER</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="?module=backend&controller=slide&action=add" class="nav-link">
                                        <i class="fas fa-plus-circle"></i>
                                        <p>ADD SLIDER</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <!-- end slide -->
                    <!-- Đơn hàng -->
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                        <li class="nav-item has-treeview">
                            <a href="" class="nav-link">
                                <i class="fas fa-shopping-cart"></i>
                                <p>
                                    Order
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="?module=backend&controller=order&action=list" class="nav-link">
                                        <i class="fas fa-list-ul"></i>
                                        <p>LIST ORDER</p>
                                    </a>
                                </li>
                                <!-- <li class="nav-item">
            <a href="?module=backend&controller=categories&action=add" class="nav-link">
                <i class="fas fa-plus-circle"></i>
                <p>ADD CATEGORIES</p>
            </a>
        </li> -->
                            </ul>
                        </li>
                    </ul>
                    <!-- end comment -->
                    <a href="?controller=user&action=logout">ĐĂNG XUẤT</a>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <!-- Default box -->
                            <div class="card">
                                <div class="card-body">
                                    <?php require_once APP_PATH . '/view/' . $module . '/' . $view_name; ?>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
    </div>
    <!-- ./wrapper -->
    <!-- Main Footer -->
    <footer class="main-footer">
        <strong>Copyright &copy; 2020<a href="http://adminlte.io">Admin V-Shop</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 3.0.5
        </div>
    </footer>
    <!-- ./wrapper -->
    <!-- jQuery -->
    <script src="<?= BASE_URL ?>/public/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= BASE_URL ?>/public/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="<?= BASE_URL ?>/public/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= BASE_URL ?>/public/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?= BASE_URL ?>/public/dist/js/demo.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="<?= BASE_URL ?>/public/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Bootstrap Switch -->
    <script src="<?= BASE_URL ?>/public/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <!-- Summernote -->
    <script src="<?= BASE_URL ?>/public/summernote/summernote-bs4.min.js"></script>
    <!-- vshoop check list -->
    <script src="<?= BASE_URL ?>/public/checklist/vshop-list.js"></script>
    <!-- chart -->
    <script src="<?= BASE_URL ?>/public/chart.js/Chart.min.js"></script>
    <!--slick -->
    <script src="<?= BASE_URL ?>/public/node_modules/slick-1.8.1/slick/slick.min.js"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="<?= BASE_URL ?>/public/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
    <!-- Select2 -->
    <script src="<?= BASE_URL ?>/public/select2/js/select2.full.min.js"></script>
    <!-- DataTables -->
    <script src="<?= BASE_URL ?>/public/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= BASE_URL ?>/public/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= BASE_URL ?>/public/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= BASE_URL ?>/public/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <!-- sumernote -->
    <script>
        $(function() {
            // Summernote
            $('.textarea').summernote()
        })
    </script>
    <!-- chart -->
    <script>
        $(function() {
            //-------------
            //- DONUT CHART -
            //-------------
            // Get context with jQuery - using jQuery's .get() method.
            var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
            var donutData = {
                labels: [<?php
                            foreach ($count_product_cate as $item) {
                                echo "'$item[ten_mh]'" . ',';
                            }

                            ?>],
                datasets: [{
                    // data: [700, 500, 400, 600, 300, 100],
                    data: [<?php
                            foreach ($count_product_cate as $item) {
                                echo "'$item[so_luong]'" . ',';
                            }

                            ?>],

                    backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
                }]
            }
            var donutOptions = {
                maintainAspectRatio: false,
                responsive: true,
            }
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            var donutChart = new Chart(donutChartCanvas, {
                type: 'doughnut',
                data: donutData,
                options: donutOptions
            })
            /* ChartJS
             * -------
             * Here we will create a few charts using ChartJS
             */

            //--------------
            //- AREA CHART -
            //--------------

            // Get context with jQuery - using jQuery's .get() method.
            var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

            var areaChartData = {
                // labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                labels: [
                    <?php
                    foreach ($sum_cart_by_day as $item) {
                        echo "'$item[ngay_lap]'" . ',';
                    }

                    ?>

                ],
                datasets: [
                    // {
                    // label: 'Digital Goods',
                    // backgroundColor: 'rgba(60,141,188,0.9)',
                    // borderColor: 'rgba(60,141,188,0.8)',
                    // pointRadius: false,
                    // pointColor: '#3b8bba',
                    // pointStrokeColor: 'rgba(60,141,188,1)',
                    // pointHighlightFill: '#fff',
                    // pointHighlightStroke: 'rgba(60,141,188,1)',
                    // // data: [28, 48, 40, 19, 86, 27, 90]
                    // // data: [
                    // // <?php
                            //     //       foreach ($count_product_day_arr as $item) {
                            //     //         echo $item['total_product'].',';
                            //     //       }
                            //     //       
                            ?>
                    // // ]
                    // },
                    {
                        // label: 'Electronics',
                        label: 'Tổng Tiền Trong Ngày',
                        // backgroundColor: 'rgba(210, 214, 222, 1)',
                        backgroundColor: 'green',
                        borderColor: 'rgba(210, 214, 222, 1)',
                        pointRadius: false,
                        pointColor: 'rgba(210, 214, 222, 1)',
                        pointStrokeColor: '#c1c7d1',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(220,220,220,1)',
                        data: [
                            <?php
                            foreach ($sum_cart_by_day as $item) {
                                echo $item['tong_tien'] . ',';
                            }
                            ?>
                        ]
                    },
                ]
            }

            var areaChartOptions = {
                maintainAspectRatio: false,
                responsive: true,
                legend: {
                    display: false
                },
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: false,
                        }
                    }],
                    yAxes: [{
                        gridLines: {
                            display: false,
                        }
                    }]
                }
            }

            // This will get the first returned node in the jQuery collection.
            var areaChart = new Chart(areaChartCanvas, {
                type: 'line',
                data: areaChartData,
                options: areaChartOptions
            })
        })
    </script>
    <!-- slide -->
    <script>
        $('.slick_slide').slick({
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 1
        });
    </script>
    <!-- data table -->
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": false,
                "paging": false,
                "lengthChange": false,
                "ordering": true,
                "info": false,
            });

        });
    </script>
    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()

        })
    </script>
</body>

</html>