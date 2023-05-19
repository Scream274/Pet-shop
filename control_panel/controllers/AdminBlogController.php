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

    public function getAllPosts()
    {
        $postM = new PostsModel();
        $catM = new CategoryModel();
        $tagM = new TagsModel();

        $posts = $postM->getAllPosts();
        $categories = $catM->getAllCategories();

        for ($i = 0; $i < count($posts); $i++) {
            $posts[$i]['tags'] = $tagM->getTagsByPostId($posts[$i]['id']);
        }

        $this->data['posts'] = $posts;
        $this->data['categories'] = $categories;
        $this->data['tags'] = $tagM->getAllTags();

        if ($this->userAuth->isAuth()) {
            AdminView::render(ADM_PAGES_PATH . 'allposts' . EXT, $this->data);
        } else {
            $this->login();
        }
    }

    public function getAllTags()
    {
        $tagM = new TagsModel();
        $this->data['tags'] = $tagM->getAllTags();
        if ($this->userAuth->isAuth()) {
            AdminView::render(ADM_PAGES_PATH . 'alltags' . EXT, $this->data);
        } else {
            $this->login();
        }
    }

    public function getAllComments()
    {
        $commentM = new CommentsModel();
        $this->data['comments'] = $commentM->getAllComments();
        if ($this->userAuth->isAuth()) {
            AdminView::render(ADM_PAGES_PATH . 'allcomments' . EXT, $this->data);
        } else {
            $this->login();
        }
    }

    public function createPost()
    {
        if ($this->userAuth->isAuth()) {
            if ($_SERVER['REQUEST_METHOD'] == "POST") {

                if (isset($_POST["categoryId"]) && isset($_POST["description"]) && isset($_POST["title"]) && isset($_POST["content"]) &&
                    isset($_POST["slogan"]) && isset($_POST["imgAlt"]) && isset($_POST["keywords"]) && isset($_FILES["imgSrc"])) {
                    $title = htmlspecialchars(trim($_POST["title"]));
                    $slogan = htmlspecialchars(trim($_POST["slogan"]));
                    $imgAlt = htmlspecialchars(trim($_POST["imgAlt"]));
                    $keywords = htmlspecialchars(trim($_POST["keywords"]));
                    $description = htmlspecialchars(trim($_POST["description"]));
                    $content = htmlspecialchars(trim($_POST["content"]));
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
                            if ($postsModel->createPost($catId, $description, $title, $slogan, mb_substr($targetFile, mb_strpos($targetFile, "/")), $imgAlt, $keywords, $content)) {
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
                            $this->getAllPosts();
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

    public function updatePost()
    {
        if ($this->userAuth->isAuth()) {
            if ($_SERVER['REQUEST_METHOD'] == "POST") {

                if (isset($_POST["id"]) && isset($_POST["categoryId"]) && isset($_POST["description"]) && isset($_POST["title"]) && isset($_POST["slogan"])
                    && isset($_POST["imgAlt"]) && isset($_POST["keywords"]) && isset($_FILES["imgSrc"]) && isset($_POST["content"])) {

                    $id = intval(htmlspecialchars(trim($_POST['id'])));
                    $title = htmlspecialchars(trim($_POST["title"]));
                    $slogan = htmlspecialchars(trim($_POST["slogan"]));
                    $imgAlt = htmlspecialchars(trim($_POST["imgAlt"]));
                    $keywords = htmlspecialchars(trim($_POST["keywords"]));
                    $description = htmlspecialchars(trim($_POST["description"]));
                    $content = htmlspecialchars(trim($_POST["content"]));
                    $catId = htmlspecialchars(trim($_POST["categoryId"]));

                    $postsModel = new PostsModel();
                    $existingPost = $postsModel->getPostById($id);

                    if (!$existingPost) {
                        $this->data['error'] = "Post not found.";
                        $this->getAllPosts();
                        return;
                    }

                    $existingPhotoPath = $existingPost['post_img'];

                    if ($_FILES['imgSrc']['name'] == '') {
                        if ($postsModel->updatePost($id, $catId, $description, $title, $slogan, $imgAlt, $keywords, $content)) {
                            $this->data['success'] = "Post successfully updated";
                            $this->getFormatCategories();
                        } else {
                            $this->data['error'] = "An error occurred while updating the post.";
                        }
                        $this->getAllPosts();
                        return;
                    }

                    $destDir = ABS_PATH . '/static/img/posts/';
                    $targetFile = $destDir . basename($_FILES['imgSrc']['name']);
                    $imgExt = mb_strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

                    if ($imgExt == 'png' || $imgExt == 'jpg' || $imgExt == 'jpeg' || $imgExt == 'gif' || $imgExt == 'jfif') {
                        if ($_FILES['imgSrc']['size'] > 180000) {
                            $this->data['error'] = "The file is too large. Compress it to a size no larger than 120KB";
                            $this->getAllPosts();
                            return;
                        }

                        if (move_uploaded_file($_FILES['imgSrc']['tmp_name'], $targetFile)) {
                            if ($postsModel->updatePost($id, $catId, $description, $title, $slogan, $imgAlt, $keywords, $content)) {
                                if ($existingPhotoPath != $targetFile) {
                                    unlink(ABS_PATH . $existingPhotoPath);
                                }
                                $this->data['success'] = "Post successfully updated";
                                $this->getFormatCategories();
                            } else {
                                unlink($targetFile);
                                $this->data['error'] = "An error occurred while updating the post.";
                            }
                        } else {
                            $this->data['error'] = "File upload to server failed";
                        }
                    } else {
                        $this->data['error'] = "Wrong file format";
                    }

                    $this->getAllPosts();
                }
            }
        } else {
            $this->login();
        }
    }

    public function deletePost()
    {
        if ($this->userAuth->isAuth()) {
            if ($_SERVER['REQUEST_METHOD'] == "GET") {
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $postM = new PostsModel();
                    $postTagM = new PostsTagsModel();
                    $postTagM->deleteManyRows(['post_id' => $id]);

                    if ($postM->deletePost($id)) {
                        $this->data['success'] = "Post deleted";
                        $this->getFormatCategories();
                    } else {
                        $this->data['error'] = "Error. Post was not deleted.";
                    }
                    $this->getAllPosts();
                }
            }
        } else {
            $this->login();
        }
    }

    public function updateComment()
    {
        if ($this->userAuth->isAuth()) {
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                if (isset($_POST['id']) && isset($_POST['comment'])) {
                    $id = intval(htmlspecialchars(trim($_POST['id'])));
                    $comment = htmlspecialchars(trim($_POST['comment']));

                    $commM = new CommentsModel();
                    if ($commM->updateOption($id, $comment)) {
                        $this->data['success'] = "Comment " . $id . " updated";
                        $this->getFormatOptions();
                    } else {
                        $this->data['error'] = "Error. Comment " . $id . " was not updated. ";
                    }
                    $this->getAllComments();
                }
            }
        } else {
            $this->login();
        }
    }

    public function deleteComment()
    {
        if ($this->userAuth->isAuth()) {
            if ($_SERVER['REQUEST_METHOD'] == "GET") {
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $commM = new CommentsModel();
                    $commM->deleteComments($id);

                    if ($commM->deleteComment($id)) {
                        $this->data['success'] = "Comment " . $id. " deleted";
                        $this->getFormatCategories();
                    } else {
                        $this->data['error'] = "Error. Comment " . $id. "  was not deleted.";
                    }
                    $this->getAllComments();
                }
            }
        } else {
            $this->login();
        }
    }

    public function verifyComment()
    {
        if ($this->userAuth->isAuth()) {
            if ($_SERVER['REQUEST_METHOD'] == "GET") {
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $commM = new CommentsModel();

                    if ($commM->verifyComment($id)) {
                        $this->data['success'] = "Comment " . $id. "  verified";
                        $this->getFormatCategories();
                    } else {
                        $this->data['error'] = "Error. Comment " . $id. "  was not verified.";
                    }
                    $this->getAllComments();
                }
            }
        } else {
            $this->login();
        }
    }

    public function deleteTag()
    {
        if ($this->userAuth->isAuth()) {
            if ($_SERVER['REQUEST_METHOD'] == "GET") {
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $tagM = new TagsModel();

                    if ($tagM->deleteTag($id)) {
                        $this->data['success'] = "Tag deleted";
                        $this->getFormatOptions();
                    } else {
                        $this->data['error'] = "Error. Tag was not deleted.";
                    }
                    $this->getAllTags();
                }
            }
        } else {
            $this->login();
        }
    }

    public function updateTag()
    {
        if ($this->userAuth->isAuth()) {
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                if (isset($_POST['Id']) && isset($_POST['tag'])) {
                    $id = intval(htmlspecialchars(trim($_POST['Id'])));
                    $tag = htmlspecialchars(trim($_POST['tag']));

                   $tagM = new TagsModel();
                    if ($tagM->updateTag($id, $tag)) {
                        $this->data['success'] = "Tag " . $id . " updated";
                        $this->getFormatOptions();
                    } else {
                        $this->data['error'] = "Error. Tag " . $id . " was not updated. ";
                    }
                    $this->getAllTags();
                }
            }
        } else {
            $this->login();
        }
    }
}