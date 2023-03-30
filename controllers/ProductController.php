<?php

namespace Myapp;

class ProductController extends Controller
{

    function index()
    {
        View::render(PAGES_PATH . 'product' . EXT, $this->data);
    }
}