<?php

namespace Myapp;

class PostsTagsModel extends DBContex
{
    public function __construct()
    {
        parent::__construct("post_tags");
    }
}