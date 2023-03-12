<?php

namespace Myapp;

class ErrorController extends Controller
{

    function index()
    {
        View::render( PAGES_PATH.'errorindex'.EXT, $this->data);
    }
}