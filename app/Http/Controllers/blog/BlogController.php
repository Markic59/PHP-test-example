<?php

namespace app\http\controllers\blog;

use app\core\View;
use Illuminate\Http\Request;

class BlogController{

    public function show(){
        echo "SHOW EXECUTED";
    }

    public function index($post, $num, Request $request){
            View::view("blog." . $post . $num );
            var_dump($request);
    }

}