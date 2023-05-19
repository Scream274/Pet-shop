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

    public function getTagsByPostId($postId) {
        $query = "SELECT * FROM tags 
              JOIN post_tags ON post_tags.tag_Id = tags.id
              WHERE post_tags.post_Id = $postId";
        return $this->executeQuery($query);
    }

    public function deleteTag($id)
    {
        return $this->deleteOneRow($id);
    }

    public function updateTag(int $id, string $tag)
    {
        return $this->updateOneRow($id, [
                'tag' => $tag
            ]) == 1;
    }
}