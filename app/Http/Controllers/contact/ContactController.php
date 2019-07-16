<?php

namespace app\http\controllers\contact;
//include __DIR__ . "../BaseController";

use app\core\View;

class ContactController{

    public function index(){
        View::view("contact.contact");
    }

    public function postEmail(){
        echo "POST EMAIL!";
    }

}