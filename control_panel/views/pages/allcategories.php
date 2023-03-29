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
                            <h3 class="card-title">All categories</h3>
                        </div>
                        <div class="card-body">
                            <p>
                                <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button"
                                   aria-expanded="false" aria-controls="collapseExample">
                                    Create category
                                </a>
                            </p>
                            <div class="collapse" id="collapseExample">
                                <div class="card card-warning">
                                    <div class="card-header">
                                        <h3 class="card-title">New Category</h3>
                                    </div>
                                    <form method="post" action="/control_panel/Categories/createCategory" enctype="multipart/form-data">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="categoryTitle">Category title:</label>
                                                <input type="text" class="form-control" id="categoryTitle" placeholder="Name" name="category">
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Description: </label>
                                                <textarea type="text" class="form-control" id="description" name="description"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Category image</label>
                                                <input type="file" class="form-control" name="imgSrc">
                                            </div>
                                            <div class="form-group">
                                                <label>Image description (alt)</label>
                                                <input type="text" class="form-control" placeholder="Image description" name="imgAlt">
                                            </div>
                                            <div class="form-group">
                                                <label>Slug</label>
                                                <input type="text" class="form-control" placeholder="slug" name="slug">
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

                        <div class="card-body row">
                            <?php
                            foreach ($data['categories'] as $key => $value){
                                ?>
                                <div class="card card-warning col-md-3">
                                    <div class="card-header">
                                        <h3 class="card-title">Manage category</h3>
                                    </div>
                                    <div class="card-body">
                                        <form method="post" action="/control_panel/Categories/updateCategory" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label class="col-form-label" for="inputSuccess"><i
                                                            class="fas fa-check"></i> Category title: </label>
                                                <input name="category" type="text" class="form-control" value="<?= $value['category'] ?>"/>
                                            </div>
                                            <div class="row">
                                                <div class="col-1">
                                                    <input name="id" value="<?= $value['id'] ?>" type="hidden" class="form-control text-center" placeholder="id"
                                                           readonly>
                                                </div>
                                                <div class="col-sm img_block">
                                                    <!-- text input -->
                                                    <div class="col-1">
                                                        <input name="src" value="<?= $value['img_src']?>" type="hidden" class="form-control text-center" placeholder="src"
                                                               readonly>
                                                    </div>
                                                    <div class="form-group text-center">
                                                        <img  src="<?= $value['img_src']?>" alt="<?= $value['img_alt']?>" style="max-width:80%">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm">
                                                    <div class="form-group">
                                                        <input value="<?= $value['img_src']?>" name="imgSrc" class="form-control" type='file'/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-form-label" for="inputWarning"><i class="fas fa-check"></i> Img alt</label>
                                                <input name="imgAlt" type="text" class="form-control is-warning" id="inputWarning" value="<?= $value['img_alt']?>">
                                            </div>
                                            <div class="form-group">
                                                <label class="col-form-label" for="inputSuccess"><i
                                                            class="fas fa-check"></i> Category description: </label>
                                                <textarea name="description" type="text" class="form-control is-valid" id="inputSuccess" rows="5"><?= $value['description'] ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-form-label" for="inputWarning"><i class="far fa-bell"></i> Slug</label>
                                                <input name="slug" type="text" class="form-control is-warning" id="inputWarning" placeholder="Slug" value="<?= $value['slug']?>">
                                            </div>
                                            <div class="form-group text-right">
                                                <button class="btn btn-warning" type="reset"  aria-expanded="false" >
                                                    Cancel
                                                </button>
                                                <button type="submit" class="btn btn-success">Update</button>
                                                <button onclick="location.href='/control_panel/Categories/deleteCategory?id=<?= $value['id'] ?>'" type="button" class="btn btn-danger">X
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

