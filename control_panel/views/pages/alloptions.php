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
                        <li class="breadcrumb-item active">Options</li>
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
                            <h3 class="card-title">All options</h3>
                        </div>
                        <div class="card-body">
                            <p>
                                <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button"
                                   aria-expanded="false" aria-controls="collapseExample">
                                    Create new option
                                </a>
                            </p>
                            <div class="collapse" id="collapseExample">
                                <div class="card card-warning">
                                    <div class="card-header">
                                        <h3 class="card-title">New options</h3>
                                    </div>
                                    <form method="post" action="/control_panel/config/createOption">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="newOptionName">Name</label>
                                                <input type="text" class="form-control" id="newOptionName" placeholder="Name" name="name">
                                            </div>
                                            <div class="form-group">
                                                <label for="newOptionValue">Value</label>
                                                <input type="text" class="form-control" id="newOptionValue" placeholder="Value" name="value">
                                            </div>
                                            <div class="form-group">
                                                <label for="newOptionGroup">Group</label>
                                                <input type="text" class="form-control" id="newOptionGroup" placeholder="Group" name="group">
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <button class="btn btn-danger" type="reset" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                                Cancel
                                            </button>
                                            <button type="submit" class="btn btn-success">Create</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
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
                                    <input type="text" class="form-control text-center" placeholder="Value" readonly>
                                </div>
                                <div class="col-1">
                                    <input type="text" class="form-control text-center" placeholder="Group" readonly>
                                </div>
                                <div class="col-2">
                                    <input type="text" class="form-control text-center" placeholder="Controls" readonly>
                                </div>
                            </div>
                        </div>
                        <?php
                        foreach ($data['options'] as $key => $option) {
                            ?>
                            <form method="post" action="/control_panel/config/updateOption">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-1">
                                            <input name="Id" value="<?= $option['Id'] ?>" type="text" class="form-control text-center" placeholder="Id"
                                                   readonly>
                                        </div>
                                        <div class="col-3">
                                            <input value="<?= $option['name'] ?>" type="text" class="form-control" placeholder="Name" name="name" >
                                        </div>
                                        <div class="col-5">
                                            <input value="<?= $option['value'] ?>" type="text" class="form-control" placeholder="Value" name="value">
                                        </div>
                                        <div class="col-1">
                                            <input value="<?= $option['group'] ?>" type="text" class="form-control" placeholder="Group" name="group">
                                        </div>
                                        <div class="col-2 text-center">
                                            <button type="reset" class="btn btn-warning">Reset</button>
                                            <button type="submit" class="btn btn-success">Update</button>
                                            <?php if(!$option['isSystem']){ ?>
                                            <button onclick="location.href='/control_panel/config/deleteOption?id=<?= $option['Id'] ?>'" type="button" class="btn btn-danger">X
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