<?php

namespace Myapp;

class CategoriesController extends Controller
{

    function index()
    {
        if ($this->userAuth->isAuth()) {
            $catM = new CategoryModel();
            $this->data['categories'] = $catM->getAllCategories();
            AdminView::render(ADM_PAGES_PATH . 'allcategories' . EXT, $this->data);
        } else {
            $this->login();
        }
    }

    public function createCategory()
    {
        if ($this->userAuth->isAuth()) {
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                if (isset($_POST["category"]) && isset($_POST["description"]) && isset($_POST["imgAlt"]) && isset($_POST["slug"]) && isset($_FILES["imgSrc"])) {
                    $category = htmlspecialchars(trim($_POST["category"]));
                    $description = htmlspecialchars(trim($_POST["description"]));
                    $imgAlt = htmlspecialchars(trim($_POST["imgAlt"]));
                    $slug = htmlspecialchars(trim($_POST["slug"]));

                    $destDir = ABS_PATH . '/static/img/categories/';
                    $targetFile = $destDir . basename($_FILES["imgSrc"]['name']);
                    $imgExt = mb_strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

                    $targetFile = $destDir . mb_substr(hash("sha256", $_POST["slug"]), 0, 8) . "." . $imgExt;
                    if ($imgExt == 'png' || $imgExt == 'jpg' || $imgExt == 'jpeg' || $imgExt == 'gif' || $imgExt == 'jfif') {
                        if ($_FILES["imgSrc"]['size'] > 180000) {
                            $this->data['error'] = "The file is too large. Compress it to a size no larger than 120KB";
                        }
                        if (move_uploaded_file($_FILES["imgSrc"]["tmp_name"], $targetFile)) {
                            $catM = new CategoryModel();
                            if ($catM->createCategory($category, $description, mb_substr($targetFile, mb_strpos($targetFile, "/")), $imgAlt, $slug)) {
                                $this->data['success'] = "Category successfully created";
                                $this->getFormatCategories();
                            } else {
                                $this->data['error'] = "An error occurred while creating the category.";
                                unlink($targetFile);
                            }
                            $this->index();
                        } else {
                            $this->data['error'] = "File upload to server failed";
                        }
                    } else {
                        $this->data['error'] = "Wrong file format";
                    }

                }
            }
        } else {
            $this->login();
        }
    }

    public function updateCategory()
    {
        if ($this->userAuth->isAuth()) {
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                if (isset($_POST["id"]) && isset($_POST["category"]) && isset($_POST["description"]) && isset($_POST["imgAlt"]) && isset($_POST["slug"]) && isset($_FILES["imgSrc"])) {

                    $category = htmlspecialchars(trim($_POST["category"]));
                    $id = intval(htmlspecialchars(trim($_POST['id'])));
                    $description = htmlspecialchars(trim($_POST["description"]));
                    $imgAlt = htmlspecialchars(trim($_POST["imgAlt"]));
                    $slug = htmlspecialchars(trim($_POST["slug"]));

                    if($_FILES['imgSrc']['name'] == ''){
                        $catM = new CategoryModel();
                        if ($catM->updateCategory($id, $category, $description, $imgAlt, $slug)) {
                            $this->data['success'] = "Category successfully created";
                            $this->getFormatCategories();
                        } else {
                            $this->data['error'] = "An error occurred while creating the category.";
                        }
                        $this->index();
                    }

                    $destDir = ABS_PATH . '/static/img/categories/';
                    $targetFile = $destDir . basename($_POST['src']);
                    $imgExt = mb_strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

                    $targetFile = $destDir . mb_substr(hash("sha256", $_POST["slug"]), 0, 8) . "." . $imgExt;
                    if ($imgExt == 'png' || $imgExt == 'jpg' || $imgExt == 'jpeg' || $imgExt == 'gif' || $imgExt == 'jfif') {
                        if ($_FILES["imgSrc"]['size'] > 180000) {
                            $this->data['error'] = "The file is too large. Compress it to a size no larger than 120KB";
                        }
                        if (move_uploaded_file($_FILES["imgSrc"]["tmp_name"], $targetFile)) {
                            $catM = new CategoryModel();
                            if ($catM->updateCategory($id, $category, $description, $imgAlt, $slug)) {
                                $this->data['success'] = "Category successfully created";
                                $this->getFormatCategories();
                            } else {
                                $this->data['error'] = "An error occurred while creating the category.";
                                unlink($targetFile);
                            }
                            $this->index();
                        } else {
                            $this->data['error'] = "File upload to server failed";
                        }
                    } else {
                        $this->data['error'] = "Wrong file format";
                    }

                }
            }
        } else {
            $this->login();
        }
    }

    public function deleteCategory(){
        if ($this->userAuth->isAuth()) {
            if ($_SERVER['REQUEST_METHOD'] == "GET") {
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $categoryModel = new CategoryModel();

                    if ($categoryModel->deleteCategory($id)) {
                        $this->data['success'] = "Category deleted";
                        $this->getFormatCategories();
                    } else {
                        $this->data['error'] = "Error. Category was not deleted.";
                    }
                    $this->index();
                }
            }
        } else {
            $this->login();
        }
    }
}