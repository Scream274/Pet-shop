<?php

use Myapp\NavigateModel;

?>
<!-- Topbar Start -->
<div class="container-fluid border-bottom d-none d-lg-block">
    <div class="row gx-0">
        <div class="col-lg-4 text-center py-2">
            <div class="d-inline-flex align-items-center">
                <i class="bi bi-geo-alt fs-1 text-primary me-3"></i>
                <div class="text-start">
                    <h6 class="text-uppercase mb-1">Our Office</h6>
                    <span><?= $data["options"]["address"]["value"] ?></span>
                </div>
            </div>
        </div>
        <div class="col-lg-4 text-center border-start border-end py-2">
            <div class="d-inline-flex align-items-center">
                <i class="bi bi-envelope-open fs-1 text-primary me-3"></i>
                <div class="text-start">
                    <h6 class="text-uppercase mb-1">Email Us</h6>
                    <span><?= $data["options"]["email"]["value"] ?></span>
                </div>
            </div>
        </div>
        <div class="col-lg-4 text-center py-2">
            <div class="d-inline-flex align-items-center">
                <i class="bi bi-phone-vibrate fs-1 text-primary me-3"></i>
                <div class="text-start">
                    <h6 class="text-uppercase mb-1">Call Us</h6>
                    <span><?= $data["options"]["phone"]["value"] ?></span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Topbar End -->


<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light shadow-sm py-3 py-lg-0 px-3 px-lg-0">
    <a href="/" class="navbar-brand ms-lg-5">
        <h1 class="m-0 text-uppercase text-dark">
            <img class="bi bi-shop fs-1 text-primary me-3 logo" src="<?= $data["options"]["logo"]["value"] ?>">
            <?= $data["options"]["title"]["value"] ?></h1>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto py-0">

            <?php
            $navigate = $data["navigate"];
            foreach ($navigate as $key => $value) {
                if (count($value["children"]) == 0) {
                    if ($value["order_value"] == 6) {
                        continue;
                    }
                    if ($value["order_value"] == 1) {
                        ?>
                        <a href="<?= $value["href"] ?>" class="nav-item nav-link active"><?= $value["title"] ?></a>
                        <?php
                    } else {
                        ?>
                        <a href="<?= $value["href"] ?>" class="nav-item nav-link"><?= $value["title"] ?></a><?php
                    }
                } else { ?>
                    <div class="nav-item dropdown">
                        <a href="<?= $value["href"] ?>" class="nav-link dropdown-toggle"
                           data-bs-toggle="dropdown"><?= $value["title"] ?></a>
                        <div class="dropdown-menu m-0">
                            <?php
                            foreach ($value["children"] as $childIndex => $child) {
                                ?>
                                <a href="<?= $child["href"] ?>" class="dropdown-item"><?= $child["title"] ?></a>
                            <?php }

                            ?>
                        </div>
                    </div>
                <?php }
            }
            $navModel = new NavigateModel();
            $contactRow = $navModel->getRowByName("contact");
            unset($navModel);
            ?>
            <a href="<?= $contactRow["href"] ?>"
               class="nav-item nav-link nav-contact bg-primary text-white px-5 ms-lg-5"><?= $contactRow["title"] ?>
                <i class="bi bi-arrow-right"></i></a>
        </div>
    </div>
</nav>
<!-- Navbar End -->