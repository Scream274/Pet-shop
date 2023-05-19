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

    public function createPost($catId, $description, $title, $slogan, string $targetFile, string $imgAlt, $keywords, $content)
    {
        return $this->addOneRow([
            'title' => $title,
            'slogan' => $slogan,
            'img_alt' => $imgAlt,
            'keywords' => $keywords,
            'post_img' => $targetFile,
            'description' => $description,
            'category_Id' => $catId,
            'content' => $content
        ]);
    }

    public function updatePost($postId, $catId, $description, $title, $slogan, string $imgAlt, $keywords, $content)
    {
        return $this->updateOneRow($postId,
            ['title' => $title,
                'slogan' => $slogan,
                'img_alt' => $imgAlt,
                'keywords' => $keywords,
                'description' => $description,
                'category_Id' => $catId,
                'content' => $content]);
    }

    public function lastInsertPostId()
    {
        $query = "SELECT MAX(id) FROM posts";
        return $this->executeQuery($query)[0];
    }

    public function deletePost($postId){
        return $this->deleteOneRow($postId);
    }

    public function getPhotoPath($postId)
    {
        $query = "SELECT post_img FROM posts WHERE id = $postId";
        $result = $this->executeQuery($query);

        if (!empty($result) && isset($result[0]['post_img'])) {
            return $result[0]['post_img'];
        }

        return null;
    }
}