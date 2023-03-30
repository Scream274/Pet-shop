<?php

namespace Myapp;

class TeamController extends Controller
{

    function index()
    {
        View::render(PAGES_PATH . 'team' . EXT, $this->data);
    }
}