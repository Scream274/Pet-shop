<?php

namespace Myapp;

class View
{
    public static function render($contentView, $data = null, $templateView = VIEW_PATH.'templateView'.EXT ) {
        require $templateView;
    }
}