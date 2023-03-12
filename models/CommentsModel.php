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
}