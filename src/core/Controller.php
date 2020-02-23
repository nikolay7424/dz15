<?php


namespace Core;

/**
 * Class Controller
 * loads models
 * validates user token
 */
class Controller
{
    /**
     * Controller constructor.
     */
    public function __construct()
    {
        if(!empty($_SERVER['HTTP_AUTH_TOKEN'])){
            $this->userModel = $this->model('user');
            $this->auth($_SERVER['HTTP_AUTH_TOKEN']);
        }else{
            header('Location: index.php?route=error/forbidden');
        }
    }

    /**
     * @param string $model
     * @return object
     * Creates new model
     */
    protected function model(string $model):object
    {
        $model = 'Model\\' . $model;
        return new $model();
    }

    /**
     * @return object
     * Creates new view
     */
    protected function view():object
    {
        return new View();
    }

    /**
     * @param string $token
     * @return bool
     * User authentication
     */
    protected function auth(string $token): bool
    {
        if ($this->isTokenValid($token)) {
            $this->userModel->setToken($token);
            $user_id = $this->userModel->getUserIdByToken();
            $this->userModel->setId($user_id);
            return true;
        } else {
            return false;
        }

    }

    /**
     * Checks token
     * @param string $token
     * @return bool
     */
    private function isTokenValid(string $token): bool
    {
        if ($this->userModel->isTokenValid($token)) {
            return true;
        } else {
            return false;
        }
    }
}
