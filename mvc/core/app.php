<?php
class app
{
  protected $controller = "home";
  protected $action = "show";
  protected $params = ["/"]; 
  function __construct()
  {
        $arr = $this->UrlProcess();
    
        
        #Lay controller
        if( file_exists("./mvc/controller/".$arr[0].".php")){
            $this->controller = $arr[0];
        }
        require_once "./mvc/controller/".$this->controller.".php";

        #Lay action
        if(isset($arr[1])){
            if(method_exists($this->controller,$arr[1])){
                $this->action = $arr[1];
            }
        }

        #Lay param
        $this->params = $arr?array_values($arr):[];

        call_user_func_array([ new $this->controller, $this->action], $this->params);
        
  }

  function UrlProcess(){
    if(isset($_GET["url"])){
        return explode("/", filter_var(trim($_GET["url"], "/")));
    }
  }
}