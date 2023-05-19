<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Categories</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/control_panel/admin/index">Admin panel</a></li>
                        <li class="breadcrumb-item active">Categories</li>
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
                            <h3 class="card-title">All posts</h3>
                        </div>

                        <div class="card-body row">
                            <?php
                            foreach ($data['posts'] as $key => $post){
                                ?>
                                <div class="card card-warning col-md-3">
                                    <div class="card-header">
                                        <h3 class="card-title">Manage post</h3>
                                    </div>
                                    <div class="card-body">
                                        <form method="post" action="/control_panel/adminblog/updatePost" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label class="col-form-label" for="inputSuccess"><i
                                                            class="fas fa-check"></i> Post slogan: </label>
                                                <input name="title" type="text" class="form-control" value="<?= $post['title'] ?>"/>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-form-label" for="inputSuccess"><i
                                                            class="fas fa-check"></i> Post title: </label>
                                                <input name="slogan" type="text" class="form-control" value="<?= $post['slogan'] ?>"/>
                                            </div>
                                            <div class="row">
                                                    <input name="id" value="<?= $post['id'] ?>" type="hidden" class="form-control text-center" placeholder="id"
                                                           readonly>
                                                <div class="col-sm img_block">
                                                    <!-- text input -->
                                                    <div class="col-1">
                                                        <input name="imgSrc" value="<?= $post['post_img']?>" type="hidden" class="form-control text-center" placeholder="src"
                                                               readonly>
                                                    </div>
                                                    <div class="form-group text-center">
                                                        <img src="<?= $post['post_img']?>" alt="<?= $post['img_alt']?>" style="max-height:190px; max-width:100%">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm">
                                                    <div class="form-group">
                                                        <input value="<?= $post['post_img']?>" name="imgSrc" class="form-control" type='file'/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-form-label" for="inputWarning"><i class="fas fa-check"></i> Img alt</label>
                                                <input name="imgAlt" type="text" class="form-control is-warning" id="inputWarning" value="<?= $post['img_alt']?>">
                                            </div>
                                            <div class="form-group">
                                                <label class="col-form-label" for="inputSuccess"><i
                                                            class="fas fa-check"></i> Post description: </label>
                                                <textarea name="description" type="text" class="form-control is-valid" id="inputSuccess" rows="5"><?= $post['description'] ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-form-label" for="inputSuccess"><i
                                                            class="fas fa-check"></i> Post content: </label>
                                                <textarea name="content" type="text" class="form-control is-valid" id="inputSuccess" rows="5"><?= $post['content'] ?></textarea>
                                            </div>

                                            <div class="form-group">
                                                <select class="form-control" name="categoryId">
                                                    <?php
                                                    foreach ($data['categories'] as $key => $category) {
                                                        ?>
                                                        <option value="<?= $category['id'] ?>"> <?= $category['category'] ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
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
                                                                        foreach ($data['tags'] as $tag) {
                                                                            $selected = false;
                                                                            foreach ($post['tags'] as $postTag) {
                                                                                if ($postTag['id'] == $tag['id']) {
                                                                                    $selected = true;
                                                                                    break;
                                                                                }
                                                                            }
                                                                            ?>
                                                                            <option value="<?= $tag['id'] ?>" <?= $selected ? 'selected' : '' ?>><?= $tag['tag'] ?></option>
                                                                            <?php
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

                                            <div class="form-group">
                                                <label class="col-form-label" for="inputWarning"><i class="far fa-bell"></i> Keywords</label>
                                                <input name="keywords" type="text" class="form-control is-warning" id="inputWarning" placeholder="Slug" value="<?= $post['keywords']?>">
                                            </div>
                                            <div class="form-group text-right">
                                                <button class="btn btn-warning" type="reset"  aria-expanded="false" >
                                                    Cancel
                                                </button>
                                                <button type="submit" class="btn btn-success">Update</button>
                                                <button onclick="location.href='/control_panel/adminblog/deletePost?id=<?= $post['id'] ?>'" type="button" class="btn btn-danger">X
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            <? } ?>
                        </div>
                    </div>
                </div>
            </div>
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