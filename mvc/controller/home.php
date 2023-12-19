<?php
require_once "./mvc/core/controller.php";
class home extends controller {
    function show(){
        $model  = $this->model("sqliModel");
        $this->view("home", ["model"=>$model]);
    }
    function sqliDetection(){
        $inputText = $_POST['text'];
        $text = $_POST['text'];
        // Gọi hàm detection từ model
        $model  = $this->model("sqliModel");
        $result = $model->detection($text);
    
        // Trả về kết quả cho Ajax
        echo $result;
    }
}
?>