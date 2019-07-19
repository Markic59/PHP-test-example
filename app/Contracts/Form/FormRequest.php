<?php

namespace app\Contracts\Form;

use Illuminate\Http\Request;

abstract class FormRequest extends Request{

    public function __construct(array $query = [], array $request = [], array $attributes = [], array $cookies = [], array $files = [], array $server = [], $content = null)
    {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);
    }

    abstract function getRules();
    abstract function getMessages();

}
