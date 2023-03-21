<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin panel | Log in</title>

    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="/control_panel/static/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="/control_panel/static/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="/control_panel/static/dist/css/adminlte.min.css">
</head>
<body>

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

<? require_once $contentView; ?>

<script src="/control_panel/static/plugins/jquery/jquery.min.js"></script>
<script src="/control_panel/static/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/control_panel/static/dist/js/adminlte.min.js"></script>
</body>
</html>
