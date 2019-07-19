<?php

namespace app\http\controllers\contact;
//include __DIR__ . "../BaseController";

use app\core\View;
use Illuminate\Http\Request;
use app\Factories\Validator\ValidatorFactory;

class ContactController{

    public function index(){
        View::view("contact.contact");
    }

    public function postEmail(Request $request)
    {

    }

}