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
                        <li class="breadcrumb-item active">Tags</li>
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
                            <h3 class="card-title">All tags</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-1">
                                    <input type="text" class="form-control text-center" placeholder="Id" readonly>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control text-center" placeholder="Tag" readonly>
                                </div>
                                <div class="col-2">
                                    <input type="text" class="form-control text-center" placeholder="Controls" readonly>
                                </div>
                            </div>
                        </div>
                        <?php
                        foreach ($data['tags'] as $key => $option) {
                            ?>
                            <form method="post" action="/control_panel/adminblog/updateTag">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-1">
                                            <input name="Id" value="<?= $option['id'] ?>" type="text" class="form-control text-center" placeholder="Id"
                                                   readonly>
                                        </div>
                                        <div class="col-3">
                                            <input value="<?= $option['tag'] ?>" type="text" class="form-control" placeholder="Name" name="tag" >
                                        </div>
                                        <div class="col-2 text-center">
                                            <button type="reset" class="btn btn-warning">Reset</button>
                                            <button type="submit" class="btn btn-success">Update</button>
                                            <button onclick="location.href='/control_panel/adminblog/deleteTag?id=<?= $option['id'] ?>'" type="button" class="btn btn-danger">X
                                            </button>
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