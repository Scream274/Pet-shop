<?php

namespace Myapp;

class NavigateModel extends DBContext
{
    public function __construct()
    {
        parent::__construct("navigate");
    }


    public function getNavigateData()
    {
        return $this->getManyRows();
    }

    public function getRowByName($name){
        return $this->getManyRows(["title" => $name])[0];
    }
}