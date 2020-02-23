<?php


namespace Controller;


use Core\Controller;

/**
 * Class Users
 * @package Controller
 */
class Users extends Controller
{
    public function index()
    {
        $this->userModel = $this->model('user');
        echo 'users controller';
    }
}