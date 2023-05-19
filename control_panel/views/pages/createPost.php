<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Blog</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/control_panel/admin/index">Admin panel</a></li>
                        <li class="breadcrumb-item active">Create post</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Create new post</h3>
                        </div>
                    </div>
                </div>
            </div>
            <form action="/control_panel/adminblog/createPost" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="form-group">
                        <label>Post title</label>
                        <input name="title" type="text" class="form-control" placeholder="Post title">
                    </div>
                    <div class="form-group">
                        <label>Slogan</label>
                        <textarea name="slogan" class="form-control" rows="1"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" class="form-control" rows="1"></textarea>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="exampleInputFile">Post image</label>
                                <div class="input-group">
                                    <input type="file" class="form-control" name="imgSrc">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <!-- textarea -->
                                <div class="form-group">
                                    <label>Image description (alt)</label>
                                    <input type="text" class="form-control" placeholder="Image description (alt)"
                                           name="imgAlt">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="exampleInputFile">Categories</label>
                                <div class="input-group">

                                    <select class="form-control" name="categoryId">
                                        <?php
                                        foreach ($data['categories'] as $key => $value) {
                                            ?>
                                            <option value="<?= $value['id'] ?>"> <?= $value['category'] ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>

                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Keywords</label>
                                    <input type="text" class="form-control" placeholder="keywords" name="keywords">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Post body</label>
                        <textarea id="summernote" class="form-control" name="content"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Tags</label>
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title">Bootstrap Duallistbox</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Multiple</label>
                                            <select name="tags[]" class="duallistbox" multiple="multiple">
                                                <?php
                                                foreach ($data['tags'] as $key => $value) {
                                                    ?>
                                                    <option value="<?= $value['id'] ?>"> <?= $value['tag'] ?></option>                                            <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success float-right">Create post</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>

<script>
    window.addEventListener('load', () => {
        $(function () {
            $('#summernote').summernote()
        })
        //Bootstrap Duallistbox
        $('.duallistbox').bootstrapDualListbox()
    })
</script>
