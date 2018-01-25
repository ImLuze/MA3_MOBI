<?php
ini_set('display_errors', true);
error_reporting(E_ALL);
session_start();

define('DS', DIRECTORY_SEPARATOR);
define('WWW_ROOT', __DIR__ . DS);

$routes = array(
  'home' => array(
    'controller' => 'Events',
    'action' => 'index'
  ),
  'events' => array(
    'controller' => 'Events',
    'action' => 'events'
  ),
  'detail' => array(
    'controller' => 'Events',
    'action' => 'detail'
  )
);

if(empty($_GET['page'])) {
  $_GET['page'] = 'home';
}
if(empty($routes[$_GET['page']])) {
  header('Location: index.php');
  exit();
}

$route = $routes[$_GET['page']];
$controllerName = $route['controller'] . 'Controller';

require_once WWW_ROOT . 'controller' . DS . $controllerName . ".php";

$controllerObj = new $controllerName();
$controllerObj->route = $route;
$controllerObj->filter();
$controllerObj->render();
