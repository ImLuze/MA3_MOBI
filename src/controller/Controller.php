<?php

class Controller {

  public $route;
  protected $viewVars = array();
  protected $isAjax = false;
  protected $env = 'development';

  public function filter() {
    //if we're running the project from a folder other than src, it means we're in production mode (dist)
    if(basename(dirname(dirname(__FILE__))) != 'src') {
      $this->env = 'production';
    }
    //if the request accept headers are set to json, we should send back json data instead of rendering html
    if(!empty($_SERVER['HTTP_ACCEPT']) && strtolower($_SERVER['HTTP_ACCEPT']) == 'application/json') {
      $this->isAjax = true;
    }
    //the variables css and js are set here and echo'd in layout.php
    //don't set a css link in development, as this is injected by webpack-dev-server
    $this->set('css', '');
    //link to the webpack-dev-server livereload script in development mode
    $this->set('js', '<script src="http://localhost:3000/js/script.js"></script>');
    if($this->env == 'production') {
      //link to the css file in production mode instead of no-css
      $this->set('css', '<link rel="stylesheet" href="css/style.css">');
      //link to the generated javascript file in production mode
      $this->set('js', '<script src="js/script.js"></script>');
    }
    //call the correct function in the controller
    call_user_func(array($this, $this->route['action']));
  }

  public function render() {
    $this->createViewVarWithContent();
    $this->renderInLayout();
    $this->cleanupSessionMessages();
  }

  public function set($variableName, $value) {
    $this->viewVars[$variableName] = $value;
  }

  public function redirect($url) {
    header("Location: {$url}");
    exit();
  }

  private function createViewVarWithContent() {
    extract($this->viewVars, EXTR_OVERWRITE);
    ob_start();
    require WWW_ROOT . 'view' . DS . strtolower($this->route['controller']) . DS . $this->route['action'] . '.php';
    $content = ob_get_clean();
    $this->set('content', $content);
  }

  private function renderInLayout() {
    extract($this->viewVars, EXTR_OVERWRITE);
    include WWW_ROOT . 'view' . DS . 'layout.php';
  }

  private function cleanupSessionMessages() {
    unset($_SESSION['info']);
    unset($_SESSION['error']);
  }

}
