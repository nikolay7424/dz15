<?php


namespace Controller;


use Core\Controller;

/**
 * Class Errors
 * @package Controller
 * Shows error messages
 */
class Errors extends Controller
{
    public function forbidden()
    {
        header('HTTP/1.1 403 Forbidden');
        $view = $this->view();
        $view->render('Error', 'You don\'t have access to this page');
    }

    public function notFound()
    {
        header('HTTP/1.1 404 Not Found');
        $view = $this->view();
        $view->render('Error', 'Page not found');
    }

    public function badRequest()
    {
        header('HTTP/1.1 400 Bad Request');
        $view = $this->view();
        $view->render('Error', 'Not enough data');
    }
}