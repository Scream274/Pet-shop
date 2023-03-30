<!-- Blog Start -->
<link href="/static/css/comments.css" rel="stylesheet">

<div class="container py-5">
    <div class="row g-5">
        <!-- Blog list Start -->
        <?php if ($data["onePost"] == null) { ?>
            <div class="col-lg-8">
                <?php
                foreach ($data["posts"] as $key => $post) { ?>
                    <div class="blog-item mb-5">
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
                                        <small><i class="bi bi-calendar-date me-2"></i><?= $post["published_date"] ?>
                                        </small>
                                    </div>
                                    <h5 class="text-uppercase mb-3"><?= $post["title"] ?></h5>
                                    <p><?= $post["description"] ?></p>
                                    <a class="text-primary text-uppercase" href="/blog/postById?Id=<?= $post["id"] ?>">Read
                                        More<i class="bi bi-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div> <?php }
                ?>
                <div class="col-12">
                    <nav aria-label="Page navigation">
                        <ul class="pagination pagination-lg m-0">
                            <li class="page-item disabled">
                                <a class="page-link rounded-0" href="#" aria-label="Previous">
                                    <span aria-hidden="true"><i class="bi bi-arrow-left"></i></span>
                                </a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link rounded-0" href="#" aria-label="Next">
                                    <span aria-hidden="true"><i class="bi bi-arrow-right"></i></span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        <?php } else {
        ?>
        <!-- Blog Start -->
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-8">
                    <!-- Blog Detail Start -->
                    <div class="mb-5">
                        <p class="d-none postId"><?= $data["onePost"]["id"] ?> </p>
                        <img class="img-fluid w-100 rounded mb-5" src="<?= $data["onePost"]["post_img"] ?>" alt="">
                        <div class="d-flex mb-3">
                            <small class="me-3"><i
                                        class="bi bi-bookmarks me-2"></i><?= $data["categories"][$data["onePost"]["category_Id"] - 1]["category"] ?>
                            </small>
                            <small><i class="bi bi-calendar-date me-2"></i><?= $data["onePost"]["published_date"] ?>
                            </small>
                        </div>
                        <h1 class="text-uppercase mb-4"><?= $data["onePost"]["title"] ?></h1>
                        <div class="post"><?= $data["onePost"]["content"] ?></div>
                    </div>
                    <!-- Blog Detail End -->

                    <!-- Comment List Start -->
                    <div class="mb-5 comment_list_container">
                        <h3 class="text-uppercase border-start border-5 border-primary ps-3 mb-4"><?= $data["onePost"]["count_comments"] ?>
                            Comments</h3>
                    </div>
                    <!-- Comment List End -->

                    <div class="alert alert-success text-center h5" id="success-alert" style="display:none">Your comment
                        has been sent for moderation!
                    </div>

                    <!-- Comment Form Start -->
                    <div class="bg-light rounded p-5" id="form">
                        <h3 class="text-uppercase border-start border-5 border-primary ps-3 mb-4">Leave a comment</h3>
                        <form class="comment_form">
                            <div class="row g-3">
                                <div class="col-12 col-sm-6">
                                    <input name="login" type="text" class="form-control bg-white border-0"
                                           placeholder="Your Name" style="height: 55px;">
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input name="email" type="email" class="form-control bg-white border-0"
                                           placeholder="Your Email" style="height: 55px;">
                                </div>
                                <div class="col-12">
                                    <textarea name="comment" class="form-control bg-white border-0" rows="5"
                                              placeholder="Comment"></textarea>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3 comment_button" type="button">Leave Your
                                        Comment
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Comment Form End -->
                </div>

                <?php } ?>
                <!-- Blog list End -->

                <!-- Sidebar Start -->
                <div class="col-lg-4">
                    <!-- Search Form Start -->
                    <div class="mb-5">
                        <form name="form" method="get" action="/blog/getPostsByKeyword">
                            <div class="input-group">
                                <input name="keyword" type="text" class="form-control p-3" placeholder="Keyword">
                                <button type="submit" class="btn btn-primary px-4"><i class="bi bi-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <!-- Search Form End -->

                    <!-- Category Start -->
                    <div class="mb-5">
                        <h3 class="text-uppercase border-start border-5 border-primary ps-3 mb-4">Categories</h3>
                        <div class="d-flex flex-column justify-content-start">
                            <?php foreach ($data["categories"] as $key => $category) { ?>
                                <a class="h5 bg-light py-2 px-3 mb-2"
                                   href="/blog/allPostsByCategory?Id=<?= $category['id'] ?>"><i
                                            class="bi bi-arrow-right me-2"></i><?= $category["category"] ?></a>
                            <?php } ?>
                        </div>
                    </div>
                    <!-- Category End -->

                    <!-- Recent Post Start -->
                    <div class="mb-5">
                        <h3 class="text-uppercase border-start border-5 border-primary ps-3 mb-4">Recent Post</h3>
                        <?php foreach ($data["posts"] as $key => $post) { ?>
                            <div class="d-flex overflow-hidden mb-3">
                                <img class="img-fluid" src="<?= $post["post_img"] ?>"
                                     style="width: 100px; height: 100px; object-fit: cover;" alt="">
                                <a href="/blog/postById?Id=<?= $post["id"] ?>"
                                   class="h5 d-flex align-items-center bg-light px-3 mb-0"><?= $post["title"] ?>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                    <!-- Recent Post End -->

                    <!-- Image Start -->
                    <div class="mb-5">
                        <img src="/static/img/blog-1.jpg" alt="" class="img-fluid rounded">
                    </div>
                    <!-- Image End -->

                    <!-- Tags Start -->
                    <div class="mb-5">
                        <h3 class="text-uppercase border-start border-5 border-primary ps-3 mb-4">Tag Cloud</h3>
                        <div class="d-flex flex-wrap m-n1">
                            <?php foreach ($data["tags"] as $key => $tag) { ?>

                                <a href="/blog/allPostsByTagId?Id=<?= $tag['id'] ?>"
                                   class="btn btn-primary m-1"><?= $tag["tag"] ?></a>

                            <?php } ?>
                        </div>
                    </div>
                    <!-- Tags End -->

                    <!-- Plain Text Start -->
                    <div>
                        <h3 class="text-uppercase border-start border-5 border-primary ps-3 mb-4">Plain Text</h3>
                        <div class="bg-light text-center" style="padding: 30px;">
                            <p>Vero sea et accusam justo dolor accusam lorem consetetur, dolores sit amet sit dolor
                                clita kasd justo, diam accusam no sea ut tempor magna takimata, amet sit et diam dolor
                                ipsum amet diam</p>
                            <a href="" class="btn btn-primary py-2 px-4">Read More</a>
                        </div>
                    </div>
                    <!-- Plain Text End -->
                </div>
                <!-- Sidebar End -->
            </div>
        </div>
        <script src="/static/js/onePostComments.js"></script>
        <!-- Blog End -->