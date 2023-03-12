<?php

namespace Myapp;

class MessagesModel extends DBContext
{
    public function __construct()
    {
        parent::__construct("messages");
    }

    public function saveMessage($name, $email, $subject, $message){
        return $this->addOneRow([
            "name" => $name,
            "email"=>$email,
            "subject" => $subject,
            "message" => $message
        ]) == 1;
    }


}