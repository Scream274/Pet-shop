<!DOCTYPE html>
<html lang="<?= $data["options"]["lang"]["value"]?>" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <title><?= $data["options"]["title"]["value"]?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="<?= $data["options"]["keywords"]["value"]?>" name="keywords">
    <meta content="<?= $data["options"]["description"]["value"]?>" name="description">

    <!-- Favicon -->
    <link href="<?= $data["options"]["favicon"]["value"]?>" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Roboto:wght@700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="/static/lib/flaticon/font/flaticon.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="/static/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="/static/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="/static/css/style.css" rel="stylesheet">
</head>

<body>
<?php require_once VIEW_PATH . "header" . EXT; ?>

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

<?php require_once $contentView; ?>

<?php require_once VIEW_PATH . "footer" . EXT; ?>


<!-- Back to Top -->
<a href="#" class="btn btn-primary py-3 fs-4 back-to-top"><i class="bi bi-arrow-up"></i></a>


<!-- JavaScript Libraries -->
<script src="/static/js/jquery-3.6.3.min.js"> </script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="/static/lib/easing/easing.min.js"></script>
<script src="/static/lib/waypoints/waypoints.min.js"></script>
<script src="/static/lib/owlcarousel/owl.carousel.min.js"></script>

<!-- Template Javascript -->
<script src="/static/js/main.js"></script>
</body>

</html>