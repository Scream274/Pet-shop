<?php

namespace Myapp;

class BlogController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $catModel = new CategoryModel();
        $postModel = new PostsModel();
        $tagModel = new TagsModel();
        $this->data["categories"] = $catModel->getAllCategories();
        $this->data["posts"] = $postModel->getAllPosts();
        $this->data["tags"] = $tagModel->getAllTags();
        $this->data["onePost"] = null;
    }

    function index()
    {
        View::render(PAGES_PATH . 'blogindex' . EXT, $this->data);
    }

    public function allPostsByCategory()
    {
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            if (isset($_GET['Id'])) {
                $id = htmlspecialchars(trim($_GET['Id']));
                $postM = new PostsModel();
                $posts = $postM->getAllPostsByCategoryId($id);
                $this->data["posts"] = $posts;

                if (count($posts) > 0) {
                } else {
                    $this->data["error"] = "List of posts is empty!";
                }
            } else {
                $this->data["error"] = "0 posts created!";
            }
            View::Render(PAGES_PATH . 'blogindex' . EXT, $this->data);
        }
    }

    public function allPostsByTagId()
    {
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            if (isset($_GET['Id'])) {
                $id = htmlspecialchars(trim($_GET['Id']));
                $postM = new PostsModel();
                $posts = $postM->getAllPostsByTagId($id);
                $this->data["posts"] = $posts;

                if (count($posts) > 0) {
                } else {
                    $this->data["error"] = "List of posts is empty!";
                }
            } else {
                $this->data["error"] = "0 posts created!";
            }
            View::Render(PAGES_PATH . 'blogindex' . EXT, $this->data);
        }
    }

    public function postById()
    {
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            if (isset($_GET['Id'])) {
                $id = htmlspecialchars(trim($_GET['Id']));

                $postM = new PostsModel();
                $this->data["onePost"] = $postM->getPostById($id);
                View::Render(PAGES_PATH . 'blogindex' . EXT, $this->data);
            }
        }
    }

    public function getPostsByKeyword()
    {
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            if (isset($_GET['keyword'])) {
                $keyword = htmlspecialchars(trim($_GET['keyword']));

                $postM = new PostsModel();
                $foundPosts = $postM->getPostsByKeyword($keyword);
                $this->data["posts"] = $foundPosts;
                if (empty($foundPosts)) {
                    $this->data["error"] = "No posts found by keyword: " . $keyword;
                }
                View::Render(PAGES_PATH . 'blogindex' . EXT, $this->data);
            }
        }
    }
}