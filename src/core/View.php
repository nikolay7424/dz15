<?php


namespace Core;


/**
 * Class View
 * @package Core
 */
class View
{
    /**
     * @param string $view
     * @param null $data
     * Loads views
     */
    public function render(string $view, $data = null)
    {
        if(file_exists('views/' . $view . '.php'))
        {
            require_once 'views/' . $view . '.php';
        }
    }
}