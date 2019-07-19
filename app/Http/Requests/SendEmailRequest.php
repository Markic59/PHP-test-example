<?php

namespace app\Http\Requests;

use app\Contracts\Form\FormRequest;

class SendEmailRequest extends FormRequest{
    public function __construct(array $query = [], array $request = [], array $attributes = [], array $cookies = [], array $files = [], array $server = [], $content = null)
    {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);
        $this->rules = array("firstname" => "required|string",
                               "lastname" => "required|string",
                                "email" => "required|string");

        $this->messages=array("firstname.required" => "Zaboravio si ime",
                                "lastname.required" => "Zaboravio si prezime",
                                 "email.required" => "Zaboravio si email");
    }

    public function getMessages()
    {
        return $this->messages;
    }

    public function getRules()
    {
        return $this->rules;
    }


}
