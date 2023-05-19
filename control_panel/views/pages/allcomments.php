<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Options</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/control_panel/admin/index">Admin panel</a></li>
                        <li class="breadcrumb-item active">Comments</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">All comments</h3>
                        </div>
                        <div class="card-body">
                            <p>
                                <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button"
                                   aria-expanded="false" aria-controls="collapseExample">
                                    Create new option
                                </a>
                            </p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-1">
                                    <input type="text" class="form-control text-center" placeholder="Id" readonly>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control text-center" placeholder="Name" readonly>
                                </div>
                                <div class="col-5">
                                    <input type="text" class="form-control text-center" placeholder="Email" readonly>
                                </div>
                                <div class="col-1">
                                    <input type="text" class="form-control text-center" placeholder="Message" readonly>
                                </div>
                                <div class="col-2">
                                    <input type="text" class="form-control text-center" placeholder="Controls" readonly>
                                </div>
                            </div>
                        </div>
                        <?php
                        foreach ($data['comments'] as $key => $comm) {
                            ?>
                            <form method="post" action="/control_panel/adminblog/updateComment">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-1">
                                            <input name="id" value="<?= $comm['id'] ?>" type="text"
                                                   class="form-control text-center" placeholder="id"
                                                   readonly>
                                        </div>
                                        <div class="col-3">
                                            <input value="<?= $comm['login'] ?>" type="text" class="form-control"
                                                   placeholder="Login" name="login" readonly>
                                        </div>
                                        <div class="col-5">
                                            <input value="<?= $comm['email'] ?>" type="text" class="form-control"
                                                   placeholder="Email" name="email" readonly>
                                        </div>
                                        <div class="col-1">
                                            <input value="<?= $comm['comment'] ?>" type="text" class="form-control"
                                                   placeholder="Comment" name="comment">
                                        </div>
                                        <div class="col-2 text-center">
                                            <button type="reset" class="btn btn-warning">Reset</button>
                                            <button type="submit" class="btn btn-success">Update</button>
                                            <button onclick="location.href='/control_panel/adminblog/deleteComment?id=<?= $comm['id'] ?>'"
                                                    type="button" class="btn btn-danger">X
                                            </button>
                                            <?php if (!$comm['verified']) { ?>
                                                <button onclick="location.href='/control_panel/adminblog/verifyComment?id=<?= $comm['id'] ?>'"
                                                        type="button" class="btn btn-light">✔
                                                </button>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>