<?php

namespace Myapp;

class TagsModel extends DBContext
{
    public function __construct()
    {
        parent::__construct("tags");
    }

    public function getAllTags(){
        return $this->getManyRows();
    }
}