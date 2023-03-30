<?php

namespace Myapp;

class TeamController extends Controller
{

    function index()
    {
        View::render(VIEW_PATH . 'team' . EXT, $this->data);
    }
}