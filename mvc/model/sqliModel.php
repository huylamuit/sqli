<?php 
require_once "./mvc/core/db.php";
class sqliModel{
    public function detection($text){
        $pythonScript = "./mvc/module/bi_lstm.py";
        $command = "python $pythonScript $text";
        $output = shell_exec($command);
        $result = json_decode($output, true);

        // Lấy kết quả dự đoán
        $predictionResult = $result['prediction'];
        echo "Prediction Result: $predictionResult";
    }
}
?>