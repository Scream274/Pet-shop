<?php

namespace Myapp;

class AboutController extends Controller
{

    function index()
    {
        View::render(PAGES_PATH . 'about' . EXT, $this->data);
    }

    function contactUs()
    {
        View::render(PAGES_PATH . 'contact_us' . EXT, $this->data);
    }

    function getClientMessage()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["name"])
                && isset($_POST["email"])
                && isset($_POST["subject"])
                && isset($_POST["message"])) {

                $name = htmlspecialchars(trim($_POST["name"]));
                $email = htmlspecialchars(trim($_POST["email"]));
                $subject = htmlspecialchars(trim($_POST["subject"]));
                $message = htmlspecialchars(trim($_POST["message"]));

                $validator = new Validator();

                if ($validator->validateName($name) &&
                    $validator->validateSubject($subject) &&
                    $validator->validateMessage($message) &&
                    $validator->validateEmail($email)) {
                    $messageModel = new MessagesModel();
                    if ($messageModel->saveMessage($name, $email, $subject, $message)) {
                        $this->data['success'] = "Message was sent!";
                    }
                } else {
                    $this->data = array_merge($this->data, $validator->getData());
                }

                $this->contactUs();
            }
        }
    }
}