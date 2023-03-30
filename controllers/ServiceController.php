<?php

namespace Myapp;

class ServiceController extends Controller
{

    function index()
    {
        View::render(PAGES_PATH . 'service' . EXT, $this->data);
    }
}