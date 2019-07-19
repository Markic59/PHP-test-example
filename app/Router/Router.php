<?php

namespace app\Router;

use app\Factories\Validator\ValidatorFactory;
use app\http\controllers\contact\ContactController;
use app\http\controllers\blog\BlogController;
use app\Http\Requests\SendEmailRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use ReflectionFunction;
use ReflectionMethod;

class Router{
    /**
     * @var
     */
    public static $instance;
    /**
     * @var array
     */
    private $get = [];
    /**
     * @var array
     */
    private $post = [];

    /**
     * @return Router
     */
    public static function instance(){

        if(self::$instance !== null){
            return self::$instance;
        }

        self::$instance = new self();
        return self::$instance;
    }

    /**
     * @param $path
     * @param $handle
     */
    public static function get($path, $handle){

        $route = new Route();
        $route->setPath($path);
        $route->setHandle($handle);
        self::instance()->get[] = $route;

    }

    /**
     * @param $path
     * @param $handle
     */
    public static function post($path, $handle){

        $route = new Route();
        $route->setPath($path);
        $route->setHandle($handle);
        self::instance()->post[] = $route;

    }

    //Chooses the controller
    public static function handle()
    {
        $methodType = $_SERVER["REQUEST_METHOD"];
        $request = SendEmailRequest::capture();


        switch ($methodType) {
            case 'GET':
                $routes = self::instance()->get;
                break;
            case 'POST':
                $routes = self::instance()->post;
                if($request !== null){
                    $validator = ValidatorFactory::make($request->all(),$request->getRules(),
                        $request->getMessages());
                    try {
                        foreach ($validator->messages()->getMessages() as $value) {
                            echo $value[0];
                            if ($value === false) {
                                return;
                            }
                        }
                    }
                    catch(ValidationException $e){
                        $e->errorBag;
                        echo "el nada";
                        return;
                    }
                }
                break;
        }

        //User passed URI
        $controllerChooserArray = explode("/", $_SERVER["REQUEST_URI"]);

        foreach ($routes as $route) {

            $tokens = explode("/", $route->getPath());

            //To be passed
            $variables = array();

            if (count($tokens) === count($controllerChooserArray)) {

                for($index = 0; $index < count($tokens); ++$index){

                    if($tokens[$index] === $controllerChooserArray[$index]){
                        continue;
                    }
                    elseif(strpos($tokens[$index], "{") !== false & strpos($tokens[$index], "}") !== false){
                        $variables[] = $controllerChooserArray[$index];
                        continue;
                    }
                    else{
                        break;
                    }

                }
                if($index === count($tokens)){
                    $handleController = self::handleController($route);
                    $class = $handleController["class"];
                    $function = $handleController["function"];
                    $vars = new ReflectionMethod($class, $function);
                    $params = $vars->getParameters();

                    if(end($params) !== false && (end($params)->getClass()) !== null) {
                        if (end($params)->getClass()->getName() === "Illuminate\Http\Request") {
                            $variables[] = $request;
                        }

                    }

                    call_user_func_array($class . "::" . $function, $variables);
                }
            }

        }
    }

    //Separates the controller class from controller function
    public static function handleController(Route $route) {

        $handlePieces = explode("@", $route->getHandle());
        return array("class" => $handlePieces[0], "function" => $handlePieces[1]);

    }

}