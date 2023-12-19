<?php
require_once "./mvc/core/controller.php";
class login extends controller {
    function show(){
        $user  = $this->model("userModel");
        $this->view("login", ["model"=>$user]);
    }
}
?>