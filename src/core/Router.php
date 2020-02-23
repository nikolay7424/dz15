<?php

namespace Core;

/**
 * Class Router
 * Creates URL and loads core controller
 * URL format ?route=controller/method
 */
class Router
{

    /**
     * Router constructor.
     */
    public function __construct()
    {
         $currentController = 'Articles';
         $currentMethod = 'index';

         //getting controller name and method name from URL
        if(isset($_GET['route']))
        {
            $url = explode('/', $_GET['route']);

            if(!empty($url[0]))
            {
                $currentController = ucwords($url[0]);
            }

            if(!empty($url[1]))
            {
                $currentMethod = $url[1];
            }
        }
        $controller_path = 'controllers/' . $currentController . '.php';
        //adding namespace
        $currentController = '\Controller\\' . $currentController;

        //instantiate controller class
        if (file_exists($controller_path)) {
            $controller = new $currentController();
        } else {
            header('Location: index.php?route=error/notFound');
        }

        //calling method
        if (method_exists($currentController, $currentMethod)) {
            $controller->$currentMethod();
        } else {
            header('Location: index.php?route=error/notFound');
        }
    }
}