<?php

namespace Myapp;

 class Validator
{
    private $data = [];

    public function validateName($name)
    {
        if (!preg_match("/^[A-z ]*$/", $name)) {
            $this->data['error'] = "Only letters and spaces are allowed in the name!";
            return false;
        }
        if ($name == "") {
            $this->data['error'] = "Error! You didn't enter the Name.";
            return false;
        }
        return true;
    }

    public function validateSubject($subject)
    {
        if (!preg_match("/^[A-z ]*$/", $subject)) {
            $this->data['error'] = "Only letters and spaces are allowed in the Subject.";
            return false;
        } else if ($subject == "") {
            $this->data['error'] = "Error! You didn't enter the Subject.";
            return false;
        } else if (strlen($subject) > 64) {
            $this->data['error'] = "Error! Your Subject is too long.";
            return false;
        }
        return true;
    }

    public function validateMessage($message)
    {
        if ($message == "") {
            $this->data['error'] = "Error! You didn't enter the Message.";
            return false;
        } else if (strlen($message) > 1000) {
            $this->data['error'] = "Error! Your Message is too long.";
            return false;
        }
        return true;
    }

    public function validateEmail($email)
    {
        $pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";
        if (!preg_match($pattern, $email)) {
            $this->data['error'] = "Email is not valid.";
            return false;
        }
        return true;
    }

    public function getData()
    {
        return $this->data;
    }

}