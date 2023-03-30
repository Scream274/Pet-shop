<!-- Hero Start -->
<div class="container-fluid bg-primary py-5 mb-5 hero-header">
    <div class="container py-5">
        <div class="row justify-content-start">
            <div class="col-lg-8 text-center text-lg-start">
                <h1 class="display-1 text-uppercase text-dark mb-lg-4">Pet Shop</h1>
                <h1 class="text-uppercase text-white mb-lg-4">Make Your Pets Happy</h1>
                <p class="fs-4 text-white mb-lg-4">We love pets, and we believe loving pets makes us better people.
                    That’s one of the many reasons we do Anything for Pets – because they will do anything for us.</p>
                <div class="d-flex align-items-center justify-content-center justify-content-lg-start pt-5">
                    <a href="" class="btn btn-outline-light border-2 py-md-3 px-md-5 me-5">Read More</a>
                    <button type="button" class="btn-play" data-bs-toggle="modal"
                            data-src="https://www.youtube.com/embed/cvGQQEXRWLo" data-bs-target="#videoModal">
                        <span></span>
                    </button>
                    <h5 class="font-weight-normal text-white m-0 ms-4 d-none d-sm-block">Play Video</h5>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Hero End -->

<!-- Video Modal Start -->
<div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content rounded-0">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Youtube Video</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- 16:9 aspect ratio -->
                <div class="ratio ratio-16x9">
                    <iframe class="embed-responsive-item" src="" id="video" allowfullscreen allowscriptaccess="always"
                            allow="autoplay"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Video Modal End -->


<?php require_once VIEW_PATH . "about_block" . EXT; ?>

<?php require_once VIEW_PATH . "service_block" . EXT; ?>

<?php require_once VIEW_PATH . "product_block" . EXT; ?>

<?php require_once VIEW_PATH . "spec_offer" . EXT; ?>

<?php require_once VIEW_PATH . "pricing_plan" . EXT; ?>

<?php require_once VIEW_PATH . "team" . EXT; ?>

<?php require_once VIEW_PATH . "testimonial" . EXT; ?>

<!-- Blog Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="border-start border-5 border-primary ps-5 mb-5" style="max-width: 600px;">
            <h6 class="text-primary text-uppercase">Latest Blog</h6>
            <h1 class="display-5 text-uppercase mb-0">Latest Articles From Our Blog Post</h1>
        </div>
        <div class="row g-5">
            <?php foreach ($data["posts"] as $key => $post) { ?>
                <div class="col-lg-6">
                    <div class="blog-item">
                        <div class="row g-0 bg-light overflow-hidden">
                            <div class="col-12 col-sm-5 h-100">
                                <img class="img-fluid h-100" src="<?= $post["post_img"] ?>" style="object-fit: cover;">
                            </div>
                            <div class="col-12 col-sm-7 h-100 d-flex flex-column justify-content-center">
                                <div class="p-4">
                                    <div class="d-flex mb-3">
                                        <small class="me-3"><i
                                                    class="bi bi-bookmarks me-2"></i><?= $data["categories"][$post["category_Id"] - 1]["category"] ?>
                                        </small>
                                        <small><i class="bi bi-calendar-date me-2"></i><?= $post["created_date"] ?>
                                        </small>
                                    </div>
                                    <h5 class="text-uppercase mb-3"><?= $post["title"] ?></h5>
                                    <p><?= $post["slogan"] ?></p>
                                    <a class="text-primary text-uppercase" href="/blog/postById?Id=<?= $post["id"] ?>">Read
                                        More<i class="bi bi-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<!-- Blog End -->