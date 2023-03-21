<?php

namespace Myapp;

class AdminView
{
    public static function render($contentView, $data = null, $templateView = ADM_VIEWS_PATH.'templateView'.EXT ) {
        require $templateView;
    }
}