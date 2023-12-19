<?php 
require_once "./mvc/core/db.php";
class userModel extends db{
    public function login($user, $password){
        $qr = 'SELECT * FROM USER WHERE user  = "'.$user.'" AND password = "'.$password.'"';  
        echo $qr;
        return mysqli_query($this->con, $qr);
    }
}
?>