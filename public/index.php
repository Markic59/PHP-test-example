<?php

function autoload($className) {
    if (file_exists(__DIR__ . "/../" . $className . '.php')) {
        require_once __DIR__ . "/../" . $className . '.php';
        return true;
    }
    return false;
}

spl_autoload_register('autoload');

use \app\router\Router;

include __DIR__ . "/../app/routes/routes.php";
Router::handle();
