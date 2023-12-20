<?php 
require_once "./mvc/core/db.php";
class sqliModel{
    public function detection($text){
        $data = array('text' => $text);
        $ch = curl_init('http://localhost:3400/predict');  // Replace with your API endpoint
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS,  json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
           'Content-Type: application/json'
        ]);
        $response = curl_exec($ch);

        if ($response === false) {
            echo 'cURL error: ' . curl_error($ch);
        } else {
            $result = json_decode($response, true);
            $threshold = 50;
            $result = round($result['prediction'] * 100,2);
            if($result > $threshold){
                echo "Câu lệnh có khả năng là SQLi với xác suất dự đoán: $result % ";
            }
            else
                echo "Câu lệnh không có khả năng là SQLi với xác suất dự đoán:  $result %  ";
        }
        
        curl_close($ch);
    }
}
?>