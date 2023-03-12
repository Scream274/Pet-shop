<?php

namespace Myapp;

class AjaxController extends Controller
{

    function index()
    {
        // TODO: Implement index() method.
    }

    public function getAllCommentsOnePost()
    {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["postId"])) {
                $postId = intval($_POST["postId"]);
                $connM = new CommentsModel();
                $comments = $connM->getAllValidComments($postId);

                echo json_encode($comments, JSON_UNESCAPED_SLASHES, JSON_UNESCAPED_UNICODE);
            }
        }
        return null;
    }

    public function saveCommentFromPost()
    {
        $commentModel = new CommentsModel();
        $commentId = $_POST["commentId"];

        if ($commentId == 0) {
            $commentModel->addNewComment($_POST["login"], $_POST["email"], $_POST["comment"], $_POST["postId"], $_SERVER["REMOTE_ADDR"]);
        } else {
            $commentModel->addNewReplyComment($_POST["login"], $_POST["email"], $_POST["comment"], $_POST["postId"], $_SERVER["REMOTE_ADDR"], $commentId);
        }
//
//        $this->data["success"] = "Your comment has been sent for moderation.";
//        View::render(PAGES_PATH . 'blogindex' . EXT, $this->data);
    }
}