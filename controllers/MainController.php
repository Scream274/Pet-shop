<?php

namespace Myapp;

class MainController extends Controller
{

    function index()
    {
        $postModel = new PostsModel();
        $categoryModel = new CategoryModel();
        $this->data["posts"] = array_slice($postModel->getAllPosts(), -2, 2);
        $this->data["categories"] = $categoryModel->getAllCategories();

        View::render(PAGES_PATH.'mainindex'.EXT, $this->data);
    }
}