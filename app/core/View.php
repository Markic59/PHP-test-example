<?php
namespace app\core;

class View{

    public static function view($relPath){

        $file = __DIR__ . "/../resources/views/" .str_replace(".","/", $relPath) . ".php";
        include $file;
    }
}