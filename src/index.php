<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once 'vendor/autoload.php';
require_once 'config/Config.php';

use Core\Router;

$router = new Router();

// curl http://localhost/dz15/src/index.php?route=articles/index --header "AUTH-Token: 123token"
// curl -d "title=title7&text=text7&id=1" -X POST http://localhost/dz15/src/index.php?route=articles/create --header "AUTH-Token: 123token"
// curl -X  PUT -d "title=new_title&text=new_text&article_id=4" http://localhost/dz15/src/index.php?route=articles/update --header "AUTH-Token: 123token"
// curl -d "title=title5&text=text5&article_id=1" -X PUT http://localhost/dz15/src/index.php?route=articles/update --header "AUTH-Token: 123token"
// curl -X  DELETE -d "article_id=5" http://localhost/dz15/src/index.php?route=articles/delete --header "AUTH-Token: 123token"