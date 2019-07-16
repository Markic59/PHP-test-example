<?php

use app\Router\Router;

Router::get("/kontakt","app\http\controllers\contact\ContactController@index");
Router::post("/kontakt","app\http\controllers\contact\ContactController@postEmail");
Router::get("/blog/{post}/stranica/{num}", "app\http\controllers\blog\BlogController@index");