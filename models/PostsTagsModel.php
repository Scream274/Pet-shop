<?php

namespace Myapp;

class PostsTagsModel extends DBContext
{
    public function __construct()
    {
        parent::__construct("post_tags");
    }

    public function addTagToPost($postId, $tagId){
        return $this->addOneRow([
            'post_Id' => $postId,
            'tag_Id' => $tagId
        ]);
    }
}