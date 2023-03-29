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

    public function createCategory($category, $description, $targetFile, $imgAlt, $slug)
    {
        return $this->addOneRow([
            'category'=>$category,
            'description'=>$description,
            'img_src'=>$targetFile,
            'img_alt'=>$imgAlt,
            'slug'=>$slug
        ]);
    }
}