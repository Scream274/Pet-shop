<?php

namespace Myapp;

class PriceController extends Controller
{

    function index()
    {
        View::render(PAGES_PATH . 'price' . EXT, $this->data);
    }
}