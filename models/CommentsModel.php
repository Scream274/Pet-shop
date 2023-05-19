<?php

namespace Myapp;

class CommentsModel extends DBContext
{
    public function __construct()
    {
        parent::__construct("comments");
    }

    public function getAllValidComments($postId)
    {
        return $this->getManyRows(["post_Id" => $postId, "verified" => true]);
    }

    public function addNewComment($login, $email, $comment, $postId, $IP)
    {
        return $this->addOneRow(["post_Id" => $postId, "login" => $login, "email" => $email, "comment" => $comment, "client_IP" => $IP]);
    }

    public function addNewReplyComment($login, $email, $comment, $postId, $IP, $parent)
    {
        return $this->addOneRow(["post_Id" => $postId, "login" => $login, "email" => $email, "comment" => $comment, "client_IP" => $IP, "comment_Id" => $parent]);
    }

    public function getAllComments()
    {
        return $this->getManyRows();
    }

    public function updateOption(int $id, string $comment)
    {
        return $this->updateOneRow($id, [
                'comment' => $comment
            ]) == 1;
    }

    public function deleteComment($id)
    {
        return $this->deleteOneRow($id);
    }

    public function verifyComment($id)
    {
        return $this->updateOneRow($id, ['verified' => 1]);
    }

    public function deleteComments($id)
    {
        return $this->deleteManyRows(["comment_Id" => $id]);
    }
}