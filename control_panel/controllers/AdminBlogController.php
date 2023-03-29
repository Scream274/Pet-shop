<?php

namespace Myapp;

class AdminBlogController extends Controller
{
    public function index()
    {
        if ($this->userAuth->isAuth()) {
            $catM = new CategoryModel();
            $tagM = new TagsModel();
            $this->data['categories'] = $catM->getAllCategories();
            $this->data['tags'] = $tagM->getAllTags();
            AdminView::Render(ADM_PAGES_PATH . 'createPost' . EXT, $this->data);
        } else {
            $this->login();
        }
    }

    public function createPost()
    {
        if ($this->userAuth->isAuth()) {
            if ($_SERVER['REQUEST_METHOD'] == "POST") {

                if (isset($_POST["categoryId"]) && isset($_POST["description"]) && isset($_POST["title"]) && isset($_POST["slogan"]) && isset($_POST["imgAlt"]) && isset($_POST["keywords"]) && isset($_FILES["imgSrc"])) {

                    $title = htmlspecialchars(trim($_POST["title"]));
                    $slogan = htmlspecialchars(trim($_POST["slogan"]));
                    $imgAlt = htmlspecialchars(trim($_POST["imgAlt"]));
                    $keywords = htmlspecialchars(trim($_POST["keywords"]));
                    $description = htmlspecialchars(trim($_POST["description"]));
                    $catId = htmlspecialchars(trim($_POST["categoryId"]));

                    $destDir = ABS_PATH . '/static/img/posts/';
                    $targetFile = $destDir . basename($_FILES["imgSrc"]['name']);
                    $imgExt = mb_strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

                    $targetFile = $destDir . mb_substr(hash("sha256", $title), 0, 8) . "." . $imgExt;
                    if ($imgExt == 'png' || $imgExt == 'jpg' || $imgExt == 'jpeg' || $imgExt == 'gif' || $imgExt == 'jfif') {

                        if ($_FILES["imgSrc"]['size'] > 180000) {
                            $this->data['error'] = "The file is too large. Compress it to a size no larger than 120KB";
                        }
                        if (move_uploaded_file($_FILES["imgSrc"]["tmp_name"], $targetFile)) {
                            $postsModel = new PostsModel();
                            if ($postsModel->createPost($catId, $description, $title, $slogan, mb_substr($targetFile, mb_strpos($targetFile, "/")), $imgAlt, $keywords)) {
                                $lastId = $postsModel->lastInsertPostId()['MAX(id)'];

                                $postTagModel = new PostsTagsModel();
                                foreach ($_POST['tags'] as $selected_option) {
                                    $postTagModel->addTagToPost($lastId, $selected_option);
                                }

                                $this->data['success'] = "Post successfully created";
                                $this->getFormatCategories();

                            } else {
                                $this->data['error'] = "An error occurred while creating post.";
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
}