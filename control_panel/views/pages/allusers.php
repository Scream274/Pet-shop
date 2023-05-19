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
                        <li class="breadcrumb-item active">Users</li>
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
                            <h3 class="card-title">All users</h3>
                        </div>
                        <div class="card-body">
                            <p>
                                <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button"
                                   aria-expanded="false" aria-controls="collapseExample">
                                    Create new user
                                </a>
                            </p>
                            <div class="collapse" id="collapseExample">
                                <div class="card card-warning">
                                    <div class="card-header">
                                        <h3 class="card-title">New user</h3>
                                    </div>
                                    <form method="post" action="/control_panel/user/createUser">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="newOptionName">Login</label>
                                                <input type="text" class="form-control" id="newOptionName" placeholder="Login" name="login">
                                            </div>
                                            <div class="form-group">
                                                <label for="newOptionValue">Email</label>
                                                <input type="text" class="form-control" id="newOptionValue" placeholder="Email" name="email">
                                            </div>                                            <div class="form-group">
                                                <label for="newOptionValue">Password</label>
                                                <input type="text" class="form-control" id="newOptionValue" placeholder="Password" name="password">
                                            </div>
                                            <div class="form-group">
                                                <label for="newOptionGroup">Role</label>
                                                <select class="form-control" name="role">
                                                    <?php foreach ($data['roles'] as $role): ?>
                                                            <option value="<?= $role['id'] ?>"
                                                                    selected><?= $role['role_value'] ?></option>
                                                    <?php endforeach; ?>
                                                </select></div>
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
                                    <input type="text" class="form-control text-center" placeholder="Login" readonly>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control text-center" placeholder="Email" readonly>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control text-center" placeholder="Role" readonly>
                                </div>
                                <div class="col-2">
                                    <input type="text" class="form-control text-center" placeholder="Controls" readonly>
                                </div>
                            </div>
                        </div>
                        <?php
                        foreach ($data['users'] as $key => $user) {
                            ?>
                            <form method="post" action="/control_panel/user/updateUser">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-1">
                                            <input name="Id" value="<?= $user['Id'] ?>" type="text"
                                                   class="form-control text-center" placeholder="Id"
                                                   readonly>
                                        </div>
                                        <div class="col-3">
                                            <input value="<?= $user['login'] ?>" type="text" class="form-control"
                                                   placeholder="Login" name="login">
                                        </div>
                                        <div class="col-3">
                                            <input value="<?= $user['email'] ?>" type="text" class="form-control"
                                                   placeholder="Email" name="email">
                                        </div>
                                        <div class="col-3">
                                            <select class="form-control" name="role">
                                                <?php foreach ($data['roles'] as $role): ?>
                                                    <?php if ($role['role_value'] == $user['role_name']): ?>
                                                        <option value="<?= $role['id'] ?>"
                                                                selected><?= $role['role_value'] ?></option>
                                                    <?php else: ?>
                                                        <option value="<?= $role['id'] ?>"><?= $role['role_value'] ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </select></div>
                                        <div class="col-2 text-center">
                                            <button type="reset" class="btn btn-warning">Reset</button>
                                            <button type="submit" class="btn btn-success">Update</button>
                                            <button onclick="location.href='/control_panel/user/deleteUser?id=<?= $user['Id'] ?>'"
                                                    type="button" class="btn btn-danger">X
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