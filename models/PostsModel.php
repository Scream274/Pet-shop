<?php

namespace Myapp;

class PostsModel extends DBContext
{
    public function __construct()
    {
        parent::__construct("posts");
    }

    public function getAllPostsByCategoryId($Id)
    {
        return $this->getManyRows(['category_Id' => $Id]);
    }

    public function getAllPosts()
    {
        return $this->getManyRows($filter = [], $orderName = "published_date", $orderMode = "DESC");
    }

    public function getAllPostsByTagId($id)
    {
        $query = "SELECT * FROM posts 
                 WHERE posts.id IN (SELECT post_tags.post_Id FROM post_tags
                 JOIN tags ON post_tags.tag_Id = tags.id
                 WHERE tags.id = $id)";
        return $this->executeQuery($query);
    }

    public function getPostById($id)
    {
        return $this->getOneRow($id);
    }

    public function getPostsByKeyword($keyword)
    {
        $query = "SELECT * FROM posts 
                 WHERE posts.keywords LIKE '%$keyword%'";
        return $this->executeQuery($query);
    }

    public function createPost($catId, $description, $title, $slogan, string $targetFile, string $imgAlt, $keywords)
    {
        return $this->addOneRow([
            'title'=>$title,
            'slogan'=>$slogan,
            'img_alt'=>$imgAlt,
            'keywords'=>$keywords,
            'post_img'=>$targetFile,
            'description' => $description,
            'category_Id' => $catId
        ]);
    }

    public function lastInsertPostId(){
        $query = "SELECT MAX(id) FROM posts";
        return $this->executeQuery($query)[0];
    }
}