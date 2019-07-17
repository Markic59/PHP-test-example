<?php

namespace app\http\controllers\contact;
//include __DIR__ . "../BaseController";

use app\core\View;
use Illuminate\Http\Request;

class ContactController{

    public function index(){
        View::view("contact.contact");
    }

    public function postEmail()
    {
        if ($request !== null) {
        var_dump($request->all());
        }
    }

}