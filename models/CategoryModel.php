<?php

namespace Myapp;

class CategoryModel extends DBContext
{
    public function __construct()
    {
        parent::__construct("categories");
    }

    public function getAllCategories(){
        return $this->getManyRows();
    }
}