<?php

namespace app\http\controllers\blog;

use app\core\View;

class BlogController{

    public function show(){
        echo "SHOW EXECUTED";
    }

    public function index($post, $num){
            View::view("blog." . $post . $num );
    }

}