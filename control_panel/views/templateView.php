<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/control_panel/static/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
          href="/control_panel/static/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="/control_panel/static/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="/control_panel/static/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/control_panel/static/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="/control_panel/static/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="/control_panel/static/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="/control_panel/static/plugins/summernote/summernote-bs4.min.css">
    <link rel="stylesheet" href="/control_panel/static/dist/css/style.css">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="/control_panel/static/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="/control_panel/static/dist/img/AdminLTELogo.png" alt="AdminLTELogo"
             height="60" width="60">
    </div>

    <!-- Navbar -->
    <? require_once ADM_VIEWS_PATH . "header.php"; ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <? require_once ADM_VIEWS_PATH . "sidebar.php"; ?>

    <?php if (!empty($data["success"])) { ?>
        <div class="alert-success text-center" role="alert">
            <?php
            echo $data["success"] ?>
        </div>
    <?php } ?>

    <?php if (!empty($data["error"])) { ?>
        <div class="alert-danger text-center" role="alert">
            <?php
            echo $data["error"] ?>
        </div>
    <?php } ?>
    <!-- Content Wrapper. Contains page content -->
    <? require_once $contentView; ?>
    <!-- /.content-wrapper -->

    <? require_once ADM_VIEWS_PATH . "footer.php"; ?>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="/control_panel/static/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="/control_panel/static/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="/control_panel/static/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="/control_panel/static/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- ChartJS -->
<script src="/control_panel/static/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="/control_panel/static/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="/control_panel/static/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="/control_panel/static/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="/control_panel/static/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="/control_panel/static/plugins/moment/moment.min.js"></script>
<script src="/control_panel/static/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="/control_panel/static/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="/control_panel/static/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="/control_panel/static/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="/control_panel/static/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/control_panel/static/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="/control_panel/static/dist/js/pages/dashboard.js"></script>
</body>
</html>